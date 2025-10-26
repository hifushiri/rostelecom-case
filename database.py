import aiosqlite
from datetime import datetime, timedelta
import logging

logger = logging.getLogger(__name__)

async def init_db():
    async with aiosqlite.connect('users.db') as db:
        await db.execute('''
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                email TEXT NOT NULL UNIQUE,
                password_hash TEXT NOT NULL,
                created_at TEXT NOT NULL
            )
        ''')
        await db.execute('''
            CREATE TABLE IF NOT EXISTS reset_codes (
                email TEXT NOT NULL,
                code TEXT NOT NULL,
                created_at TEXT NOT NULL,
                expires_at TEXT NOT NULL
            )
        ''')
        await db.execute('''
            CREATE TABLE IF NOT EXISTS projects (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                org_name TEXT NOT NULL,
                org_inn TEXT NOT NULL,
                project_name TEXT NOT NULL,
                service TEXT NOT NULL,
                payment_type TEXT NOT NULL,
                stage TEXT NOT NULL,
                probability INTEGER NOT NULL,
                manager TEXT NOT NULL,
                business_segment TEXT ,
                year TEXT NOT NULL,
                industry_manager TEXT NOT NULL,
                project_number TEXT NOT NULL,
                industry_solution BOOLEAN NOT NULL,
                forecast_accepted BOOLEAN NOT NULL,
                dzo_implementation BOOLEAN NOT NULL,
                management_control BOOLEAN NOT NULL,
                assessment_accepted TEXT NOT NULL,
                created_at TEXT NOT NULL,
                current_status TEXT,
                done_in_period TEXT,
                plans_for_next_period TEXT
            )
        ''')
        await db.execute('''
            CREATE TABLE IF NOT EXISTS revenues (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                project_id INTEGER NOT NULL,
                year INTEGER NOT NULL,
                month TEXT NOT NULL,
                amount REAL NOT NULL,
                status TEXT NOT NULL,
                FOREIGN KEY (project_id) REFERENCES projects(id)
            )
        ''')
        await db.execute('''
            CREATE TABLE IF NOT EXISTS costs (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                project_id INTEGER NOT NULL,
                year INTEGER NOT NULL,
                month TEXT NOT NULL,
                amount REAL NOT NULL,
                type TEXT NOT NULL,
                status TEXT NOT NULL,
                FOREIGN KEY (project_id) REFERENCES projects(id)
            )
        ''')
        await db.execute('''
            CREATE TABLE IF NOT EXISTS history (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                project_id INTEGER NOT NULL,
                parameter TEXT NOT NULL,
                date TEXT NOT NULL,
                user TEXT NOT NULL,
                change TEXT NOT NULL,
                FOREIGN KEY (project_id) REFERENCES projects(id)
            )
        ''')

        # Проверка и обновление схемы
        cursor = await db.execute('PRAGMA table_info(projects)')
        columns = await cursor.fetchall()
        column_names = [col[1] for col in columns]
        logger.info(f"Существующие столбцы в таблице projects: {column_names}")
        required_columns = {
            'org_name': 'TEXT NOT NULL',
            'org_inn': 'TEXT NOT NULL',
            'project_name': 'TEXT NOT NULL',
            'service': 'TEXT NOT NULL',
            'payment_type': 'TEXT NOT NULL',
            'stage': 'TEXT NOT NULL',
            'probability': 'INTEGER NOT NULL DEFAULT 50',
            'manager': 'TEXT NOT NULL',
            'business_segment': 'TEXT ',
            'year': 'TEXT NOT NULL',
            'industry_manager': 'TEXT NOT NULL',
            'project_number': 'TEXT NOT NULL',
            'industry_solution': 'BOOLEAN NOT NULL DEFAULT 0',
            'forecast_accepted': 'BOOLEAN NOT NULL DEFAULT 0',
            'dzo_implementation': 'BOOLEAN NOT NULL DEFAULT 0',
            'management_control': 'BOOLEAN NOT NULL DEFAULT 0',
            'assessment_accepted': 'TEXT NOT NULL',
            'created_at': 'TEXT NOT NULL',
            'current_status': 'TEXT',
            'done_in_period': 'TEXT',
            'plans_for_next_period': 'TEXT'
        }

        # Переименование segment в business_segment, если он существует
        if 'segment' in column_names and 'business_segment' not in column_names:
            logger.info("Переименование столбца segment в business_segment")
            await db.execute('ALTER TABLE projects RENAME COLUMN segment TO business_segment')

        # Добавление недостающих столбцов
        for col_name, col_type in required_columns.items():
            if col_name not in column_names:
                logger.info(f"Добавление столбца {col_name} в таблицу projects")
                await db.execute(f'ALTER TABLE projects ADD COLUMN {col_name} {col_type}')

        await db.commit()
        logger.info("База данных инициализирована")

