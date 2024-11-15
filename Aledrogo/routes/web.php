<?php
use App\Http\Controllers\ListingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('index');
Route::resource('/',ListingController::class);

Route::middleware('auth')->group(function () {
    Route::view('/logout', 'auth.logout')->name('logout');
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/delete/{id}', [ListingController::class, 'destroy'])->name('delete');

    // Route::view('/item/', 'listings.details')->name('details');
    Route::get('/item/{id}', [ListingController::class, 'show'])->name('itemDetails');

    Route::get('/email/verify', [AuthController::class, 'verifyNotice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification', [AuthController::class, 'verifyResend'])->middleware('throttle:6,1')->name('verification.send');
});

Route::middleware('guest')->group(function () {
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
    Route::post('/forgot-password',[ResetPasswordController::class, 'passwordEmail']);
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'passwordReset'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])->name('password.update');
});



Route::view('/create', 'listings.create')->middleware(['auth', 'verified'])->name('listItem');
Route::resource('listings', ListingController::class);

Route::get('/{perPage?}', [ListingController::class, 'index'])->name('perPage');

use App\Http\Controllers\PayPalController;

Route::get('/paypal/create-payment', [PayPalController::class, 'createPayment'])->name('paypal.createPayment');
Route::get('/paypal/capture-payment', [PayPalController::class, 'capturePayment'])->name('paypal.capturePayment');
Route::post('/paypal/payout', [PayPalController::class, 'sendPayout'])->name('paypal.payout');
