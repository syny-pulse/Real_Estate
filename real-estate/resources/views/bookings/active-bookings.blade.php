@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif
    
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <h1 class="text-3xl font-bold text-gray-800">Active Bookings</h1>
            <p class="text-gray-600 mt-2">Properties currently occupied by guests</p>
            
            @if($activeBookings->isEmpty())
                <div class="mt-6 bg-gray-50 p-8 text-center rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-gray-600">You don't have any properties with active bookings at the moment.</p>
                    <a href="{{ route('properties.index') }}" class="mt-4 inline-block px-6 py-2 bg-blue-800 text-white rounded hover:bg-blue-700 transition">
                        Manage Properties
                    </a>
                </div>
            @else
                <div class="mt-6 grid grid-cols-1 gap-6">
                    @foreach($activeBookings as $booking)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                        <div class="md:flex">
                            <!-- Property Image -->
                            <div class="md:w-1/3 h-64 md:h-auto">
                                @if($booking->property->images->isNotEmpty())
                                    @php
                                        $primaryImage = $booking->property->images->where('is_primary', true)->first() ?? $booking->property->images->first();
                                    @endphp
                                    <img src="{{ asset('storage/' . $primaryImage->image_path) }}" 
                                         alt="{{ $booking->property->title }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="h-full flex items-center justify-center text-gray-400 bg-gray-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Booking Details -->
                            <div class="p-6 md:w-2/3">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h2 class="text-xl font-bold text-gray-800">{{ $booking->property->title }}</h2>
                                        <p class="text-gray-600">{{ $booking->property->address }}</p>
                                    </div>
                                    <span class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded">Occupied</span>
                                </div>
                                
                                <div class="mt-4 grid grid-cols-2 md:grid-cols-3 gap-4">
                                    <div>
                                        <span class="text-gray-500 text-sm">Guest</span>
                                        <p class="font-medium">{{ $booking->customer->name }}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-500 text-sm">Check-in Date</span>
                                        <p class="font-medium">{{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-500 text-sm">Check-out Date</span>
                                        <p class="font-medium">{{ \Carbon\Carbon::parse($booking->check_in)->addDays($booking->booking_period)->format('M d, Y') }}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-500 text-sm">Duration</span>
                                        <p class="font-medium">{{ $booking->booking_period }} days</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-500 text-sm">Guests</span>
                                        <p class="font-medium">{{ $booking->guests }} people</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-500 text-sm">Booking Revenue</span>
                                        <p class="font-medium text-blue-800">UGX {{ number_format($booking->total_price) }}/=</p>
                                    </div>
                                </div>
                                
                                <div class="mt-6 flex items-center justify-between">
                                    <div>
                                        <span class="text-gray-500 text-sm">Contact</span>
                                        <p class="font-medium">{{ $booking->customer->email }}</p>
                                    </div>
                                    
                                    <div class="space-x-2">
                                        <a href="{{ route('properties.show', $booking->property_id) }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
                                            View Property
                                        </a>
                                        <button onclick="contactGuest('{{ $booking->customer->email }}')" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                                            Contact Guest
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-6">
                    {{ $activeBookings->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function contactGuest(email) {
        // This could be expanded to open a modal with a contact form
        // For now, we'll just open the default email client
        window.location.href = `mailto:${email}`;
    }
</script>
@endsection