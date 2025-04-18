@extends('layouts.owner')

@section('content')
    <main class="flex flex-col lg:flex-row min-h-screen bg-gray-50">
        <!-- Include the sidebar partial -->
        @include('owner.partials.sidebar')

        <!-- Main Content Area -->
        <div class="flex-1 md:ml-64">
            <div class="max-w-5xl mx-auto p-6 bg-white shadow-md rounded-lg my-8">
                <h1 class="text-3xl font-bold text-blue-900 mb-6 border-b pb-4">Edit Property</h1>

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

                <form id="property-form" action="{{ route('properties.update', $property->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Hidden input for status (will be changed by JavaScript) -->
                    <input type="hidden" name="status" id="property-status" value="{{ $property->status }}">

                    <!-- Title & Description -->
                    <div class="mb-8 bg-blue-50 bg-opacity-30 p-6 rounded-lg">
                        <h2 class="text-xl font-semibold text-blue-800 mb-2">Title & Description</h2>
                        <p class="text-gray-600 text-sm mb-4">Describe your property to your attendants</p>

                        <div class="mb-4">
                            <input type="text" name="title" value="{{ old('title', $property->title) }}"
                                class="w-full px-4 py-3 border @error('title') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Title here">
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <textarea name="description"
                                class="w-full px-4 py-3 border @error('description') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Description goes here" rows="4">{{ old('description', $property->description) }}</textarea>
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
                                <option value="apartment"
                                    {{ old('property_type', $property->property_type) == 'apartment' ? 'selected' : '' }}>
                                    Apartment</option>
                                <option value="house"
                                    {{ old('property_type', $property->property_type) == 'house' ? 'selected' : '' }}>House
                                </option>
                                <option value="land"
                                    {{ old('property_type', $property->property_type) == 'land' ? 'selected' : '' }}>Land
                                </option>
                                <option value="commercial"
                                    {{ old('property_type', $property->property_type) == 'commercial' ? 'selected' : '' }}>
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
                            <input type="number" name="price" step="any"
                                value="{{ old('price', $property->price) }}"
                                class="w-full px-4 py-3 border @error('price') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Price per month">
                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- Availability Status -->
                    <div class="mb-6 bg-blue-50 bg-opacity-30 p-6 rounded-lg">
                        <h2 class="text-xl font-semibold text-blue-800 mb-2">Availability</h2>
                        <p class="text-gray-600 text-sm mb-4">Set the availability status of this property</p>

                        <select name="availability_status"
                            class="w-full px-4 py-3 border @error('availability_status') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="available"
                                {{ old('availability_status', $property->availability_status) == 'available' ? 'selected' : '' }}>
                                Available</option>
                            <option value="booked"
                                {{ old('availability_status', $property->availability_status) == 'booked' ? 'selected' : '' }}>
                                Booked</option>
                            <option value="sold"
                                {{ old('availability_status', $property->availability_status) == 'sold' ? 'selected' : '' }}>
                                Sold</option>
                        </select>

                        @error('availability_status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Location (Read-only) -->
                    <div class="mb-8 bg-blue-50 bg-opacity-30 p-6 rounded-lg">
                        <h2 class="text-xl font-semibold text-blue-800 mb-2">Location</h2>
                        <p class="text-sm text-gray-600 mb-4">Property location cannot be changed</p>

                        <div class="mt-4">
                            <label for="location" class="block text-blue-900 mb-1">Location Name</label>
                            <input type="text" id="location" name="address" value="{{ $property->address }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed"
                                readonly>
                            <!-- Hidden inputs to keep the latitude and longitude values -->
                            <input type="hidden" id="latitude" name="latitude" value="{{ $property->latitude }}">
                            <input type="hidden" id="longitude" name="longitude" value="{{ $property->longitude }}">
                        </div>
                    </div>

                    <!-- Photos -->
                    <div class="mb-8 bg-blue-50 bg-opacity-30 p-6 rounded-lg">
                        <h2 class="text-xl font-semibold text-blue-800 mb-2">Photos</h2>
                        <p class="text-gray-600 text-sm mb-4">Update property photos if needed</p>

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
                                        <img id="thumbnail-preview"
                                            src="{{ asset('storage/' . $property->primary_image->image_path) }}"
                                            class="w-full h-48 object-cover rounded">
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
                                    <div id="photos-placeholder"
                                        class="text-center {{ $property->images->count() > 0 ? 'hidden' : '' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="mx-auto h-10 w-10 text-blue-800 mb-3" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p class="mb-1 font-medium text-blue-900">Upload property photos</p>
                                        <p class="text-xs text-gray-500">Select at least 4 images</p>
                                    </div>
                                    <div id="photos-preview" class="mt-2 grid grid-cols-2 gap-2">
                                        @foreach ($property->images as $image)
                                            @if ($image->id !== $property->primary_image->id)
                                                <div class="relative existing-image" data-image-id="{{ $image->id }}">
                                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                                        class="w-full h-24 object-cover rounded">
                                                    <button type="button"
                                                        class="existing-image-delete absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 shadow-sm hover:bg-red-600">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                    <input type="hidden" name="existing_images[]"
                                                        value="{{ $image->id }}">
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
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
                            <input type="number" name="bedrooms" value="{{ old('bedrooms', $property->bedrooms) }}"
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
                            <input type="number" name="bathrooms" value="{{ old('bathrooms', $property->bathrooms) }}"
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
                            <input type="number" name="area" step="any"
                                value="{{ old('area', $property->area) }}"
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
                                        {{ old('has_' . $amenity, $property->{'has_' . $amenity}) ? 'checked' : '' }}
                                        class="h-5 w-5 text-blue-800 rounded">
                                    <span class="text-gray-700">{{ ucfirst($amenity) }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                        <!-- Cancel Button -->
                        <a href="{{ route('property.owner.dashboard') }}"
                            class="bg-gray-500 text-white py-4 rounded-md hover:bg-gray-600 transition font-medium text-lg flex items-center justify-center">
                            <i class="fas fa-times mr-2"></i> Cancel
                        </a>

                        <!-- Update Button -->
                        <button type="submit" id="submit-form"
                            class="bg-blue-800 text-white py-4 rounded-md hover:bg-blue-900 transition font-medium text-lg flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i> Update Property
                        </button>
                    </div>
                </form>
            </div>

            <!-- Confirmation Modal for Delete Image -->
            <div id="delete-image-modal"
                class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
                <div class="bg-white rounded-lg p-6 max-w-sm mx-auto">
                    <h3 class="text-xl font-bold text-blue-900 mb-4">Delete Image?</h3>
                    <p class="mb-6">Are you sure you want to remove this image? This action cannot be undone.</p>
                    <div class="flex justify-end space-x-3">
                        <button id="cancel-delete-image"
                            class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancel</button>
                        <button id="confirm-delete-image"
                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Delete Image</button>
                    </div>
                </div>
            </div>

        </div>
    </main>

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show existing thumbnail on page load if it exists
            const thumbnailPreview = document.getElementById('thumbnail-preview');
            const thumbnailPreviewContainer = document.getElementById('thumbnail-preview-container');
            const thumbnailPlaceholder = document.getElementById('thumbnail-placeholder');

            if (thumbnailPreview && thumbnailPreview.getAttribute('src')) {
                thumbnailPreviewContainer.classList.remove('hidden');
                thumbnailPlaceholder.classList.add('hidden');
            }
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

                // Add a hidden input to indicate thumbnail should be removed
                const deleteInput = document.createElement('input');
                deleteInput.type = 'hidden';
                deleteInput.name = 'delete_thumbnail';
                deleteInput.value = '1';
                document.getElementById('property-form').appendChild(deleteInput);
            });

            // Multiple photos preview
            document.getElementById('photos-upload').addEventListener('change', function(event) {
                const files = event.target.files;
                const previewContainer = document.getElementById('photos-preview');
                const placeholder = document.getElementById('photos-placeholder');

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
                                    if (document.getElementById('photos-preview').children
                                        .length === 0) {
                                        document.getElementById('photos-placeholder').classList
                                            .remove('hidden');
                                        document.getElementById('photos-upload').value = '';
                                    }
                                });

                                imgContainer.appendChild(deleteBtn);
                                previewContainer.appendChild(imgContainer);
                            }
                            reader.readAsDataURL(file);
                        }
                    }
                }
            });

            // Handle existing image deletion
            const deleteModal = document.getElementById('delete-image-modal');
            const cancelDeleteBtn = document.getElementById('cancel-delete-image');
            const confirmDeleteBtn = document.getElementById('confirm-delete-image');
            let currentImageToDelete = null;

            // Attach click handlers to all existing image delete buttons
            document.querySelectorAll('.existing-image-delete').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const imageContainer = this.closest('.existing-image');
                    currentImageToDelete = imageContainer;
                    deleteModal.classList.remove('hidden');
                });
            });

            // Cancel image deletion
            cancelDeleteBtn.addEventListener('click', function() {
                deleteModal.classList.add('hidden');
                currentImageToDelete = null;
            });

            // Confirm image deletion
            confirmDeleteBtn.addEventListener('click', function() {
                if (currentImageToDelete) {
                    const imageId = currentImageToDelete.dataset.imageId;

                    // Create hidden input to tell the server to delete this image
                    const deleteInput = document.createElement('input');
                    deleteInput.type = 'hidden';
                    deleteInput.name = 'delete_images[]';
                    deleteInput.value = imageId;
                    document.getElementById('property-form').appendChild(deleteInput);

                    // Remove the image from the DOM
                    currentImageToDelete.remove();

                    // Check if there are any images left
                    if (document.getElementById('photos-preview').children.length === 0) {
                        document.getElementById('photos-placeholder').classList.remove('hidden');
                    }

                    deleteModal.classList.add('hidden');
                    currentImageToDelete = null;
                }
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
