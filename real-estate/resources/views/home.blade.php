@extends('layouts.app')

@section('content')

 <!-- Hero Section -->
 <section class="hero-section h-96 flex items-center" style="background-image: url('/uploads/properties/hero.jpg'); background-size: 100% auto; background-repeat: no-repeat; background-position: center;">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Find Your Perfect Home</h1>
        <p class="text-xl text-white mb-8 max-w-2xl mx-auto">Browse thousands of properties across the country and find the perfect place for you and your family.</p>

        <!-- Search Form -->
        <div class="bg-white p-4 rounded-lg shadow-lg max-w-4xl mx-auto">
            <form class="flex flex-col md:flex-row gap-4">
                <select class="flex-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Property Type</option>
                    <option value="apartment">Apartment</option>
                    <option value="house">House</option>
                    <option value="land">Land</option>
                    <option value="commercial">Commercial</option>
                </select>
                <select class="flex-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Availability</option>
                    <option value="apartment">Lease</option>
                    <option value="house">Rent</option>
                    <option value="land">Sale</option>
                    <option value="commercial">Short Stay</option>
                </select>
                <input type="text" placeholder="City" class="flex-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="number" placeholder="Max Price" class="flex-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="btn-primary">Search</button>
            </form>
        </div>
    </div>
</section>

<!-- Featured Properties -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Featured Properties</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($featuredProperties as $property)
                <!-- Property Card -->
                <div class="property-card bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="h-48 bg-gray-200">
                        @if($property->primary_image)
                            <img src="{{ $property->primary_image->image_path }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                        @else
                            <img src="\uploads\properties\default-property.jpg" alt="{{ $property->title }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="p-4">
                        <span class="text-sm text-blue-800 font-medium">
                            {{ number_format($property->price) }}
                            @if(in_array($property->property_type, ['apartment', 'house']))
                                /Month
                            @endif
                        </span>
                        <h3 class="text-xl font-semibold text-gray-800 mt-1">{{ $property->title }}</h3>
                        <p class="text-gray-600 mt-1">{{ $property->city }}, {{ $property->address }}</p>
                        <div class="flex items-center mt-2 text-gray-700 text-sm">
                            @if($property->bedrooms)
                                <span class="mr-4">{{ $property->bedrooms }} Beds</span>
                            @endif
                            @if($property->bathrooms)
                                <span class="mr-4">{{ $property->bathrooms }} Baths</span>
                            @endif
                            @if($property->area)
                                <span>{{ $property->area }} sqft</span>
                            @endif
                        </div>
                        <a href="{{ route('properties.show', $property->slug) }}" class="block mt-4 text-center py-2 border border-blue-800 text-blue-800 rounded hover:bg-blue-800 hover:text-white transition">View Details</a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-8">
                    <p class="text-gray-600">No featured properties available at the moment.</p>
                </div>
            @endforelse
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('properties.index') }}" class="btn-primary">View All Properties</a>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="py-16 bg-blue-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center">How It Works</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Search Properties</h3>
                <p class="text-gray-600">Browse our wide selection of properties based on your preferences.</p>
            </div>

            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Book a Visit</h3>
                <p class="text-gray-600">Schedule a viewing or make a direct booking of your chosen property.</p>
            </div>

            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Find Your Home</h3>
                <p class="text-gray-600">Complete the booking process and move into your dream home.</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-blue-800 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Ready to Find Your Dream Property?</h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto">Join thousands of happy customers who found their perfect home with PropertyFinder.</p>
        <div class="space-x-4">
            <a href="{{route('register.show')}}" class="btn-primary bg-white text-blue-800 hover:bg-gray-100">Register Now</a>
            <a href="/properties" class="btn-primary bg-transparent border border-white hover:bg-blue-900">Browse Properties</a>
        </div>
    </div>
</section>

@endsection
