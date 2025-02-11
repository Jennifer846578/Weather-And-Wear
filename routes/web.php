<?php

use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacebookController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\homepageController;

// Route::get('/', function () {
//     return view('homepage');
// });

Route::get('/',[App\Http\Controllers\homepageController::class,'index']);

// Route::post('/homepage', function () {
//     return view('homepage');
// });
Route::post('/homepage',[App\Http\Controllers\homepageController::class,'index']);

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/logins', function () {
    return view('login');
});

Route::get('/registers', function () {
    return view('register');
});

Route::get('/wardrobe', function () {
    return view('wardrobe');
});

Route::get('/details', function () {
    return view('details');
});

Route::get('/detailsTop', function () {
    return view('detailsTop');
});

Route::get('/detailsBottom', function () {
    return view('detailsBottom');
});

Route::get('/detailsStyle', function () {
    return view('detailsStyle');
});

Route::get('/history', function () {
    return view('history');
});

Route::get('/wardrobe/blazer', function () {
    return view('blazer');
})->name('wardrobe.blazer');

Route::get('/redirect',[SocialiteController::class, 'redirect'])->name('redirect')->middleware('guest');
Route::get('/callback',[SocialiteController::class, 'callback'])->name('callback')->middleware('guest');
Route::get('/logout',[SocialiteController::class, 'logout'])->name('logout')->middleware('guest');

Route::get('/auth/facebook', [FacebookController::class, 'facebookpage'])->name('auth/facebook');
Route::get('/auth/facebook/callback', [FacebookController::class, 'facebookredirect'])->name('auth/facebook/callback');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
