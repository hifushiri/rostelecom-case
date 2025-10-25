<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ростелеком - Сведения о проекте</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --rtk-red: #E30613;
            --rtk-dark-red: #B0050F;
            --rtk-gray: #4A4A4A;
            --rtk-light-gray: #F5F5F5;
            --rtk-blue: #0054B9;
            --rtk-white: #FFFFFF;
        }
        body {
            background-color: var(--rtk-light-gray);
            font-family: 'Arial', sans-serif;
        }
        .dashboard-container {
            max-width: 1200px;
            width: 100%;
            margin: 2rem auto;
            padding: 2rem;
            background-color: var(--rtk-white);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: var(--rtk-red);
            color: var(--rtk-white);
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: var(--rtk-dark-red);
        }
        .btn-secondary {
            background-color: var(--rtk-blue);
            color: var(--rtk-white);
            transition: background-color 0.3s;
        }
        .btn-secondary:hover {
            background-color: #003f8a;
        }
        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--rtk-gray);
            margin-bottom: 1rem;
            margin-top: 1.5rem;
        }
        .gantt-chart {
            background-color: var(--rtk-light-gray);
            padding: 1rem;
            border-radius: 8px;
            height: 150px;
            position: relative;
        }
        .gantt-bar {
            position: absolute;
            height: 20px;
            border-radius: 4px;
        }
        .gantt-bar.initiation { background-color: var(--rtk-blue); }
        .gantt-bar.realization { background-color: var(--rtk-red); }
        .gantt-bar.completion { background-color: #34D399; }
        .gantt-bar.revenue { background-color: #10B981; height: 10px; top: 50px; }
        .gantt-bar.expense { background-color: #F87171; height: 10px; top: 70px; }
        @media (max-width: 640px) {
            .dashboard-container {
                max-width: 100%;
                margin: 1rem;
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body class="min-h-screen bg-gray-100">
    <!-- Шапка -->
    <div class="report-builder-container">
        <!-- Логотип/Заголовок Ростелеком -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-[var(--rtk-red)]">Ростелеком</h1>
            <p class="text-sm text-[var(--rtk-gray)] mt-1">Управление проектами коммерческого подразделения</p>
        </div>

        <h2 class="text-2xl font-semibold text-center mb-6 text-[var(--rtk-gray)]">Конструктор отчетов</h2>

        <!-- Форма конструктора отчетов -->

    <!-- Основной контент -->
    <div class="dashboard-container">
        <h2 class="text-xl md:text-2xl font-semibold text-[var(--rtk-gray)] mb-4">Сведения о проекте</h2>

        <!-- Общая информация -->
        <section class="mb-8">
            <h3 class="section-title">Общая информация</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <p><strong>Название организации:</strong> ООО Ромашка</p>
                    <p><strong>ИНН организации:</strong> 1234567890</p>
                    <p><strong>Название проекта:</strong> Подключение интернета</p>
                    <p><strong>Услуга:</strong> Интернет</p>
                    <p><strong>Тип платежа:</strong> Разовый</p>
                    <p><strong>Этап проекта:</strong> Реализация</p>
                    <p><strong>Вероятность реализации:</strong> 80%</p>
                </div>
                <div>
                    <p><strong>Менеджер:</strong> Иванов И.И.</p>
                    <p><strong>Сегмент бизнеса:</strong> B2B</p>
                    <p><strong>Год реализации:</strong> 2025</p>
                    <p><strong>Отраслевое решение:</strong> Да</p>
                    <p><strong>Принимаемый к прогнозу:</strong> Да</p>
                    <p><strong>Реализация через ДЗО:</strong> Нет</p>
                    <p><strong>Требуется контроль:</strong> Нет</p>
                    <p><strong>Отраслевой менеджер:</strong> Сидоров С.С.</p>
                    <p><strong>Номер проекта:</strong> PRJ-001</p>
                    <p><strong>Дата создания:</strong> 2025-01-15</p>
                </div>
            </div>
        </section>

        <!-- Выручка -->
        <section class="mb-8">
            <h3 class="section-title">Информация по выручке</h3>
            <table class="min-w-full bg-[var(--rtk-white)] border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Год</th>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Месяц</th>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Сумма</th>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Статус начисления</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-4 border-b">2025</td>
                        <td class="py-2 px-4 border-b">Январь</td>
                        <td class="py-2 px-4 border-b">1,500,000 ₽</td>
                        <td class="py-2 px-4 border-b">Начислено</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Затраты -->
        <section class="mb-8">
            <h3 class="section-title">Информация по затратам</h3>
            <table class="min-w-full bg-[var(--rtk-white)] border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Год</th>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Месяц</th>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Сумма</th>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Вид затрат</th>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Статус отражения</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-4 border-b">2025</td>
                        <td class="py-2 px-4 border-b">Январь</td>
                        <td class="py-2 px-4 border-b">500,000 ₽</td>
                        <td class="py-2 px-4 border-b">Оборудование</td>
                        <td class="py-2 px-4 border-b">Отражено</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Дополнительная информация -->
        <section class="mb-8">
            <h3 class="section-title">Дополнительная информация</h3>
            <div class="space-y-4">
                <p><strong>Текущий статус:</strong> Проект в стадии реализации, подключение оборудования завершено.</p>
                <p><strong>Что сделано за период:</strong> Проведены переговоры с клиентом, подписан договор.</p>
                <p><strong>Планы на следующий период:</strong> Настройка и тестирование сети.</p>
            </div>
        </section>

        <!-- История изменений -->
        <section class="mb-8">
            <h3 class="section-title">История изменений</h3>
            <table class="min-w-full bg-[var(--rtk-white)] border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Дата</th>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Пользователь</th>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Изменённый параметр</th>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Изменение</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-4 border-b">2025-01-15</td>
                        <td class="py-2 px-4 border-b">Иванов И.И.</td>
                        <td class="py-2 px-4 border-b">Этап проекта</td>
                        <td class="py-2 px-4 border-b">Инициация → Реализация</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b">2025-01-10</td>
                        <td class="py-2 px-4 border-b">Петров П.П.</td>
                        <td class="py-2 px-4 border-b">Сумма выручки</td>
                        <td class="py-2 px-4 border-b">1,200,000 ₽ → 1,500,000 ₽</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Диаграмма Ганта (пример) -->
        <section class="mb-8">
            <h3 class="section-title">Диаграмма Ганта</h3>
            <div class="gantt-chart">
                <div class="gantt-bar initiation" style="width: 20%; left: 0;">Инициация</div>
                <div class="gantt-bar realization" style="width: 30%; left: 20%;">Реализация</div>
                <div class="gantt-bar completion" style="width: 20%; left: 50%;">Завершение</div>
                <div class="gantt-bar revenue" style="width: 10%; left: 20%;">Выручка</div>
                <div class="gantt-bar expense" style="width: 10%; left: 25%;">Затраты</div>
            </div>
        </section>

        <!-- Кнопки -->
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="/newpage" class="btn-secondary px-4 py-2 rounded text-center">Вернуться на главную</a>
            <a href="/project-card?org=1234567890" class="btn-primary px-4 py-2 rounded text-center">Редактировать проект</a>
            <button class="btn-secondary px-4 py-2 rounded" onclick="window.print()">Печать</button>
        </div>
    </div>

    <!-- Футер -->
    <footer class="bg-gray-700 text-[var(--rtk-white)] text-center p-4 mt-8">
        <p>&copy; 2025 Ростелеком. Все права защищены.</p>
    </footer>
</body>
</html>