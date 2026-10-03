<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'test-layout');
Route::view('/connexion', 'test-layout')->name('login');
Route::view('/inscription', 'test-layout')->name('register');
