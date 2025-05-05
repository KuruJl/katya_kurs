<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use app\Models\Booking;
use app\Models\User;
use App\Http\Controllers\AdminBookingController;
use App\Http\Middleware\CheckAdmin;


Route::get('/', function () {
    return view('main'); 
    })->name('main');  



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

Route::middleware(['is_admin'])->group(function () {
    Route::get('/index', [AdminBookingController::class, 'index'])->name('admin.index');
    Route::get('/create', [AdminBookingController::class, 'create'])->name('admin.create');
    Route::post('/create', [AdminBookingController::class, 'store'])->name('admin.store');
    Route::delete('/{booking}', [AdminBookingController::class, 'destroy'])->name('admin.destroy');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';
