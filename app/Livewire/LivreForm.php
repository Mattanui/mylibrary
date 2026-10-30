<?php

namespace App\Livewire;

use App\Models\Categorie;
use App\Models\Livre;
use App\Rules\Isbn;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class LivreForm extends Component
{
    use WithFileUploads;

    public ?Livre $livre = null;

    public string $titre = '';
    public string $isbn = '';
    public string $prix = '';
    public string $categorie_id = '';

    public $couverture = null;
    public $dos = null;

    public function mount(?Livre $livre = null) {
        if ($livre) {
            abort_if($livre->user_id !== auth()->id(), 403);

            $this->livre = $livre;
            $this->titre = $livre->titre;
            $this->isbn = $livre->isbn;
            $this->prix = $livre->prix;
            $this->categorie_id = $livre->categorie_id;
        }
    }

    protected function rules(): array {
        $imageObligatoire = $this->livre ? 'nullable' : 'required';

        return [
            'titre' => ['required', 'string', 'max:255'],
            'isbn' => [
                'required',
                'string',
                new Isbn(),
                Rule::unique('livres', 'isbn')->ignore($this->livre?->id),
            ],
            'prix' => ['required', 'numeric', 'min:0', 'max:999999.99'],
            'categorie_id' => ['required', 'exists:categories,id'],
            'couverture' => [$imageObligatoire, 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'dos' => [$imageObligatoire, 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function save() {
        $this->isbn = strtoupper(str_replace(['-', ' '], '', $this->isbn));

        $donnees = $this->validate();

        if ($this->couverture) {
            $donnees['couverture'] = $this->stockerImage($this->couverture, $this->livre?->couverture);
        } else {
            unset($donnees['couverture']);
        }

        if ($this->dos) {
            $donnees['dos'] = $this->stockerImage($this->dos, $this->livre?->dos);
        } else {
            unset($donnees['dos']);
        }

        if ($this->livre) {
            $this->livre->update($donnees);
            session()->flash('message', 'Livre modifié.');
        } else {
            auth()->user()->livres()->create($donnees);
            session()->flash('message', 'Livre ajouté.');
        }

        return $this->redirectRoute('livres.mes');
    }

    private function stockerImage($fichier, ?string $ancienChemin): string {
        if ($ancienChemin) {
            Storage::disk('public')->delete($ancienChemin);
        }

        return $fichier->store('livres', 'public');
    }

    public function render()
    {
        return view('livewire.livre-form', [
            'categories' => Categorie::orderBy('nom')->get(),
        ])->title($this->livre ? 'Modifier un livre' : 'Ajouter un livre');
    }
}
