<div>
    <h1 class="text-3xl md:text-4xl font-bold mb-6 hidden md:block">Tous les livres</h1>

    <div class="mb-6">
        <label for="categorie" class="block font-semibold mb-1">Filtrer par catégorie</label>
        <select id="categorie" wire:model.live="categorie"
                class="w-full md:w-72 border-2 border-black p-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400">
            <option value="">Toutes les catégories</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->nom }}</option>
            @endforeach
        </select>
    </div>

    <x-livres-table :livres="$livres" />
</div>
