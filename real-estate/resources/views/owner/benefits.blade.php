@extends('layouts.app')
@section('content')

<!-- Registration Container -->
<div class="flex flex-col lg:flex-row min-h-screen">
    <!-- Left Panel -->
    <div class="flex-1 bg-gradient-to-br from-blue-800 to-blue-500 text-white p-8 lg:p-16 flex flex-col justify-center">
        <div class="max-w-lg mx-auto text-center lg:text-left">
            <h1 class="text-4xl font-semibold mb-6">Become a landlord at Property Finder with one step</h1>
            <p class="text-lg mb-8 opacity-90">Are you interested in registering as a Property Owner at Property Finder? Fill in your personal details so that we know you better and our team will review and confirm your details within 24 hours.</p>
            
            <div class="w-56 h-72 md:w-72 md:h-72 lg:w-72 lg:h-72 bg-white rounded-full flex items-center justify-center mx-auto my-8 overflow-hidden">
                <img src="\uploads\properties\house-isolated-field.jpg" alt="Modern House" class="w-fill h-fill">
            </div>
        </div>
    </div>
    
    <!-- Right Panel -->
    <div class="flex-1 bg-white flex items-center justify-center p-4 md:p-8">
        <div class="w-full max-w-md">
            @if ($errors->any())
                <div class="bg-red-50 text-red-800 p-4 rounded-lg mb-6">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Register as a Property Owner</h2>
                
                <form method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                        <input type="text" name="name" id="name" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                        <input type="email" name="email" id="email" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4 relative">
                        <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                        <input type="password" name="password" id="password" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <button type="button" class="toggle-password absolute right-3 top-10 text-gray-500 focus:outline-none">
                            <i class="fas fa-eye-slash"></i>
                        </button>
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 font-medium mb-2">Phone Number</label>
                        <input type="number" name="phone" id="phone" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 font-medium mb-2">Address</label>
                        <textarea name="address" id="address" rows="3" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="role" class="block text-gray-700 font-medium mb-2">Role</label>
                        <select name="role" id="role" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="owner">Property Owner</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="profile_image" class="block text-gray-700 font-medium mb-2">Profile Image</label>
                        <input type="file" name="profile_image" id="profile_image" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="w-full bg-blue-800 text-white py-3 px-4 rounded-md font-medium hover:bg-blue-900 transition duration-200">
                            Submit for Review
                        </button>
                    </div>
                    
                    <p class="text-center text-gray-700 mt-6">Already a Property Owner on PropertyFinder? Please <a href="/login" class="text-blue-800 font-medium hover:underline">login here</a></p>
                    <p class="text-center text-gray-500 text-sm mt-3">By submitting this form, I am agreeing to the PropertyFinder <a href="/terms" class="text-blue-800 font-medium hover:underline">Terms</a> and <a href="/privacy-policy" class="text-blue-800 font-medium hover:underline">Privacy Policy</a></p>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<section class="py-20 px-4 md:px-8 bg-white">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-4xl font-bold text-gray-800 mb-16 text-center">Reason to list your property at Property Finder</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Accept Online Applications</h3>
                <p class="text-gray-600">Collect all the information needed to properly evaluate candidates: employment & income, residence history, personal information, and more.</p>
            </div>
            
            <div class="p-8 bg-blue-50 rounded-xl shadow-md col-span-1 md:col-span-2 lg:col-span-2 relative overflow-hidden">
                <div class="flex justify-center items-center relative">
                    <img src="/images/laptop-mockup.png" alt="Property Finder" class="w-full max-w-md object-contain">
                    <div class="absolute top-1/7 left-1/2 transform -translate-x-1/2 w-4/5 text-center">
                        <p class="text-lg font-semibold mb-1">Effortless Search, Find it with Ease!</p>
                        <p class="text-sm mb-3 opacity-80">Just enter a few search criteria, and get ready to view great matches.</p>
                        <div class="flex justify-between items-center bg-white rounded-lg p-2 shadow-md">
                            <div class="flex gap-4">
                                <span class="text-sm text-gray-600">My criteria</span>
                                <span class="text-sm text-gray-600">Price range</span>
                                <span class="text-sm text-gray-600">Rooms</span>
                            </div>
                            <button class="bg-blue-800 text-white px-4 py-1 rounded text-sm">Search</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Accept Online Applications</h3>
                <p class="text-gray-600">Collect all the information needed to properly evaluate candidates: employment & income, residence history, personal information, and more.</p>
            </div>
            
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Accept Online Applications</h3>
                <p class="text-gray-600">Collect all the information needed to properly evaluate candidates: employment & income, residence history, personal information, and more.</p>
            </div>
        </div>
    </div>
</section>

<script>
    // Add Font Awesome if it's not already included in your layout
    if (!document.querySelector('link[href*="font-awesome"]')) {
        const fontAwesome = document.createElement('link');
        fontAwesome.rel = 'stylesheet';
        fontAwesome.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css';
        document.head.appendChild(fontAwesome);
    }

    // Toggle password visibility
    document.querySelector('.toggle-password').addEventListener('click', function() {
        const passwordInput = document.querySelector('#password');
        const icon = this.querySelector('i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    });

    // Show selected filename when choosing a file
    document.getElementById('profile_image').addEventListener('change', function() {
        const fileName = this.files[0]?.name || 'Profile Image';
        // You could implement a label to show the file name here if needed
    });
</script>
@endsection