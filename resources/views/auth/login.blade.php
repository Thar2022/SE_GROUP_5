<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Vite link tag for loading CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            padding: 32px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .login-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 24px;
            color: #333333;
        }

        .input-field {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            padding: 12px;
            margin-bottom: 16px;
            font-size: 16px;
            outline: none;
        }

        .login-button {
            background-color: #2563eb;
            color: #ffffff;
            padding: 12px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .login-button:hover {
            background-color: #1e4bbf;
        }

        .forgot-password {
            margin-top: 16px;
            font-size: 14px;
            color: #2563eb;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2 class="login-title">เข้าสู่ระบบ</h2>
        @if (Session::has('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                <p class="font-bold">Error!</p>
                <p>{{ Session::get('error') }}</p>
            </div>
        @endif
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <input type="email" name="email" class="input-field" placeholder="อีเมล" required>
            <input type="password" name="password" class="input-field" placeholder="รหัสผ่าน" required>
            <button type="submit" class="login-button">เข้าสู่ระบบ</button>
        </form>
    </div>
</body>

</html>

