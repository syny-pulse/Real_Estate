<header class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{route('home')}}" class="text-2xl font-bold text-blue-800">{{ config('app.name', 'PropertyFinder') }}</a>
        <nav class="hidden md:flex space-x-6">
            <a href="{{route('home')}}" class="font-medium text-blue-800">Home</a>
            <a href="{{route('properties.index')}}" class="font-medium text-gray-600 hover:text-blue-800">Listed Properties</a>
            <a href="{{route('property.owner.benefits')}}" class="font-medium text-gray-600 hover:text-blue-800">Property Owner</a>
            <a href="/about" class="font-medium text-gray-600 hover:text-blue-800">About Us</a>
            <a href="/contact" class="font-medium text-gray-600 hover:text-blue-800">Contact Us</a>
        </nav>
        <div class="relative inline-block text-left">
            @guest
                <a href="{{route('login.show')}}" class="font-medium text-gray-600 hover:text-blue-800">Login</a>
                <a href="{{route('register.show')}}" class="btn-primary">Register</a>
            @else
                <div class="relative" id="user-menu-container">
                    <button id="user-menu-button" type="button" class="inline-flex items-center space-x-2 focus:outline-none" aria-expanded="false" aria-haspopup="true">
                        <svg class="w-8 h-8 text-gray-700" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                        <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="user-menu" class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <div class="py-1" role="none">
                            <a href="/my-booked-properties" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="menu-item-0">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2v-5H3v5a2 2 0 002 2z"/>
                                </svg>
                                My Bookings
                            </a>
                            <a href="/my-wishlist" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="menu-item-1">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                My Wishlist
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="menu-item-2">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                Notifications
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left flex items-center px-4 py-2 text-sm text-red-600 hover:bg-gray-100" role="menuitem" tabindex="-1" id="menu-item-3">
                                    <svg class="w-5 h-5 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7"/>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</header>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const userMenuButton = document.getElementById('user-menu-button');
    const userMenu = document.getElementById('user-menu');
    const userMenuContainer = document.getElementById('user-menu-container');

    function toggleMenu() {
        if (userMenu.classList.contains('hidden')) {
            userMenu.classList.remove('hidden');
            userMenuButton.setAttribute('aria-expanded', 'true');
        } else {
            userMenu.classList.add('hidden');
            userMenuButton.setAttribute('aria-expanded', 'false');
        }
    }

    userMenuButton.addEventListener('click', function (event) {
        event.stopPropagation();
        toggleMenu();
    });

    let hideTimeout;
    userMenuContainer.addEventListener('mouseleave', function () {
        hideTimeout = setTimeout(() => {
            userMenu.classList.add('hidden');
            userMenuButton.setAttribute('aria-expanded', 'false');
        }, 300); // Delay hiding by 300ms for smoother experience
    });

    userMenuContainer.addEventListener('mouseenter', function () {
        clearTimeout(hideTimeout);
        userMenu.classList.remove('hidden');
        userMenuButton.setAttribute('aria-expanded', 'true');
    });

    document.addEventListener('click', function (event) {
        if (!userMenuContainer.contains(event.target)) {
            userMenu.classList.add('hidden');
            userMenuButton.setAttribute('aria-expanded', 'false');
        }
    });
});
</script>
