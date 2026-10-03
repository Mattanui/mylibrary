<x-layouts::app title="Connexion">
    <div class="max-w-md mx-auto">
        <h1 class="text-3xl md:text-4xl font-bold mb-8 hidden md:block">Connexion</h1>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block font-semibold mb-1 text-lg">Adresse e-mail *</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                       class="w-full border-2 border-black p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block font-semibold mb-1 text-lg">Mot de passe *</label>
                <input type="password" id="password" name="password" required
                       class="w-full border-2 border-black p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit"
                        class="border-2 border-black bg-white px-8 py-3 font-bold text-lg cursor-pointer hover:bg-gray-200 transition-colors">
                    Se connecter
                </button>
            </div>
        </form>

        <p class="mt-6">
            Pas encore de compte ?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">S'inscrire</a>
        </p>
    </div>
</x-layouts::app>
