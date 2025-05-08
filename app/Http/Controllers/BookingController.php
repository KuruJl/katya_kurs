<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class BookingController extends Controller
{
    protected $adminViews = 'admin.';
    public function adminIndex()
    {
        $bookings = Booking::with('user')->latest()->paginate(10);
        return view($this->adminViews . 'bookings.index', compact('bookings'));
    }
    
    // Метод для редактирования брони
    public function adminEdit(Booking $booking)
    {
        return view($this->adminViews . 'bookings.edit', compact('booking'));
    }

    
    public function index(Request $request)
    {
        
        // Устанавливаем локаль на русский для Carbon
        Carbon::setLocale('ru');
        
        $viewStartDate = Carbon::parse($request->input('start_date', Carbon::today()))->startOfDay();
        $viewEndDate = $viewStartDate->copy()->addDays(12)->endOfDay();

        $slotIntervalMinutes = 150;
        $workingHoursStart = 8;
        $workingHoursEnd = 19;

        // Получаем существующие записи
        $existingBookings = Booking::whereBetween('start_time', [$viewStartDate, $viewEndDate])
            ->get()
            ->keyBy(fn($booking) => $booking->start_time->format('Y-m-d H:i'));

        // Генерируем сетку времени, исключая воскресенья
        $timeSlotsGrid = [];
        $period = CarbonPeriod::create($viewStartDate, '1 day', $viewEndDate);

        foreach ($period as $date) {
            // Пропускаем воскресенье (день недели 0 - воскресенье)
            if ($date->dayOfWeek === Carbon::SUNDAY) {
                continue;
            }

            $dateStr = $date->format('Y-m-d');
            $timeSlotsGrid[$dateStr] = [
                'day_name' => $date->translatedFormat('l'), // День недели на русском
                'date' => $date->translatedFormat('j F'),    // "28 апреля"
                'slots' => []
            ];

            $dayStartTime = $date->copy()->hour($workingHoursStart)->minute(0);
            $dayEndTime = $date->copy()->hour($workingHoursEnd)->minute(0);

            $timePeriod = CarbonPeriod::create(
                $dayStartTime, 
                $slotIntervalMinutes . ' minutes', 
                $dayEndTime->subMinute()
            );

            foreach ($timePeriod as $slotTime) {
                $timeStr = $slotTime->format('H:i');
                $dateTimeStrCheck = $slotTime->format('Y-m-d H:i');
                $dateTimeStrForm = $slotTime->format('Y-m-d H:i:s');

                $isBooked = isset($existingBookings[$dateTimeStrCheck]);
                $isPast = $slotTime->isPast();

                $timeSlotsGrid[$dateStr]['slots'][$timeStr] = [
                    'time' => $timeStr,
                    'datetime_form' => $dateTimeStrForm,
                    'is_available' => !$isBooked && !$isPast,
                    'is_past' => $isPast,
                ];
            }
        }

        return view('bookings.index', [
            'timeSlotsGrid' => $timeSlotsGrid,
            'viewStartDate' => $viewStartDate,
            'viewEndDate' => $viewEndDate,
        ]);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'start_time' => 'required|date_format:Y-m-d H:i:s|after:now',
    ]);

    $startTime = Carbon::parse($validated['start_time']);

    // Проверка воскресенья
    if ($startTime->dayOfWeek === Carbon::SUNDAY) {
        return back()->with('error', 'Запись на воскресенье недоступна');
    }

    // Проверка доступности слота
    if (Booking::where('start_time', $startTime)->exists()) {
        return back()->with('error', 'Это время уже занято');
    }

    try {
        // Создаем бронь с привязкой к авторизованному пользователю
        Booking::create([
            'start_time' => $startTime,
            'end_time' => $startTime->copy()->addHours(2),
            'user_id' => auth()->user()->id // Эта строка будет работать
        ]);

        return back()->with('success', 'Вы успешно записаны на ' . $startTime->translatedFormat('d F Y в H:i'));

    } catch (\Exception $e) {
        Log::error('Booking error: ' . $e->getMessage());
        return back()->with('error', 'Ошибка: ' . $e->getMessage()); // Показываем реальную ошибку
    }
    
}
}