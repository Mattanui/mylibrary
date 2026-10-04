<x-layouts::app title="Inscription">
    <div class="max-w-md mx-auto">
        <h1 class="text-3xl md:text-4xl font-bold mb-8 hidden md:block">Inscription</h1>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block font-semibold mb-1 text-lg">Nom *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       class="w-full border-2 border-black p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block font-semibold mb-1 text-lg">Adresse e-mail *</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                       class="w-full border-2 border-black p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block font-semibold mb-1 text-lg">Mot de passe * (8 caractères minimum)</label>
                <input type="password" id="password" name="password" required
                       class="w-full border-2 border-black p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block font-semibold mb-1 text-lg">Confirmation du mot de passe *</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                       class="w-full border-2 border-black p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit"
                        class="border-2 border-black bg-white px-8 py-3 font-bold text-lg cursor-pointer hover:bg-gray-200 transition-colors">
                    S'inscrire
                </button>
            </div>
        </form>

        @if (config('services.google.client_id'))
        <div class="mt-6 text-center">
            <p class="text-gray-500 mb-3">ou</p>
            <a href="{{ route('google.redirect') }}"
               class="inline-block border-2 border-black bg-white px-8 py-3 font-bold hover:bg-gray-200 transition-colors">
                Continuer avec Google
            </a>
        </div>
        @endif

        <p class="mt-6">
            Déjà un compte ?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Se connecter</a>
        </p>
    </div>
</x-layouts::app>
