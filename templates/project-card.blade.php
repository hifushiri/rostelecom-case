<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Карточка проекта - Ростелеком</title>
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
        .project-card-container {
            max-width: 800px;
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
        #successMessage {
            animation: fadeIn 0.5s;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @media (max-width: 640px) {
            .project-card-container {
                max-width: 100%;
                margin: 1rem;
                padding: 1.5rem;
            }
            .history-table {
                max-height: none;
            }
        }
    </style>
</head>
<body class="min-h-screen bg-gray-100">
    <div class="project-card-container">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-[var(--rtk-red)]">Ростелеком</h1>
            <p class="text-sm text-[var(--rtk-gray)] mt-1">Управление проектами коммерческого подразделения</p>
        </div>

        <h2 class="text-2xl font-semibold text-center mb-6 text-[var(--rtk-gray)]">Карточка проекта</h2>

        <div id="errorMessage" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside"></ul>
        </div>
        <div id="successMessage" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            <p>Проект успешно добавлен! Перенаправляем...</p>
        </div>

        <form id="projectForm">
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
                        <select id="service" name="service" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                            <option value="internet" selected>Интернет</option>
                            <option value="tv">Телевидение</option>
                            <option value="cloud">Облачные услуги</option>
                        </select>
                    </div>
                    <div>
                        <label for="payment_type" class="block text-sm font-medium text-[var(--rtk-gray)]">Тип платежа</label>
                        <select id="payment_type" name="payment_type" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                            <option value="prepaid" selected>Предоплата</option>
                            <option value="postpaid">Постоплата</option>
                        </select>
                    </div>
                    <div>
                        <label for="stage" class="block text-sm font-medium text-[var(--rtk-gray)]">Этап проекта</label>
                        <select id="stage" name="stage" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                            <option value="Инициация" selected>Инициация</option>
                            <option value="Реализация">Реализация</option>
                            <option value="Завершение">Завершение</option>
                        </select>
                    </div>
                    <div>
                        <label for="probability" class="block text-sm font-medium text-[var(--rtk-gray)]">Вероятность реализации (%)</label>
                        <input type="number" id="probability" name="probability" min="0" max="100" value="50" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                    </div>
                    <div>
                        <label for="manager" class="block text-sm font-medium text-[var(--rtk-gray)]">Менеджер</label>
                        <input type="text" id="manager" name="manager" placeholder="Иванов И.И." required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                    </div>
                    <div>
                        <label for="business_segment" class="block text-sm font-medium text-[var(--rtk-gray)]">Сегмент бизнеса</label>
                        <select id="business_segment" name="business_segment" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                            <option value="B2B" selected>B2B</option>
                            <option value="B2C">B2C</option>
                            <option value="B2G">B2G</option>
                        </select>
                    </div>
                    <div>
                        <label for="year" class="block text-sm font-medium text-[var(--rtk-gray)]">Год реализации</label>
                        <input type="date" id="year" name="year" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                    </div>
                    <div>
                        <label for="industry_manager" class="block text-sm font-medium text-[var(--rtk-gray)]">Отраслевой менеджер</label>
                        <input type="text" id="industry_manager" name="industry_manager" placeholder="Петров П.П." required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                    </div>
                    <div>
                        <label for="project_number" class="block text-sm font-medium text-[var(--rtk-gray)]">Номер проекта</label>
                        <input type="text" id="project_number" name="project_number" placeholder="PRJ-001" required
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
                        <select id="assessment_accepted" name="assessment_accepted" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                            <option value="yes" selected>Да</option>
                            <option value="no">Нет</option>
                        </select>
                    </div>
                    <div>
                        <label for="created_at" class="block text-sm font-medium text-[var(--rtk-gray)]">Дата создания</label>
                        <input type="text" id="created_at" name="created_at" value="{{ current_date }}" readonly
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 text-sm">
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="section-title">Информация по выручке</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300" id="revenueTable">
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
                                        <option value="accrued" selected>Начислено</option>
                                        <option value="planned">Запланировано</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button type="button" id="addRevenueRow" class="mt-2 text-sm text-[var(--rtk-blue)] hover:underline">+ Добавить строку</button>
            </div>

            <div class="mb-6">
                <h3 class="section-title">Информация по затратам</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300" id="costTable">
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
                                        <option value="equipment" selected>Оборудование</option>
                                        <option value="services">Услуги</option>
                                    </select>
                                </td>
                                <td class="py-2 px-4 border-b">
                                    <select name="cost_status[]" class="w-full px-2 py-1 border border-gray-300 rounded-md text-sm">
                                        <option value="reflected" selected>Отражено</option>
                                        <option value="planned">Запланировано</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button type="button" id="addCostRow" class="mt-2 text-sm text-[var(--rtk-blue)] hover:underline">+ Добавить строку</button>
            </div>

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

            <div class="mb-6">
                <h3 class="section-title">История изменений (последние 10)</h3>
                <div class="history-table overflow-x-auto">
                    <table class="min-w-full border border-gray-300" id="historyTable">
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
                                <td class="py-2 px-4 border-b">
                                    <input type="text" name="history_parameter[]" placeholder="Этап проекта" class="w-full px-2 py-1 border border-gray-300 rounded-md text-sm">
                                </td>
                                <td class="py-2 px-4 border-b">
                                    <input type="date" name="history_date[]" class="w-full px-2 py-1 border border-gray-300 rounded-md text-sm">
                                </td>
                                <td class="py-2 px-4 border-b">
                                    <input type="text" name="history_user[]" placeholder="Иванов И.И." class="w-full px-2 py-1 border border-gray-300 rounded-md text-sm">
                                </td>
                                <td class="py-2 px-4 border-b">
                                    <input type="text" name="history_change[]" placeholder="Инициация → Реализация" class="w-full px-2 py-1 border border-gray-300 rounded-md text-sm">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button type="button" id="addHistoryRow" class="mt-2 text-sm text-[var(--rtk-blue)] hover:underline">+ Добавить строку</button>
            </div>

            <div class="flex flex-col sm:flex-row gap-4">
                <button type="submit" class="btn-primary py-2 px-4 rounded-md font-medium text-base">Сохранить</button>
                <a href="/newpage" class="btn-secondary py-2 px-4 rounded-md font-medium text-base text-center">Отмена</a>
            </div>
        </form>

        <p class="mt-4 text-center text-sm text-[var(--rtk-gray)]">
            <a href="/newpage" class="link-blue font-medium">Вернуться к списку проектов</a>
        </p>
    </div>

    <script>
        document.getElementById('addRevenueRow').addEventListener('click', function() {
            const tbody = document.querySelector('#revenueTable tbody');
            const row = document.createElement('tr');
            row.innerHTML = `
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
                        <option value="accrued" selected>Начислено</option>
                        <option value="planned">Запланировано</option>
                    </select>
                </td>
            `;
            tbody.appendChild(row);
        });

        document.getElementById('addCostRow').addEventListener('click', function() {
            const tbody = document.querySelector('#costTable tbody');
            const row = document.createElement('tr');
            row.innerHTML = `
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
                        <option value="equipment" selected>Оборудование</option>
                        <option value="services">Услуги</option>
                    </select>
                </td>
                <td class="py-2 px-4 border-b">
                    <select name="cost_status[]" class="w-full px-2 py-1 border border-gray-300 rounded-md text-sm">
                        <option value="reflected" selected>Отражено</option>
                        <option value="planned">Запланировано</option>
                    </select>
                </td>
            `;
            tbody.appendChild(row);
        });

        document.getElementById('addHistoryRow').addEventListener('click', function() {
            const tbody = document.querySelector('#historyTable tbody');
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="py-2 px-4 border-b">
                    <input type="text" name="history_parameter[]" placeholder="Этап проекта" class="w-full px-2 py-1 border border-gray-300 rounded-md text-sm">
                </td>
                <td class="py-2 px-4 border-b">
                    <input type="date" name="history_date[]" class="w-full px-2 py-1 border border-gray-300 rounded-md text-sm">
                </td>
                <td class="py-2 px-4 border-b">
                    <input type="text" name="history_user[]" placeholder="Иванов И.И." class="w-full px-2 py-1 border border-gray-300 rounded-md text-sm">
                </td>
                <td class="py-2 px-4 border-b">
                    <input type="text" name="history_change[]" placeholder="Инициация → Реализация" class="w-full px-2 py-1 border border-gray-300 rounded-md text-sm">
                </td>
            `;
            tbody.appendChild(row);
        });

        document.getElementById('projectForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const project = {
                org_name: formData.get('org_name'),
                org_inn: formData.get('org_inn'),
                project_name: formData.get('project_name'),
                service: formData.get('service'),
                payment_type: formData.get('payment_type'),
                stage: formData.get('stage'),
                probability: parseInt(formData.get('probability') || 0),
                manager: formData.get('manager'),
                business_segment: formData.get('business_segment'),
                year: formData.get('year'),
                industry_manager: formData.get('industry_manager'),
                project_number: formData.get('project_number'),
                industry_solution: formData.get('industry_solution') === 'on',
                forecast_accepted: formData.get('forecast_accepted') === 'on',
                dzo_implementation: formData.get('dzo_implementation') === 'on',
                management_control: formData.get('management_control') === 'on',
                assessment_accepted: formData.get('assessment_accepted'),
                created_at: formData.get('created_at'),
                current_status: formData.get('current_status') || null,
                done_in_period: formData.get('done_in_period') || null,
                plans_for_next_period: formData.get('plans_for_next_period') || null,
                revenues: [],
                costs: [],
                history: []
            };

            // Валидация business_segment
            if (!project.business_segment || project.business_segment === '') {
                const errorDiv = document.getElementById('errorMessage');
                errorDiv.classList.remove('hidden');
                errorDiv.querySelector('ul').innerHTML = `<li>Пожалуйста, выберите сегмент бизнеса</li>`;
                return;
            }

            const revenueYears = formData.getAll('revenue_year[]');
            const revenueMonths = formData.getAll('revenue_month[]');
            const revenueAmounts = formData.getAll('revenue_amount[]');
            const revenueStatuses = formData.getAll('revenue_status[]');
            for (let i = 0; i < revenueYears.length; i++) {
                if (revenueYears[i] && revenueMonths[i] && revenueAmounts[i] && revenueStatuses[i]) {
                    project.revenues.push({
                        year: parseInt(revenueYears[i]),
                        month: revenueMonths[i],
                        amount: parseFloat(revenueAmounts[i]),
                        status: revenueStatuses[i]
                    });
                }
            }

            const costYears = formData.getAll('cost_year[]');
            const costMonths = formData.getAll('cost_month[]');
            const costAmounts = formData.getAll('cost_amount[]');
            const costTypes = formData.getAll('cost_type[]');
            const costStatuses = formData.getAll('cost_status[]');
            for (let i = 0; i < costYears.length; i++) {
                if (costYears[i] && costMonths[i] && costAmounts[i] && costTypes[i] && costStatuses[i]) {
                    project.costs.push({
                        year: parseInt(costYears[i]),
                        month: costMonths[i],
                        amount: parseFloat(costAmounts[i]),
                        type: costTypes[i],
                        status: costStatuses[i]
                    });
                }
            }

            const historyParameters = formData.getAll('history_parameter[]');
            const historyDates = formData.getAll('history_date[]');
            const historyUsers = formData.getAll('history_user[]');
            const historyChanges = formData.getAll('history_change[]');
            for (let i = 0; i < historyParameters.length; i++) {
                if (historyParameters[i] && historyDates[i] && historyUsers[i] && historyChanges[i]) {
                    project.history.push({
                        parameter: historyParameters[i],
                        date: historyDates[i],
                        user: historyUsers[i],
                        change: historyChanges[i]
                    });
                }
            }

            console.log('Отправляем проект:', project);

            const errorDiv = document.getElementById('errorMessage');
            const successDiv = document.getElementById('successMessage');

            errorDiv.classList.add('hidden');
            successDiv.classList.add('hidden');

            try {
                const response = await fetch('/project', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(project)
                });
                const result = await response.json();
                if (response.ok) {
                    successDiv.classList.remove('hidden');
                    setTimeout(() => { window.location.href = '/newpage'; }, 2000);
                } else {
                    errorDiv.classList.remove('hidden');
                    errorDiv.querySelector('ul').innerHTML = `<li>${result.detail || 'Ошибка добавления проекта'}</li>`;
                }
            } catch (error) {
                errorDiv.classList.remove('hidden');
                errorDiv.querySelector('ul').innerHTML = `<li>Ошибка сети: ${error.message}</li>`;
            }
        });
    </script>
</body>
</html>