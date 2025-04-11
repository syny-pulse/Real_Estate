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
                <img src="\uploads\properties\landlord.png" alt="Modern House" class="w-full h-full object-cover">
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
                        <input type="tel" name="phone" id="phone" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
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
            <div class="p-6 bg-blue-50 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Accept Online Applications</h3>
                <p class="text-gray-600">Collect all the information needed to properly evaluate candidates: employment & income, residence history, personal information, and more.</p>
            </div>
            
            <div class="p-8 bg-blue-50 rounded-xl shadow-md col-span-1 md:col-span-2 lg:col-span-2 relative overflow-hidden">
                <div class="flex flex-col md:flex-row items-center">
                    <!-- Left side content -->
                    <div class="md:w-1/2 mb-6 md:mb-0 md:pr-6">
                        <h3 class="text-2xl font-semibold text-blue-800 mb-3">Maximum Exposure for Your Property</h3>
                        <p class="text-gray-700 mb-4">Reach thousands of potential tenants searching for their next home through our powerful platform. Our advanced search algorithms ensure your property gets in front of the right audience.</p>
                        
                        <div class="flex items-center mb-4">
                            <div class="bg-blue-100 rounded-full p-2 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="font-medium text-gray-700">25,000+ active daily users</p>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="bg-blue-100 rounded-full p-2 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="font-medium text-gray-700">Average listing time: 14 days</p>
                        </div>
                    </div>
                    
                    <!-- Right side stats -->
                    <div class="md:w-1/2 bg-white rounded-lg shadow-lg p-6">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Performance Statistics</h4>
                        
                        <div class="mb-4">
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">Property views</span>
                                <span class="text-sm font-medium text-blue-600">2,400 / month</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 80%"></div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">Inquiries received</span>
                                <span class="text-sm font-medium text-blue-600">42 / month</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 65%"></div>
                            </div>
                        </div>
                        
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">Qualified leads</span>
                                <span class="text-sm font-medium text-blue-600">18 / month</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 45%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="p-6 bg-blue-50 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Accept Online Applications</h3>
                <p class="text-gray-600">Collect all the information needed to properly evaluate candidates: employment & income, residence history, personal information, and more.</p>
            </div>
            
            <div class="p-6 bg-blue-50 rounded-lg shadow-md">
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