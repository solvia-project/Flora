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

Route::get('/register', function () {
    return view('content.register');
})->name('front.register.view');

Route::get('/login', function () {
    return view('content.login');
})->name('front.login.view');

Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/classes', [ClassController::class, 'index'])->name('classes.index');

Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');

Route::get('/admin/booking', [AdminBookingController::class, 'index'])->name('admin.booking.index');

Route::get('/admin/user', [AdminUserController::class, 'index'])->name('admin.user.index');

Route::get('/admin/class', [AdminClassController::class, 'index'])->name('admin.class.index');

Route::get('/admin/editclass', [AdminClassController::class, 'edit'])->name('admin.class.edit');

Route::post('/admin/class', [AdminClassController::class, 'store'])->name('admin.class.store');

Route::put('/admin/class/{id}', [AdminClassController::class, 'update'])->name('admin.class.update');
