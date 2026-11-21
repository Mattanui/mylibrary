<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LivreResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'isbn' => $this->isbn,
            'categorie' => $this->categorie->nom,
            'prix' => (float) $this->prix,
            'couverture' => asset('storage/' . $this->couverture),
            'dos' => asset('storage/' . $this->dos),
        ];
    }
}
