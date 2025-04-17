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
                    @if($property->primary_image)
                        <img src="{{ $property->primary_image->image_path }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                    @elseif($property->images->isNotEmpty())
                        <img src="{{ $property->images->first()->image_path }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                    @else
                        <img src="\uploads\properties\default-property.jpg" alt="{{ $property->title }}" class="w-full h-full object-cover">
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
