<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация - Ростелеком Управление проектами</title>
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
        .register-container {
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
            .register-container {
                max-width: 100%; /* На мобильных вся ширина */
                margin: 1rem; /* Меньшие отступы */
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="register-container">
        <!-- Логотип/Заголовок Ростелеком -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-[var(--rtk-red)]">Ростелеком</h1>
            <p class="text-sm text-[var(--rtk-gray)] mt-1">Управление проектами коммерческого подразделения</p>
        </div>

        <h2 class="text-2xl font-semibold text-center mb-6 text-[var(--rtk-gray)]">Регистрация</h2>

        <!-- Сообщение об ошибке (демо, скрыто) -->
        <div class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside">
                <li>Пожалуйста, заполните все поля корректно</li>
            </ul>
        </div>

        <!-- Форма регистрации -->
        <form>
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-[var(--rtk-gray)]">ФИО</label>
                <input type="text" id="name" name="name" placeholder="Иванов Иван Иванович" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-[var(--rtk-gray)]">Email</label>
                <input type="email" id="email" name="email" placeholder="example@rostelecom.ru" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-[var(--rtk-gray)]">Пароль</label>
                <input type="password" id="password" name="password" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-[var(--rtk-gray)]">Подтверждение пароля</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
            </div>

            <button type="submit" class="w-full btn-primary py-2 px-4 rounded-md font-medium text-base">
                Зарегистрироваться
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-[var(--rtk-gray)]">
            Уже есть аккаунт? <a href="/login" class="link-blue font-medium">Войти</a>
        </p>
    </div>
</body>
</html>