async def create_user(name: str, email: str, password_hash: str) -> bool:
    try:
        async with aiosqlite.connect('users.db') as db:
            await db.execute(
                'INSERT INTO users (name, email, password_hash, created_at) VALUES (?, ?, ?, ?)',
                (name, email, password_hash, datetime.utcnow().isoformat())
            )
            await db.commit()
            return True
    except aiosqlite.IntegrityError:
        logger.error(f"Пользователь с email {email} уже существует")
        return False

async def get_user_by_email(email: str) -> dict:
    async with aiosqlite.connect('users.db') as db:
        db.row_factory = aiosqlite.Row
        cursor = await db.execute('SELECT * FROM users WHERE email = ?', (email,))
        user = await cursor.fetchone()
        return dict(user) if user else None

async def save_reset_code(email: str, code: str):
    async with aiosqlite.connect('users.db') as db:
        await db.execute('DELETE FROM reset_codes WHERE email = ?', (email,))
        expires_at = (datetime.utcnow() + timedelta(minutes=10)).isoformat()
        await db.execute(
            'INSERT INTO reset_codes (email, code, created_at, expires_at) VALUES (?, ?, ?, ?)',
            (email, code, datetime.utcnow().isoformat(), expires_at)
        )
        await db.commit()

async def verify_reset_code(email: str, code: str) -> bool:
    async with aiosqlite.connect('users.db') as db:
        db.row_factory = aiosqlite.Row
        cursor = await db.execute('SELECT code, expires_at FROM reset_codes WHERE email = ?', (email,))
        result = await cursor.fetchone()
        if result and result['code'] == code:
            expires_at = result['expires_at']
            if expires_at:
                expires_at = datetime.fromisoformat(expires_at)
                if datetime.utcnow() < expires_at:
                    await db.execute('DELETE FROM reset_codes WHERE email = ?', (email,))
                    await db.commit()
                    return True
            else:
                logger.warning(f"Столбец expires_at для {email} равен NULL, пропускаем проверку времени")
                await db.execute('DELETE FROM reset_codes WHERE email = ?', (email,))
                await db.commit()
                return True
        return False

async def update_user_password(email: str, password_hash: str):
    async with aiosqlite.connect('users.db') as db:
        await db.execute('UPDATE users SET password_hash = ? WHERE email = ?', (password_hash, email))
        await db.commit()

