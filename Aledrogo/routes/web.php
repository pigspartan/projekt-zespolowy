<?php
use App\Http\Controllers\ListingController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::view('/logout', 'auth.logout')->name('logout');
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::view('/', 'index')->name('index');
Route::resource('/',ListingController::class);

Route::view('/create', 'listings.create')->middleware('auth')->name('listItem');
Route::resource('listings', ListingController::class);

Route::get('/{perPage?}', [ListingController::class, 'index'])->name('perPage');
