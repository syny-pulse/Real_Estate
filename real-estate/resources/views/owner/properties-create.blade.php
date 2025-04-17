@extends('layouts.owner')

@section('content')
<main class="flex flex-col lg:flex-row min-h-screen bg-gray-50">
    <!-- Include the sidebar partial -->
    @include('owner.partials.sidebar')

    <!-- Main Content Area -->
    <div class="flex-1 md:ml-64">
    <div class="max-w-5xl mx-auto p-6 bg-white shadow-md rounded-lg my-8">
        <h1 class="text-3xl font-bold text-blue-900 mb-6 border-b pb-4">Add New Property</h1>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-800 p-4 mb-6" role="alert">
                <p class="font-bold">Success!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- System Error Message (for exceptions) -->
        @error('system_error')
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p class="font-bold">System Error</p>
                <p>{{ $message }}</p>
            </div>
        @enderror

        <!-- General Error Message from session -->
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p class="font-bold">Error</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <!-- Validation Errors Summary -->
        @if ($errors->any() && !$errors->has('system_error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p class="font-bold">Please fix the following errors:</p>
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="property-form" action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Hidden input for status (default is 'pending', will be changed by JavaScript) -->
            <input type="hidden" name="status" id="property-status" value="pending">

            <!-- Title & Description -->
            <div class="mb-8 bg-blue-50 bg-opacity-30 p-6 rounded-lg">
                <h2 class="text-xl font-semibold text-blue-800 mb-2">Title & Description</h2>
                <p class="text-gray-600 text-sm mb-4">Describe your property to your attendants</p>

                <div class="mb-4">
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="w-full px-4 py-3 border @error('title') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Title here">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <textarea name="description"
                        class="w-full px-4 py-3 border @error('description') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Description goes here" rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Property Type -->
                <div class="mb-6 bg-blue-50 bg-opacity-30 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-blue-800 mb-2">Type</h2>
                    <p class="text-gray-600 text-sm mb-4">Let's set the property type</p>
                    <select name="property_type"
                        class="w-full px-4 py-3 border @error('property_type') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Property Type</option>
                        <option value="apartment" {{ old('property_type') == 'apartment' ? 'selected' : '' }}>Apartment
                        </option>
                        <option value="house" {{ old('property_type') == 'house' ? 'selected' : '' }}>House</option>
                        <option value="land" {{ old('property_type') == 'land' ? 'selected' : '' }}>Land</option>
                        <option value="commercial" {{ old('property_type') == 'commercial' ? 'selected' : '' }}>
                            Commercial</option>
                    </select>
                    @error('property_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div class="mb-6 bg-blue-50 bg-opacity-30 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-blue-800 mb-2">Price</h2>
                    <p class="text-gray-600 text-sm mb-4">Let's set the property price</p>
                    <input type="number" name="price" step="any" value="{{ old('price') }}"
                        class="w-full px-4 py-3 border @error('price') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Price per month">
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Map -->
<div class="mb-8 bg-blue-50 bg-opacity-30 p-6 rounded-lg">
    <h2 class="text-xl font-semibold text-blue-800 mb-2">Location</h2>
    <p class="text-sm text-gray-600 mb-4">Search for a location or click directly on the map</p>
    
    <div id="map" class="mb-4 rounded-lg border @error('latitude') border-red-500 @else border-gray-300 @enderror" style="height: 400px; width: 100%;"></div>

    <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}">
    <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}">

    @error('latitude')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
    @error('longitude')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror

    <div class="mt-4">
        <label for="location" class="block text-blue-900 mb-1">Location Name</label>
        <input type="text" id="location" name="address" value="{{ old('address') }}"
            class="w-full px-4 py-3 border @error('address') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            readonly>
        @error('address')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

            <!-- Photos -->
            <div class="mb-8 bg-blue-50 bg-opacity-30 p-6 rounded-lg">
                <h2 class="text-xl font-semibold text-blue-800 mb-2">Photos</h2>
                <p class="text-gray-600 text-sm mb-4">Let's add photos for the property</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <!-- Thumbnail Upload -->
                    <div>
                        <div id="thumbnail-container"
                            class="border-2 border-dashed @error('thumbnail') border-red-500 @else border-blue-500 @enderror rounded-lg p-6 text-center cursor-pointer hover:bg-blue-50 transition">
                            <div id="thumbnail-placeholder">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-blue-800 mb-3"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="mb-1 font-medium text-blue-900">Upload thumbnail</p>
                                <p class="text-xs text-gray-500">or drag and drop image here</p>
                            </div>
                            <div id="thumbnail-preview-container" class="relative hidden">
                                <img id="thumbnail-preview" class="w-full h-48 object-cover rounded">
                                <button type="button" id="thumbnail-delete"
                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 shadow-md hover:bg-red-600">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <input type="file" name="thumbnail" class="hidden" id="thumbnail-upload"
                                accept="image/*">
                        </div>
                        @error('thumbnail')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Multiple Photos Upload -->
                    <div>
                        <div id="photos-container"
                            class="border-2 border-dashed @error('photos') border-red-500 @else border-blue-500 @enderror rounded-lg p-6 cursor-pointer hover:bg-blue-50 transition">
                            <div id="photos-placeholder" class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-blue-800 mb-3"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="mb-1 font-medium text-blue-900">Upload property photos</p>
                                <p class="text-xs text-gray-500">Select at least 4 images</p>
                            </div>
                            <div id="photos-preview" class="mt-2 grid grid-cols-2 gap-2"></div>
                            <input type="file" name="photos[]" multiple class="hidden" id="photos-upload"
                                accept="image/*">
                        </div>
                        @error('photos')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        @error('photos.*')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Bedrooms -->
                <div class="mb-6 bg-blue-50 bg-opacity-30 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-blue-800 mb-2">Bedrooms</h2>
                    <p class="text-gray-600 text-sm mb-4">Number of bedrooms</p>
                    <input type="number" name="bedrooms" value="{{ old('bedrooms') }}"
                        class="w-full px-4 py-3 border @error('bedrooms') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Number of bedrooms">
                    @error('bedrooms')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bathrooms -->
                <div class="mb-6 bg-blue-50 bg-opacity-30 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-blue-800 mb-2">Bathrooms</h2>
                    <p class="text-gray-600 text-sm mb-4">Number of bathrooms</p>
                    <input type="number" name="bathrooms" value="{{ old('bathrooms') }}"
                        class="w-full px-4 py-3 border @error('bathrooms') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Number of bathrooms">
                    @error('bathrooms')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Area -->
                <div class="mb-6 bg-blue-50 bg-opacity-30 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-blue-800 mb-2">Area</h2>
                    <p class="text-gray-600 text-sm mb-4">Size of the property</p>
                    <input type="number" name="area" step="any" value="{{ old('area') }}"
                        class="w-full px-4 py-3 border @error('area') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Area (sq ft)">
                    @error('area')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Amenities -->
            <div class="mb-8 bg-blue-50 bg-opacity-30 p-6 rounded-lg">
                <h2 class="text-xl font-semibold text-blue-800 mb-2">Amenities</h2>
                <p class="text-gray-600 text-sm mb-4">Select available amenities</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach (['wifi', 'parking', 'pool', 'balcony', 'gym', 'security', 'ac', 'heating'] as $amenity)
                        <label
                            class="flex items-center space-x-2 bg-white p-3 rounded-lg border border-gray-200 hover:border-blue-500 cursor-pointer transition">
                            <input type="checkbox" name="has_{{ $amenity }}"
                                {{ old('has_' . $amenity) ? 'checked' : '' }} class="h-5 w-5 text-blue-800 rounded">
                            <span class="text-gray-700">{{ ucfirst($amenity) }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                <!-- Clear Form Button -->
                <button type="button" id="clear-form"
                    class="bg-red-500 text-white py-4 rounded-md hover:bg-red-600 transition font-medium text-lg flex items-center justify-center">
                    <i class="fas fa-trash-alt mr-2"></i> Delete Property
                </button>

                <!-- Submit Button -->
                <button type="submit" id="submit-form"
                    class="bg-blue-800 text-white py-4 rounded-md hover:bg-blue-900 transition font-medium text-lg flex items-center justify-center">
                    <i class="fas fa-paper-plane mr-2"></i> Send for Approval
                </button>
            </div>
        </form>
    </div>

    <!-- Confirmation Modal for Clear Form -->
    <div id="clear-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-6 max-w-sm mx-auto">
            <h3 class="text-xl font-bold text-blue-900 mb-4">Clear Form?</h3>
            <p class="mb-6">Are you sure you want to clear all data? This action cannot be undone.</p>
            <div class="flex justify-end space-x-3">
                <button id="cancel-clear" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancel</button>
                <button id="confirm-clear" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Clear
                    Form</button>
            </div>
        </div>
    </div>

</div>
</main>

<!-- Add Leaflet CSS and JS in the section or in your layout file -->
@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<style>
    #map {
        height: 400px;
        width: 100%;
    }
    
    /* Enhanced geocoder control styles with larger input */
    .leaflet-control-geocoder {
        width: 100%;
        max-width: 550px; /* Increased size */
        margin-top: 10px !important;
        z-index: 1000; /* Ensure it's above other elements */
    }

    .leaflet-control-geocoder-form {
        display: flex;
        width: 100%;
    }

    .leaflet-control-geocoder-form input {
        width: 100%;
        padding: 14px 20px; /* Larger input area */
        font-size: 18px;
        border-radius: 8px;
        border: 2px solid #3b82f6;
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    .leaflet-control-geocoder-form input:focus {
        outline: none;
        border-color: #1d4ed8;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
    }

    .leaflet-control-geocoder-icon {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        background-color: #3b82f6;
        border-radius: 4px;
        padding: 10px; /* Larger icon */
    }
    
    /* Completely overhauled search results styling */
    .leaflet-control-geocoder-results {
        max-height: 300px;
        overflow-y: auto;
        background-color: white !important;
        border-radius: 8px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.2);
        width: 100%;
        border: 1px solid #e5e7eb;
        margin-top: 5px;
        z-index: 1001; /* Above the map */
        position: relative;
    }
    
    .leaflet-control-geocoder-alternatives {
        list-style: none;
        padding: 0;
        margin: 0;
        background-color: white !important;
        width: 100%;
    }
    
    /* Each suggestion item */
    .leaflet-control-geocoder-alternatives li {
        padding: 16px 20px;
        cursor: pointer;
        border-bottom: 1px solid #e5e7eb;
        font-size: 16px;
        background-color: white !important;
        color: #1f2937;
        margin: 0;
        width: 100%;
    }
    
    /* Force white background on all elements inside list items */
    .leaflet-control-geocoder-alternatives li * {
        background-color: white !important; 
    }
    
    .leaflet-control-geocoder-alternatives li:hover {
        background-color: #eff6ff !important;
    }
    
    .leaflet-control-geocoder-alternatives li:last-child {
        border-bottom: none;
    }
    
    /* No results message */
    .leaflet-control-geocoder-no-results {
        background-color: white !important;
        padding: 16px 20px;
        font-size: 16px;
        color: #ef4444;
        width: 100%;
    }
    
    /* Special case for the error container */
    .leaflet-control-geocoder-error {
        background-color: white !important;
        padding: 16px 20px;
        color: #ef4444;
        width: 100%;
    }
    
    /* Force proper styling for any dynamically added elements */
    .leaflet-control-geocoder,
    .leaflet-control-geocoder *,
    .leaflet-control-geocoder-results,
    .leaflet-control-geocoder-results *,
    .leaflet-control-geocoder-alternatives,
    .leaflet-control-geocoder-alternatives * {
        background-color: white !important;
    }
    
    /* Only apply blue background on hover for list items */
    .leaflet-control-geocoder-alternatives li:hover {
        background-color: #eff6ff !important;
    }
</style>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Kampala coordinates
    const kampalaLat = 0.3476;
    const kampalaLng = 32.5825;
    
    // Initialize map with Kampala as default center
    var map = L.map('map').setView([kampalaLat, kampalaLng], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    let marker;

    // If we have stored coordinates (from validation error), use them
    const storedLat = "{{ old('latitude') }}";
    const storedLng = "{{ old('longitude') }}";

    if (storedLat && storedLng) {
        marker = L.marker([storedLat, storedLng]).addTo(map);
        map.setView([storedLat, storedLng], 12);
    } else {
        // Default center is now Kampala
        marker = L.marker([kampalaLat, kampalaLng]).addTo(map);
        document.getElementById('latitude').value = kampalaLat;
        document.getElementById('longitude').value = kampalaLng;
        
        // Get the address for Kampala
        reverseGeocode(kampalaLat, kampalaLng);
    }

    // Force map to recalculate its size after it's fully loaded
    setTimeout(function() {
        map.invalidateSize();
    }, 100);

    // Create a proper search control with enhanced options and add it to the map
    const searchControl = L.Control.geocoder({
        defaultMarkGeocode: false,
        placeholder: 'Search for locations in Uganda...',
        errorMessage: 'Location not found. Please try another search.',
        geocoder: L.Control.Geocoder.nominatim({
            geocodingQueryParams: {
                countrycodes: 'ug', // Limit to Uganda
                limit: 5
            }
        }),
        position: 'topright', // Position it at the top right of the map
        expanded: true, // Start with the control expanded
        suggestMinLength: 3, // Start suggesting after 3 characters
        suggestTimeout: 250, // Wait time before suggesting
    }).addTo(map);
    
    // Handle results from the map's geocoder control
    searchControl.on('markgeocode', function(e) {
        const latlng = e.geocode.center;
        
        if (marker) {
            marker.setLatLng(latlng);
        } else {
            marker = L.marker(latlng).addTo(map);
        }
        
        map.setView(latlng, 15);
        
        // Update form values
        document.getElementById('latitude').value = latlng.lat;
        document.getElementById('longitude').value = latlng.lng;
        
        // Format location name properly but keep "Uganda" in the input field
        let locationName = e.geocode.name;
        // Clean up the location name to show "Location, Uganda" on one line
        if (locationName.includes(',')) {
            // Get first part (locality) and add Uganda
            locationName = locationName.split(',')[0].trim() + ", Uganda";
        } else if (!locationName.endsWith("Uganda")) {
            locationName = locationName + ", Uganda";
        }
        
        document.getElementById('location').value = locationName;
    });

    // Map click event to set marker
    map.on('click', function(e) {
        const lat = e.latlng.lat;
        const lng = e.latlng.lng;

        if (marker) {
            marker.setLatLng([lat, lng]);
        } else {
            marker = L.marker([lat, lng]).addTo(map);
        }

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;

        reverseGeocode(lat, lng);
    });

    // Function to do reverse geocoding with improved formatting
    function reverseGeocode(lat, lng) {
        // Consider adding a loading indicator here
        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`, {
            headers: {
                'User-Agent': '{{ config('app.name', 'PropertyFinder') }}/1.0'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const address = data.address;
            // Get primary location name
            let locationName = address?.city || address?.town || address?.village || address?.suburb || address?.hamlet || "Unknown location";
            
            // Format the location as "Location, Uganda" on a single line
            document.getElementById('location').value = locationName + ", Uganda";
        })
        .catch(error => {
            console.error('Error with reverse geocoding:', error);
            document.getElementById('location').value = "Location not found";
        });
    }

    // Set up a mutation observer to force styling and modify search results
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.addedNodes.length) {
                // Force white background on all search result elements
                const resultsElements = document.querySelectorAll('.leaflet-control-geocoder-results, .leaflet-control-geocoder-results *, .leaflet-control-geocoder-alternatives li');
                resultsElements.forEach(el => {
                    el.style.backgroundColor = 'white';
                });
                
                // Process list items to hide "Uganda" text
                const listItems = document.querySelectorAll('.leaflet-control-geocoder-alternatives li');
                listItems.forEach(li => {
                    // Store original text for data retrieval later
                    const originalText = li.textContent;
                    li.setAttribute('data-original-text', originalText);
                    
                    // Replace display text to hide "Uganda"
                    let displayText = originalText;
                    if (displayText.includes(',')) {
                        // Get first part before any comma
                        displayText = displayText.split(',')[0].trim();
                    } else if (displayText.toLowerCase().includes('uganda')) {
                        // Remove "Uganda" if it's at the end
                        displayText = displayText.replace(/,?\s*uganda$/i, '');
                    }
                    
                    // Replace the content while preserving any HTML
                    if (originalText !== displayText) {
                        li.textContent = displayText;
                    }
                    
                    // Apply hover styles
                    li.addEventListener('mouseover', () => {
                        li.style.backgroundColor = '#eff6ff';
                    });
                    li.addEventListener('mouseout', () => {
                        li.style.backgroundColor = 'white';
                    });
                });
            }
        });
    });

    // Start observing the map container for added nodes
    observer.observe(document.getElementById('map'), { 
        childList: true,
        subtree: true
    });

    // Apply additional CSS to ensure white background on search results
    // and process list items to hide "Uganda" text
    setTimeout(() => {
        // Force white background on results container and all children
        const resultsElements = document.querySelectorAll('.leaflet-control-geocoder-results, .leaflet-control-geocoder-results *');
        resultsElements.forEach(el => {
            el.style.backgroundColor = 'white';
        });
        
        // Process list items to hide "Uganda" text
        const listItems = document.querySelectorAll('.leaflet-control-geocoder-alternatives li');
        listItems.forEach(li => {
            // Store original text for data retrieval later
            const originalText = li.textContent;
            li.setAttribute('data-original-text', originalText);
            
            // Replace display text to hide "Uganda"
            let displayText = originalText;
            if (displayText.includes(',')) {
                // Get first part before any comma
                displayText = displayText.split(',')[0].trim();
            } else if (displayText.toLowerCase().includes('uganda')) {
                // Remove "Uganda" if it's at the end
                displayText = displayText.replace(/,?\s*uganda$/i, '');
            }
            
            // Replace the content
            if (originalText !== displayText) {
                li.textContent = displayText;
            }
        });
    }, 1000);

    // Rest of your code remains the same...
    // Thumbnail upload container click handler
    document.getElementById('thumbnail-container').addEventListener('click', function() {
        document.getElementById('thumbnail-upload').click();
    });

    // Photos upload container click handler
    document.getElementById('photos-container').addEventListener('click', function() {
        document.getElementById('photos-upload').click();
    });

    // Thumbnail preview
    document.getElementById('thumbnail-upload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewContainer = document.getElementById('thumbnail-preview-container');
                const preview = document.getElementById('thumbnail-preview');
                const placeholder = document.getElementById('thumbnail-placeholder');

                preview.src = e.target.result;
                previewContainer.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    // Thumbnail delete button
    document.getElementById('thumbnail-delete').addEventListener('click', function(e) {
        e.stopPropagation(); // Prevent container click
        const previewContainer = document.getElementById('thumbnail-preview-container');
        const placeholder = document.getElementById('thumbnail-placeholder');
        const fileInput = document.getElementById('thumbnail-upload');

        previewContainer.classList.add('hidden');
        placeholder.classList.remove('hidden');
        fileInput.value = ''; // Clear the file input
    });

    // Multiple photos preview
    document.getElementById('photos-upload').addEventListener('change', function(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('photos-preview');
        const placeholder = document.getElementById('photos-placeholder');

        previewContainer.innerHTML = ''; // Clear existing previews

        if (files.length > 0) {
            placeholder.classList.add('hidden');

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgContainer = document.createElement('div');
                        imgContainer.className = 'relative';

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'w-full h-24 object-cover rounded';
                        imgContainer.appendChild(img);

                        const deleteBtn = document.createElement('button');
                        deleteBtn.type = 'button';
                        deleteBtn.className =
                            'absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 shadow-sm hover:bg-red-600';
                        deleteBtn.innerHTML = '<i class="fas fa-times"></i>';
                        deleteBtn.dataset.index = i;
                        deleteBtn.addEventListener('click', function(e) {
                            e.stopPropagation();
                            imgContainer.remove();

                            // Check if there are any images left
                            if (document.getElementById('photos-preview').children.length === 0) {
                                document.getElementById('photos-placeholder').classList.remove(
                                    'hidden');
                                document.getElementById('photos-upload').value = '';
                            }
                        });

                        imgContainer.appendChild(deleteBtn);
                        previewContainer.appendChild(imgContainer);
                    }
                    reader.readAsDataURL(file);
                }
            }
        } else {
            placeholder.classList.remove('hidden');
        }
    });

    // Clear form functionality
    document.getElementById('clear-form').addEventListener('click', function() {
        // Show the confirmation modal
        document.getElementById('clear-modal').classList.remove('hidden');
    });

    // Cancel clearing form
    document.getElementById('cancel-clear').addEventListener('click', function() {
        document.getElementById('clear-modal').classList.add('hidden');
    });

    // Confirm clearing form
    document.getElementById('confirm-clear').addEventListener('click', function() {
        // Reset the form
        document.getElementById('property-form').reset();

        // Reset the map to Kampala
        if (marker) {
            marker.setLatLng([kampalaLat, kampalaLng]);
            map.setView([kampalaLat, kampalaLng], 12);
        } else {
            marker = L.marker([kampalaLat, kampalaLng]).addTo(map);
            map.setView([kampalaLat, kampalaLng], 12);
        }

        // Reset the location fields
        document.getElementById('latitude').value = kampalaLat;
        document.getElementById('longitude').value = kampalaLng;
        reverseGeocode(kampalaLat, kampalaLng);

        // Reset the thumbnail
        const thumbnailPreviewContainer = document.getElementById('thumbnail-preview-container');
        const thumbnailPlaceholder = document.getElementById('thumbnail-placeholder');
        thumbnailPreviewContainer.classList.add('hidden');
        thumbnailPlaceholder.classList.remove('hidden');

        // Reset the photos
        const photosPreview = document.getElementById('photos-preview');
        const photosPlaceholder = document.getElementById('photos-placeholder');
        photosPreview.innerHTML = '';
        photosPlaceholder.classList.remove('hidden');

        // Hide the modal
        document.getElementById('clear-modal').classList.add('hidden');
    });

    // Regular submission (sets status to pending)
    document.getElementById('submit-form').addEventListener('click', function() {
        // Ensure the status is set to pending
        document.getElementById('property-status').value = 'pending';
    });

    // Auto-scroll to errors if they exist
    if (document.querySelector('.text-red-500')) {
        document.querySelector('.text-red-500').scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }
});
</script>
@endsection
@endsection