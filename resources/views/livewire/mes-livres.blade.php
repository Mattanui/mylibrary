<div>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <h1 class="text-3xl md:text-4xl font-bold hidden md:block">Mes livres</h1>
        <a href="{{ route('livres.create') }}"
           class="inline-block text-center border-2 border-black bg-white px-6 py-2 font-bold hover:bg-gray-200 transition-colors">
            + Ajouter un livre
        </a>
    </div>

    @if ($message)
        <div class="mb-6 border-2 border-green-700 bg-green-50 text-green-800 font-semibold px-4 py-3">
            {{ $message }}
        </div>
    @endif

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

    <x-livres-table :livres="$livres" :actions="true" />
</div>
