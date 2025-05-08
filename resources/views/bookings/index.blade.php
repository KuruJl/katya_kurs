<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Запись на процедуру</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            padding: 20px;
            background-color: #feceda;
            color: #a73151;
            line-height: 1.6;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            color: #881d3a;
        }
        .booking-container {
            max-width: 100%;
            overflow-x: auto;
            border: 1px solid #da6886;
            border-radius: 15px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(167, 49, 81, 0.1);
        }
        .booking-grid {
            display: flex;
            min-width: fit-content;
        }
        .day-column {
            border-left: 1px solid #f8a5b7;
            padding: 15px;
            min-width: 120px;
            flex-shrink: 0;
        }
        .day-column:first-child {
            border-left: none;
        }
        .day-header {
            text-align: center;
            font-weight: 600;
            padding-bottom: 10px;
            margin-bottom: 15px;
            border-bottom: 1px solid #f8a5b7;
            color: #da6886;
        }
        .day-name {
            display: block;
            font-size: 0.9em;
            color: #da6886;
            margin-top: 5px;
            font-weight: 500;
        }
        .time-slot {
            padding: 10px 5px;
            margin-bottom: 8px;
            border-radius: 10px;
            text-align: center;
            font-size: 0.95em;
            border: 1px solid transparent;
            transition: all 0.2s ease;
            font-weight: 500;
        }
        .time-slot.available {
            background-color: #e8f5e9;
            border-color: #a5d6a7;
            color: #2e7d32;
            cursor: pointer;
        }
        .time-slot.available:hover {
            background-color: #c8e6c9;
            transform: translateY(-2px);
        }
        .time-slot.unavailable {
            background-color: #ffebee;
            color: #c62828;
            border-color: #ef9a9a;
            cursor: not-allowed;
        }
        .time-slot.past {
            background-color: #f5f5f5;
            color: #9e9e9e;
            border-color: #e0e0e0;
            cursor: not-allowed;
        }
        .time-slot form, .time-slot button {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background: none;
            border: none;
            color: inherit;
            font: inherit;
            cursor: inherit;
        }
        .alert {
            padding: 15px;
            margin: 0 auto 20px;
            border-radius: 10px;
            max-width: 800px;
            text-align: center;
        }
        .alert-success {
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #a5d6a7;
        }
        .alert-danger {
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #ef9a9a;
        }
        .navigation {
            text-align: center;
            margin-bottom: 25px;
        }
        .navigation a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #a73151;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            margin: 0 10px;
            transition: background-color 0.2s ease;
            font-weight: 500;
        }
        .navigation a:hover {
            background-color: #881d3a;
        }
        .no-slots {
            text-align: center;
            color: #da6886;
            font-style: italic;
            padding: 10px;
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
        background-color: #a73151;
    }
    </style>
</head>
<body>
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
                        <a href="{{ route('profile.edit') }}" class="nav-button profile">Профиль</a>
                        <form method="POST" action="{{ route('main') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" class="nav-button" style="cursor: pointer;">Выйти</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="nav-button">Вход</a>
                        <a href="{{ route('register') }}" class="nav-button">Регистрация</a>
                    @endauth
                </div>
            </div>
        </div>

<h1>Запись на процедуру</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="navigation">
    <a href="{{ route('bookings.index', ['start_date' => $viewStartDate->copy()->subDays(7)->format('Y-m-d')]) }}">← Пред. неделя</a>
    <span>{{ $viewStartDate->translatedFormat('d F') }} - {{ $viewEndDate->translatedFormat('d F Y') }}</span>
    <a href="{{ route('bookings.index', ['start_date' => $viewStartDate->copy()->addDays(7)->format('Y-m-d')]) }}">След. неделя →</a>
</div>

<div class="booking-container">
    <div class="booking-grid">
        @foreach ($timeSlotsGrid as $date => $dayData)
            <div class="day-column">
                <div class="day-header">
                    {{ $dayData['date'] }}
                    <span class="day-name">{{ $dayData['day_name'] }}</span>
                </div>

                @if (empty($dayData['slots']))
                    <p class="no-slots">Нет доступного времени</p>
                @else
                    @foreach ($dayData['slots'] as $time => $slotData)
                        @php
                            $slotClass = $slotData['is_past'] ? 'past' :
                                         ($slotData['is_available'] ? 'available' : 'unavailable');
                        @endphp

                        <div class="time-slot {{ $slotClass }}">
                            @if ($slotData['is_available'])
                                <form action="{{ route('bookings.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="start_time" value="{{ $slotData['datetime_form'] }}">
                                    <button type="submit">{{ $time }}</button>
                                </form>
                            @else
                                <span>{{ $time }}</span>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('form');

        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const time = form.querySelector('button').textContent;
                const date = form.closest('.day-column').querySelector('.day-header').textContent;

                if (!confirm(`Подтвердите запись на ${date} в ${time}`)) {
                    e.preventDefault();
                }
            });
        });
    });
</script>

</body>
</html>