<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\ClassController as AdminClassController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

Route::get('/', [HomeController::class, 'index'])->name('home');

//

Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/classes', [ClassController::class, 'index'])->name('classes.index');

Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
Route::post('/booking', [BookingController::class, 'store'])->middleware('auth')->name('booking.store');
Route::post('/booking/pay', [BookingController::class, 'pay'])->middleware('auth')->name('booking.pay');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/booking', [AdminBookingController::class, 'index'])->name('admin.booking.index');
    Route::get('/admin/user', [AdminUserController::class, 'index'])->name('admin.user.index');
    Route::get('/admin/class', [AdminClassController::class, 'index'])->name('admin.class.index');
    Route::get('/admin/editclass', [AdminClassController::class, 'edit'])->name('admin.class.edit');
    Route::post('/admin/class', [AdminClassController::class, 'store'])->name('admin.class.store');
    Route::put('/admin/class/{id}', [AdminClassController::class, 'update'])->name('admin.class.update');
    Route::delete('/admin/class/{id}', [AdminClassController::class, 'destroy'])->name('admin.class.destroy');
});

require __DIR__.'/auth.php';
