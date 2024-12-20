<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/profile', function () {
    return view('profile');
});

abc
Route::get('/push', function () {
    return view('profile');
});
