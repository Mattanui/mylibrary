@props(['livres', 'actions' => false])

<div class="overflow-x-auto bg-white border-2 border-black">
    <table class="w-full text-left">
        <thead class="bg-gray-100 border-b-2 border-black">
        <tr>
            <th class="p-3">Couverture</th>
            <th class="p-3">Titre</th>
            <th class="p-3">ISBN</th>
            <th class="p-3">Catégorie</th>
            <th class="p-3 text-right">Prix</th>
            @if ($actions)
                <th class="p-3">Actions</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @forelse ($livres as $livre)
            <tr wire:key="livre-{{ $livre->id }}" class="border-b border-gray-200">
                <td class="p-3">
                    <img src="{{ asset('storage/' . $livre->couverture) }}" alt="Couverture de {{ $livre->titre }}"
                         class="h-20 w-auto border border-gray-300">
                </td>
                <td class="p-3 font-semibold">{{ $livre->titre }}</td>
                <td class="p-3">{{ $livre->isbn }}</td>
                <td class="p-3">{{ $livre->categorie->nom }}</td>
                <td class="p-3 text-right whitespace-nowrap">{{ number_format($livre->prix, 2, ',', ' ') }} €</td>
                @if ($actions)
                    <td class="p-3 whitespace-nowrap">
                        <a href="{{ route('livres.edit', $livre) }}" class="text-blue-600 hover:underline mr-3">Modifier</a>
                        <button type="button"
                                wire:click="supprimer({{ $livre->id }})"
                                wire:confirm="Supprimer définitivement « {{ $livre->titre }} » ?"
                                class="text-red-600 hover:underline cursor-pointer">
                            Supprimer
                        </button>
                    </td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="{{ $actions ? 6 : 5 }}" class="p-6 text-center text-gray-500">Aucun livre à afficher.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">
    {{ $livres->links() }}
</div>
