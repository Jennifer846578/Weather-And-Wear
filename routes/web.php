<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/vinsen', function () {
    return view('ganteng');
});