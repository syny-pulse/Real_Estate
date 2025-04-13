<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'PropertyFinder') }} - @yield('title', 'Find Your Dream Home')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-50">

    <!-- Unified Header for All Users -->
    <header class="bg-blue-800 shadow-md">
        <div class="container mx-auto px-4">
            <!-- Top navigation bar -->
            <div class="flex justify-between items-center py-4">
                <a href="/" class="text-2xl font-bold text-white">{{ config('app.name', 'PropertyFinder') }}</a>

                <div class="flex items-center space-x-6">
                    @guest
                        <div class="flex space-x-3">
                            <a href="{{ route('login') }}"
                                class="px-4 py-2 border border-white text-white rounded-md hover:bg-white hover:text-blue-800 transition">Log
                                In</a>
                            <a href="{{ route('register') }}"
                                class="px-4 py-2 bg-white text-blue-800 rounded-md hover:bg-blue-100 transition">Sign Up</a>
                        </div>
                    @else
                        <div class="relative group">
                            <button class="flex items-center space-x-2 text-white focus:outline-none">
                                <div class="h-10 w-10 rounded-full overflow-hidden border-2 border-white">
                                    @if (Auth::user()->profile_image)
                                        <img src="{{ Auth::user()->profile_image }}" alt="{{ Auth::user()->name }}"
                                            class="h-full w-full object-cover">
                                    @else
                                        <div
                                            class="h-full w-full bg-blue-600 flex items-center justify-center text-white text-lg font-bold">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div
                                class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg py-1 z-50 hidden group-hover:block">
                                <a href="/dashboard"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Dashboard</a>
                                <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Profile
                                    Settings</a>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest

                    <!-- Mobile menu button -->
                    <button type="button" class="md:hidden text-white focus:outline-none" aria-label="Toggle menu">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    @auth
        <!-- Dashboard Profile Section -->
        <section class="bg-white border-b border-gray-200 py-6">
            <div class="container mx-auto px-4">
                <div class="flex flex-col sm:flex-row items-center justify-between">
                    <!-- User Info -->
                    <div class="flex items-center mb-4 sm:mb-0">
                        <div class="relative h-16 w-16 rounded-full overflow-hidden border-2 border-blue-800 mr-4 group">
                            @if (Auth::user()->profile_image)
                                <img src="{{ Auth::user()->profile_image }}" alt="{{ Auth::user()->name }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full bg-blue-800 flex items-center justify-center text-white text-xl font-bold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            @endif

                            <!-- Edit Profile Image Overlay -->
                            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer"
                                onclick="document.getElementById('profile-image-upload').click()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>

                            <form id="profile-image-form" action="{{ route('profile.update-image') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="file" id="profile-image-upload" name="profile_image" class="hidden"
                                    onchange="document.getElementById('profile-image-form').submit()">
                            </form>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">{{ Auth::user()->name }}</h2>
                            <div class="flex items-center text-gray-600 text-sm mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span>{{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- User Stats Summary -->
                    <div class="flex flex-wrap gap-4">
                        <div class="bg-gray-50 rounded-lg px-4 py-3 text-center">
                            <p class="text-xs text-gray-500">Member Since</p>
                            <p class="text-lg font-semibold text-gray-800">{{ Auth::user()->created_at->format('M Y') }}
                            </p>
                        </div>
                        <div class="bg-gray-50 rounded-lg px-4 py-3 text-center">
                            <p class="text-xs text-gray-500">Properties</p>
                            <p class="text-lg font-semibold text-gray-800">{{ $totalProperties ?? 0 }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg px-4 py-3 text-center">
                            <p class="text-xs text-gray-500">Rating</p>
                            <div class="flex items-center justify-center text-yellow-400">
                                <span
                                    class="text-lg font-semibold text-gray-800 mr-1">{{ number_format(Auth::user()->average_rating ?? 0, 1) }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endauth
    <!-- Main Dashboard Content -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Left Sidebar - Navigation -->
                <div class="lg:w-1/4">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">Dashboard Menu</h3>
                        <nav>
                            <ul class="space-y-2">
                                <li>
                                    <a href="#properties"
                                        class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-800 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        My Properties
                                    </a>
                                </li>
                                <!-- Bookings & Requests Dropdown - CSS only -->
                                <li class="relative group">
                                    <button
                                        class="flex items-center justify-between w-full p-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-800 transition">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span>Bookings & Requests</span>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4 transition-transform group-hover:rotate-180" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <div class="pl-8 mt-2 space-y-2 hidden group-hover:block">
                                        <a href="#active-bookings"
                                            class="block p-2 text-sm text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-800 transition">
                                            Active Bookings
                                        </a>
                                        <a href="#pending-requests"
                                            class="block p-2 text-sm text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-800 transition">
                                            Pending Requests
                                        </a>
                                        <a href="#booking-history"
                                            class="block p-2 text-sm text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-800 transition">
                                            Booking History
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <a href="#messages"
                                        class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-800 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                        </svg>
                                        Messages
                                    </a>
                                </li>
                                <!-- Financial Dropdown - CSS only -->
                                <li class="relative group">
                                    <button
                                        class="flex items-center justify-between w-full p-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-800 transition">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Financial</span>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4 transition-transform group-hover:rotate-180" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <div class="pl-8 mt-2 space-y-2 hidden group-hover:block">
                                        <a href="#earnings"
                                            class="block p-2 text-sm text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-800 transition">
                                            Earnings Summary
                                        </a>
                                        <a href="#transactions"
                                            class="block p-2 text-sm text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-800 transition">
                                            Transactions
                                        </a>
                                        <a href="#withdrawals"
                                            class="block p-2 text-sm text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-800 transition">
                                            Withdrawals
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <a href="#reviews"
                                        class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-800 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-.38 1.81.588 1.81h4.914a1 1 0 00.951-.69l1.519-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                        Ratings & Reviews
                                    </a>
                                </li>
                                <li>
                                    <a href="#settings"
                                        class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-800 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Account Settings
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-lg shadow-md p-6 mt-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">Quick Actions</h3>
                        <div class="space-y-4">
                            <a href="{{ route('properties.create') }}"
                                class="block w-full py-3 px-4 bg-blue-800 text-white rounded-md text-center hover:bg-blue-900 transition">
                                Add New Property
                            </a>
                            <a href="/withdraw"
                                class="block w-full py-3 px-4 border border-blue-800 text-blue-800 rounded-md text-center hover:bg-blue-50 transition">
                                Request Withdrawal
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="lg:w-3/4">
                    <!-- My Properties Section -->
                    <div id="properties" class="bg-white rounded-lg shadow-md p-6 mb-8">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-semibold text-gray-800">My Properties</h3>
                            <a href="{{ route('properties.create') }}"
                                class="px-4 py-2 bg-blue-800 text-white rounded-md hover:bg-blue-900 transition">Add
                                New Property</a>
                        </div>

                        <!-- Properties Filter Tabs -->
                        <div class="mb-6 border-b border-gray-200">
                            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" role="tablist">
                                <li class="mr-2" role="presentation">
                                    <button class="inline-block p-4 border-b-2 border-blue-800 rounded-t-lg active"
                                        id="all-tab" data-tabs-target="#all" type="button" role="tab"
                                        aria-controls="all" aria-selected="true">
                                        All Properties
                                    </button>
                                </li>
                                <li class="mr-2" role="presentation">
                                    <button
                                        class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300"
                                        id="active-tab" data-tabs-target="#active" type="button" role="tab"
                                        aria-controls="active" aria-selected="false">
                                        Active
                                    </button>
                                </li>
                                <li class="mr-2" role="presentation">
                                    <button
                                        class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300"
                                        id="pending-tab" data-tabs-target="#pending" type="button" role="tab"
                                        aria-controls="pending" aria-selected="false">
                                        Pending Approval
                                    </button>
                                </li>
                                <li class="mr-2" role="presentation">
                                    <button
                                        class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300"
                                        id="draft-tab" data-tabs-target="#draft" type="button" role="tab"
                                        aria-controls="draft" aria-selected="false">
                                        Drafts
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <!-- Property Cards Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if (count($properties ?? []) > 0)
                                @foreach ($properties as $property)
                                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                                        <div class="relative h-48">
                                            @if ($property->featured_image)
                                                <img src="{{ $property->featured_image }}"
                                                    alt="{{ $property->title }}" class="w-full h-full object-cover">
                                            @else
                                                <div
                                                    class="bg-gray-100 w-full h-full flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-12 w-12 text-gray-400" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                </div>
                                            @endif

                                            <div class="absolute top-2 right-2">
                                                <span
                                                    class="px-2 py-1 text-xs font-medium rounded-full {{ $property->status == 'active' ? 'bg-green-100 text-green-800' : ($property->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                                    {{ ucfirst($property->status) }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="p-4">
                                            <h4 class="text-lg font-semibold text-gray-800 mb-1">
                                                {{ $property->title }}</h4>
                                            <p class="text-gray-600 text-sm mb-2">{{ $property->address }}</p>

                                            <div class="flex items-center mb-4">
                                                <span
                                                    class="text-xl font-bold text-blue-800">${{ number_format($property->price) }}</span>
                                                <span class="text-gray-500 text-sm ml-1">/
                                                    {{ $property->pricing_type }}</span>
                                            </div>

                                            <div class="flex justify-between items-center text-gray-500 text-sm">
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                                    </svg>
                                                    {{ $property->property_type }}
                                                </div>
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    Added {{ $property->created_at->format('M d, Y') }}
                                                </div>
                                            </div>

                                            <div class="mt-4 flex space-x-2">
                                                <a href="{{ route('properties.edit', $property->id) }}"
                                                    class="px-3 py-1 border border-blue-800 text-blue-800 rounded hover:bg-blue-50 transition text-sm">Edit</a>
                                                <a href="{{ route('properties.show', $property->id) }}"
                                                    class="px-3 py-1 bg-gray-100 text-gray-700 rounded hover:bg-gray-200 transition text-sm">View</a>
                                                <form action="{{ route('properties.destroy', $property->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-3 py-1 border border-red-500 text-red-500 rounded hover:bg-red-50 transition text-sm"
                                                        onclick="return confirm('Are you sure you want to delete this property?')">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-span-full flex flex-col items-center justify-center py-12 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-700 mb-2">No properties found</h3>
                                    <p class="text-gray-500 mb-6">You haven't added any properties yet.</p>
                                    <a href="/properties/create"
                                        class="px-4 py-2 bg-blue-800 text-white rounded-md hover:bg-blue-900 transition">Add
                                        Your First Property</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Recent Activity Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Recent Activity</h3>

                        @if (count($recentActivities ?? []) > 0)
                            <div class="space-y-4">
                                @foreach ($recentActivities as $activity)
                                    <div
                                        class="flex items-start p-4 border-l-4 {{ $activity->type == 'booking' ? 'border-green-500 bg-green-50' : ($activity->type == 'message' ? 'border-blue-500 bg-blue-50' : 'border-yellow-500 bg-yellow-50') }}">
                                        <div class="flex-shrink-0 mr-4">
                                            <div
                                                class="h-10 w-10 rounded-full flex items-center justify-center {{ $activity->type == 'booking' ? 'bg-green-100 text-green-500' : ($activity->type == 'message' ? 'bg-blue-100 text-blue-500' : 'bg-yellow-100 text-yellow-500') }}">
                                                @if ($activity->type == 'booking')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                @elseif($activity->type == 'message')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex justify-between">
                                                <h4 class="text-sm font-semibold text-gray-800">{{ $activity->title }}
                                                </h4>
                                                <span
                                                    class="text-xs text-gray-500">{{ $activity->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-sm text-gray-600 mt-1">{{ $activity->description }}</p>
                                            @if ($activity->action_url)
                                                <a href="{{ $activity->action_url }}"
                                                    class="inline-block mt-2 text-sm font-medium text-blue-800 hover:underline">
                                                    {{ $activity->action_text ?? 'View Details' }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center py-8 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mb-3"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="text-lg font-medium text-gray-700 mb-1">No recent activity</h3>
                                <p class="text-gray-500">Your recent activities will appear here.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Financial Summary -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <!-- Earnings Card -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Earnings Summary</h3>
                            <div class="space-y-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Total Earnings</span>
                                    <span
                                        class="font-semibold text-gray-800">${{ number_format($totalEarnings ?? 0, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">This Month</span>
                                    <span
                                        class="font-semibold text-gray-800">${{ number_format($monthlyEarnings ?? 0, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Pending Payouts</span>
                                    <span
                                        class="font-semibold text-gray-800">${{ number_format($pendingPayouts ?? 0, 2) }}</span>
                                </div>
                                <div class="border-t border-dashed border-gray-200 pt-4 mt-4">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Available for Withdrawal</span>
                                        <span
                                            class="font-semibold text-green-600">${{ number_format($availableForWithdrawal ?? 0, 2) }}</span>
                                    </div>
                                </div>
                                <a href="/earnings"
                                    class="block text-center w-full py-2 mt-2 border border-blue-800 text-blue-800 rounded hover:bg-blue-50 transition text-sm">
                                    View Earnings Details
                                </a>
                            </div>
                        </div>

                        <!-- Upcoming Bookings Card -->
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Upcoming Bookings</h3>

                            @if (count($upcomingBookings ?? []) > 0)
                                <div class="space-y-4">
                                    @foreach ($upcomingBookings as $booking)
                                        <div class="flex py-2 border-b border-gray-100">
                                            <div class="flex-shrink-0 mr-3">
                                                <div
                                                    class="h-12 w-12 rounded-lg bg-blue-50 flex items-center justify-center text-blue-800 font-bold">
                                                    {{ date('d', strtotime($booking->start_date)) }}
                                                    <span
                                                        class="text-xs">{{ date('M', strtotime($booking->start_date)) }}</span>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="text-sm font-semibold text-gray-800">
                                                    {{ $booking->property->title }}</h4>
                                                <p class="text-xs text-gray-600">
                                                    {{ date('M d', strtotime($booking->start_date)) }} -
                                                    {{ date('M d, Y', strtotime($booking->end_date)) }}</p>
                                                <span
                                                    class="inline-block mt-1 px-2 py-0.5 text-xs rounded-full {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </div>
                                            <div class="flex-shrink-0 ml-2 text-right">
                                                <span
                                                    class="font-semibold text-gray-800">${{ number_format($booking->total_amount, 2) }}</span>
                                                <div class="text-xs text-gray-500">{{ $booking->guest_name }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <a href="/bookings"
                                        class="block text-center w-full py-2 mt-2 border border-blue-800 text-blue-800 rounded hover:bg-blue-50 transition text-sm">
                                        View All Bookings
                                    </a>
                                </div>
                            @else
                                <div class="flex flex-col items-center justify-center py-8 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300 mb-3"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <h3 class="text-base font-medium text-gray-700 mb-1">No upcoming bookings</h3>
                                    <p class="text-sm text-gray-500">Bookings will appear here once they're confirmed.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
