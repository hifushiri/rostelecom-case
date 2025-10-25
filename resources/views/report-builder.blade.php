<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Конструктор отчетов - Ростелеком Управление проектами</title>
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
        .report-builder-container {
            max-width: 1000px; /* Шире для формы и таблицы */
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
        .report-table {
            max-height: 400px;
            overflow-y: auto;
        }
        @media (max-width: 640px) {
            .report-builder-container {
                max-width: 100%; /* На мобильных вся ширина */
                margin: 1rem;
                padding: 1.5rem;
            }
            .report-table {
                max-height: none; /* Скролл допустим на мобильных */
            }
        }
    </style>
</head>
<body class="min-h-screen bg-gray-100">
    <div class="report-builder-container">
        <!-- Логотип/Заголовок Ростелеком -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-[var(--rtk-red)]">Ростелеком</h1>
            <p class="text-sm text-[var(--rtk-gray)] mt-1">Управление проектами коммерческого подразделения</p>
        </div>

        <h2 class="text-2xl font-semibold text-center mb-6 text-[var(--rtk-gray)]">Конструктор отчетов</h2>

        <!-- Форма конструктора отчетов -->
        <form class="mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Фильтры по параметрам -->
                <div>
                    <label for="segment" class="block text-sm font-medium text-[var(--rtk-gray)]">Сегмент бизнеса</label>
                    <select id="segment" name="segment" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                        <option value="">Все сегменты</option>
                        <option value="b2b">B2B</option>
                        <option value="b2c">B2C</option>
                        <option value="b2g">B2G</option>
                    </select>
                </div>
                <div>
                    <label for="stage" class="block text-sm font-medium text-[var(--rtk-gray)]">Этап проекта</label>
                    <select id="stage" name="stage" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                        <option value="">Все этапы</option>
                        <option value="initiation">Инициация</option>
                        <option value="execution">Реализация</option>
                        <option value="completion">Завершение</option>
                    </select>
                </div>
                <div>
                    <label for="service" class="block text-sm font-medium text-[var(--rtk-gray)]">Услуга</label>
                    <select id="service" name="service" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                        <option value="">Все услуги</option>
                        <option value="internet">Интернет</option>
                        <option value="tv">Телевидение</option>
                        <option value="cloud">Облачные услуги</option>
                    </select>
                </div>
                <div>
                    <label for="manager" class="block text-sm font-medium text-[var(--rtk-gray)]">Менеджер</label>
                    <input type="text" id="manager" name="manager" placeholder="Иванов И.И." class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                </div>
                <div>
                    <label for="year_from" class="block text-sm font-medium text-[var(--rtk-gray)]">Год реализации (от)</label>
                    <input type="number" id="year_from" name="year_from" placeholder="2024" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                </div>
                <div>
                    <label for="year_to" class="block text-sm font-medium text-[var(--rtk-gray)]">Год реализации (до)</label>
                    <input type="number" id="year_to" name="year_to" placeholder="2025" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                </div>
                <div>
                    <label for="probability_min" class="block text-sm font-medium text-[var(--rtk-gray)]">Вероятность реализации (мин, %)</label>
                    <input type="number" id="probability_min" name="probability_min" placeholder="0" min="0" max="100" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                </div>
                <div>
                    <label for="probability_max" class="block text-sm font-medium text-[var(--rtk-gray)]">Вероятность реализации (макс, %)</label>
                    <input type="number" id="probability_max" name="probability_max" placeholder="100" min="0" max="100" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                </div>
                <div>
                    <label for="revenue_min" class="block text-sm font-medium text-[var(--rtk-gray)]">Выручка (мин, ₽)</label>
                    <input type="number" id="revenue_min" name="revenue_min" placeholder="0" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                </div>
                <div>
                    <label for="revenue_max" class="block text-sm font-medium text-[var(--rtk-gray)]">Выручка (макс, ₽)</label>
                    <input type="number" id="revenue_max" name="revenue_max" placeholder="10000000" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                </div>
                <div class="md:col-span-2 lg:col-span-3">
                    <label class="flex items-center">
                        <input type="checkbox" name="include_history" class="rounded border-gray-300 text-[var(--rtk-red)] focus:ring-[var(--rtk-red)]">
                        <span class="ml-2 text-sm text-[var(--rtk-gray)]">Включить историю изменений</span>
                    </label>
                </div>
            </div>

            <!-- Кнопки действий -->
            <div class="mt-6 flex flex-col sm:flex-row gap-4">
                <button type="submit" class="btn-primary py-2 px-4 rounded-md font-medium text-base">
                    Сформировать отчет
                </button>
                <button type="button" class="btn-secondary py-2 px-4 rounded-md font-medium text-base">
                    Экспорт в Excel
                </button>
                <button type="button" class="btn-secondary py-2 px-4 rounded-md font-medium text-base">
                    Экспорт в PDF
                </button>
            </div>
        </form>

        <!-- Витрина отчета (результат) -->
        <div class="mt-8">
            <h3 class="section-title">Результат отчета</h3>
            <div class="report-table overflow-x-auto">
                <table class="min-w-full border border-gray-300">
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
                            <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Сумма (₽)</th>
                            <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Сумма с вероятностью (₽)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b text-sm">B2B</td>
                            <td class="py-2 px-4 border-b text-sm">1234567890</td>
                            <td class="py-2 px-4 border-b text-sm">ООО Ромашка</td>
                            <td class="py-2 px-4 border-b text-sm">Подключение интернета</td>
                            <td class="py-2 px-4 border-b text-sm">Реализация</td>
                            <td class="py-2 px-4 border-b text-sm">2025</td>
                            <td class="py-2 px-4 border-b text-sm">Интернет</td>
                            <td class="py-2 px-4 border-b text-sm">Иванов И.И.</td>
                            <td class="py-2 px-4 border-b text-sm">1,500,000</td>
                            <td class="py-2 px-4 border-b text-sm">1,200,000</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b text-sm">B2C</td>
                            <td class="py-2 px-4 border-b text-sm">0987654321</td>
                            <td class="py-2 px-4 border-b text-sm">ООО Лютик</td>
                            <td class="py-2 px-4 border-b text-sm">Телевидение</td>
                            <td class="py-2 px-4 border-b text-sm">Завершение</td>
                            <td class="py-2 px-4 border-b text-sm">2025</td>
                            <td class="py-2 px-4 border-b text-sm">ТВ</td>
                            <td class="py-2 px-4 border-b text-sm">Петров П.П.</td>
                            <td class="py-2 px-4 border-b text-sm">800,000</td>
                            <td class="py-2 px-4 border-b text-sm">800,000</td>
                        </tr>
                        <!-- Демо-строки, в реальности динамические -->
                    </tbody>
                </table>
            </div>
            <p class="mt-2 text-sm text-[var(--rtk-gray)] italic">Найдено 2 проекта. Общая выручка: 2,300,000 ₽ (с вероятностью: 2,000,000 ₽)</p>
        </div>

        <p class="mt-6 text-center text-sm text-[var(--rtk-gray)]">
            <a href="/dashboard" class="link-blue font-medium">Вернуться к дашборду</a>
        </p>
    </div>
</body>
</html>