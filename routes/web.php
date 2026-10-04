<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;

Route::redirect('/', '/livres');

Route::middleware('guest')->group(function () {
    Route::get('/inscription', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/inscription', [AuthController::class, 'register']);

    Route::get('/connexion', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/connexion', [AuthController::class, 'login']);

    Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
    Route::get('/auth/google/callback', [GoogleController::class, 'callback']);
});

Route::middleware('auth')->group(function () {
    Route::post('/deconnexion', [AuthController::class, 'logout'])->name('logout');

    Route::view('/livres', 'en-construction', ['title' => 'Tous les livres'])->name('livres.index');
    Route::view('/mes-livres', 'en-construction', ['title' => 'Mes livres'])->name('livres.mes');
    Route::view('/livres/ajouter', 'en-construction', ['title' => 'Ajouter un livre'])->name('livres.create');
    Route::view('/page-api', 'en-construction', ['title' => 'Page API'])->name('page-api');
});
