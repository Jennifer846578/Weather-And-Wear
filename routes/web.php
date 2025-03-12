<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\homepageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WardrobeController;
use Illuminate\Support\Facades\Auth;
// Route::get('/', function () {
//     return view('homepage');
// });

// Route::get('/test',[App\Http\Controllers\Test001Controller::class,'index']);
// Route::resource('test',   App\Http\Controllers\Test001Controller::class);

// Route::get('/', function () {
//     return view('homepage')->with('user', session('user'))->with('login_success', session('login_success'));
// });

Route::get('/',[App\Http\Controllers\homepageController::class,'index'])->name('home');

// Route::post('/homepage', function () {
//     return view('homepage');
// });
Route::post('/homepage',[App\Http\Controllers\homepageController::class,'index'])->name("root");

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
Route::delete('/wardrobe',[App\Http\Controllers\WardrobeController::class,'UndoAddWardrobe'])->name('UndoAddWardrobe');
Route::put('/wardrobe',[App\Http\Controllers\WardrobeController::class,'indexfour'])->name('detailSave');


// Route::resource('wardrobe',App\Http\Controllers\WardrobeController::class)->names([
//     'wardrobe.index'=>'wardrobe_page',
//     'wardrobe.indexone'=>'details_page',
// ]);

Route::get('/details', [App\Http\Controllers\WardrobeController::class,'indexone'])->name('details_page');
Route::post('/details',[App\Http\Controllers\WardrobeController::class,'backToIndexOne'])->name('backdetails_page');
// Route::get('/detailsBottom/{id}', [App\Http\Controllers\WardrobeController::class,'indextwob'])->name('detailsBottom');
Route::post('/detailsBottom',[App\Http\Controllers\WardrobeController::class,'indextwob'])->name('detailsBottom');
Route::post('/detailsTop',[App\Http\Controllers\WardrobeController::class,'indextwot'])->name('detailsTop');
Route::put('/detailsBottom',[App\Http\Controllers\WardrobeController::class,'indextwobret'])->name('backdetailsBottom');
Route::put('/detailsTop',[App\Http\Controllers\WardrobeController::class,'indextwotret'])->name('backdetailsTop');
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

// Route::get('/editClothes', function () {
//     return view('editClothes');
// })->name('editClothes_page');
Route::delete('/deleteClothes',[App\Http\Controllers\WardrobeController::class,'deleteWardrobeClothes'])->name('deleteWardrobeClothes');
Route::post('/ReturnEditClothes',[App\Http\Controllers\WardrobeController::class,'GetEditWardrobeOne'])->name('BackEditClothes');
Route::post('/editClothes',[App\Http\Controllers\WardrobeController::class,'editWardrobeOne'])->name('editClothes_page');
// Route::get('/editClothes',[App\Http\Controllers\WardrobeController::class,'editWardrobeGet'])->name('editClothes_page_get');
Route::put('/editClothes',[App\Http\Controllers\WardrobeController::class,'editClothesTopBottomPage'])->name('GetTopBottomEdit');
Route::put('/ReturnEditClothes',[App\Http\Controllers\WardrobeController::class,'editClothesTopBottomReturnPage'])->name('ReturnTopBottomEdit');
Route::post('/editClothesStyle',[App\Http\Controllers\WardrobeController::class,'EditClothesCategory'])->name('editStyle');
Route::put('/editClothesStyle',[App\Http\Controllers\WardrobeController::class,'EditClothesStyle'])->name('editStyleDone');
Route::post('/EditUnsave',[App\Http\Controllers\WardrobeController::class,'deleteEditWardrobe'])->name('deleteDataCopy');
// Route::post('/editClothes/image',[App\Http\Controllers\WardrobeController::class,'ChangeWardrobeImage'])->name('editWardrobeChangeImage');

Route::get('/editTopClothes', function () {
    return view('editTopClothes');
});

Route::get('/editBottomClothes', function () {
    return view('editBottomClothes');
});

Route::get('/editStyleClothes', function () {
    return view('editStyleClothes');
});

// Route::get('/history', function () {
//     return view('history');
// })->name('history_page');

Route::get('/history',[App\Http\Controllers\HistoryController::class,'index'])->name('history_page');

// Route::get('/wardrobe/blazer', function () {
//     return view('blazer');
// })->name('blazer_page');

Route::get('/wardrobe',[App\Http\Controllers\WardrobeController::class,'showWardrobe'])->name('wardrobe_page');
Route::get('/wardrobe/{category}/{favourite}/{style}/{editted}',[App\Http\Controllers\WardrobeController::class,'showWardrobeCategory'])->name('wardrobe_page_category');
Route::put('/wardrobe/favorite',[App\Http\Controllers\WardrobeController::class,'favWardrobe'])->name('wardrobe_fav');

Route::get('/redirect',[SocialiteController::class, 'redirect'])->name('redirect')->middleware('guest');
Route::get('/callback',[SocialiteController::class, 'callback'])->name('callback')->middleware('guest');
Route::get('/logout',[SocialiteController::class, 'logout'])->name('logout')->middleware('guest');

Route::get('/auth/facebook', [FacebookController::class, 'facebookpage'])->name('auth/facebook');
Route::get('/auth/facebook/callback', [FacebookController::class, 'facebookredirect'])->name('auth/facebook/callback');

Auth::routes();

// google calendar
// use App\Http\Controllers\GoogleAuthController;

// Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.auth');
// Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('google.callback');
// Route::get('/schedule', [GoogleAuthController::class, 'getCalendarEvents'])->name('view.schedule');


use App\Http\Controllers\GoogleAuthController;

Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.auth');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('google.callback');
// Route::get('/schedule', [GoogleAuthController::class, 'getCalendarEvents'])->name('view.schedule');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//test python
use App\Http\Controllers\alamaktestdoang;

Route::get('/generator',[App\Http\Controllers\GeneratorController::class,'index'])->name('generator');
Route::post('/generatorclothes',[App\Http\Controllers\GeneratorController::class,'index'])->name('generatorPost');

//menggunakan baju
use App\Http\Controllers\HistoryController;
Route::post('/useoutfit',[App\Http\Controllers\HistoryController::class,'store'])->name('UseOutfit');