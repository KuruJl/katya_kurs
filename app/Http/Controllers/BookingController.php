<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;
// Убедитесь, что эта модель подключена, если вы используете объявления
// use App\Models\Announcement; 
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class BookingController extends Controller
{
    // Ваши старые методы для админки можно оставить или удалить, если они больше не используются
    // protected $adminViews = 'admin.';
    // public function adminIndex() { ... }
    // public function adminEdit(Booking $booking) { ... }
    
    /**
     * Отображает сетку записи для КЛИЕНТА.
     * Содержит правильную логику проверки пересечений.
     */
    public function index(Request $request)
    {
        Carbon::setLocale('ru');

        $viewStartDate = Carbon::parse($request->input('start_date', Carbon::today()))->startOfDay();
        $viewEndDate = $viewStartDate->copy()->addDays(13)->endOfDay();

        $slotIntervalMinutes = 150;
        $workingHoursStart = 8;
        $workingHoursEnd = 21;

        // 1. Получаем ВСЕ записи в диапазоне, включая ручные и стандартные
        $existingBookings = Booking::where('start_time', '<', $viewEndDate)
            ->where('end_time', '>', $viewStartDate)
            ->get();
            
        // 2. (Опционально) Получаем активные объявления
        // $activeAnnouncements = Announcement::where('is_active', true)->latest()->get();

        $timeSlotsGrid = [];
        $period = CarbonPeriod::create($viewStartDate, '1 day', $viewEndDate);

        foreach ($period as $date) {
            if ($date->dayOfWeek === Carbon::SUNDAY) {
                continue;
            }

            $dateStr = $date->format('Y-m-d');
            $timeSlotsGrid[$dateStr] = [
                'day_name' => $date->translatedFormat('l'),
                'date' => $date->translatedFormat('j F'),
                'slots' => []
            ];

            $dayStartTime = $date->copy()->hour($workingHoursStart)->minute(0);
            $dayEndTime = $date->copy()->hour($workingHoursEnd)->minute(0);

            $timePeriod = CarbonPeriod::create(
                $dayStartTime,
                $slotIntervalMinutes . ' minutes',
                $dayEndTime->subMinute()
            );

            foreach ($timePeriod as $slotStart) {
                // 3. Для каждого стандартного слота определяем его начало и конец
                $slotEnd = $slotStart->copy()->addMinutes($slotIntervalMinutes);
                $timeStr = $slotStart->format('H:i');
                $dateTimeStrForm = $slotStart->format('Y-m-d H:i:s');
                $isPast = $slotStart->isPast();

                // 4. Проверяем, есть ли в базе запись, которая ПЕРЕСЕКАЕТСЯ с этим слотом
                $isSlotBooked = $existingBookings->first(function ($booking) use ($slotStart, $slotEnd) {
                    // Условие пересечения:
                    // (Начало брони < Конец слота) И (Конец брони > Начало слота)
                    return $booking->start_time < $slotEnd && $booking->end_time > $slotStart;
                });
                
                $isAvailable = is_null($isSlotBooked) && !$isPast;

                $timeSlotsGrid[$dateStr]['slots'][$timeStr] = [
                    'datetime_form' => $dateTimeStrForm,
                    'is_available' => $isAvailable,
                    'is_past' => $isPast,
                ];
            }
        }

        return view('bookings.index', [
            'timeSlotsGrid' => $timeSlotsGrid,
            'viewStartDate' => $viewStartDate,
            'viewEndDate' => $viewEndDate,
            // Если вы используете объявления, раскомментируйте следующую строку
            // 'activeAnnouncements' => $activeAnnouncements ?? collect(),
        ]);
    }

    /**
     * Сохраняет бронирование, созданное КЛИЕНТОМ.
     * Содержит правильную логику проверки пересечений.
     */
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

        // Улучшенная проверка доступности слота (проверяем пересечение)
        $slotEndTime = $startTime->copy()->addMinutes(150); // Стандартная длительность для клиента
        
        $existing = Booking::where('start_time', '<', $slotEndTime)
            ->where('end_time', '>', $startTime)
            ->exists();

        if ($existing) {
            return back()->with('error', 'К сожалению, это время уже занято или недоступно.');
        }

        try {
            Booking::create([
                'start_time' => $startTime,
                'end_time' => $slotEndTime, // Явно указываем время окончания
                'user_id' => auth()->user()->id,
            ]);

            return back()->with('success', 'Вы успешно записаны на ' . $startTime->translatedFormat('d F Y в H:i'));

        } catch (\Exception $e) {
            Log::error('Booking error: ' . $e->getMessage());
            return back()->with('error', 'Произошла ошибка при записи. Попробуйте позже.');
        }
    }
}