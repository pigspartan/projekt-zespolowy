<?php
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\SuspendedMiddleware;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('index');
Route::resource('/', ListingController::class);


Route::middleware('auth')->group(function () {
    Route::middleware([SuspendedMiddleware::class])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/delete/{id}', [ListingController::class, 'destroy'])->name('delete');

        Route::view('/create', 'listings.create')->middleware(['auth', 'verified'])->name('listItem');
        Route::resource('listings', ListingController::class);


        // Route::view('/item/', 'listings.details')->name('details');
        Route::get('/item/{id}', [ListingController::class, 'show'])->name('itemDetails');
        Route::post('/item/{id}/flag', [ListingController::class, 'flag'])->name('listing.flag');
        Route::get('/item/unflag/{id}', [ListingController::class, 'unflag'])->name('listing.unflag');

        Route::get('/email/verify', [AuthController::class, 'verifyNotice'])->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');
        Route::post('/email/verification-notification', [AuthController::class, 'verifyResend'])->middleware('throttle:6,1')->name('verification.send');

        Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware([RoleMiddleware::class . ':Admin'])->name('admin.dashboard');
        Route::get('/admin/user/delete/{id}', [AdminController::class, 'deleteUser'])->middleware([RoleMiddleware::class . ':Admin'])->name('admin.user.delete');
        Route::get('/admin/user/restore/{id}', [AdminController::class, 'restoreUser'])->middleware([RoleMiddleware::class . ':Admin'])->name('admin.user.restore');
        Route::get('/admin/user/suspend/{id}', [AdminController::class, 'suspendUser'])->middleware([RoleMiddleware::class . ':Admin'])->name('admin.user.suspend');
        Route::get('/admin/user/inspect/{id}', [AdminController::class, 'inspectUser'])->middleware([RoleMiddleware::class . ':Admin'])->name('admin.user.inspect');
    });

    Route::view('/suspended', 'suspended')->name('suspended');
    Route::view('/logout', 'auth.logout')->name('logout');
    Route::post('/logout', [AuthController::class, 'logout']);

});

Route::middleware('guest')->group(function () {
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
    Route::post('/forgot-password', [ResetPasswordController::class, 'passwordEmail']);
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'passwordReset'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])->name('password.update');
});




Route::get('/{perPage?}', [ListingController::class, 'index'])->name('perPage');
Route::get('/userListings/{id}/{perPage?}', [ListingController::class, 'userListings'])->name('userListings');

use App\Http\Controllers\PayPalController;

Route::get('/paypal/create-payment', [PayPalController::class, 'createPayment'])->name('paypal.createPayment');
Route::get('/paypal/capture-payment', [PayPalController::class, 'capturePayment'])->name('paypal.capturePayment');
Route::post('/paypal/payout', [PayPalController::class, 'sendPayout'])->name('paypal.payout');
Route::post('/send', [MessageController::class, 'sendMessage'])->name('send');

