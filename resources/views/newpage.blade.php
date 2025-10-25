<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ростелеком - Управление проектами</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Кастомные стили для индикации изменений */
        .status-new { background-color: #E30613; color: #FFFFFF; }
        .status-removed { background-color: #4A4A4A; color: #FFFFFF; }
        .status-stage-changed { background-color: #0054B9; color: #FFFFFF; }
        .status-revenue-up { background-color: #10B981; color: #FFFFFF; }
        .status-revenue-down { background-color: #F87171; color: #FFFFFF; }
        .status-transferred { background-color: #FBBF24; color: #4A4A4A; }
        .status-completed { background-color: #34D399; color: #4A4A4A; }

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
        .header-container {
            background: linear-gradient(to right, var(--rtk-white), #f8fafc);
            padding: 1.5rem 2rem;
            border-bottom: 2px solid var(--rtk-red);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .user-panel {
            display: inline-flex;
            align-items: center;
            background-color: var(--rtk-light-gray);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
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
        .btn-nav {
            background-color: var(--rtk-light-gray);
            color: var(--rtk-gray);
            transition: background-color 0.3s, color 0.3s;
        }
        .btn-nav:hover {
            background-color: var(--rtk-blue);
            color: var(--rtk-white);
        }
        .link-blue {
            color: var(--rtk-blue);
        }
        .link-blue:hover {
            text-decoration: underline;
        }
        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--rtk-gray);
            margin-bottom: 1rem;
            margin-top: 1.5rem;
        }
        .kpi-card {
            background-color: var(--rtk-light-gray);
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: transform 0.2s;
        }
        .kpi-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .project-link {
            color: var(--rtk-blue);
            text-decoration: none;
        }
        .project-link:hover {
            text-decoration: underline;
        }
        @media (max-width: 640px) {
            .dashboard-container {
                max-width: 100%;
                margin: 1rem;
                padding: 1.5rem;
            }
            .header-container {
                padding: 1rem;
            }
            .nav-container {
                flex-direction: column;
                align-items: flex-start;
            }
            .user-panel {
                flex-direction: column;
                align-items: flex-start;
                width: auto;
            }
        }
    </style>
</head>
<body class="min-h-screen bg-gray-100">
    <!-- Шапка -->
    <header class="header-container">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
            <!-- Логотип -->
            <div>
                <h1 class="text-3xl font-bold text-[var(--rtk-red)]">Ростелеком</h1>
                <p class="text-sm text-[var(--rtk-gray)] mt-1">Управление проектами коммерческого подразделения</p>
            </div>
            <!-- Навигация -->
            <nav class="nav-container flex flex-wrap gap-2 mt-4 sm:mt-0">
                <a href="/analytics-dashboard" class="btn-nav px-4 py-2 rounded text-sm"><i class="fas fa-chart-line mr-1"></i>Дашборд аналитики</a>
                <a href="/report-builder" class="btn-nav px-4 py-2 rounded text-sm"><i class="fas fa-file-alt mr-1"></i>Конструктор отчетов</a>
                <a href="/dictionaries" class="btn-nav px-4 py-2 rounded text-sm"><i class="fas fa-book mr-1"></i>Управление справочниками</a>
                <a href="/user-management" class="btn-nav px-4 py-2 rounded text-sm"><i class="fas fa-users mr-1"></i>Управление пользователями</a>
            </nav>
        </div>
    </header>

    <!-- Основной контент -->
    <div class="dashboard-container">
        <!-- Панель пользователя -->
        <div class="flex justify-end">
            <div class="user-panel">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-user text-[var(--rtk-gray)]"></i>
                    <span class="text-sm text-[var(--rtk-gray)]">Иванов И.И.</span>
                    <a href="/entrance" class="text-sm link-blue"><i class="fas fa-sign-out-alt mr-1"></i>Выйти</a>
                </div>
            </div>
        </div>

        <!-- Аналитика -->
        <section class="mb-8">
            <h2 class="text-xl md:text-2xl font-semibold text-[var(--rtk-gray)] mb-4">Аналитика проектов</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="kpi-card">
                    <h3 class="text-lg font-medium text-[var(--rtk-gray)] mb-2">Общее количество проектов</h3>
                    <p class="text-2xl font-bold text-[var(--rtk-red)]">125</p>
                </div>
                <div class="kpi-card">
                    <h3 class="text-lg font-medium text-[var(--rtk-gray)] mb-2">Общая выручка</h3>
                    <p class="text-2xl font-bold text-[var(--rtk-red)]">15,230,000 ₽</p>
                </div>
                <div class="kpi-card">
                    <h3 class="text-lg font-medium text-[var(--rtk-gray)] mb-2">Проекты по стадиям</h3>
                    <p class="text-sm text-[var(--rtk-gray)]">Инициация: 30</p>
                    <p class="text-sm text-[var(--rtk-gray)]">Реализация: 50</p>
                    <p class="text-sm text-[var(--rtk-gray)]">Завершение: 45</p>
                </div>
                <div class="kpi-card">
                    <h3 class="text-lg font-medium text-[var(--rtk-gray)] mb-2">По менеджерам</h3>
                    <p class="text-sm text-[var(--rtk-gray)]">Иванов: 40 (5,000,000 ₽)</p>
                    <p class="text-sm text-[var(--rtk-gray)]">Петров: 35 (4,200,000 ₽)</p>
                </div>
                <div class="kpi-card">
                    <h3 class="text-lg font-medium text-[var(--rtk-gray)] mb-2">Среднее время на стадиях</h3>
                    <p class="text-sm text-[var(--rtk-gray)]">Инициация: 20 дней</p>
                    <p class="text-sm text-[var(--rtk-gray)]">Реализация: 45 дней</p>
                    <p class="text-sm text-[var(--rtk-gray)]">Завершение: 10 дней</p>
                </div>
                <div class="kpi-card">
                    <h3 class="text-lg font-medium text-[var(--rtk-gray)] mb-2">Выручка с вероятностью</h3>
                    <p class="text-2xl font-bold text-[var(--rtk-red)]">12,180,000 ₽</p>
                </div>
            </div>
        </section>

        <!-- Фильтр периода и кнопка Добавить -->
        <section class="mb-8">
            <h2 class="text-xl md:text-2xl font-semibold text-[var(--rtk-gray)] mb-4">Реестр проектов</h2>
            <div class="flex flex-col sm:flex-row gap-4 mb-4">
                <select class="border border-gray-300 rounded p-2 flex-1">
                    <option>Неделя</option>
                    <option>Месяц</option>
                    <option>Квартал</option>
                    <option>Произвольный период</option>
                </select>
                <button class="btn-secondary px-4 py-2 rounded text-[var(--rtk-white)]">Применить</button>
                <button class="btn-secondary px-4 py-2 rounded text-[var(--rtk-white)]">Экспорт в Excel</button>
                <button class="btn-secondary px-4 py-2 rounded text-[var(--rtk-white)]">Экспорт в PDF</button>
                <a href="/project-card" class="btn-primary px-4 py-2 rounded text-[var(--rtk-white)] text-center">Добавить</a>
            </div>
        </section>

        <!-- Таблица реестра с ссылками на сведения о проекте -->
        <section class="overflow-x-auto">
            <table class="min-w-full bg-[var(--rtk-white)] border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Сегмент</th>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">ИНН</th>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Организация</th>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Проект</th>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Этап</th>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Год</th>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Услуга</th>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Менеджер</th>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Сумма</th>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Сумма с вероятностью</th>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Статус</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-4 border-b">B2B</td>
                        <td class="py-2 px-4 border-b">1234567890</td>
                        <td class="py-2 px-4 border-b"><a href="/project-details?org=1234567890" class="project-link">ООО Ромашка</a></td>
                        <td class="py-2 px-4 border-b">Подключение интернета</td>
                        <td class="py-2 px-4 border-b">Реализация</td>
                        <td class="py-2 px-4 border-b">2025</td>
                        <td class="py-2 px-4 border-b">Интернет</td>
                        <td class="py-2 px-4 border-b">Иванов И.И.</td>
                        <td class="py-2 px-4 border-b">1,500,000 ₽</td>
                        <td class="py-2 px-4 border-b">1,200,000 ₽</td>
                        <td class="py-2 px-4 border-b"><span class="status-new px-2 py-1 rounded text-sm">Новый</span></td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b">B2C</td>
                        <td class="py-2 px-4 border-b">0987654321</td>
                        <td class="py-2 px-4 border-b"><a href="/project-details?org=0987654321" class="project-link">ООО Лютик</a></td>
                        <td class="py-2 px-4 border-b">Телевидение</td>
                        <td class="py-2 px-4 border-b">Завершение</td>
                        <td class="py-2 px-4 border-b">2025</td>
                        <td class="py-2 px-4 border-b">ТВ</td>
                        <td class="py-2 px-4 border-b">Петров П.П.</td>
                        <td class="py-2 px-4 border-b">800,000 ₽</td>
                        <td class="py-2 px-4 border-b">800,000 ₽</td>
                        <td class="py-2 px-4 border-b"><span class="status-completed px-2 py-1 rounded text-sm">Завершён</span></td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b">B2G</td>
                        <td class="py-2 px-4 border-b">1122334455</td>
                        <td class="py-2 px-4 border-b"><a href="/project-details?org=1122334455" class="project-link">Гос. учреждение</a></td>
                        <td class="py-2 px-4 border-b">Цифровизация</td>
                        <td class="py-2 px-4 border-b">Инициация</td>
                        <td class="py-2 px-4 border-b">2025</td>
                        <td class="py-2 px-4 border-b">Облачные услуги</td>
                        <td class="py-2 px-4 border-b">Сидоров С.С.</td>
                        <td class="py-2 px-4 border-b">2,000,000 ₽</td>
                        <td class="py-2 px-4 border-b">1,000,000 ₽</td>
                        <td class="py-2 px-4 border-b"><span class="status-revenue-up px-2 py-1 rounded text-sm">Выручка +</span></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>

    <!-- Футер -->
    <footer class="bg-gray-700 text-[var(--rtk-white)] text-center p-4 mt-8">
        <p>&copy; 2025 Ростелеком. Все права защищены.</p>
    </footer>
</body>
</html>