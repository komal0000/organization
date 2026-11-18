@php
    $generalSetting = getSetting('general');
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <title>Admin sign in · {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600&family=Nunito:wght@800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --orange: #F4891F;
            --orange-dark: #d9740f;
            --yellow: #FAAC19;
            --ink: #283734;
            --muted: #6f7775;
            --line: #e6dfcf;
            --cream: #fff7e8;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            background: var(--cream);
            color: var(--ink);
            font-family: Manrope, sans-serif;
        }

        .login {
            width: 100%;
            max-width: 400px;
        }

        .login-card {
            background: #fff;
            border-radius: 12px;
            border-top: 3px solid var(--orange);
            box-shadow: 0 1px 2px rgba(40, 55, 52, 0.06), 0 8px 24px rgba(40, 55, 52, 0.06);
            padding: 32px 28px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 28px;
        }

        .brand img {
            height: 48px;
            width: auto;
        }

        .brand span {
            font-size: 0.85rem;
            color: var(--muted);
        }

        h1 {
            font-family: Nunito, sans-serif;
            font-weight: 900;
            font-size: 1.6rem;
            margin: 0 0 4px;
        }

        .lead {
            color: var(--muted);
            margin: 0 0 24px;
            font-size: 0.95rem;
        }

        .alert {
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 0.9rem;
            margin-bottom: 16px;
            background: #fdecea;
            color: #9b2c22;
        }

        .alert.ok {
            background: #e8f5ec;
            color: #1e6b3a;
        }

        label {
            display: block;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            font: inherit;
            padding: 11px 12px;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: #fff;
            color: var(--ink);
            margin-bottom: 16px;
        }

        input:focus {
            outline: none;
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(244, 137, 31, 0.18);
        }

        button {
            width: 100%;
            margin-top: 8px;
            padding: 12px;
            border: 0;
            border-radius: 8px;
            background: var(--orange);
            color: #fff;
            font: inherit;
            font-weight: 600;
            cursor: pointer;
        }

        button:hover {
            background: var(--orange-dark);
        }

        button:disabled {
            opacity: 0.7;
            cursor: wait;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: var(--muted);
            font-size: 0.9rem;
            text-decoration: none;
        }

        .back:hover {
            color: var(--orange-dark);
        }
    </style>
</head>

<body>
    <main class="login">
        <div class="login-card">
            <div class="brand">
                @if (!empty($generalSetting->header_logo))
                    <img src="{{ vasset($generalSetting->header_logo) }}" alt="{{ config('app.name') }} logo">
                @else
                    <strong>{{ config('app.name') }}</strong>
                @endif
                <span>Admin panel</span>
            </div>

            <h1>Sign in</h1>
            <p class="lead">Use your admin email and password.</p>

            @if (session('error'))
                <div class="alert" role="alert">{{ session('error') }}</div>
            @elseif (session('message'))
                <div class="alert ok" role="status">{{ session('message') }}</div>
            @endif

            <form method="POST" id="loginForm">
                @csrf
                <label for="{{ $email }}">Email</label>
                <input type="email" name="{{ $email }}" id="{{ $email }}" autocomplete="username" required autofocus>

                <label for="{{ $password }}">Password</label>
                <input type="password" name="{{ $password }}" id="{{ $password }}" autocomplete="current-password" required>

                <button type="submit" id="loginBtn">Sign in</button>
            </form>
        </div>

        <a href="{{ url('/') }}" class="back">← Back to website</a>
    </main>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('loginBtn');
            btn.disabled = true;
            btn.textContent = 'Signing in…';
        });
    </script>
</body>

</html>
