<?php

namespace App\Livewire;

use App\Models\Categorie;
use App\Models\Livre;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Mes livres')]
class MesLivres extends Component
{
    use WithPagination;

    public string $categorie = '';
    public string $message = '';

    public function updatedCategorie()
    {
        $this->resetPage();
    }

    public function supprimer(Livre $livre)
    {
        abort_if($livre->user_id !== auth()->id(), 403);

        Storage::disk('public')->delete([$livre->couverture, $livre->dos]);
        $livre->delete();

        $this->message = 'Livre « ' . $livre->titre . ' » supprimé.';
    }

    public function render()
    {
        $livres = auth()->user()->livres()
            ->with('categorie')
            ->when($this->categorie, function ($requete) {
                $requete->where('categorie_id', $this->categorie);
            })
            ->orderBy('titre')
            ->paginate(12);

        return view('livewire.mes-livres', [
            'livres' => $livres,
            'categories' => Categorie::orderBy('nom')->get(),
        ]);
    }
}
