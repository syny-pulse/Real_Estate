<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'PropertyFinder') }} - Add New Property</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <div class="max-w-5xl mx-auto p-6 bg-white shadow-md rounded-lg my-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-4">Add New Property</h1>

        <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Title & Description -->
            <div class="mb-8 bg-gray-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Title & Description</h2>
                <p class="text-gray-600 text-sm mb-4">Describe your property to your attendants</p>

                <div class="mb-4">
                    <input type="text" name="title" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Title here">
                </div>

                <div>
                    <textarea name="description" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Description goes here" rows="4"></textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Property Type -->
                <div class="mb-6 bg-gray-50 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Type</h2>
                    <p class="text-gray-600 text-sm mb-4">Let's set the property type</p>
                    <select name="property_type"
                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="apartment">Apartment</option>
                        <option value="house">House</option>
                        <option value="land">Land</option>
                        <option value="commercial">Commercial</option>
                    </select>
                </div>

                <!-- Price -->
                <div class="mb-6 bg-gray-50 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Price</h2>
                    <p class="text-gray-600 text-sm mb-4">Let's set the property price</p>
                    <input type="number" name="price" required step ="any"
                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Price per month">
                </div>
            </div>

            <!-- Map -->
            <div class="mb-8 bg-gray-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Location</h2>
                <p class="text-sm text-gray-600 mb-2">Click on the map to select property location</p>
                <div id="map" style="height: 400px;" class="mb-4 rounded-lg border border-gray-300"></div>
                <input type="hidden" id="latitude" name="latitude" required>
                <input type="hidden" id="longitude" name="longitude" required>

                <div class="mt-4">
                    <label for="location" class="block text-gray-700 mb-1">Location Name</label>
                    <input type="text" id="location" name="address"
                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        readonly>
                </div>
            </div>

            <!-- Photos -->
            <div class="mb-8 bg-gray-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Photos</h2>
                <p class="text-gray-600 text-sm mb-4">Let's add photos for the property</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <!-- Thumbnail Upload -->
                    <div id="thumbnail-container"
                        class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:bg-gray-100 transition">
                        <div id="thumbnail-placeholder">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-400 mb-3"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="mb-1 font-medium text-gray-900">Upload thumbnail</p>
                            <p class="text-xs text-gray-500">or drag and drop image here</p>
                        </div>
                        <div id="thumbnail-preview-container" class="relative hidden">
                            <img id="thumbnail-preview" class="w-full h-48 object-cover rounded">
                            <button type="button" id="thumbnail-delete"
                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 shadow-md hover:bg-red-600">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <input type="file" name="thumbnail" class="hidden" id="thumbnail-upload" accept="image/*"
                            required>
                    </div>

                    <!-- Multiple Photos Upload -->
                    <div id="photos-container"
                        class="border-2 border-dashed border-gray-300 rounded-lg p-6 cursor-pointer hover:bg-gray-100 transition">
                        <div id="photos-placeholder" class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-400 mb-3"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="mb-1 font-medium text-gray-900">Upload property photos</p>
                            <p class="text-xs text-gray-500">Select at least 4 images</p>
                        </div>
                        <div id="photos-preview" class="mt-2 grid grid-cols-2 gap-2"></div>
                        <input type="file" name="photos[]" multiple class="hidden" id="photos-upload"
                            accept="image/*" required>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Bedrooms -->
                <div class="mb-6 bg-gray-50 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Bedrooms</h2>
                    <p class="text-gray-600 text-sm mb-4">Number of bedrooms</p>
                    <input type="number" name="bedrooms"
                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Number of bedrooms" required>
                </div>

                <!-- Bathrooms -->
                <div class="mb-6 bg-gray-50 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Bathrooms</h2>
                    <p class="text-gray-600 text-sm mb-4">Number of bathrooms</p>
                    <input type="number" name="bathrooms"
                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Number of bathrooms" required>
                </div>

                <!-- Area -->
                <div class="mb-6 bg-gray-50 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Area</h2>
                    <p class="text-gray-600 text-sm mb-4">Size of the property</p>
                    <input type="number" name="area" step ="any"
                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Area (sq ft)" required>
                </div>
            </div>

            <!-- Amenities -->
            <div class="mb-8 bg-gray-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Amenities</h2>
                <p class="text-gray-600 text-sm mb-4">Select available amenities</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach (['wifi', 'parking', 'pool', 'balcony', 'gym', 'security', 'ac', 'heating'] as $amenity)
                        <label
                            class="flex items-center space-x-2 bg-white p-3 rounded-lg border border-gray-200 hover:border-blue-300 cursor-pointer transition">
                            <input type="checkbox" name="has_{{ $amenity }}"
                                class="h-5 w-5 text-blue-600 rounded">
                            <span class="text-gray-700">{{ ucfirst($amenity) }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mb-8">
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-4 rounded-md hover:bg-blue-700 transition font-medium text-lg">
                    Send for Approval
                </button>
            </div>
        </form>
    </div>

    <script>
        var map = L.map('map').setView([1.3733, 32.2903], 7);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        let marker;

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

            fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`, {
                    headers: {
                        'User-Agent': '{{ config('app.name', 'PropertyFinder') }}/1.0 (groupimak@gmail.com)'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const address = data.address;
                    const locationName = address?.city || address?.town || address?.village || data
                        .display_name || "Unknown location";
                    document.getElementById('location').value = locationName;
                })
                .catch(error => {
                    console.error('Error with reverse geocoding:', error);
                    document.getElementById('location').value = "Location not found";
                });
        });

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

        // Reset form button functionality could be added here
    </script>
</body>

</html>
