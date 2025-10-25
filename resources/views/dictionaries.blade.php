<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление справочниками - Ростелеком Управление проектами</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --rtk-red: #E30613; /* Основной красный Ростелеком */
            --rtk-dark-red: #B0050F; /* Темнее для ховера */
            --rtk-gray: #4A4A4A; /* Серый текст/фон */
            --rtk-light-gray: #F5F5F5; /* Светлый фон */
            --rtk-blue: #0054B9; /* Синий акцент */
            --rtk-white: #FFFFFF;
        }
        body {
            background-color: var(--rtk-light-gray);
            font-family: 'Arial', sans-serif;
        }
        .dictionaries-container {
            max-width: 1000px; /* Ширина для таблицы и формы */
            width: 100%;
            margin: 2rem auto; /* Отступы сверху и снизу */
            padding: 2rem; /* Компактные внутренние отступы */
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
            background-color: #003f8a; /* Темнее синего */
        }
        .btn-danger {
            background-color: #F87171;
            color: var(--rtk-white);
            transition: background-color 0.3s;
        }
        .btn-danger:hover {
            background-color: #EF4444;
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
        .dictionary-table {
            max-height: 400px;
            overflow-y: auto;
        }
        @media (max-width: 640px) {
            .dictionaries-container {
                max-width: 100%; /* На мобильных вся ширина */
                margin: 1rem;
                padding: 1.5rem;
            }
            .dictionary-table {
                max-height: none; /* Скролл допустим */
            }
        }
    </style>
</head>
<body class="min-h-screen bg-gray-100">
    <div class="dictionaries-container">
        <!-- Логотип/Заголовок Ростелеком -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-[var(--rtk-red)]">Ростелеком</h1>
            <p class="text-sm text-[var(--rtk-gray)] mt-1">Управление проектами коммерческого подразделения</p>
        </div>

        <h2 class="text-2xl font-semibold text-center mb-6 text-[var(--rtk-gray)]">Управление справочниками</h2>

        <!-- Сообщение об ошибке (демо, скрыто) -->
        <div class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside">
                <li>Пожалуйста, заполните все обязательные поля</li>
            </ul>
        </div>

        <!-- Выбор справочника -->
        <div class="mb-6">
            <h3 class="section-title">Выберите справочник</h3>
            <form>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="dictionary" class="block text-sm font-medium text-[var(--rtk-gray)]">Справочник</label>
                        <select id="dictionary" name="dictionary" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                            <option value="">Выберите справочник</option>
                            <option value="services">Услуги</option>
                            <option value="stages">Этапы проекта</option>
                            <option value="payment_types">Типы платежей</option>
                            <option value="business_segments">Сегменты бизнеса</option>
                            <option value="cost_types">Виды затрат</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-primary py-2 px-4 rounded-md font-medium text-base self-end">
                        Показать
                    </button>
                </div>
            </form>
        </div>

        <!-- Форма добавления/редактирования элемента справочника -->
        <div class="mb-8">
            <h3 class="section-title">Добавить/редактировать элемент справочника</h3>
            <form>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-[var(--rtk-gray)]">Название</label>
                        <input type="text" id="name" name="name" placeholder="Например, Интернет" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                    </div>
                    <div>
                        <label for="code" class="block text-sm font-medium text-[var(--rtk-gray)]">Код (опционально)</label>
                        <input type="text" id="code" name="code" placeholder="Например, INT"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
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

        <!-- Таблица элементов справочника -->
        <div>
            <h3 class="section-title">Список элементов (Услуги)</h3>
            <div class="dictionary-table overflow-x-auto">
                <table class="min-w-full border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Название</th>
                            <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Код</th>
                            <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b text-sm">Интернет</td>
                            <td class="py-2 px-4 border-b text-sm">INT</td>
                            <td class="py-2 px-4 border-b text-sm">
                                <button class="btn-secondary py-1 px-2 rounded-md text-xs mr-2">Редактировать</button>
                                <button class="btn-danger py-1 px-2 rounded-md text-xs">Удалить</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b text-sm">Телевидение</td>
                            <td class="py-2 px-4 border-b text-sm">TV</td>
                            <td class="py-2 px-4 border-b text-sm">
                                <button class="btn-secondary py-1 px-2 rounded-md text-xs mr-2">Редактировать</button>
                                <button class="btn-danger py-1 px-2 rounded-md text-xs">Удалить</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b text-sm">Облачные услуги</td>
                            <td class="py-2 px-4 border-b text-sm">CLOUD</td>
                            <td class="py-2 px-4 border-b text-sm">
                                <button class="btn-secondary py-1 px-2 rounded-md text-xs mr-2">Редактировать</button>
                                <button class="btn-danger py-1 px-2 rounded-md text-xs">Удалить</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <p class="mt-6 text-center text-sm text-[var(--rtk-gray)]">
            <a href="/dashboard" class="link-blue font-medium">Вернуться к дашборду</a>
        </p>
    </div>
</body>
</html>