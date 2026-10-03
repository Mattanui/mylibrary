@props(['route'])

<li @class([
    'border-b border-gray-200 md:border-b-0 md:mr-2',
    'bg-blue-300 md:bg-transparent md:text-blue-600' => request()->routeIs($route),
])>
    <a href="{{ route($route) }}" class="block px-4 py-3 md:py-2 md:px-2 hover:text-blue-600">
        {{ $slot }}
    </a>
</li>
