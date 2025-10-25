<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление пользователями - Ростелеком Управление проектами</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Кастомные стили для статусов */
        .status-active {
            background-color: #10B981;
            color: var(--rtk-white);
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
        }
        .status-inactive {
            background-color: var(--rtk-gray);
            color: var(--rtk-white);
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
        }

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
        .user-management-container {
            max-width: 1000px;
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
        .btn-danger {
            background-color: #F87171;
            color: var(--rtk-white);
            transition: background-color 0.3s;
        }
        .btn-danger:hover {
            background-color: #EF4444;
        }
        .btn-back {
            background-color: var(--rtk-blue);
            color: var(--rtk-white);
            border-radius: 8px;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 36px;
            width: 36px;
        }
        .btn-back:hover {
            background-color: #003f8a;
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
        .users-table {
            max-height: 400px;
            overflow-y: auto;
        }
        @media (max-width: 640px) {
            .user-management-container {
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
            .users-table {
                max-height: none;
            }
            .btn-back {
                height: 32px;
                width: 32px;
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
    <div class="user-management-container">
        <!-- Панель пользователя и кнопка Назад -->
        <div class="flex justify-between items-center mb-4">
            <!-- Кнопка Назад -->
            <a href="/newpage" class="btn-back"><i class="fas fa-arrow-left text-[var(--rtk-white)]"></i></a>
            <!-- Панель пользователя -->
            <div class="user-panel">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-user text-[var(--rtk-gray)]"></i>
                    <span class="text-sm text-[var(--rtk-gray)]">Иванов И.И.</span>
                    <a href="/entrance" class="text-sm link-blue"><i class="fas fa-sign-out-alt mr-1"></i>Выйти</a>
                </div>
            </div>
        </div>

        <h2 class="text-2xl font-semibold text-center mb-6 text-[var(--rtk-gray)]">Управление пользователями</h2>

        <!-- Сообщение об ошибке (демо, скрыто) -->
        <div class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside">
                <li>Пожалуйста, заполните все обязательные поля</li>
            </ul>
        </div>

        <!-- Форма добавления/редактирования пользователя -->
        <div class="mb-8">
            <h3 class="section-title">Добавить/редактировать пользователя</h3>
            <form>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-[var(--rtk-gray)]">ФИО</label>
                        <input type="text" id="name" name="name" placeholder="Иванов Иван Иванович" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-[var(--rtk-gray)]">Email</label>
                        <input type="email" id="email" name="email" placeholder="example@rostelecom.ru" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                    </div>
                    <div>
                        <label for="role" class="block text-sm font-medium text-[var(--rtk-gray)]">Роль</label>
                        <select id="role" name="role" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                            <option value="">Выберите роль</option>
                            <option value="admin">Администратор</option>
                            <option value="analyst">Аналитик</option>
                            <option value="user">Пользователь</option>
                        </select>
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-[var(--rtk-gray)]">Статус</label>
                        <select id="status" name="status" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                            <option value="active">Активен</option>
                            <option value="inactive">Неактивен</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 flex flex-col sm:flex-row gap-4">
                    <button type="submit" class="btn-primary py-2 px-4 rounded-md font-medium text-base">
                        Сохранить
                    </button>
                    <button type="button" class="btn-secondary py-2 px-4 rounded-md font-medium text-base">
                        Очистить форму
                    </button>
                </div>
            </form>
        </div>

        <!-- Таблица пользователей -->
        <div>
            <h3 class="section-title">Список пользователей</h3>
            <div class="users-table overflow-x-auto">
                <table class="min-w-full border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">ФИО</th>
                            <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Email</th>
                            <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Роль</th>
                            <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Статус</th>
                            <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b text-sm">Иванов Иван Иванович</td>
                            <td class="py-2 px-4 border-b text-sm">ivanov@rostelecom.ru</td>
                            <td class="py-2 px-4 border-b text-sm">Администратор</td>
                            <td class="py-2 px-4 border-b"><span class="status-active">Активен</span></td>
                            <td class="py-2 px-4 border-b text-sm">
                                <button class="btn-secondary py-1 px-2 rounded-md text-xs mr-2">Редактировать</button>
                                <button class="btn-danger py-1 px-2 rounded-md text-xs">Удалить</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b text-sm">Петров Петр Петрович</td>
                            <td class="py-2 px-4 border-b text-sm">petrov@rostelecom.ru</td>
                            <td class="py-2 px-4 border-b text-sm">Аналитик</td>
                            <td class="py-2 px-4 border-b"><span class="status-active">Активен</span></td>
                            <td class="py-2 px-4 border-b text-sm">
                                <button class="btn-secondary py-1 px-2 rounded-md text-xs mr-2">Редактировать</button>
                                <button class="btn-danger py-1 px-2 rounded-md text-xs">Удалить</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b text-sm">Сидоров Сергей Сергеевич</td>
                            <td class="py-2 px-4 border-b text-sm">sidorov@rostelecom.ru</td>
                            <td class="py-2 px-4 border-b text-sm">Пользователь</td>
                            <td class="py-2 px-4 border-b"><span class="status-inactive">Неактивен</span></td>
                            <td class="py-2 px-4 border-b text-sm">
                                <button class="btn-secondary py-1 px-2 rounded-md text-xs mr-2">Редактировать</button>
                                <button class="btn-danger py-1 px-2 rounded-md text-xs">Удалить</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Футер -->
    <footer class="bg-gray-700 text-[var(--rtk-white)] text-center p-4 mt-8">
        <p>&copy; 2025 Ростелеком. Все права защищены.</p>
    </footer>
</body>
</html>