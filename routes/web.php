<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use app\Models\Booking;
use app\Models\User;

Route::get('/', function () {
    return view('main'); // или ваш шаблон
})->name('main');  // ⚠️ Важно: имя должно быть 'main'
Route::get('/service', function () {
    return view('service');
})->name('service'); // Добавляем имя маршрута
// Группируем маршруты, требующие аутентификации

Route::middleware(['auth'])->group(function () {
            Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
            // routes/web.php
        Route::post('/bookings', [BookingController::class, 'store'])
        ->name('bookings.store')
        ->middleware('auth'); // Только для авторизованных
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Сюда можно добавить другие маршруты, доступные только авторизованным пользователям
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    // Другие защищённые маршруты
});


// Маршруты аутентификации Laravel (если вы использовали php artisan ui:auth или Breeze/Jetstream)
// Auth::routes(); // для ui:auth
// Или они уже определены, если вы использовали Breeze/Jetstream

// Главная страница и другие общедоступные маршруты

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';
