<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход - Ростелеком Управление проектами</title>
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
        .login-container {
            max-width: 600px;
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
        @media (max-width: 640px) {
            .login-container {
                max-width: 100%;
                margin: 1rem;
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="login-container">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-[var(--rtk-red)]">Ростелеком</h1>
            <p class="text-sm text-[var(--rtk-gray)] mt-1">Управление проектами коммерческого подразделения</p>
        </div>
        <h2 class="text-2xl font-semibold text-center mb-6 text-[var(--rtk-gray)]">Вход</h2>
        
        <div id="errorMessage" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside"></ul>
        </div>
        <div id="successMessage" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            <p>Вход успешен! Перенаправляем на подтверждение...</p>
        </div>

        <form id="loginForm">
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-[var(--rtk-gray)]">Email</label>
                <input type="email" id="email" name="email" placeholder="example@rostelecom.ru" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-[var(--rtk-gray)]">Пароль</label>
                <input type="password" id="password" name="password" required minlength="8" maxlength="72"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
            </div>
            <div class="mb-4 flex items-center">
                <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-[var(--rtk-red)] focus:ring-[var(--rtk-red)] border-gray-300 rounded">
                <label for="remember" class="ml-2 text-sm text-[var(--rtk-gray)]">Запомнить меня</label>
            </div>
            <button type="submit" class="w-full btn-primary py-2 px-4 rounded-md font-medium text-base">
                Войти
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-[var(--rtk-gray)]">
            Нет аккаунта? <a href="/registration" class="link-blue font-medium">Зарегистрироваться</a>
        </p>
        <p class="mt-2 text-center text-sm text-[var(--rtk-gray)]">
            <a href="/forgot-password" class="link-blue font-medium">Забыли пароль?</a>
        </p>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const remember = document.getElementById('remember').checked;
            const errorDiv = document.getElementById('errorMessage');
            const successDiv = document.getElementById('successMessage');

            // Сброс сообщений
            errorDiv.classList.add('hidden');
            successDiv.classList.add('hidden');

            // Проверка длины пароля
            if (password.length < 8) {
                errorDiv.classList.remove('hidden');
                errorDiv.querySelector('ul').innerHTML = `<li>Пароль должен содержать минимум 8 символов</li>`;
                return;
            }

            // Ограничение длины пароля до 72 байт
            const encoder = new TextEncoder();
            const byteLength = encoder.encode(password).length;
            console.log(`Отправляемый пароль: длина ${password.length} символов, ${byteLength} байт`);
            const trimmedPassword = new TextDecoder('utf-8').decode(encoder.encode(password).slice(0, 72));

            try {
                const response = await fetch('/login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, password: trimmedPassword, remember })
                });
                const result = await response.json();
                if (response.ok) {
                    successDiv.classList.remove('hidden');
                    // Перенаправление на /verify-code с email в параметрах
                    setTimeout(() => { 
                        window.location.href = `/verify-code?email=${encodeURIComponent(result.email)}`; 
                    }, 2000);
                } else {
                    errorDiv.classList.remove('hidden');
                    errorDiv.querySelector('ul').innerHTML = `<li>${result.detail || 'Ошибка входа'}</li>`;
                }
            } catch (error) {
                errorDiv.classList.remove('hidden');
                errorDiv.querySelector('ul').innerHTML = `<li>Ошибка сети: ${error.message}</li>`;
            }
        });
    </script>
</body>
</html>