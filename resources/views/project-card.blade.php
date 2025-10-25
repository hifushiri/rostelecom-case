<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Карточка проекта - Ростелеком Управление проектами</title>
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
        .project-card-container {
            max-width: 800px; /* Чуть шире для формы с таблицами */
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
        .history-table {
            max-height: 200px;
            overflow-y: auto;
        }
        @media (max-width: 640px) {
            .project-card-container {
                max-width: 100%; /* На мобильных вся ширина */
                margin: 1rem;
                padding: 1.5rem;
            }
            .history-table {
                max-height: none; /* Скролл допустим на мобильных */
            }
        }
    </style>
</head>
<body class="min-h-screen bg-gray-100">
    <div class="project-card-container">
        <!-- Логотип/Заголовок Ростелеком -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-[var(--rtk-red)]">Ростелеком</h1>
            <p class="text-sm text-[var(--rtk-gray)] mt-1">Управление проектами коммерческого подразделения</p>
        </div>

        <h2 class="text-2xl font-semibold text-center mb-6 text-[var(--rtk-gray)]">Карточка проекта</h2>

        <!-- Сообщение об ошибке (демо, скрыто) -->
        <div class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside">
                <li>Пожалуйста, заполните все обязательные поля</li>
            </ul>
        </div>

        <!-- Форма карточки проекта -->
        <form>
            <!-- Общая информация -->
            <div class="mb-6">
                <h3 class="section-title">Общая информация</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="org_name" class="block text-sm font-medium text-[var(--rtk-gray)]">Название организации</label>
                        <input type="text" id="org_name" name="org_name" placeholder="ООО Ромашка" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                    </div>
                    <div>
                        <label for="org_inn" class="block text-sm font-medium text-[var(--rtk-gray)]">ИНН организации</label>
                        <input type="text" id="org_inn" name="org_inn" placeholder="1234567890" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                    </div>
                    <div>
                        <label for="project_name" class="block text-sm font-medium text-[var(--rtk-gray)]">Название проекта</label>
                        <input type="text" id="project_name" name="project_name" placeholder="Подключение интернета" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                    </div>
                    <div>
                        <label for="service" class="block text-sm font-medium text-[var(--rtk-gray)]">Услуга</label>
                        <select id="service" name="service" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                            <option value="">Выберите услугу</option>
                            <option value="internet">Интернет</option>
                            <option value="tv">Телевидение</option>
                            <option value="cloud">Облачные услуги</option>
                        </select>
                    </div>
                    <div>
                        <label for="payment_type" class="block text-sm font-medium text-[var(--rtk-gray)]">Тип платежа</label>
                        <select id="payment_type" name="payment_type" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                            <option value="">Выберите тип</option>
                            <option value="prepaid">Предоплата</option>
                            <option value="postpaid">Постоплата</option>
                        </select>
                    </div>
                    <div>
                        <label for="stage" class="block text-sm font-medium text-[var(--rtk-gray)]">Этап проекта</label>
                        <select id="stage" name="stage" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                            <option value="">Выберите этап</option>
                            <option value="initiation">Инициация</option>
                            <option value="execution">Реализация</option>
                            <option value="completion">Завершение</option>
                        </select>
                    </div>
                    <div>
                        <label for="probability" class="block text-sm font-medium text-[var(--rtk-gray)]">Вероятность реализации (%)</label>
                        <input type="number" id="probability" name="probability" value="0" readonly
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 text-sm">
                    </div>
                    <div>
                        <label for="manager" class="block text-sm font-medium text-[var(--rtk-gray)]">Менеджер</label>
                        <input type="text" id="manager" name="manager" placeholder="Иванов И.И."
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                    </div>
                    <div>
                        <label for="business_segment" class="block text-sm font-medium text-[var(--rtk-gray)]">Сегмент бизнеса</label>
                        <select id="business_segment" name="business_segment" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                            <option value="">Выберите сегмент</option>
                            <option value="b2b">B2B</option>
                            <option value="b2c">B2C</option>
                            <option value="b2g">B2G</option>
                        </select>
                    </div>
                    <div>
                        <label for="year" class="block text-sm font-medium text-[var(--rtk-gray)]">Год реализации</label>
                        <input type="date" id="year" name="year" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                    </div>
                    <div>
                        <label for="industry_manager" class="block text-sm font-medium text-[var(--rtk-gray)]">Отраслевой менеджер</label>
                        <input type="text" id="industry_manager" name="industry_manager" placeholder="Петров П.П."
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                    </div>
                    <div>
                        <label for="project_number" class="block text-sm font-medium text-[var(--rtk-gray)]">Номер проекта</label>
                        <input type="text" id="project_number" name="project_number" placeholder="PRJ-001"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                    </div>
                </div>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="industry_solution" class="rounded border-gray-300 text-[var(--rtk-red)] focus:ring-[var(--rtk-red)]">
                        <span class="ml-2 text-sm text-[var(--rtk-gray)]">Отраслевое решение</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="forecast_accepted" class="rounded border-gray-300 text-[var(--rtk-red)] focus:ring-[var(--rtk-red)]">
                        <span class="ml-2 text-sm text-[var(--rtk-gray)]">Принимаемый к прогнозу</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="dzo_implementation" class="rounded border-gray-300 text-[var(--rtk-red)] focus:ring-[var(--rtk-red)]">
                        <span class="ml-2 text-sm text-[var(--rtk-gray)]">Реализация через ДЗО</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="management_control" class="rounded border-gray-300 text-[var(--rtk-red)] focus:ring-[var(--rtk-red)]">
                        <span class="ml-2 text-sm text-[var(--rtk-gray)]">Требуется контроль статуса</span>
                    </label>
                    <div>
                        <label for="assessment_accepted" class="block text-sm font-medium text-[var(--rtk-gray)]">Принимаемый к оценке</label>
                        <select id="assessment_accepted" name="assessment_accepted" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                            <option value="">Выберите значение</option>
                            <option value="yes">Да</option>
                            <option value="no">Нет</option>
                        </select>
                    </div>
                    <div>
                        <label for="created_at" class="block text-sm font-medium text-[var(--rtk-gray)]">Дата создания</label>
                        <input type="text" id="created_at" name="created_at" value="2025-10-25" readonly
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 text-sm">
                    </div>
                </div>
            </div>

            <!-- Информация по выручке -->
            <div class="mb-6">
                <h3 class="section-title">Информация по выручке</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Год</th>
                                <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Месяц</th>
                                <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Сумма (₽)</th>
                                <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Статус начисления</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border-b">
                                    <input type="number" name="revenue_year[]" placeholder="2025" class="w-full px-2 py-1 border border-gray-300 rounded-md text-sm">
                                </td>
                                <td class="py-2 px-4 border-b">
                                    <input type="text" name="revenue_month[]" placeholder="Январь" class="w-full px-2 py-1 border border-gray-300 rounded-md text-sm">
                                </td>
                                <td class="py-2 px-4 border-b">
                                    <input type="number" name="revenue_amount[]" placeholder="1000000" class="w-full px-2 py-1 border border-gray-300 rounded-md text-sm">
                                </td>
                                <td class="py-2 px-4 border-b">
                                    <select name="revenue_status[]" class="w-full px-2 py-1 border border-gray-300 rounded-md text-sm">
                                        <option value="">Выберите статус</option>
                                        <option value="accrued">Начислено</option>
                                        <option value="planned">Запланировано</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button type="button" class="mt-2 text-sm text-[var(--rtk-blue)] hover:underline">+ Добавить строку</button>
            </div>

            <!-- Информация по затратам -->
            <div class="mb-6">
                <h3 class="section-title">Информация по затратам</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Год</th>
                                <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Месяц</th>
                                <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Сумма (₽)</th>
                                <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Вид затрат</th>
                                <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Статус</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border-b">
                                    <input type="number" name="cost_year[]" placeholder="2025" class="w-full px-2 py-1 border border-gray-300 rounded-md text-sm">
                                </td>
                                <td class="py-2 px-4 border-b">
                                    <input type="text" name="cost_month[]" placeholder="Январь" class="w-full px-2 py-1 border border-gray-300 rounded-md text-sm">
                                </td>
                                <td class="py-2 px-4 border-b">
                                    <input type="number" name="cost_amount[]" placeholder="500000" class="w-full px-2 py-1 border border-gray-300 rounded-md text-sm">
                                </td>
                                <td class="py-2 px-4 border-b">
                                    <select name="cost_type[]" class="w-full px-2 py-1 border border-gray-300 rounded-md text-sm">
                                        <option value="">Выберите вид</option>
                                        <option value="equipment">Оборудование</option>
                                        <option value="services">Услуги</option>
                                    </select>
                                </td>
                                <td class="py-2 px-4 border-b">
                                    <select name="cost_status[]" class="w-full px-2 py-1 border border-gray-300 rounded-md text-sm">
                                        <option value="">Выберите статус</option>
                                        <option value="reflected">Отражено</option>
                                        <option value="planned">Запланировано</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button type="button" class="mt-2 text-sm text-[var(--rtk-blue)] hover:underline">+ Добавить строку</button>
            </div>

            <!-- Дополнительная информация -->
            <div class="mb-6">
                <h3 class="section-title">Дополнительная информация</h3>
                <div class="space-y-4">
                    <div>
                        <label for="current_status" class="block text-sm font-medium text-[var(--rtk-gray)]">Текущий статус (до 1000 символов)</label>
                        <textarea id="current_status" name="current_status" rows="4" maxlength="1000" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm" placeholder="Опишите текущий статус проекта"></textarea>
                    </div>
                    <div>
                        <label for="done_in_period" class="block text-sm font-medium text-[var(--rtk-gray)]">Что сделано за период (до 1000 символов)</label>
                        <textarea id="done_in_period" name="done_in_period" rows="4" maxlength="1000" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm" placeholder="Опишите достижения за период"></textarea>
                    </div>
                    <div>
                        <label for="plans_for_next_period" class="block text-sm font-medium text-[var(--rtk-gray)]">Планы на следующий период (до 1000 символов)</label>
                        <textarea id="plans_for_next_period" name="plans_for_next_period" rows="4" maxlength="1000" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm" placeholder="Опишите планы на следующий период"></textarea>
                    </div>
                </div>
            </div>

            <!-- История изменений -->
            <div class="mb-6">
                <h3 class="section-title">История изменений (последние 10)</h3>
                <div class="history-table overflow-x-auto">
                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Параметр</th>
                                <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Дата</th>
                                <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Пользователь</th>
                                <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Изменение</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border-b text-sm">Этап проекта</td>
                                <td class="py-2 px-4 border-b text-sm">2025-10-24</td>
                                <td class="py-2 px-4 border-b text-sm">Иванов И.И.</td>
                                <td class="py-2 px-4 border-b text-sm">Инициация → Реализация</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border-b text-sm">Сумма выручки</td>
                                <td class="py-2 px-4 border-b text-sm">2025-10-23</td>
                                <td class="py-2 px-4 border-b text-sm">Петров П.П.</td>
                                <td class="py-2 px-4 border-b text-sm">1,000,000 ₽ → 1,500,000 ₽</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Кнопки действий -->
            <div class="flex flex-col sm:flex-row gap-4">
                <button type="submit" class="btn-primary py-2 px-4 rounded-md font-medium text-base">
                    Сохранить
                </button>
                <button type="button" class="btn-secondary py-2 px-4 rounded-md font-medium text-base">
                    Печать карточки
                </button>
            </div>
        </form>

        <p class="mt-4 text-center text-sm text-[var(--rtk-gray)]">
            <a href="/dashboard" class="link-blue font-medium">Вернуться к списку проектов</a>
        </p>
    </div>
</body>
</html>