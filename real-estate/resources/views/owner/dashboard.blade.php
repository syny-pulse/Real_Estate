@extends('layouts.owner')

@section('content')
<main class="flex flex-col lg:flex-row min-h-screen bg-gray-50">
    <!-- Include the sidebar partial -->
    @include('owner.partials.sidebar')

    <!-- Main Content Area -->
    <div class="flex-1 md:ml-64">
        <div class="container mx-auto p-4 lg:p-6 max-w-7xl">
            <!-- My Properties Section -->
            <div id="properties" class="bg-white rounded-lg shadow-md p-4 lg:p-6 mb-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <h3 class="text-2xl font-semibold text-gray-800">My Properties</h3>
                    <a href="{{ route('properties.create') }}" class="px-4 py-2 bg-blue-800 text-white rounded-md hover:bg-blue-900 transition w-full sm:w-auto text-center">Add New Property</a>
                </div>

                <!-- Properties Filter Tabs -->
                <div class="mb-6 border-b border-gray-200 overflow-x-auto">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" role="tablist">
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 border-blue-800 rounded-t-lg active" id="all-tab" data-tabs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">
                                All Properties
                            </button>
                        </li>
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="active-tab" data-tabs-target="#active" type="button" role="tab" aria-controls="active" aria-selected="false">
                                Active
                            </button>
                        </li>
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="pending-tab" data-tabs-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="false">
                                Pending Approval
                            </button>
                        </li>
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="draft-tab" data-tabs-target="#draft" type="button" role="tab" aria-controls="draft" aria-selected="false">
                                Drafts
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Property Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @if (count($properties ?? []) > 0)
                        @foreach ($properties as $property)
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden transition hover:shadow-md">
                                <div class="relative h-48">
                                    @if ($property->featured_image)
                                        <img src="{{ $property->featured_image }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="bg-gray-100 w-full h-full flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                    @endif

                                    <div class="absolute top-2 right-2">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $property->status == 'active' ? 'bg-green-100 text-green-800' : ($property->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ ucfirst($property->status) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="p-4">
                                    <h4 class="text-lg font-semibold text-gray-800 mb-1">{{ $property->title }}</h4>
                                    <p class="text-gray-600 text-sm mb-2">{{ $property->address }}</p>

                                    <div class="flex items-center mb-4">
                                        <span class="text-xl font-bold text-blue-800">${{ number_format($property->price) }}</span>
                                        <span class="text-gray-500 text-sm ml-1">/ {{ $property->pricing_type }}</span>
                                    </div>

                                    <div class="flex justify-between items-center text-gray-500 text-sm mb-4">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                            </svg>
                                            {{ $property->property_type }}
                                        </div>
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            Added {{ $property->created_at->format('M d, Y') }}
                                        </div>
                                    </div>

                                    <div class="flex space-x-2">
                                        <a href="{{ route('properties.edit', $property->id) }}" class="px-3 py-1 border border-blue-800 text-blue-800 rounded hover:bg-blue-50 transition text-sm flex-1 text-center">Edit</a>
                                        <a href="{{ route('properties.show', $property->id) }}" class="px-3 py-1 bg-gray-100 text-gray-700 rounded hover:bg-gray-200 transition text-sm flex-1 text-center">View</a>
                                        <form action="{{ route('properties.destroy', $property->id) }}" method="POST" class="inline flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full px-3 py-1 border border-red-500 text-red-500 rounded hover:bg-red-50 transition text-sm" onclick="return confirm('Are you sure you want to delete this property?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-span-full flex flex-col items-center justify-center py-12 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <h3 class="text-lg font-medium text-gray-700 mb-2">No properties found</h3>
                            <p class="text-gray-500 mb-6">You haven't added any properties yet.</p>
                            <a href="/properties/create" class="px-4 py-2 bg-blue-800 text-white rounded-md hover:bg-blue-900 transition">Add Your First Property</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Activity Card -->
            <div class="bg-white rounded-lg shadow-md p-4 lg:p-6 mb-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Recent Activity</h3>

                @if (count($recentActivities ?? []) > 0)
                    <div class="space-y-4">
                        @foreach ($recentActivities as $activity)
                            <div class="flex items-start p-4 border-l-4 {{ $activity->type == 'booking' ? 'border-green-500 bg-green-50' : ($activity->type == 'message' ? 'border-blue-500 bg-blue-50' : 'border-yellow-500 bg-yellow-50') }}">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="h-10 w-10 rounded-full flex items-center justify-center {{ $activity->type == 'booking' ? 'bg-green-100 text-green-500' : ($activity->type == 'message' ? 'bg-blue-100 text-blue-500' : 'bg-yellow-100 text-yellow-500') }}">
                                        @if ($activity->type == 'booking')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        @elseif($activity->type == 'message')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between">
                                        <h4 class="text-sm font-semibold text-gray-800">{{ $activity->title }}</h4>
                                        <span class="text-xs text-gray-500">{{ $activity->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">{{ $activity->description }}</p>
                                    @if ($activity->action_url)
                                        <a href="{{ $activity->action_url }}" class="inline-block mt-2 text-sm font-medium text-blue-800 hover:underline">
                                            {{ $activity->action_text ?? 'View Details' }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-8 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-lg font-medium text-gray-700 mb-1">No recent activity</h3>
                        <p class="text-gray-500">Your recent activities will appear here.</p>
                    </div>
                @endif
            </div>

            <!-- Financial Summary & Upcoming Bookings Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Earnings Card -->
                <div class="bg-white rounded-lg shadow-md p-4 lg:p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Earnings Summary</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Earnings</span>
                            <span class="font-semibold text-gray-800">${{ number_format($totalEarnings ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">This Month</span>
                            <span class="font-semibold text-gray-800">${{ number_format($monthlyEarnings ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Pending Payouts</span>
                            <span class="font-semibold text-gray-800">${{ number_format($pendingPayouts ?? 0, 2) }}</span>
                        </div>
                        <div class="border-t border-dashed border-gray-200 pt-4 mt-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Available for Withdrawal</span>
                                <span class="font-semibold text-green-600">${{ number_format($availableForWithdrawal ?? 0, 2) }}</span>
                            </div>
                        </div>
                        <a href="/earnings" class="block text-center w-full py-2 mt-2 border border-blue-800 text-blue-800 rounded hover:bg-blue-50 transition text-sm">
                            View Earnings Details
                        </a>
                    </div>
                </div>

                <!-- Upcoming Bookings Card -->
                <div class="bg-white rounded-lg shadow-md p-4 lg:p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Upcoming Bookings</h3>

                    @if (count($upcomingBookings ?? []) > 0)
                        <div class="space-y-4">
                            @foreach ($upcomingBookings as $booking)
                                <div class="flex py-2 border-b border-gray-100">
                                    <div class="flex-shrink-0 mr-3">
                                        <div class="h-12 w-12 rounded-lg bg-blue-50 flex flex-col items-center justify-center text-blue-800">
                                            <span class="font-bold leading-none">{{ date('d', strtotime($booking->start_date)) }}</span>
                                            <span class="text-xs">{{ date('M', strtotime($booking->start_date)) }}</span>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-sm font-semibold text-gray-800">{{ $booking->property->title }}</h4>
                                        <p class="text-xs text-gray-600">
                                            {{ date('M d', strtotime($booking->start_date)) }} -
                                            {{ date('M d, Y', strtotime($booking->end_date)) }}</p>
                                        <span class="inline-block mt-1 px-2 py-0.5 text-xs rounded-full {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </div>
                                    <div class="flex-shrink-0 ml-2 text-right">
                                        <span class="font-semibold text-gray-800">${{ number_format($booking->total_amount, 2) }}</span>
                                        <div class="text-xs text-gray-500">{{ $booking->guest_name }}</div>
                                    </div>
                                </div>
                            @endforeach
                            <a href="/bookings" class="block text-center w-full py-2 mt-2 border border-blue-800 text-blue-800 rounded hover:bg-blue-50 transition text-sm">
                                View All Bookings
                            </a>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-8 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <h3 class="text-base font-medium text-gray-700 mb-1">No upcoming bookings</h3>
                            <p class="text-sm text-gray-500">Bookings will appear here once they're confirmed.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection