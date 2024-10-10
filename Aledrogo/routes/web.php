<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('index');

Route::view('/register', 'auth.register')->name('register');

Route::view('/login', 'auth.login')->name('login');
