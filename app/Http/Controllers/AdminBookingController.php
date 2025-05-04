<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;
class AdminBookingController extends Controller
{
    /**
     * Отображает список всех бронирований.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $bookings = Booking::all(); // Получаем все бронирования из базы данных
        return view('admin.index', compact('bookings'));
    }

    /**
     * Отображает форму для добавления нового бронирования.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Сохраняет новое бронирование в базу данных.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
{
    
    try {
        $startTime = Carbon::parse($request->input('start_time'));
    } catch (\Exception $e) {
        return back()->withErrors(['start_time' => 'Некорректный формат даты и времени. Пожалуйста, используйте ГГГГ-ММ-ДД ЧЧ:ММ.'])->withInput();
    }

    $formattedStartTime = $startTime->format('Y-m-d H:i');

    $request->validate([
        'start_time' => 'required|date', // Изменено на просто 'date'
        // ... другие правила ...
    ]);

    Booking::create([
        'start_time' => $formattedStartTime,
        // ... другие поля ...
    ]);

    return redirect()->route('admin.index')->with('success', 'Бронирование успешно добавлено!');
}

    /**
     * Удаляет указанное бронирование из базы данных.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        // Перенаправление на страницу со списком бронирований с уведомлением
        return redirect()->route('admin.index')->with('success', 'Бронирование успешно удалено!');
    }
}