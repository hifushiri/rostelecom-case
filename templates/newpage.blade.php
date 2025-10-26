<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ростелеком - Список проектов</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
        .status-initiation { background-color: #E30613; color: #FFFFFF; }
        .status-execution { background-color: #0054B9; color: #FFFFFF; }
        .status-completion { background-color: #10B981; color: #FFFFFF; }
        .project-link {
            color: var(--rtk-blue);
            text-decoration: none;
        }
        .project-link:hover {
            text-decoration: underline;
        }
        .metrics-card {
            background-color: var(--rtk-light-gray);
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
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
            .metrics-card {
                padding: 0.5rem;
            }
        }
    </style>
</head>
<body class="min-h-screen bg-gray-100">
    <header class="header-container">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
            <div>
                <h1 class="text-3xl font-bold text-[var(--rtk-red)]">Ростелеком</h1>
                <p class="text-sm text-[var(--rtk-gray)] mt-1">Управление проектами коммерческого подразделения</p>
            </div>
            <nav class="nav-container flex flex-wrap gap-2 mt-4 sm:mt-0">
                <a href="/analytics-dashboard" class="btn-nav px-4 py-2 rounded text-sm"><i class="fas fa-chart-line mr-1"></i>Дашборд аналитики</a>
                <a href="/report-builder" class="btn-nav px-4 py-2 rounded text-sm"><i class="fas fa-file-alt mr-1"></i>Конструктор отчетов</a>
                <a href="/dictionaries" class="btn-nav px-4 py-2 rounded text-sm"><i class="fas fa-book mr-1"></i>Управление справочниками</a>
                <a href="/user-management" class="btn-nav px-4 py-2 rounded text-sm"><i class="fas fa-users mr-1"></i>Управление пользователями</a>
            </nav>
        </div>
    </header>

    <div class="dashboard-container">
        <div class="flex justify-end">
            <div class="user-panel">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-user text-[var(--rtk-gray)]"></i>
                    <span class="text-sm text-[var(--rtk-gray)]">{{ metrics.user_name | default("Иванов И.И.") }}</span>
                    <a href="/entrance" class="text-sm link-blue"><i class="fas fa-sign-out-alt mr-1"></i>Выйти</a>
                </div>
            </div>
        </div>

        <section class="mb-8">
            <h2 class="section-title">Аналитика проектов</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="metrics-card">
                    <h3 class="text-sm font-medium text-[var(--rtk-gray)]">Общее количество проектов</h3>
                    <p class="text-xl font-bold text-[var(--rtk-red)]">{{ metrics.total_projects }}</p>
                </div>
                <div class="metrics-card">
                    <h3 class="text-sm font-medium text-[var(--rtk-gray)]">Общая выручка (₽)</h3>
                    <p class="text-xl font-bold text-[var(--rtk-red)]">{{ "{:,.0f}".format(metrics.total_amount) }}</p>
                </div>
                <div class="metrics-card">
                    <h3 class="text-sm font-medium text-[var(--rtk-gray)]">Выручка с вероятностью (₽)</h3>
                    <p class="text-xl font-bold text-[var(--rtk-red)]">{{ "{:,.0f}".format(metrics.total_prob_amount) }}</p>
                </div>
                <div class="metrics-card">
                    <h3 class="text-sm font-medium text-[var(--rtk-gray)]">Проекты по стадиям</h3>
                    <ul class="text-sm text-[var(--rtk-gray)]">
                        {% for stage, count in metrics.stage_counts.items() %}
                        <li>{{ stage }}: {{ count }}</li>
                        {% endfor %}
                    </ul>
                </div>
                <div class="metrics-card">
                    <h3 class="text-sm font-medium text-[var(--rtk-gray)]">Статистика по менеджерам</h3>
                    <ul class="text-sm text-[var(--rtk-gray)]">
                        {% for manager, stats in metrics.manager_stats.items() %}
                        <li>{{ manager }}: {{ stats.count }} проектов, {{ "{:,.0f}".format(stats.amount) }} ₽</li>
                        {% endfor %}
                    </ul>
                </div>
                <div class="metrics-card">
                    <h3 class="text-sm font-medium text-[var(--rtk-gray)]">Среднее время на стадиях</h3>
                    <ul class="text-sm text-[var(--rtk-gray)]">
                        {% for stage, time in metrics.avg_stage_times.items() %}
                        <li>{{ stage }}: {{ time }} дней</li>
                        {% endfor %}
                    </ul>
                </div>
            </div>
        </section>

        <section class="mb-8">
            <h2 class="section-title">Реестр проектов</h2>
            <div class="flex flex-col sm:flex-row gap-4 mb-4">
                <select id="periodFilter" class="border border-gray-300 rounded p-2 flex-1">
                    <option value="week">Неделя</option>
                    <option value="month">Месяц</option>
                    <option value="quarter">Квартал</option>
                    <option value="custom">Произвольный период</option>
                </select>
                <button id="applyFilter" class="btn-secondary px-4 py-2 rounded text-[var(--rtk-white)]">Применить</button>
                <button id="exportExcel" class="btn-secondary px-4 py-2 rounded text-[var(--rtk-white)]">Экспорт в Excel</button>
                <button id="exportPDF" class="btn-secondary px-4 py-2 rounded text-[var(--rtk-white)]">Экспорт в PDF</button>
                <a href="/project-card" class="btn-primary px-4 py-2 rounded text-[var(--rtk-white)] text-center">Добавить проект</a>
            </div>
        </section>

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
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Сумма (₽)</th>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Сумма с вероятностью (₽)</th>
                        <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Статус</th>
                    </tr>
                </thead>
                <tbody>
                    {% for project in projects %}
                    <tr>
                        <td class="py-2 px-4 border-b text-sm">{{ project.business_segment }}</td>
                        <td class="py-2 px-4 border-b text-sm">{{ project.org_inn }}</td>
                        <td class="py-2 px-4 border-b text-sm">
                            <a href="/project-details?org={{ project.org_inn }}" class="project-link">{{ project.org_name }}</a>
                        </td>
                        <td class="py-2 px-4 border-b text-sm">{{ project.project_name }}</td>
                        <td class="py-2 px-4 border-b text-sm">{{ project.stage }}</td>
                        <td class="py-2 px-4 border-b text-sm">{{ project.year }}</td>
                        <td class="py-2 px-4 border-b text-sm">
                            {% if project.service == 'internet' %}
                                Интернет
                            {% elif project.service == 'tv' %}
                                Телевидение
                            {% elif project.service == 'cloud' %}
                                Облачные услуги
                            {% else %}
                                {{ project.service }}
                            {% endif %}
                        </td>
                        <td class="py-2 px-4 border-b text-sm">{{ project.manager }}</td>
                        <td class="py-2 px-4 border-b text-sm">
                            {% set total_revenue = project.revenues | sum(attribute='amount') %}
                            {{ "{:,.0f}".format(total_revenue) }}
                        </td>
                        <td class="py-2 px-4 border-b text-sm">
                            {{ "{:,.0f}".format(total_revenue * (project.probability / 100)) }}
                        </td>
                        <td class="py-2 px-4 border-b text-sm">
                            <span class="inline-block px-2 py-1 rounded text-xs 
                                {% if project.stage == 'Инициация' %}
                                    status-initiation
                                {% elif project.stage == 'Реализация' %}
                                    status-execution
                                {% elif project.stage == 'Завершение' %}
                                    status-completion
                                {% else %}
                                    bg-gray-200 text-[var(--rtk-gray)]
                                {% endif %}
                            ">
                                {{ project.stage }}
                            </span>
                        </td>
                    </tr>
                    {% else %}
                    <tr>
                        <td colspan="11" class="py-2 px-4 border-b text-center text-sm text-[var(--rtk-gray)]">
                            Нет проектов
                        </td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </section>
    </div>

    <script>
        document.getElementById('applyFilter').addEventListener('click', function() {
            const period = document.getElementById('periodFilter').value;
            alert('Фильтрация по периоду: ' + period + ' (функционал в разработке)');
        });

        document.getElementById('exportExcel').addEventListener('click', function() {
            alert('Экспорт в Excel (функционал в разработке)');
        });

        document.getElementById('exportPDF').addEventListener('click', function() {
            alert('Экспорт в PDF (функционал в разработке)');
        });
    </script>
</body>
</html>