@props(['title' => 'MyLibrary'])

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} - MyLibrary</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-50 text-gray-800 font-sans">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
            <div class="flex justify-between items-center p-4 md:px-8">
                <a href="{{ url('/') }}" class="text-2xl md-text-3xl font-blod">MyLibrary</a>
                <label for="burger-toggle" class="cursor-pointer md:hidden flex flex-col justify-between h-5 w-7">
                    <span class="block h-1 w-full bg-black rounded"></span>
                    <span class="block h-1 w-full bg-black rounded"></span>
                    <span class="block h-1 w-full bg-black rounded"></span>
                </label>
            </div>

            <input type="checkbox" id="burger-toggle" class="hidden peer">

            <div class="block peer-checked:hidden md:hidden bg-blue-300 text-blue-800 font-semibold px-4 py-3 border-t border-gray-200">
                {{ $title }}
            </div>

            <nav class="hidden peer-checked:block md:block border-t border-gray-200 md:border-t-0 md:px-8">
                <ul class="flex flex-col md:flex-row text-sm md:text-base font-semibold">
                    @auth
                    <x-nav-lien route="livres.index">Tous les livres</x-nav-lien>
                    <x-nav-lien route="livres.mes">Mes livres</x-nav-lien>
                    <x-nav-lien route="livres.create">Ajouter un livre</x-nav-lien>
                    <x-nav-lien route="page-api">Page API</x-nav-lien>

                    <li class="md:ml-auto">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="block w-full text-left px-4 py-3 md:py-2 md:px-2 font-semibold cursor-pointer hover:text-blue-600">
                                Déconnexion
                            </button>
                        </form>
                    </li>
                    @else
                    <x-nav-lien route="login">Connexion</x-nav-lien>
                    <x-nav-lien route="register">Inscription</x-nav-lien>
                    @endauth
                </ul>
            </nav>
        </header>

        <main class="flex-grow p-4 md:p-8 max-w-7xl mx-auto w-full">
            {{ $slot }}
        </main>

        <footer class="bg-white py-8 mt-4 border-t border-gray-200 px-4 md:px-8">
            <div class="flex flex-col md:flex-row items-center space-y-3 md:space-y-0">
                <div class="w-full md:w-1/2 flex justify-center">
                    <p class="font-medium text-sm text-gray-800">Andreas Pettiaux @2026</p>
                </div>

                <div class="w-full md:w-1/2 flex justify-center items-center space-x-3">
                    <span class="text-sm font-medium text-gray-800">Suivez-moi :</span>

                    <div class="flex space-x-2">
                        <a href="https://www.linkedin.com" target="_blank" rel="noopener noreferrer"
                           class="w-6 h-6 bg-black text-white flex items-center justify-center rounded-sm font-bold text-xs hover:bg-gray-700 transition-colors">
                            in
                        </a>

                        <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer"
                           class="w-6 h-6 bg-black text-white flex items-center justify-center rounded-sm font-bold text-xs hover:bg-gray-700 transition-colors">
                            f
                        </a>

                        <a href="https://twitter.com" target="_blank" rel="noopener noreferrer"
                           class="w-6 h-6 bg-black text-white flex items-center justify-center rounded-sm hover:bg-gray-700 transition-colors">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    @livewireScripts
</body>

</html>
