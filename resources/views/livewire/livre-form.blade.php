<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl md:text-4xl font-bold mb-8 hidden md:block">
        {{ $livre ? 'Modifier un livre' : 'Ajouter un livre' }}
    </h1>

    <form wire:submit="save" class="space-y-4">

        <div>
            <label for="titre" class="block font-semibold mb-1 text-lg">Titre *</label>
            <input type="text" id="titre" wire:model="titre"
                   class="w-full border-2 border-black p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            @error('titre')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="isbn" class="block font-semibold mb-1 text-lg">ISBN * (10 ou 13 caractères)</label>
            <input type="text" id="isbn" wire:model="isbn" placeholder="978-2-07-036822-8"
                   class="w-full border-2 border-black p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            @error('isbn')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="prix" class="block font-semibold mb-1 text-lg">Prix (€) *</label>
            <input type="number" id="prix" wire:model="prix" step="0.01" min="0"
                   class="w-full border-2 border-black p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            @error('prix')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="categorie_id" class="block font-semibold mb-1 text-lg">Catégorie *</label>
            <select id="categorie_id" wire:model="categorie_id"
                    class="w-full border-2 border-black p-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="">-- Choisir une catégorie --</option>
                @foreach ($categories as $categorie)
                <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                @endforeach
            </select>
            @error('categorie_id')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="couverture" class="block font-semibold mb-1 text-lg">
                Image de couverture {{ $livre ? '(laisser vide pour garder l\'actuelle)' : '*' }}
            </label>
            <input type="file" id="couverture" wire:model="couverture" accept=".jpg,.jpeg,.png,.webp"
                   class="w-full border-2 border-black p-2 bg-white">
            <p class="text-sm text-gray-500 mt-1">JPEG ou WebP recommandé, 2 Mo maximum.</p>
            <p wire:loading wire:target="couverture" class="text-sm text-blue-600 mt-1">Envoi en cours…</p>
            @error('couverture')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror

            @if ($couverture && $couverture->isPreviewable())
            <img src="{{ $couverture->temporaryUrl() }}" alt="Aperçu de la couverture" class="mt-2 h-40 border-2 border-black">
            @elseif ($livre)
            <img src="{{ asset('storage/' . $livre->couverture) }}" alt="Couverture actuelle" class="mt-2 h-40 border-2 border-black">
            @endif
        </div>

        <div>
            <label for="dos" class="block font-semibold mb-1 text-lg">
                Image du dos {{ $livre ? '(laisser vide pour garder l\'actuelle)' : '*' }}
            </label>
            <input type="file" id="dos" wire:model="dos" accept=".jpg,.jpeg,.png,.webp"
                   class="w-full border-2 border-black p-2 bg-white">
            <p class="text-sm text-gray-500 mt-1">JPEG ou WebP recommandé, 2 Mo maximum.</p>
            <p wire:loading wire:target="dos" class="text-sm text-blue-600 mt-1">Envoi en cours…</p>
            @error('dos')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror

            @if ($dos && $dos->isPreviewable())
            <img src="{{ $dos->temporaryUrl() }}" alt="Aperçu du dos" class="mt-2 h-40 border-2 border-black">
            @elseif ($livre)
            <img src="{{ asset('storage/' . $livre->dos) }}" alt="Dos actuel" class="mt-2 h-40 border-2 border-black">
            @endif
        </div>

        <div class="flex justify-end mt-4">
            <button type="submit" wire:loading.attr="disabled"
                    class="border-2 border-black bg-white px-8 py-3 font-bold text-lg cursor-pointer hover:bg-gray-200 transition-colors">
                Enregistrer
            </button>
        </div>
    </form>
</div>
