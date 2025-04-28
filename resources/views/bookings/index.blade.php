<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Запись на процедуру</title>
    {{-- Рекомендуется подключить ваш основной CSS файл --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}

    {{-- Встроенные стили для примера --}}
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            padding: 20px;
            background-color: #feceda;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .booking-container {
            max-width: 100%;
            overflow-x: auto; /* Горизонтальная прокрутка на маленьких экранах */
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .booking-grid {
            display: flex;
            min-width: fit-content; /* Чтобы колонки не сжимались слишком сильно */
        }
        .day-column {
            border-left: 1px solid #eee;
            padding: 10px;
            min-width: 110px; /* Минимальная ширина колонки дня */
            flex-shrink: 0; /* Запрещаем сжатие колонок */
        }
        .day-column:first-child {
            border-left: none;
        }
        .day-header {
            text-align: center;
            font-weight: 600;
            padding-bottom: 10px;
            margin-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
            font-size: 0.9em;
            color: #555;
        }
        .day-header .day-name { /* Название дня недели */
            display: block;
            font-size: 0.85em;
            color: #777;
            text-transform: capitalize; /* Делаем первую букву заглавной */
        }
        .time-slot {
            padding: 8px 5px;
            margin-bottom: 6px;
            border-radius: 5px;
            text-align: center;
            font-size: 0.95em;
            border: 1px solid transparent;
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }

        /* Доступный слот (зеленый) */
        .time-slot.available {
            background-color: #d1e7dd; /* Bootstrap success background */
            border-color: #badbcc;
            color: #0f5132; /* Bootstrap success text */
            cursor: pointer;
        }
        .time-slot.available:hover {
            background-color: #b6dcc4;
            border-color: #a4c9b3;
        }

        /* Недоступный или прошедший слот (красный/серый) */
        .time-slot.unavailable {
            background-color: #f8d7da; /* Bootstrap danger background */
            color: #58151c; /* Bootstrap danger text */
            border-color: #f5c2c7;
            cursor: not-allowed;
            opacity: 0.8;
        }
         .time-slot.past {
            background-color: #e9ecef; /* Серый для прошедшего времени */
            color: #6c757d;
            border-color: #dee2e6;
            cursor: not-allowed;
            opacity: 0.7;
        }

        /* Стили для формы внутри слота */
        .time-slot form {
            margin: 0;
            display: block; /* Чтобы форма занимала весь слот */
        }
        .time-slot button {
            background: none;
            border: none;
            padding: 0;
            margin: 0;
            color: inherit; /* Наследуем цвет текста от родителя (.time-slot) */
            font: inherit; /* Наследуем шрифт */
            cursor: pointer;
            width: 100%;
            height: 100%;
            text-align: center;
            display: block;
        }
        .time-slot.unavailable button,
        .time-slot.past button {
            cursor: not-allowed;
        }

        /* Сообщения обратной связи */
        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: .375rem; /* Tailwind's rounded-md */
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        .alert-success {
            color: #0f5132;
            background-color: #d1e7dd;
            border-color: #badbcc;
        }
        .alert-danger {
            color: #842029;
            background-color: #f8d7da;
            border-color: #f5c2c7;
        }

        /* Навигация (простой пример) */
        .navigation {
            text-align: center;
            margin-bottom: 20px;
        }
        .navigation a {
            display: inline-block;
            padding: 8px 15px;
            background-color: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 0 5px;
            transition: background-color 0.2s ease;
        }
        .navigation a:hover {
            background-color: #0b5ed7;
        }

    </style>
</head>
<body>

<h1>Запись на процедуру</h1>

{{-- Отображение сообщений успеха или ошибок --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
{{-- Отображение ошибок валидации --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Навигация по неделям (пример) --}}
<div class="navigation">
    <a href="{{ route('bookings.index', ['start_date' => $viewStartDate->copy()->subDays(7)->format('Y-m-d')]) }}">← Пред. неделя</a>
    <span>{{ $viewStartDate->translatedFormat('d M') }} - {{ $viewEndDate->translatedFormat('d M Y') }}</span>
    <a href="{{ route('bookings.index', ['start_date' => $viewStartDate->copy()->addDays(7)->format('Y-m-d')]) }}">След. неделя →</a>
</div>

{{-- Контейнер для сетки с прокруткой --}}
<div class="booking-container">
    <div class="booking-grid">
        {{-- Цикл по дням из контроллера --}}
        @foreach ($timeSlotsGrid as $date => $slots)
            @php $currentDate = \Carbon\Carbon::parse($date); @endphp
            <div class="day-column">
                <div class="day-header">
                     {{-- Выводим дату --}}
                    {{ $currentDate->translatedFormat('d M') }}
                    {{-- Выводим день недели --}}
                    <span class="day-name">{{ $currentDate->translatedFormat('D') }}</span>
                </div>

                {{-- Проверяем, есть ли слоты на этот день --}}
                @if (empty($slots))
                    <p style="text-align: center; color: #999; font-size: 0.9em;">Нет доступного времени</p>
                @else
                    {{-- Цикл по временным слотам дня --}}
                    @foreach ($slots as $time => $slotData)
                        @php
                            // Определяем CSS класс в зависимости от статуса слота
                            $slotClass = '';
                            if ($slotData['is_past']) {
                                $slotClass = 'past'; // Прошедшее время - серый
                            } elseif ($slotData['is_available']) {
                                $slotClass = 'available'; // Доступно - зеленый
                            } else {
                                $slotClass = 'unavailable'; // Занято - красный
                            }
                        @endphp

                        <div class="time-slot {{ $slotClass }}">
                            {{-- Если слот доступен, показываем форму для бронирования --}}
                            @if ($slotData['is_available'])
                                <form action="{{ route('bookings.store') }}" method="POST" class="booking-form">
                                    @csrf
                                    {{-- Скрытое поле с точным временем для отправки --}}
                                    <input type="hidden" name="start_time" value="{{ $slotData['datetime_form'] }}">
                                    {{-- Кнопка для отправки формы --}}
                                    <button type="submit">{{ $slotData['time'] }}</button>
                                </form>
                            @else
                                {{-- Если слот недоступен или прошел, просто показываем время --}}
                                <span>{{ $slotData['time'] }}</span>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div> {{-- конец .day-column --}}
        @endforeach
    </div> {{-- конец .booking-grid --}}
</div> {{-- конец .booking-container --}}

{{-- Небольшой скрипт для подтверждения записи --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bookingForms = document.querySelectorAll('.booking-form');

        bookingForms.forEach(form => {
            form.addEventListener('submit', function(event) {
                // Получаем время и дату из формы/кнопки для сообщения
                const timeButton = form.querySelector('button');
                const time = timeButton ? timeButton.textContent : 'выбранное время';
                // Находим ближайший заголовок дня
                const dayHeader = form.closest('.day-column').querySelector('.day-header');
                const dateStr = dayHeader ? dayHeader.textContent.trim().split('\n')[0] : 'выбранную дату'; // Получаем дату 'd M'

                // Показываем стандартное окно подтверждения браузера
                const confirmation = confirm(`Вы уверены, что хотите записаться на ${dateStr} в ${time}?`);

                // Если пользователь нажал "Отмена", предотвращаем отправку формы
                if (!confirmation) {
                    event.preventDefault();
                }
                // Если пользователь нажал "ОК", форма отправится как обычно
            });
        });
    });
</script>

</body>
</html>
    