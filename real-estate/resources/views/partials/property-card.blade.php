<div class="property-card bg-white rounded-lg shadow-md overflow-hidden">
    <div class="h-48 bg-gray-200">
        @if($property->primaryImage)
            <img src="{{ asset('storage/' . $property->primaryImage->image_path) }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
        @else
            <img src="{{ asset('images/property-placeholder.jpg') }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
        @endif
    </div>
    <div class="p-4">
        <span class="text-sm text-blue-800 font-medium">${{ number_format($property->price) }}</span>
        <h3 class="text-xl font-semibold text-gray-800 mt-1">{{ $property->title }}</h3>
        <p class="text-gray-600 mt-1">{{ $property->city }}, {{ $property->state }}</p>
        <div class="flex items-center mt-2 text-gray-700 text-sm">
            <span class="mr-4">{{ $property->bedrooms }} {{ Str::plural('Bed', $property->bedrooms) }}</span>
            <span class="mr-4">{{ $property->bathrooms }} {{ Str::plural('Bath', $property->bathrooms) }}</span>
            <span>{{ number_format($property->area) }} sqft</span>
        </div>
        <a href="{{ route('properties.show', $property->slug) }}" class="block mt-4 text-center py-2 border border-blue-800 text-blue-800 rounded hover:bg-blue-800 hover:text-white transition">View Details</a>
    </div>
</div>