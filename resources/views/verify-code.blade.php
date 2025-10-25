<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Проверка кода - Ростелеком Управление проектами</title>
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
        .verify-container {
            max-width: 600px; /* Ширина для десктопа */
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
        .link-blue {
            color: var(--rtk-blue);
        }
        .link-blue:hover {
            text-decoration: underline;
        }
        @media (max-width: 640px) {
            .verify-container {
                max-width: 100%; /* На мобильных вся ширина */
                margin: 1rem; /* Меньшие отступы */
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="verify-container">
        <!-- Логотип/Заголовок Ростелеком -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-[var(--rtk-red)]">Ростелеком</h1>
            <p class="text-sm text-[var(--rtk-gray)] mt-1">Управление проектами коммерческого подразделения</p>
        </div>

        <h2 class="text-2xl font-semibold text-center mb-6 text-[var(--rtk-gray)]">Проверка кода</h2>

        <!-- Сообщение об успехе/ошибке -->
        <div id="successMessage" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            Все верно!
        </div>
        <div id="errorMessage" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside">
                <li>Неверный код</li>
            </ul>
        </div>

        <!-- Форма ввода кода -->
        <form id="verifyForm" action="/verify-code" method="POST">
            <div class="mb-4">
                <label for="code" class="block text-sm font-medium text-[var(--rtk-gray)]">Код из email</label>
                <input type="text" id="code" name="code" placeholder="Введите 6-значный код" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
            </div>

            <button type="submit" class="w-full btn-primary py-2 px-4 rounded-md font-medium text-base">
                Подтвердить
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-[var(--rtk-gray)]">
            <a href="/entrance" class="link-blue font-medium">Вернуться ко входу</a>
        </p>
    </div>

    <script>
        document.getElementById('verifyForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Отменяем отправку формы

            const code = document.getElementById('code').value;
            const errorMessage = document.getElementById('errorMessage');
            const successMessage = document.getElementById('successMessage');

            // Простая проверка: код должен быть "123456" (для демо)
            if (code === '123456') {
                errorMessage.classList.add('hidden');
                successMessage.classList.remove('hidden');
                setTimeout(() => {
                    window.location.href = '/newpage'; // Переход на /newpage через 1 секунду
                }, 1000);
            } else {
                successMessage.classList.add('hidden');
                errorMessage.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>