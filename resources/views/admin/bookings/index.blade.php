<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора: Управление записями</title>
    
    {{-- Подключаем Bootstrap для модального окна --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">

    {{-- Стили, СКОПИРОВАННЫЕ и АДАПТИРОВАННЫЕ из bookings.index --}}
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            padding: 20px;
            background-color: #feceda; /* <-- Цвет фона как у клиента */
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
            min-width: 140px; /* Немного шире для админки */
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
            min-height: 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .time-slot.available {
            background-color: #e8f5e9;
            border-color: #a5d6a7;
            color: #2e7d32;
            cursor: pointer;
        }
        .time-slot.available:hover {
            background-color: #c8e6c9;
        }
        .time-slot.unavailable {
            background-color: #ffebee;
            color: #c62828;
            border-color: #ef9a9a;
        }
        .time-slot.past {
            background-color: #f5f5f5;
            color: #9e9e9e;
            border-color: #e0e0e0;
        }
        .time-slot form, .time-slot button {
            margin: 0; padding: 0; width: 100%; height: 100%; background: none; border: none; color: inherit; font: inherit; cursor: inherit;
        }
        .booked-info { font-size: 0.85em; font-weight: 400; max-width: 100%; word-wrap: break-word; }
        .cancel-form button { background-color: #dc3545; color: white; padding: 4px 8px; font-size: 0.8em; border-radius: 5px; margin-top: 5px; cursor: pointer; transition: background-color 0.2s; }
        .cancel-form button:hover { background-color: #c82333; }
        
        .navigation {
            text-align: center;
            margin-bottom: 15px;
        }
        .navigation a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #a73151; /* <-- Цвет кнопок как у клиента */
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
        
        .controls-container {
            text-align: center;
            margin-bottom: 25px;
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }
        /* Адаптация кнопок управления под основной стиль */
        .controls-container .btn-success { background-color: #4CAF50; border-color: #4CAF50; }
        .controls-container .btn-info { background-color: #00BCD4; border-color: #00BCD4; }
        .controls-container .btn-secondary { background-color: #6c757d; border-color: #6c757d; }

        /* Стили для хедера и футера из bookings.index */
        .header-container { max-width: 800px; margin: 0 auto 30px; }
        .header-nav { background-color: #f8bbd0; color: #a73151; padding: 20px; display: flex; justify-content: space-between; align-items: center; border-radius: 15px; box-shadow: 0 4px 8px rgba(167, 49, 81, 0.1); }
        .brand-container { display: flex; align-items: center; gap: 15px; text-decoration: none; }
        .logo { width: 80px; height: auto; border-radius: 10px; object-fit: contain; object-position: center; }
        .brand-name { color: #a73151; letter-spacing: 4px; font-size: 24px; font-weight: 600; text-transform: uppercase; }
        .brand-quality, .brand-elegance { letter-spacing: 3px; color: #c95a77; display: block; margin-top: 3px; font-size: 16px; }
        .nav-buttons { display: flex; gap: 10px; flex-wrap: wrap; justify-content: center; }
        .nav-button { padding: 10px 18px; background-color: #da6886; color: white; text-decoration: none; border-radius: 10px; font-weight: 500; letter-spacing: 1px; transition: background-color 0.3s ease; border: none; cursor: pointer; }
        .nav-button:hover { background-color: #c95a77; }
        .nav-button.profile { background-color: #a73151; }
        .footer { display: flex; align-items: center; justify-content: center; gap: 30px; flex-wrap: wrap; margin-top: 40px; }
        .footer .logo { width: 80px; height: 80px; }
        .contact-info { display: flex; flex-direction: column; align-items: center; }
        .contact-phone { color: #a73151; letter-spacing: 2px; margin-bottom: 15px; font-size: 18px; }
        .social-links { display: flex; flex-direction: column; align-items: center; gap: 10px; }
        .social-link { color: #a73151; letter-spacing: 2px; font-size: 16px; text-decoration: none; transition: color 0.3s ease; }
        .social-link:hover { color: #881d3a; }
        .modal-body, .modal-header, .modal-footer { color: #333; } /* Чтобы текст в модалке был читаемым */
    </style>
</head>
<body>

{{-- ===================== ХЕДЕР (скопирован из bookings.index) ===================== --}}
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
            {{-- Кнопки в хедере для админа --}}
            <a href="{{ route('bookings.index') }}" class="nav-button">Вид клиента</a>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="nav-button" style="cursor: pointer;">Выйти</button>
            </form>
        </div>
    </div>
</div>

<h1>Панель администратора</h1>

@if(session('success'))
    <div class="alert alert-success mx-auto" style="max-width: 800px;">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger mx-auto" style="max-width: 800px;">{{ session('error') }}</div>
@endif

<div class="navigation">
    <a href="{{ route('admin.bookings.index', ['start_date' => $viewStartDate->copy()->subDays(7)->format('Y-m-d')]) }}">← Пред. неделя</a>
    <span>{{ $viewStartDate->translatedFormat('d F') }} - {{ $viewEndDate->translatedFormat('d F Y') }}</span>
    <a href="{{ route('admin.bookings.index', ['start_date' => $viewStartDate->copy()->addDays(7)->format('Y-m-d')]) }}">След. неделя →</a>
</div>

<div class="controls-container">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#manualBookingModal">
        + Создать ручную запись
    </button>
    @if(Route::has('admin.announcements.index'))
        <a href="{{ route('admin.announcements.index') }}" class="btn btn-info">Управление объявлениями</a>
    @endif
</div>

<div class="booking-container">
    {{-- Весь блок с booking-grid и логикой отображения слотов остается без изменений --}}
    <div class="booking-grid">
        @foreach ($timeSlotsGrid as $date => $dayData)
            <div class="day-column">
                <div class="day-header">
                    {{ $dayData['date'] }}
                    <span class="day-name">{{ $dayData['day_name'] }}</span>
                </div>

                @if ($dayData['is_fully_blocked'])
                    @foreach ($dayData['slots'] as $time => $slotData)
                        <div class="time-slot unavailable">
                            <span>{{ $time }}</span>
                            <div class="booked-info" style="font-size: 1.5em; color: #a94442;"></div>
                            <div class="booked-info" style="font-size: 0.8em;">(День закрыт)</div>
                        </div>
                    @endforeach
                    <div class="text-center mt-3">
                         <form action="{{ route('admin.bookings.destroy', $dayData['blocker_booking_id']) }}" method="POST" class="cancel-form" onsubmit="return confirm('Вы уверены, что хотите разблокировать весь день?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-success">Разблокировать день</button>
                        </form>
                    </div>
                @else
                    @foreach ($dayData['slots'] as $time => $slotData)
                        @php
                            $slotClass = $slotData['is_past'] ? 'past' : ($slotData['is_available'] ? 'available' : 'unavailable');
                        @endphp
                        <div class="time-slot {{ $slotClass }}">
                            @if ($slotData['is_available'])
                                <form action="{{ route('admin.bookings.store') }}" method="POST" onsubmit="return confirm('Забронировать этот слот на свое имя?')">
                                    @csrf
                                    <input type="hidden" name="start_time" value="{{ $slotData['datetime_form'] }}">
                                    <button type="submit">{{ $time }}<br><span style="font-size: 0.8em;">(свободно)</span></button>
                                </form>
                            @elseif (!empty($slotData['booking_info']))
                                <span>{{ $time }}</span>
                                <div class="booked-info">
                                    <strong>{{ $slotData['booking_info']['user_name'] }}</strong>
                                </div>
                                <form action="{{ route('admin.bookings.destroy', $slotData['booking_info']['id']) }}" method="POST" class="cancel-form" onsubmit="return confirm('Вы уверены, что хотите отменить эту запись?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Отменить</button>
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

{{-- Модальное окно остается без изменений --}}
<div class="modal fade" id="manualBookingModal" tabindex="-1" aria-labelledby="manualBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manualBookingModalLabel">Создание ручной записи / Блокировка времени</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body border-bottom">
                <h6 class="mb-3">Быстрая блокировка дня</h6>
                <div class="mb-3">
                    <label for="block_day_date" class="form-label">Выберите дату, которую нужно закрыть</label>
                    <input type="date" class="form-control" id="block_day_date" name="block_day_date">
                </div>
                <button type="button" id="blockDayBtn" class="btn btn-warning w-100">Закрыть выбранный день для записи</button>
            </div>
            <form action="{{ route('admin.bookings.store.manual') }}" method="POST" id="manualBookingForm">
                @csrf
                <div class="modal-body">
                    <h6 class="mb-3">Ручная блокировка произвольного времени</h6>
                    <p class="text-muted small">Для блокировки произвольного отрезка времени...</p>
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Дата и время начала</label>
                        <input type="datetime-local" class="form-control" id="start_time" name="start_time" required>
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Продолжительность (в минутах)</label>
                        <input type="number" class="form-control" id="duration" name="duration" value="150" required min="10">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Заблокировать указанное время</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===================== ФУТЕР (скопирован из bookings.index) ===================== --}}
<footer class="footer">
    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/2166173af264b6b233ee79ec2f0ed8858f630d0c" alt="Логотип Nails.iirk" class="logo">
    <div class="contact-info">
        <p class="contact-phone">Связаться с нами: 89025497599</p>
        <nav class="social-links">
            <a href="#" class="social-link">Наш VK</a>
            <a href="#" class="social-link">Наш Instagram</a>
        </nav>
    </div>
</footer>

{{-- Скрипты для Bootstrap и для блокировки дня --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Находим формы для бронирования стандартных слотов
        const adminBookingForms = document.querySelectorAll('.booking-container form[action*="admin/bookings"]');
        
        adminBookingForms.forEach(form => {
            // Проверяем, это форма отмены или бронирования
            const isCancelForm = form.classList.contains('cancel-form');

            form.addEventListener('submit', function(e) {
                let message = 'Вы уверены?'; // Сообщение по умолчанию
                
                if (isCancelForm) {
                    message = 'Вы уверены, что хотите отменить эту запись?';
                } else {
                    const time = form.querySelector('button').textContent.trim();
                    const dateRaw = form.closest('.day-column').querySelector('.day-header').textContent;
                    const dateClean = dateRaw.trim().replace(/\s+/g, ' ');
                    message = `Подтвердите бронирование на ${dateClean} в ${time}`;
                }

                if (!confirm(message)) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const blockDayBtn = document.getElementById('blockDayBtn');
        const blockDayDateInput = document.getElementById('block_day_date');
        const manualBookingForm = document.getElementById('manualBookingForm');
        const startTimeInput = document.getElementById('start_time');
        const durationInput = document.getElementById('duration');

        blockDayBtn.addEventListener('click', function() {
            const selectedDate = blockDayDateInput.value;
            if (!selectedDate) {
                alert('Пожалуйста, сначала выберите дату для блокировки.');
                return;
            }
            const workDayStartHour = 8;
            const workDayEndHour = 21;
            const startTimeString = `${selectedDate}T${String(workDayStartHour).padStart(2, '0')}:00`;
            const durationInMinutes = (workDayEndHour - workDayStartHour) * 60;
            startTimeInput.value = startTimeString;
            durationInput.value = durationInMinutes;
            if (confirm(`Вы уверены, что хотите закрыть для записи весь день ${selectedDate}?`)) {
                manualBookingForm.submit();
            }
        });
    });
</script>

</body>
</html>