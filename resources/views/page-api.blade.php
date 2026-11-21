<x-layouts::app title="Page API">
    <h1 class="text-3xl md:text-4xl font-bold mb-4 hidden md:block">Page API</h1>

    <p class="mb-6 text-gray-700">
        Les livres ci-dessous sont chargés en JavaScript depuis <code>GET /api/livres</code>.
    </p>

    <p id="message-etat" class="mb-4 font-semibold">Chargement des livres…</p>

    <div class="overflow-x-auto bg-white border-2 border-black">
        <table class="w-full text-left">
            <thead class="bg-gray-100 border-b-2 border-black">
            <tr>
                <th class="p-3">Couverture</th>
                <th class="p-3">Titre</th>
                <th class="p-3">ISBN</th>
                <th class="p-3">Catégorie</th>
                <th class="p-3 text-right">Prix</th>
            </tr>
            </thead>
            <tbody id="livres-body"></tbody>
        </table>
    </div>

    @vite('resources/js/page-api.js')
</x-layouts::app>
