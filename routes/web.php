<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use app\Models\Booking;
use app\Models\User;
use App\Http\Controllers\AdminBookingController;
use App\Http\Middleware\CheckAdmin;


// Route::get('/', function () {
 //   return view('main'); 
 //   })->name('main');  

 Route::get('/', function () {
    return 'SUCCESS! The server is working perfectly!';
});

Route::get('/service', function () {
    return view('service');
    })->name('service'); 
    Route::middleware(['auth'])->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store')->middleware('auth'); // Только для авторизованных
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    // Главная страница админ-панели с сеткой бронирований
    // URL: /admin/bookings, Имя роута: admin.bookings.index
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    
    // Создание бронирования (админом через сетку)
    // URL: /admin/bookings (метод POST), Имя роута: admin.bookings.store
    Route::post('/bookings', [AdminBookingController::class, 'store'])->name('bookings.store');
    
    // Удаление/отмена бронирования
    // URL: /admin/bookings/1 (метод DELETE), Имя роута: admin.bookings.destroy
    Route::delete('/bookings/{booking}', [AdminBookingController::class, 'destroy'])->name('bookings.destroy');

    Route::post('/bookings/manual', [AdminBookingController::class, 'storeManual'])->name('bookings.store.manual');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';
