<?php

use App\Http\Controllers\Api\LivreController;
use Illuminate\Support\Facades\Route;

// GET /api/livres : réservé aux utilisateurs connectés, 60 appels par minute au maximum
Route::get('/livres', [LivreController::class, 'index'])
    ->middleware(['auth:sanctum', 'throttle:60,1'])
    ->name('api.livres');
