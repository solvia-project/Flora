<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('content.home');
});

Route::get('/register', function () {
    return view('content.register');
});

