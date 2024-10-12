<?php
use App\Http\Controllers\ListingController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('index');

Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::view('/logout', 'auth.logout')->name('logout');
Route::post('/logout', [AuthController::class, 'logout']);


Route::view('/listings','listings.index')->name('home');
Route::resource('listings', ListingController::class);