async def create_project(project: dict) -> int:
    async with aiosqlite.connect('users.db') as db:
        try:
            cursor = await db.execute(
                '''
                INSERT INTO projects (
                    org_name, org_inn, project_name, service, payment_type, stage, probability, manager,
                    business_segment, year, industry_manager, project_number, industry_solution,
                    forecast_accepted, dzo_implementation, management_control, assessment_accepted,
                    created_at, current_status, done_in_period, plans_for_next_period
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ''',
                (
                    project['org_name'], project['org_inn'], project['project_name'], project['service'],
                    project['payment_type'], project['stage'], project['probability'], project['manager'],
                    project['business_segment'], project['year'], project['industry_manager'],
                    project['project_number'], project['industry_solution'], project['forecast_accepted'],
                    project['dzo_implementation'], project['management_control'], project['assessment_accepted'],
                    project['created_at'], project['current_status'], project['done_in_period'],
                    project['plans_for_next_period']
                )
            )
            project_id = cursor.lastrowid
            for revenue in project.get('revenues', []):
                await db.execute(
                    '''
                    INSERT INTO revenues (project_id, year, month, amount, status)
                    VALUES (?, ?, ?, ?, ?)
                    ''',
                    (project_id, revenue['year'], revenue['month'], revenue['amount'], revenue['status'])
                )
            for cost in project.get('costs', []):
                await db.execute(
                    '''
                    INSERT INTO costs (project_id, year, month, amount, type, status)
                    VALUES (?, ?, ?, ?, ?, ?)
                    ''',
                    (project_id, cost['year'], cost['month'], cost['amount'], cost['type'], cost['status'])
                )
            for history in project.get('history', []):
                await db.execute(
                    '''
                    INSERT INTO history (project_id, parameter, date, user, change)
                    VALUES (?, ?, ?, ?, ?)
                    ''',
                    (project_id, history['parameter'], history['date'], history['user'], history['change'])
                )
            await db.commit()
            return project_id
        except aiosqlite.IntegrityError as e:
            logger.error(f"Ошибка при создании проекта: {str(e)}")
            raise

async def get_all_projects() -> list:
    async with aiosqlite.connect('users.db') as db:
        db.row_factory = aiosqlite.Row
        cursor = await db.execute('SELECT * FROM projects')
        projects = await cursor.fetchall()
        result = []
        for project in projects:
            project_dict = dict(project)
            cursor = await db.execute('SELECT * FROM revenues WHERE project_id = ?', (project['id'],))
            project_dict['revenues'] = [dict(row) for row in await cursor.fetchall()]
            cursor = await db.execute('SELECT * FROM costs WHERE project_id = ?', (project['id'],))
            project_dict['costs'] = [dict(row) for row in await cursor.fetchall()]
            cursor = await db.execute('SELECT * FROM history WHERE project_id = ?', (project['id'],))
            project_dict['history'] = [dict(row) for row in await cursor.fetchall()]
            result.append(project_dict)
        logger.info(f"Возвращаемые проекты: {result}")
        return result

async def get_project_metrics():
    async with aiosqlite.connect('users.db') as db:
        db.row_factory = aiosqlite.Row
        cursor = await db.execute('SELECT COUNT(*) AS total FROM projects')
        total_projects = (await cursor.fetchone())['total']
        logger.info(f"Всего проектов: {total_projects}")
        
        cursor = await db.execute('SELECT SUM(revenues.amount) AS total_amount FROM revenues')
        total_amount = (await cursor.fetchone())['total_amount'] or 0
        logger.info(f"Общая выручка: {total_amount}")
        
        cursor = await db.execute('SELECT SUM(revenues.amount * projects.probability / 100) AS total_prob_amount FROM projects JOIN revenues ON projects.id = revenues.project_id')
        total_prob_amount = (await cursor.fetchone())['total_prob_amount'] or 0
        logger.info(f"Общая вероятная выручка: {total_prob_amount}")
        
        cursor = await db.execute('SELECT stage, COUNT(*) AS count FROM projects GROUP BY stage')
        stages = await cursor.fetchall()
        stage_counts = {stage['stage']: stage['count'] for stage in stages}
        logger.info(f"Количество по этапам: {stage_counts}")
        
        cursor = await db.execute('SELECT projects.manager, COUNT(projects.id) AS count, SUM(revenues.amount) AS total_amount FROM projects LEFT JOIN revenues ON projects.id = revenues.project_id GROUP BY projects.manager')
        managers = await cursor.fetchall()
        manager_stats = {manager['manager']: {'count': manager['count'], 'amount': manager['total_amount'] or 0} for manager in managers}
        logger.info(f"Статистика менеджеров: {manager_stats}")
        
        avg_stage_times = {'Инициация': 20, 'Реализация': 45, 'Завершение': 10}
        return {
            'total_projects': total_projects,
            'total_amount': total_amount,
            'total_prob_amount': total_prob_amount,
            'stage_counts': stage_counts,
            'manager_stats': manager_stats,
            'avg_stage_times': avg_stage_times,
            'user_name': 'Иванов И.И.'
        }
        