<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аналитический дашборд - Ростелеком Управление проектами</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/frappe-gantt@0.6.1/dist/frappe-gantt.css">
    <script src="https://cdn.jsdelivr.net/npm/frappe-gantt@0.6.1/dist/frappe-gantt.min.js"></script>
    <style>
        :root {
            --rtk-red: #E30613;
            --rtk-dark-red: #B0050F;
            --rtk-gray: #4A4A4A;
            --rtk-light-gray: #F5F5F5;
            --rtk-blue: #0054B9;
            --rtk-white: #FFFFFF;
            --rtk-light-red: #FF4D5A;
            --rtk-light-blue: #3366CC;
            --rtk-gray-blue: #667799;
            --rtk-gold: #FFD700;
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
        .chart-container {
            height: 300px;
            margin-bottom: 2rem;
        }
        .gantt-container {
            height: 600px;
            margin-bottom: 2rem;
        }
        .projects-table {
            max-height: 400px;
            overflow-y: auto;
        }
        .status-indicator {
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            color: var(--rtk-white);
        }
        .status-new { background-color: var(--rtk-red); }
        .status-removed { background-color: var(--rtk-gray); }
        .status-stage-up { background-color: var(--rtk-blue); }
        .status-revenue-up { background-color: #10B981; }
        .status-revenue-down { background-color: #F87171; }
        @media (max-width: 640px) {
            .dashboard-container {
                max-width: 100%;
                margin: 1rem;
                padding: 1.5rem;
            }
            .chart-container {
                height: 200px;
            }
            .gantt-container {
                height: 400px;
            }
            .projects-table {
                max-height: none;
            }
        }
    </style>
</head>
<body class="min-h-screen bg-gray-100">
    <div class="dashboard-container">
        <!-- Логотип/Заголовок Ростелеком -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-[var(--rtk-red)]">Ростелеком</h1>
            <p class="text-sm text-[var(--rtk-gray)] mt-1">Управление проектами коммерческого подразделения</p>
        </div>

        <h2 class="text-2xl font-semibold text-center mb-6 text-[var(--rtk-gray)]">Аналитический дашборд</h2>

        <!-- Фильтры для дашборда -->
        <div class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="period" class="block text-sm font-medium text-[var(--rtk-gray)]">Период</label>
                <select id="period" name="period" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                    <option value="week">Неделя</option>
                    <option value="month" selected>Месяц</option>
                    <option value="quarter">Квартал</option>
                    <option value="custom">Произвольный</option>
                </select>
            </div>
            <div>
                <label for="segment" class="block text-sm font-medium text-[var(--rtk-gray)]">Сегмент</label>
                <select id="segment" name="segment" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                    <option value="">Все сегменты</option>
                    <option value="b2b">B2B</option>
                    <option value="b2c">B2C</option>
                    <option value="b2g">B2G</option>
                </select>
            </div>
            <div>
                <label for="chart-type" class="block text-sm font-medium text-[var(--rtk-gray)]">Тип графика</label>
                <select id="chart-type" name="chart-type" onchange="toggleChart()" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
                    <option value="stages">Круговая (Проекты по стадиям)</option>
                    <option value="managers">Столбчатая (Выручка по менеджерам)</option>
                    <option value="segments">Круговая (Проекты по сегментам)</option>
                    <option value="stage_times">Столбчатая (Среднее время на стадиях)</option>
                    <option value="weighted_revenue">Линейная (Выручка с учетом вероятности)</option>
                    <option value="gantt">Диаграмма Ганта</option>
                </select>
            </div>
            <button class="btn-primary py-2 px-4 rounded-md font-medium text-base self-end">
                Применить фильтры
            </button>
        </div>

        <!-- Аналитические карточки -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-gray-50 p-4 rounded-md shadow">
                <h3 class="text-sm font-medium text-[var(--rtk-gray)]">Общее количество проектов</h3>
                <p class="text-2xl font-bold text-[var(--rtk-red)]">125</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-md shadow">
                <h3 class="text-sm font-medium text-[var(--rtk-gray)]">Общая выручка</h3>
                <p class="text-2xl font-bold text-[var(--rtk-red)]">15,230,000 ₽</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-md shadow">
                <h3 class="text-sm font-medium text-[var(--rtk-gray)]">Выручка с вероятностью</h3>
                <p class="text-2xl font-bold text-[var(--rtk-red)]">12,180,000 ₽</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-md shadow">
                <h3 class="text-sm font-medium text-[var(--rtk-gray)]">Среднее время на стадиях</h3>
                <p class="text-sm">Инициация: 20 дней</p>
                <p class="text-sm">Реализация: 45 дней</p>
                <p class="text-sm">Завершение: 10 дней</p>
            </div>
        </div>

        <!-- Графики аналитики -->
        <div class="mb-8">
            <div id="stages-chart" class="chart-container">
                <h3 class="section-title">Проекты по стадиям</h3>
                <canvas id="stagesChart"></canvas>
            </div>
            <div id="managers-chart" class="chart-container hidden">
                <h3 class="section-title">Выручка по менеджерам</h3>
                <canvas id="managersChart"></canvas>
            </div>
            <div id="segments-chart" class="chart-container hidden">
                <h3 class="section-title">Проекты по сегментам</h3>
                <canvas id="segmentsChart"></canvas>
            </div>
            <div id="stage_times-chart" class="chart-container hidden">
                <h3 class="section-title">Среднее время на стадиях</h3>
                <canvas id="stageTimesChart"></canvas>
            </div>
            <div id="weighted_revenue-chart" class="chart-container hidden">
                <h3 class="section-title">Выручка с учетом вероятности</h3>
                <canvas id="weightedRevenueChart"></canvas>
            </div>
            <div id="gantt-chart" class="gantt-container hidden">
                <h3 class="section-title">Диаграмма Ганта</h3>
                <div id="ganttChart"></div>
            </div>
        </div>

        <!-- Реестр проектов с индикацией -->
        <div>
            <h3 class="section-title">Реестр проектов</h3>
            <div class="projects-table overflow-x-auto">
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
                            <th class="py-2 px-4 border-b text-left text-sm text-[var(--rtk-gray)]">Изменения</th>
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
                            <td class="py-2 px-4 border-b"><span class="status-indicator status-new">Новый</span></td>
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
                            <td class="py-2 px-4 border-b"><span class="status-indicator status-revenue-up">Выручка +</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <p class="mt-6 text-center text-sm text-[var(--rtk-gray)]">
            <a href="/dashboard" class="link-blue font-medium">Вернуться к основному дашборду</a>
        </p>
    </div>

    <!-- Скрипты для графиков -->
    <script>
        function toggleChart() {
            const chartType = document.getElementById('chart-type').value;
            const charts = ['stages-chart', 'managers-chart', 'segments-chart', 'stage_times-chart', 'weighted_revenue-chart', 'gantt-chart'];
            charts.forEach(chart => {
                const element = document.getElementById(chart);
                if (element) {
                    element.classList.add('hidden');
                    if (chart === chartType + '-chart') {
                        element.classList.remove('hidden');
                        if (chart === 'gantt-chart') {
                            initializeGanttChart();
                        }
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            toggleChart();
        });

        // Круговая: Проекты по стадиям
        const stagesCtx = document.getElementById('stagesChart').getContext('2d');
        const stagesChart = new Chart(stagesCtx, {
            type: 'pie',
            data: {
                labels: ['Инициация', 'Реализация', 'Завершение', 'Планирование'],
                datasets: [{
                    label: 'Количество проектов',
                    data: [30, 50, 45, 20],
                    backgroundColor: [
                        'rgba(227, 6, 19, 0.8)', // --rtk-red с прозрачностью
                        'rgba(0, 84, 185, 0.8)', // --rtk-blue
                        'rgba(255, 215, 0, 0.8)', // --rtk-gold
                        'rgba(102, 119, 153, 0.8)' // --rtk-gray-blue
                    ],
                    borderColor: [
                        'var(--rtk-red)',
                        'var(--rtk-blue)',
                        'var(--rtk-gold)',
                        'var(--rtk-gray-blue)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // Столбчатая: Выручка по менеджерам
        const managersCtx = document.getElementById('managersChart').getContext('2d');
        const managersChart = new Chart(managersCtx, {
            type: 'bar',
            data: {
                labels: ['Иванов', 'Петров', 'Сидоров', 'Кузнецова'],
                datasets: [{
                    label: 'Выручка (₽)',
                    data: [5000000, 4200000, 3000000, 3500000],
                    backgroundColor: [
                        'rgba(0, 84, 185, 0.8)', // --rtk-blue
                        'rgba(51, 102, 204, 0.8)', // --rtk-light-blue
                        'rgba(227, 6, 19, 0.8)', // --rtk-red
                        'rgba(255, 77, 90, 0.8)' // --rtk-light-red
                    ],
                    borderColor: [
                        'var(--rtk-blue)',
                        'var(--rtk-light-blue)',
                        'var(--rtk-red)',
                        'var(--rtk-light-red)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                },
                plugins: {
                    legend: { position: 'top' }
                }
            }
        });

        // Круговая: Проекты по сегментам
        const segmentsCtx = document.getElementById('segmentsChart').getContext('2d');
        const segmentsChart = new Chart(segmentsCtx, {
            type: 'pie',
            data: {
                labels: ['B2B', 'B2C', 'B2G'],
                datasets: [{
                    label: 'Проекты по сегментам',
                    data: [60, 40, 25],
                    backgroundColor: [
                        'rgba(227, 6, 19, 0.8)', // --rtk-red
                        'rgba(0, 84, 185, 0.8)', // --rtk-blue
                        'rgba(255, 215, 0, 0.8)' // --rtk-gold
                    ],
                    borderColor: [
                        'var(--rtk-red)',
                        'var(--rtk-blue)',
                        'var(--rtk-gold)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // Столбчатая: Среднее время на стадиях
        const stageTimesCtx = document.getElementById('stageTimesChart').getContext('2d');
        const stageTimesChart = new Chart(stageTimesCtx, {
            type: 'bar',
            data: {
                labels: ['Инициация', 'Реализация', 'Завершение'],
                datasets: [{
                    label: 'Среднее время (дни)',
                    data: [20, 45, 10],
                    backgroundColor: [
                        'rgba(255, 77, 90, 0.8)', // --rtk-light-red
                        'rgba(227, 6, 19, 0.8)', // --rtk-red
                        'rgba(255, 215, 0, 0.8)' // --rtk-gold
                    ],
                    borderColor: [
                        'var(--rtk-light-red)',
                        'var(--rtk-red)',
                        'var(--rtk-gold)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                },
                plugins: {
                    legend: { position: 'top' }
                }
            }
        });

        // Линейная: Выручка с учетом вероятности
        const weightedRevenueCtx = document.getElementById('weightedRevenueChart').getContext('2d');
        const weightedRevenueChart = new Chart(weightedRevenueCtx, {
            type: 'line',
            data: {
                labels: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн'],
                datasets: [
                    {
                        label: 'Плановая выручка',
                        data: [4000000, 6000000, 8000000, 7000000, 9000000, 10000000],
                        borderColor: 'var(--rtk-blue)',
                        backgroundColor: 'rgba(0, 84, 185, 0.2)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Выручка с учетом вероятности',
                        data: [3200000, 4500000, 5600000, 4900000, 6300000, 7000000],
                        borderColor: 'var(--rtk-red)',
                        backgroundColor: 'rgba(227, 6, 19, 0.2)',
                        fill: true,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                },
                plugins: {
                    legend: { position: 'top' }
                }
            }
        });

        // Диаграмма Ганта
        function initializeGanttChart() {
            const container = document.getElementById('ganttChart');
            if (!container || typeof Gantt === 'undefined') {
                console.error('Gantt container or library not found');
                return;
            }
            const tasks = [
                {
                    id: 'task-1',
                    name: 'Анализ требований',
                    start: '2025-10-01',
                    end: '2025-10-05',
                    progress: 100,
                    custom_class: 'gantt-red'
                },
                {
                    id: 'task-2',
                    name: 'Проектирование',
                    start: '2025-10-03',
                    end: '2025-10-10',
                    progress: 100,
                    dependencies: 'task-1',
                    custom_class: 'gantt-blue'
                },
                {
                    id: 'task-3',
                    name: 'Разработка',
                    start: '2025-10-08',
                    end: '2025-10-20',
                    progress: 75,
                    dependencies: 'task-2',
                    custom_class: 'gantt-light-blue'
                },
                {
                    id: 'task-4',
                    name: 'Тестирование',
                    start: '2025-10-15',
                    end: '2025-10-25',
                    progress: 60,
                    dependencies: 'task-3',
                    custom_class: 'gantt-gold'
                },
                {
                    id: 'task-5',
                    name: 'Внедрение',
                    start: '2025-10-22',
                    end: '2025-10-30',
                    progress: 30,
                    dependencies: 'task-4',
                    custom_class: 'gantt-gray-blue'
                }
            ];
            const ganttChart = new Gantt('#ganttChart', tasks, {
                view_mode: 'Week',
                language: 'ru',
                custom_popup_html: function(task) {
                    return `
                        <div class="p-2" style="min-width: 200px;">
                            <h6>${task.name}</h6>
                            <p>Начало: ${new Date(task.start).toLocaleDateString('ru-RU')}</p>
                            <p>Конец: ${new Date(task.end).toLocaleDateString('ru-RU')}</p>
                            <p>Прогресс: ${task.progress}%</p>
                        </div>
                    `;
                }
            });
        }
    </script>

    <style>
        .gantt-red .bar { fill: var(--rtk-red); }
        .gantt-blue .bar { fill: var(--rtk-blue); }
        .gantt-light-blue .bar { fill: var(--rtk-light-blue); }
        .gantt-gold .bar { fill: var(--rtk-gold); }
        .gantt-gray-blue .bar { fill: var(--rtk-gray-blue); }
    </style>
</body>
</html>