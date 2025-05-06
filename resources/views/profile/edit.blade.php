<style>
    body {
        background-color: #ffe0f0; /* Розовый фон страницы */
    }

    .header-container {
        max-width: 600px; /* Ширина контейнера форм */
        margin: 0 auto; /* Центрирование контейнера */
        margin-bottom: 30px; /* Отступ до основного контента */
    }

    .header-nav {
        background-color: #f8bbd0; /* Светло-розовый фон шапки */
        color: #a73151; /* Основной цвет текста шапки */
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(167, 49, 81, 0.1);
    }

    .brand-container {
        display: flex;
        align-items: center;
        gap: 15px;
        text-decoration: none;
    }

    .logo {
        width: 80px;
        height: auto;
        border-radius: 10px;
        object-fit: contain;
        object-position: center;
    }

    .brand-name {
        color: #a73151;
        letter-spacing: 4px;
        font-size: 24px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .brand-quality,
    .brand-elegance {
        letter-spacing: 3px;
        color: #c95a77;
        display: block;
        margin-top: 3px;
        font-size: 16px;
    }

    .nav-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .nav-button {
        padding: 10px 18px;
        background-color: #da6886;
        color: white;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 500;
        letter-spacing: 1px;
        transition: background-color 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .nav-button:hover {
        background-color: #c95a77;
    }

    .nav-button.profile {
        background-color: #a73151;
    }

    .nav-button.logout {
        background-color: #881d3a;
    }

    /* Остальные стили профиля */
    .custom-profile-header {
        text-align: center;
        margin-bottom: 2rem;
        color: #a73151;
    }

    .profile-forms-container {
        max-width: 600px;
        margin: 0 auto;
    }

    .profile-card {
        background: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .danger-zone {
        border: 1px solid #ff6b6b;
    }

    h2 {
        color: #a73151;
        margin-top: 0;
    }

    /* Стили для активных бронирований */
    .booking-list {
        list-style: none;
        padding: 0;
    }

    .booking-item {
        padding: 0.75rem;
        margin-bottom: 0.5rem;
        border-radius: 8px;
        background-color: #f9f9f9;
        border-left: 3px solid transparent; /* Изначально прозрачная граница */
    }

    .booking-active {
        background-color: #e0f7fa !important; /* Светло-голубой фон */
        border-left-color: #4caf50 !important; /* Зеленая полоса слева */
        font-weight: bold; /* Можно сделать текст жирным */
    }

    .booking-active-label {
        color: #1976d2; /* Синий цвет для метки "Активно" */
        margin-right: 0.5rem;
    }

    .bookings-section {
        max-width: 600px;
        margin: 0 auto;
        margin-bottom: 2rem; /* Добавим отступ снизу блока бронирований */
        background-color: #f9f9f9; /* Светлый фон для всего блока */
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
    }

    .bookings-section h1,
    .bookings-section h2 {
        color: #333; /* Более темный цвет заголовков */
        margin-top: 0.5rem;
        margin-bottom: 0.75rem;
    }

    .bookings-section h2:first-child {
        margin-top: 0; /* Уберем верхний отступ у первого заголовка */
    }

    /* Адаптивность шапки */
    @media (max-width: 768px) {
        .header-nav {
            flex-direction: column;
            align-items: stretch;
        }

        .brand-container {
            margin-bottom: 15px;
        }

        .nav-buttons {
            width: 100%;
        }

        .nav-button {
            flex-grow: 1;
        }
    }
</style>

<x-app-layout>
    <div class="py-12">
        <div class="header-container">
            <div class="header-nav">
                <a href="{{ route('main') }}" class="brand-container">
                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/27234bd614096077bf3ab6f70411fd2f7e8a3467?placeholderIfAbsent=true&apiKey=1f1e2d1492e74be8b445b694e3a68aae"
                        class="logo" alt="Логотип Nails.iirk">
                    <div>
                        <div class="brand-name">nails.iirk</div>
                        <span class="brand-quality">качество</span>
                        <span class="brand-elegance">изящность</span>
                    </div>
                </a>

                <div class="nav-buttons">
                    @auth
                        <a href="{{ route('main') }}" class="nav-button profile">Главная</a>
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" class="nav-button logout" style="cursor: pointer;">Выйти</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="nav-button">Вход</a>
                        <a href="{{ route('register') }}" class="nav-button">Регистрация</a>
                    @endauth
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="custom-profile-header">
                <h1>Привет, {{ Auth::user()->name }}! 👋</h1>
                <p>Редактируйте ваш профиль</p>
            </div>

            <div class="bookings-section">
                <h1>Ваши бронирования</h1>

                <h2>Активные бронирования</h2>
                @if ($activeBookings->isEmpty())
                    <p>Нет активных бронирований.</p>
                @else
                    <ul class="booking-list">
                        @foreach ($activeBookings as $booking)
                            <li class="booking-item booking-active">
                                <span class="booking-active-label">Активно:</span> {{ $booking->start_time->format('d.m.Y H:i') }}
                            </li>
                        @endforeach
                    </ul>
                @endif

                <h2>Прошедшие бронирования</h2>
                @if ($pastBookings->isEmpty())
                    <p>Нет прошедших бронирований.</p>
                @else
                    <ul class="booking-list">
                        @foreach ($pastBookings as $booking)
                            <li class="booking-item">
                                {{ $booking->start_time->format('d.m.Y H:i') }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="profile-forms-container">
                <div class="profile-card">
                    <h2>📝 Основные данные</h2>
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="profile-card">
                    <h2>🔐 Смена пароля</h2>
                    @include('profile.partials.update-password-form')
                </div>

                <div class="profile-card danger-zone">
                    <h2>❌ Удалить аккаунт</h2>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>