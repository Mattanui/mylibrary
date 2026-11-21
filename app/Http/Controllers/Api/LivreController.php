<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LivreResource;
use App\Models\Livre;

class LivreController extends Controller
{
    // GET /api/livres : tous les livres, au format JSON
    public function index()
    {
        $livres = Livre::with('categorie')->orderBy('titre')->get();

        return LivreResource::collection($livres);
    }
}
