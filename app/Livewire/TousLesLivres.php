<?php

namespace App\Livewire;

use App\Models\Categorie;
use App\Models\Livre;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Tous les livres')]
class TousLesLivres extends Component
{
    use WithPagination;

    public string $categorie = '';

    public function updatedCategorie()
    {
        $this->resetPage();
    }

    public function render()
    {
        $livres = Livre::with('categorie')
            ->when($this->categorie, function ($requete) {
                $requete->where('categorie_id', $this->categorie);
            })
            ->orderBy('titre')
            ->paginate(12);

        return view('livewire.tous-les-livres', [
            'livres' => $livres,
            'categories' => Categorie::orderBy('nom')->get(),
        ]);
    }
}
