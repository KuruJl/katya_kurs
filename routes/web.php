<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/main', function () {
    return view('main');
});
Route::get('/usluga', function () {
    return view('bookings.usluga');
});
// Группируем маршруты, требующие аутентификации
Route::middleware(['auth'])->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Сюда можно добавить другие маршруты, доступные только авторизованным пользователям
});

// Маршруты аутентификации Laravel (если вы использовали php artisan ui:auth или Breeze/Jetstream)
// Auth::routes(); // для ui:auth
// Или они уже определены, если вы использовали Breeze/Jetstream

// Главная страница и другие общедоступные маршруты
Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';
