<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Booking; // Убедись, что модель Booking создана (php artisan make:model Booking -m)
use Carbon\Carbon;
use Carbon\CarbonPeriod; // Для удобной генерации дат и времени

class BookingController extends Controller
{
    /**
     * Отображает сетку записи.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // 1. Определяем диапазон дат для отображения
        // Можно получать даты из GET-параметров ?start_date=...&end_date=...
        // По умолчанию, например, следующие 7 дней
        $viewStartDate = Carbon::parse($request->input('start_date', Carbon::today()))->startOfDay();
        // На картинке примерно 2 недели, возьмем 14 дней для примера
        $viewEndDate = $viewStartDate->copy()->addDays(13)->endOfDay();

        // 2. Определяем параметры сетки времени
        $slotIntervalMinutes = 150; // Интервал слота в минутах (как 14:00, 14:30)
        $workingHoursStart = 8;    // Начало рабочего дня (8 утра)
        $workingHoursEnd = 19;     // Конец рабочего дня (7 вечера)

        // 3. Получаем существующие (занятые) записи на этот период
        $existingBookings = Booking::whereBetween('start_time', [$viewStartDate, $viewEndDate])
                                    ->get()
                                    // Преобразуем в формат 'Y-m-d H:i' => true для быстрой проверки
                                    ->keyBy(fn($booking) => $booking->start_time->format('Y-m-d H:i'));

        // 4. Генерируем полную сетку времени для диапазона дат
        $timeSlotsGrid = [];
        $period = CarbonPeriod::create($viewStartDate, '1 day', $viewEndDate); // Период дат

        foreach ($period as $date) {
            $dateStr = $date->format('Y-m-d');
            $timeSlotsGrid[$dateStr] = [];

            // Генерируем слоты времени для текущего дня
            $dayStartTime = $date->copy()->hour($workingHoursStart)->minute(0)->second(0);
            $dayEndTime = $date->copy()->hour($workingHoursEnd)->minute(0)->second(0);

            // Используем CarbonPeriod для генерации временных интервалов
            $timePeriod = CarbonPeriod::create($dayStartTime, $slotIntervalMinutes.' minutes', $dayEndTime->subMinute()); // до конца рабочего дня

            foreach ($timePeriod as $slotTime) {
                $timeStr = $slotTime->format('H:i'); // '14:00'
                $dateTimeStrCheck = $slotTime->format('Y-m-d H:i'); // '2025-04-28 14:00'
                $dateTimeStrForm = $slotTime->format('Y-m-d H:i:s'); // '2025-04-28 14:00:00' для формы

                // Проверяем, занят ли этот слот
                $isBooked = isset($existingBookings[$dateTimeStrCheck]);
                // Дополнительно: проверяем, не прошло ли уже это время
                $isPast = $slotTime->isPast();

                $timeSlotsGrid[$dateStr][$timeStr] = [
                    'time' => $timeStr,
                    'datetime_form' => $dateTimeStrForm,
                    'is_available' => !$isBooked && !$isPast, // Доступен, если не занят и не в прошлом
                    'is_past' => $isPast,
                ];
            }
        }

        // 5. Передаем данные в представление
        return view('bookings.index', [
            'timeSlotsGrid' => $timeSlotsGrid,
            'viewStartDate' => $viewStartDate,
            'viewEndDate' => $viewEndDate,
            // Можно передать заголовки дней недели и т.д.
        ]);
    }

    /**
     * Сохраняет новую запись.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 1. Валидация входящих данных
        $validated = $request->validate([
            // Убедимся, что время приходит в ожидаемом формате и оно не в прошлом
            'start_time' => 'required|date_format:Y-m-d H:i:s|after:now',
            // Можно добавить другие поля: 'service_id', 'client_name', 'client_phone' и т.д.
        ]);

        $startTime = Carbon::parse($validated['start_time']);

        // 2. ПРОВЕРКА ДОСТУПНОСТИ ПЕРЕД СОЗДАНИЕМ (ВАЖНО!)
        // Защита от ситуации, когда два пользователя одновременно пытаются забронировать одно время
        $isAlreadyBooked = Booking::where('start_time', $startTime)->exists();

        if ($isAlreadyBooked) {
            // Возвращаем пользователя назад с сообщением об ошибке
            return back()->with('error', 'Извините, это время только что заняли. Пожалуйста, выберите другое.');
        }

        // 3. Определяем время окончания (если нужно)
        // Например, стандартная длительность услуги - 1 час
        $endTime = $startTime->copy()->addHour();

        // 4. Создание записи в базе данных
        try {
            Booking::create([
                'start_time' => $startTime,
                'end_time' => $endTime, // Сохраняем и время окончания
                // 'user_id' => auth()->id(), // Если используется аутентификация Laravel
                // 'client_name' => $request->input('client_name'), // Если есть поля для данных клиента
            ]);

            // 5. Редирект назад с сообщением об успехе
            return back()->with('success', 'Вы успешно записаны на ' . $startTime->translatedFormat('d F Y в H:i'));

        } catch (\Exception $e) {
            // Логирование ошибки (важно для отладки)
            Log::error('Ошибка создания записи: ' . $e->getMessage());
            // Возвращаем пользователя назад с общей ошибкой
            return back()->with('error', 'Произошла ошибка при создании записи. Попробуйте еще раз.');
        }
    }
}
