<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подтверждение кода - Ростелеком</title>
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
        .form-container {
            max-width: 400px;
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
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="form-container">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-[var(--rtk-red)]">Ростелеком</h1>
            <p class="text-sm text-[var(--rtk-gray)] mt-1">Управление проектами коммерческого подразделения</p>
        </div>
        <h2 class="text-2xl font-semibold text-center mb-6 text-[var(--rtk-gray)]">Подтверждение кода</h2>

        <div id="errorMessage" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside"></ul>
        </div>
        <div id="successMessage" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            <p>Код подтверждён! Перенаправляем...</p>
        </div>

        <form id="verifyCodeForm">
            <input type="hidden" id="email" name="email" value="{{ request.query_params.get('email') }}">
            <div class="mb-4">
                <label for="code" class="block text-sm font-medium text-[var(--rtk-gray)]">Код подтверждения</label>
                <input type="text" id="code" name="code" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--rtk-red)] focus:border-[var(--rtk-red)] text-sm">
            </div>
            <button type="submit" class="btn-primary w-full py-2 px-4 rounded-md font-medium text-base">Подтвердить</button>
        </form>

        <p class="mt-4 text-center text-sm text-[var(--rtk-gray)]">
            <a href="/entrance" class="link-blue font-medium">Вернуться к входу</a>
        </p>
    </div>

    <script>
        document.getElementById('verifyCodeForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const data = {
                email: formData.get('email'),
                code: formData.get('code')
            };
            const errorDiv = document.getElementById('errorMessage');
            const successDiv = document.getElementById('successMessage');

            errorDiv.classList.add('hidden');
            successDiv.classList.add('hidden');

            try {
                const response = await fetch('/verify-code', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                const result = await response.json();
                if (response.ok) {
                    successDiv.classList.remove('hidden');
                    setTimeout(() => { window.location.href = result.redirect || '/newpage'; }, 2000);
                } else {
                    errorDiv.classList.remove('hidden');
                    errorDiv.querySelector('ul').innerHTML = `<li>${result.detail || 'Неверный код'}</li>`;
                }
            } catch (error) {
                errorDiv.classList.remove('hidden');
                errorDiv.querySelector('ul').innerHTML = `<li>Ошибка сети: ${error.message}</li>`;
            }
        });
    </script>
</body>
</html>