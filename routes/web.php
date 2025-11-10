<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('content.home');
});

Route::get('/register', function () {
    return view('content.register');
});

Route::get('/login', function () {
    return view('content.login');
});

Route::get('/about', function () {
    return view('content.aboutus');
});

Route::get('/classes', function () {
    return view('content.class');
});

Route::get('/booking', function () {
    return view('content.booking');
});

Route::get('/admin/booking', function () {
    return view('admin.booking');
});

Route::get('/admin/user', function () {
    return view('admin.user');
});
