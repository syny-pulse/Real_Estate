@extends('layouts.app')

@section('content')
<section class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">All Properties</h2>
        
        @if($properties->isEmpty())
            <p class="text-center text-gray-600">No properties found.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($properties as $property)
                <div class="property-card bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="h-48 bg-gray-200">
                        @if($property->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $property->images->first()->image_path) }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <span class="text-sm text-blue-800 font-medium">
                            @if($property->property_type === 'rental')
                                {{ number_format($property->price) }}/Month
                            @else
                                {{ number_format($property->price) }}
                            @endif
                        </span>
                        <h3 class="text-xl font-semibold text-gray-800 mt-1">{{ $property->title }}</h3>
                        <p class="text-gray-600 mt-1">{{ $property->address }}</p>
                        <div class="flex items-center mt-2 text-gray-700 text-sm">
                            <span class="mr-4">{{ $property->bedrooms }} Beds</span>
                            <span class="mr-4">{{ $property->bathrooms }} Baths</span>
                            <span>{{ $property->area }} sqft</span>
                        </div>
                        <a href="/properties/{{ $property->id }}" class="block mt-4 text-center py-2 border border-blue-800 text-blue-800 rounded hover:bg-blue-800 hover:text-white transition">View Details</a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-8">
                {{ $properties->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
