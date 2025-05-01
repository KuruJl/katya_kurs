<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация - Nails.iirk</title>
    <style>
        :root {
            --primary-color: #a73151;
            --secondary-color: #da6886;
            --background-color: #feceda;
            --text-color: #333;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-color);
            color: var(--primary-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
            padding: 0;
        }
        
        .auth-container {
            max-width: 400px;
            width: 100%;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(167, 49, 81, 0.1);
        }
        
        .auth-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .auth-logo img {
            width: 100px;
            border-radius: 15px;
        }
        
        .auth-title {
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--primary-color);
        }
        
        .auth-form .input-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .auth-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--primary-color);
            width: 100%;
            max-width: 300px;
            text-align: left;
        }
        
        .auth-form input {
            width: 100%;
            max-width: 300px;
            padding: 12px 15px;
            border: 2px solid #f8a5b7;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            text-align: center;
        }
        
        .auth-form input:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(218, 104, 134, 0.2);
        }
        
        .auth-button {
            width: 100%;
            max-width: 300px;
            padding: 15px;
            background-color: var(--secondary-color);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin: 0 auto;
            display: block;
        }
        
        .auth-button:hover {
            background-color: var(--primary-color);
            transform: translateY(-2px);
        }
        
        .auth-links {
            margin-top: 20px;
            text-align: center;
        }
        
        .auth-links a {
            color: var(--secondary-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .auth-links a:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }
        
        .error-message {
            color: #c62828;
            font-size: 14px;
            margin-top: 5px;
            text-align: center;
        }
        
        .password-hint {
            font-size: 12px;
            color: #777;
            margin-top: 5px;
            text-align: center;
            width: 100%;
            max-width: 300px;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-logo">
            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/27234bd614096077bf3ab6f70411fd2f7e8a3467?placeholderIfAbsent=true&apiKey=1f1e2d1492e74be8b445b694e3a68aae" 
                 alt="Логотип Nails.iirk">
        </div>
        
        <h1 class="auth-title">РЕГИСТРАЦИЯ</h1>
        
        @if ($errors->any())
            <div class="error-message" style="margin-bottom: 20px;">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        
        <form method="POST" action="{{ route('register') }}" class="auth-form">
            @csrf
            
            <div class="input-group">
                <label for="name">Имя</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
            </div>
            
            <div class="input-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            </div>
            
            <div class="input-group">
                <label for="password">Пароль</label>
                <input id="password" type="password" name="password" required>
                <p class="password-hint">Минимум 8 символов</p>
            </div>
            
            <div class="input-group">
                <label for="password_confirmation">Подтвердите пароль</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
            </div>
            
            <button type="submit" class="auth-button">ЗАРЕГИСТРИРОВАТЬСЯ</button>
            
            <div class="auth-links">
                <a href="{{ route('login') }}">Уже есть аккаунт? Войти</a>
            </div>
        </form>
    </div>
</body>
</html>