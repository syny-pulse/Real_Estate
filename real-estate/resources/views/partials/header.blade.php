<header class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-800">{{ config('app.name', 'PropertyFinder') }}</a>
        <nav class="hidden md:flex space-x-6">
            <a href="{{ route('home') }}" class="font-medium {{ request()->routeIs('home') ? 'text-blue-800' : 'text-gray-600 hover:text-blue-800' }}">Home</a>
            <a href="{{ route('properties.index') }}" class="font-medium {{ request()->routeIs('properties.*') ? 'text-blue-800' : 'text-gray-600 hover:text-blue-800' }}">Listed Properties</a>
            <a href="{{ route('about') }}" class="font-medium {{ request()->routeIs('about') ? 'text-blue-800' : 'text-gray-600 hover:text-blue-800' }}">About Us</a>
            <a href="{{ route('contact') }}" class="font-medium {{ request()->routeIs('contact') ? 'text-blue-800' : 'text-gray-600 hover:text-blue-800' }}">Contact Us</a>
            <a href="{{ route('property_owner.index') }}" class="font-medium {{ request()->routeIs('property_owner.*') ? 'text-blue-800' : 'text-gray-600 hover:text-blue-800' }}">Property Owner</a>
        </nav>
        <div class="flex items-center space-x-4">
            @guest
                <a href="{{ route('login') }}" class="font-medium text-gray-600 hover:text-blue-800">Login</a>
                <a href="{{ route('register') }}" class="btn-primary">Register</a>
            @else
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center font-medium text-gray-600 hover:text-blue-800">
                        {{ Auth::user()->name }}
                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</header>