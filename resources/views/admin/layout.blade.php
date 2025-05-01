<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель | {{ config('app.name') }}</title>
    <style>
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        .admin-sidebar {
            width: 250px;
            background: #a73151;
            color: white;
            padding: 20px;
        }
        .admin-content {
            flex: 1;
            padding: 20px;
            background: #f5f5f5;
        }
        .sidebar-link {
            display: block;
            color: white;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            text-decoration: none;
        }
        .sidebar-link:hover {
            background: #da6886;
        }
        .card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-sidebar">
            <h2>Админ-панель</h2>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link">Дашборд</a>
            <a href="{{ route('admin.bookings.index') }}" class="sidebar-link">Бронирования</a>
            <a href="{{ route('admin.profile.edit') }}" class="sidebar-link">Профиль</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="background: none; border: none; color: white; cursor: pointer;" 
                        class="sidebar-link">Выйти</button>
            </form>
        </div>
        
        <div class="admin-content">
            @yield('content')
        </div>
    </div>
</body>
</html>