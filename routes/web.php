<?php

use App\Livewire\LivreForm;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Livewire\MesLivres;
use App\Livewire\TousLesLivres;

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

    Route::livewire('/livres', TousLesLivres::class)->name('livres.index');
    Route::livewire('/mes-livres', MesLivres::class)->name('livres.mes');
    Route::livewire('/livres/ajouter', LivreForm::class)->name('livres.create');
    Route::livewire('/livres/{livre}/modifier', LivreForm::class)->name('livres.edit');
    Route::view('/page-api', 'en-construction', ['title' => 'Page API'])->name('page-api');
});
