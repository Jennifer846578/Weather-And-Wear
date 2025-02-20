<?php

use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\homepageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Test001Controller;
use App\Http\Controllers\WardrobeController;
use Illuminate\Support\Facades\Auth;
// Route::get('/', function () {
//     return view('homepage');
// });

// Route::get('/test',[App\Http\Controllers\Test001Controller::class,'index']);
Route::resource('test',   App\Http\Controllers\Test001Controller::class);

Route::get('/',[App\Http\Controllers\homepageController::class,'index'])->name('home');

// Route::post('/homepage', function () {
//     return view('homepage');
// });
Route::post('/homepage',[App\Http\Controllers\homepageController::class,'index']);

Route::resource('profile',App\Http\Controllers\ProfileController::class);

Route::get('/profile', function () {
    return view('profile');
})->name('profile_page');

Route::get('/logins', function () {
    return view('login');
});

Route::get('/registers', function () {
    return view('register');
});

Route::get('/wardrobe', [App\Http\Controllers\WardrobeController::class,'index'])->name('wardrobe_page');
Route::post('/wardrobe', [App\Http\Controllers\WardrobeController::class,'store'])->name('wardrobe_store');
Route::put('/wardrobe',[App\Http\Controllers\WardrobeController::class,'indexfour'])->name('detailSave');


// Route::resource('wardrobe',App\Http\Controllers\WardrobeController::class)->names([
//     'wardrobe.index'=>'wardrobe_page',
//     'wardrobe.indexone'=>'details_page',
// ]);

Route::get('/details', [App\Http\Controllers\WardrobeController::class,'indexone'])->name('details_page');
// Route::get('/detailsBottom/{id}', [App\Http\Controllers\WardrobeController::class,'indextwob'])->name('detailsBottom');
Route::post('/detailsBottom',[App\Http\Controllers\WardrobeController::class,'indextwob'])->name('detailsBottom');
Route::post('/detailsTop',[App\Http\Controllers\WardrobeController::class,'indextwot'])->name('detailsTop');
Route::post('/detailsStyle',[App\Http\Controllers\WardrobeController::class,'indexthree'])->name('detailsStyle');
// Route::post('/detailSave',[App\Http\Controllers\WardrobeController::class,'indexfour'])->name('detailSave');
// Route::get('/detailsTop', function () {
//     return view('detailsTop');
// });

// Route::get('/detailsBottom', function () {
//     return view('detailsBottom');
// });

// Route::get('/detailsStyle', function () {
//     return view('detailsStyle');
// });

Route::get('/editClothes', function () {
    return view('editClothes');
})->name('editClothes_page');

Route::get('/editTopClothes', function () {
    return view('editTopClothes');
});

Route::get('/editBottomClothes', function () {
    return view('editBottomClothes');
});

Route::get('/editStyleClothes', function () {
    return view('editStyleClothes');
});

Route::get('/history', function () {
    return view('history');
})->name('history_page');

// Route::get('/wardrobe/blazer', function () {
//     return view('blazer');
// })->name('blazer_page');

Route::get('/wardrobe/blazer',[App\Http\Controllers\WardrobeController::class,'showBlazer'])->name('blazer_page');
Route::put('/wardrobe/blazer',[App\Http\Controllers\WardrobeController::class,'favBlazer'])->name('blazer_fav');

Route::get('/redirect',[SocialiteController::class, 'redirect'])->name('redirect')->middleware('guest');
Route::get('/callback',[SocialiteController::class, 'callback'])->name('callback')->middleware('guest');
Route::get('/logout',[SocialiteController::class, 'logout'])->name('logout')->middleware('guest');

Route::get('/auth/facebook', [FacebookController::class, 'facebookpage'])->name('auth/facebook');
Route::get('/auth/facebook/callback', [FacebookController::class, 'facebookredirect'])->name('auth/facebook/callback');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
