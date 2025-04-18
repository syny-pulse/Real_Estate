@extends('layouts.app')

@section('content')
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">My booked Properties</h2>
            @if ($bookings->isEmpty())
                <p>No booked properties found.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($bookings as $booking)
                        <div class="property-card bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="h-48 bg-gray-200">
                                @if ($booking->property->primary_image)
                                    <img src="{{ asset('storage/' . $booking->property->primary_image->image_path) }}"
                                        alt="{{ $booking->property->title }}" class="w-full h-full object-cover">
                                @elseif($booking->property->images->isNotEmpty())
                                    <img src="{{ asset('storage/' . $booking->property->images->first()->image_path) }}"
                                        alt="{{ $booking->property->title }}" class="w-full h-full object-cover">
                                @else
                                    <img src="\uploads\properties\default-property.jpg"
                                        alt="{{ $booking->property->title }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="p-4">
                                <h2 class="text-xl font-semibold">{{ $booking->property->title }}</h2>
                                <p>Description: {{ $booking->property->description }}</p>
                                <p>Rooms: {{ $booking->property->bedrooms }} Bedrooms, {{ $booking->property->bathrooms }}
                                    Bathrooms</p>
                                <p>Price: ${{ $booking->total_price }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endsection
