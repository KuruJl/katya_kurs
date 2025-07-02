<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AdminBookingController extends Controller
{
    /**
     * Отображает интерактивную сетку для управления бронированиями.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function storeManual(Request $request)
    {
        $request->validate([
            'start_time' => 'required|date',
            'duration' => 'required|integer|min:1',
            'note' => 'nullable|string|max:255',
        ]);

        $startTime = Carbon::parse($request->input('start_time'));

        // ======================= ВОТ ИСПРАВЛЕНИЕ =======================
        // Мы явно преобразуем строковое значение из запроса в число (integer)
        // с помощью (int).
        $durationInMinutes = (int) $request->input('duration');
        $endTime = $startTime->copy()->addMinutes($durationInMinutes);
        // ===============================================================

        // Проверка на пересечение с другими записями
        $existing = Booking::where(function ($query) use ($startTime, $endTime) {
            $query->where('start_time', '<', $endTime)
                  ->where('end_time', '>', $startTime);
        })->exists();

        if ($existing) {
            return back()->with('error', 'Это время уже пересекается с существующей записью.');
        }

        // Используем ID админа, а в примечании укажем, что это ручная блокировка.
        Booking::create([
            'start_time' => $startTime,
            'end_time' => $endTime,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('admin.bookings.index')->with('success', 'Время успешно заблокировано!');
    }


    /**
     * Отображает интерактивную сетку для управления бронированиями.
     * Улучшенная версия, которая учитывает ручные записи.
     */
    public function index(Request $request)
    {
        Carbon::setLocale('ru');
        $viewStartDate = Carbon::parse($request->input('start_date', Carbon::today()))->startOfDay();
        $viewEndDate = $viewStartDate->copy()->addDays(13)->endOfDay();
        $slotIntervalMinutes = 150;
        $workingHoursStart = 8;
        $workingHoursEnd = 21;

        $existingBookings = Booking::with('user')
            ->where('start_time', '<', $viewEndDate)
            ->where('end_time', '>', $viewStartDate)
            ->get();

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
                'slots' => [],
                'is_fully_blocked' => false, // Новый флаг
                'blocker_booking_id' => null, // ID брони, которая блокирует день
            ];

            $dayStartTime = $date->copy()->hour($workingHoursStart)->minute(0);
            $dayEndTime = $date->copy()->hour($workingHoursEnd)->minute(0);

            // Ищем бронь, которая полностью покрывает рабочий день
            $fullDayBlocker = $existingBookings->first(function ($booking) use ($dayStartTime, $dayEndTime) {
                return $booking->start_time <= $dayStartTime && $booking->end_time >= $dayEndTime;
            });

            if ($fullDayBlocker) {
                $timeSlotsGrid[$dateStr]['is_fully_blocked'] = true;
                $timeSlotsGrid[$dateStr]['blocker_booking_id'] = $fullDayBlocker->id;
            }

            $timePeriod = CarbonPeriod::create($dayStartTime, $slotIntervalMinutes . ' minutes', $dayEndTime->subMinute());

            foreach ($timePeriod as $slotStart) {
                $slotEnd = $slotStart->copy()->addMinutes($slotIntervalMinutes);
                $timeStr = $slotStart->format('H:i');
                $dateTimeStrForm = $slotStart->format('Y-m-d H:i:s');
                $isPast = $slotStart->isPast();

                $conflictingBooking = $existingBookings->first(function ($booking) use ($slotStart, $slotEnd) {
                    return $booking->start_time < $slotEnd && $booking->end_time > $slotStart;
                });

                $timeSlotsGrid[$dateStr]['slots'][$timeStr] = [
                    'datetime_form' => $dateTimeStrForm,
                    'is_available' => is_null($conflictingBooking) && !$isPast,
                    'is_past' => $isPast,
                    'booking_info' => $conflictingBooking ? [
                        'id' => $conflictingBooking->id,
                        'user_name' => $conflictingBooking->user->name . ' (' . $conflictingBooking->start_time->format('H:i') . '-' . $conflictingBooking->end_time->format('H:i') . ')',
                        'user_email' => $conflictingBooking->user->email ?? ''
                    ] : null,
                ];
            }
        }
        return view('admin.bookings.index', [
            'timeSlotsGrid' => $timeSlotsGrid,
            'viewStartDate' => $viewStartDate,
            'viewEndDate' => $viewEndDate,
        ]);
    }

    /**
     * Сохраняет новое бронирование (забронированное админом).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_time' => 'required|date_format:Y-m-d H:i:s|after_or_equal:now',
        ]);

        $startTime = Carbon::parse($request->input('start_time'));

        // Проверка, не занято ли уже время
        if (Booking::where('start_time', $startTime)->exists()) {
            return back()->with('error', 'Это время уже занято.');
        }

        // Админ бронирует слот на свое имя
        Booking::create([
            'start_time' => $startTime,
            'end_time' => $startTime->copy()->addMinutes(150),
            'user_id' => Auth::id(), // ID администратора
        ]);

        return back()->with('success', 'Слот успешно забронирован!');
    }

    /**
     * Удаляет указанное бронирование.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return back()->with('success', 'Бронирование успешно отменено!');
    }
}