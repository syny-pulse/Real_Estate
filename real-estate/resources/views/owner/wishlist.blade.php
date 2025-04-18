@extends('layouts.app')

@section('content')
<section class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Your wishlist</h2>
    @if($wishlistItems->isEmpty())
        <p>No properties in your wishlist.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($wishlistItems as $wishlistItem)
                <div class="property-card bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="h-48 bg-gray-200">
                        @if($wishlistItem->property->primary_image)
                            <img src="{{ asset('storage/' . $wishlistItem->property->primary_image->image_path) }}" alt="{{ $wishlistItem->property->title }}" class="w-full h-full object-cover">
                        @elseif($wishlistItem->property->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $wishlistItem->property->images->first()->image_path) }}" alt="{{ $wishlistItem->property->title }}" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('uploads/properties/default-property.jpg') }}" alt="{{ $wishlistItem->property->title }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="p-4">
                        <h2 class="text-xl font-semibold">{{ $wishlistItem->property->title }}</h2>
                        <p>Description: {{ $wishlistItem->property->description }}</p>
                        <p>Rooms: {{ $wishlistItem->property->bedrooms }} Bedrooms, {{ $wishlistItem->property->bathrooms }} Bathrooms</p>
                        <p>Price: ${{ $wishlistItem->property->price }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
