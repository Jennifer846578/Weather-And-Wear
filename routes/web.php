<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/homepage', function () {
    return view('homepage');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/profile1', function () {
    return view('profile1');
});