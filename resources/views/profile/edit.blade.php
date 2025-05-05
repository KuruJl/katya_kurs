<style>
    .custom-profile-header {
        text-align: center;
        margin-bottom: 2rem;
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

    .bookings-section h1, .bookings-section h2 {
        color: #333; /* Более темный цвет заголовков */
        margin-top: 0.5rem;
        margin-bottom: 0.75rem;
    }

    .bookings-section h2:first-child {
        margin-top: 0; /* Уберем верхний отступ у первого заголовка */
    }
</style>

<x-app-layout>
    <div class="py-12">
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