@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Property Images Gallery -->
        <div class="p-4 bg-gray-100">
            @if($property->images->isNotEmpty())
                @php
                    $primaryImage = $property->images->where('is_primary', true)->first() ?? $property->images->first();
                    $secondaryImages = $property->images->where('id', '!=', $primaryImage->id)->take(4);
                @endphp
                <div class="flex flex-col md:flex-row gap-4 h-96">
                    <!-- Primary Image (Left Half) -->
                    <div class="w-full md:w-1/2 h-full rounded-lg overflow-hidden shadow-md">
                    @if($property->primary_image)
                        <img src="{{ asset('storage/' . $property->primary_image->image_path) }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                    @elseif($property->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $property->images->first()->image_path) }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('uploads/properties/default-property.jpg') }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                    @endif
                    </div>
                    
                    <!-- Secondary Images (Right Half) -->
                    <div class="w-full md:w-1/2 h-full">
                        <div class="grid grid-cols-2 gap-4 h-full">
                            @foreach($secondaryImages as $image)
                            <div class="rounded-lg overflow-hidden shadow-md h-full">
                            @if($property->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('uploads/properties/default-property.jpg') }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                            @endif
                            </div>
                            @endforeach
                            @if($secondaryImages->count() < 4)
                                @for($i = 0; $i < 4 - $secondaryImages->count(); $i++)
                                <div class="rounded-lg overflow-hidden shadow-md bg-gray-200 h-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                @endfor
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="h-96 flex items-center justify-center text-gray-400 bg-white rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            @endif
        </div>

        <!-- Property Details -->
        <div class="p-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ $property->title }}</h1>
            <p class="text-gray-600 mt-2">{{ $property->address }}</p>
            
            <div class="mt-4 flex items-center">
                <span class="text-2xl font-bold text-blue-800">
                    @if($property->property_type === 'rental')
                        ${{ number_format($property->price) }}/Month
                    @else
                        ${{ number_format($property->price) }}
                    @endif
                </span>
            </div>

            <!-- Property Features -->
            <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="flex items-center">
                    <span class="text-gray-700">{{ $property->bedrooms }} Bedrooms</span>
                </div>
                <div class="flex items-center">
                    <span class="text-gray-700">{{ $property->bathrooms }} Bathrooms</span>
                </div>
                <div class="flex items-center">
                    <span class="text-gray-700">{{ $property->area }} sqft</span>
                </div>
                <div class="flex items-center">
                    <span class="text-gray-700">{{ ucfirst($property->property_type) }}</span>
                </div>
            </div>

            <!-- Location Details -->
            <div class="mt-6">
                <h2 class="text-xl font-semibold text-gray-800">Location</h2>
                <div class="mt-2 p-4 bg-gray-50 rounded-lg">
                    <p class="text-gray-600">{{ $property->address }}</p>
                    @if($property->latitude && $property->longitude)
                    <div class="mt-4">
                        <a href="https://www.google.com/maps?q={{ $property->latitude }},{{ $property->longitude }}" 
                           target="_blank"
                           class="text-blue-600 hover:text-blue-800">
                            View on Google Maps
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Property Description -->
            <div class="mt-6">
                <h2 class="text-xl font-semibold text-gray-800">Description</h2>
                <p class="mt-2 text-gray-600">{{ $property->description }}</p>
            </div>

            <!-- Amenities Table -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Amenities</h2>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amenity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Available</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if($amenities)
                        @foreach([
                            'Gym' => $amenities->has_gym,
                            'Air Conditioning' => $amenities->has_ac,
                            'WiFi' => $amenities->has_wifi,
                            'Swimming Pool' => $amenities->has_pool,
                            'Balcony' => $amenities->has_balcony,
                            'Security' => $amenities->has_security,
                            'Heating' => $amenities->has_heating
                        ] as $name => $available)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($available)
                                    <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex space-x-4">
                @auth
                <button onclick="document.getElementById('booking-modal').showModal()" 
                        class="px-6 py-2 bg-blue-800 text-white rounded hover:bg-blue-700 transition">
                    Book Now
                </button>

                <dialog id="booking-modal" class="p-6 rounded-lg shadow-xl backdrop:bg-black/50 w-full max-w-md">
                    <form method="POST" action="{{ route('bookings.store') }}" class="space-y-4">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                        <input type="hidden" name="total_price" id="total-price" value="{{ $property->price }}">
                        
                        <div>
                            <label class="block text-gray-700">Check-in Date</label>
                            <input type="date" name="check_in" required min="{{ date('Y-m-d') }}"
                                   class="w-full p-2 border rounded" id="check-in-date">
                        </div>
                        
                        <div>
                            <label class="block text-gray-700">Booking Period (days)</label>
                            <input type="number" name="booking_period" required min="1" 
                                   class="w-full p-2 border rounded" id="booking-period">
                        </div>

                        <div>
                            <label class="block text-gray-700">Number of Guests</label>
                            <input type="number" name="guests" required min="1" 
                                   class="w-full p-2 border rounded">
                        </div>

                        <div class="bg-gray-100 p-4 rounded">
                            <p class="text-gray-700">Total Price: <span id="price-display">${{ number_format($property->price) }}</span></p>
                        </div>
                        
                        <div class="flex justify-end space-x-4">
                            <button type="button" onclick="document.getElementById('booking-modal').close()" 
                                    class="px-4 py-2 text-gray-600 hover:text-gray-800">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Submit Booking
                            </button>
                        </div>
                    </form>
                </dialog>
                @else
                <a href="{{ route('login.show') }}" class="px-6 py-2 bg-blue-800 text-white rounded hover:bg-blue-700 transition">
                    Login to Book
                </a>
                @endauth
                @auth
                <form action="{{ route('wishlist.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                    <button type="submit" class="px-6 py-2 border border-blue-800 text-blue-800 rounded hover:bg-blue-50 transition">
                        Add to Wishlist
                    </button>
                </form>
                @else
                <a href="{{ route('login.show') }}" class="px-6 py-2 border border-blue-800 text-blue-800 rounded hover:bg-blue-50 transition">
                    Login to Add to Wishlist
                </a>
                @endauth
            </div>

            <!-- Reviews Section -->
            <div class="mt-12">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Reviews</h2>
                
                @auth
                @php
                    $userBooking = \App\Models\Booking::where('customer_id', auth()->id())
                        ->where('property_id', $property->id)
                        ->first();
                @endphp
                
                @if($userBooking && !$userBooking->review)
                <button onclick="document.getElementById('review-modal').showModal()" 
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition mb-4">
                    Add Review
                </button>

                <dialog id="review-modal" class="p-6 rounded-lg shadow-xl backdrop:bg-black/50 w-full max-w-md">
                    <form method="POST" action="{{ route('reviews.store') }}" class="space-y-4">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                        <input type="hidden" name="booking_id" value="{{ $userBooking->id }}">
                        
                        <div>
                            <label class="block text-gray-700 mb-2">Rating</label>
                            <div class="flex justify-between">
                                @foreach([0 => '😡', 1 => '😞', 2 => '😐', 3 => '🙂', 4 => '😊', 5 => '😍'] as $rating => $emoji)
                                <label class="cursor-pointer">
                                    <input type="radio" name="rating" value="{{ $rating }}" class="hidden peer" required>
                                    <span class="text-4xl peer-checked:text-yellow-400">{{ $emoji }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700">Comment</label>
                            <textarea name="comment" class="w-full p-2 border rounded" rows="4"></textarea>
                        </div>
                        
                        <div class="flex justify-end space-x-4">
                            <button type="button" onclick="document.getElementById('review-modal').close()" 
                                    class="px-4 py-2 text-gray-600 hover:text-gray-800">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                Submit Review
                            </button>
                        </div>
                    </form>
                </dialog>
                @elseif($userBooking && $userBooking->review)
                <p class="text-gray-600">You've already reviewed this property</p>
                @else
                <p class="text-gray-600">You must book this property before reviewing</p>
                @endif
                @else
                <p class="text-gray-600">Please <a href="{{ route('login.show') }}" class="text-blue-600 hover:underline">login</a> to leave a review</p>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
