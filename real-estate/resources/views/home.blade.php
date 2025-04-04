<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PropertyFinder - Find Your Dream Home</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #1E40AF;
            --primary-light: #3B82F6;
            --primary-dark: #1E3A8A;
            --secondary: #E0F2FE;
        }
        .btn-primary {
            background-color: var(--primary);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        .btn-primary:hover {
            background-color: var(--primary-dark);
        }
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/api/placeholder/1200/500');
            background-size: cover;
            background-position: center;
        }
        .property-card {
            transition: transform 0.3s;
        }
        .property-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-blue-800">PropertyFinder</a>
            <nav class="hidden md:flex space-x-6">
                <a href="/" class="font-medium text-blue-800">Home</a>
                <a href="/properties" class="font-medium text-gray-600 hover:text-blue-800">Listed Properties</a>
                <a href="/properties" class="font-medium text-gray-600 hover:text-blue-800">Property Owner</a>
                <a href="/about" class="font-medium text-gray-600 hover:text-blue-800">About Us</a>
                <a href="/contact" class="font-medium text-gray-600 hover:text-blue-800">Contact Us</a>
            </nav>
            <div class="flex items-center space-x-4">
                <a href="/login" class="font-medium text-gray-600 hover:text-blue-800">Login</a>
                <a href="/register" class="btn-primary">Register</a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-section h-96 flex items-center">
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
                <!-- Property Card 1 -->
                <div class="property-card bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="h-48 bg-gray-200">
                        <img src="\uploads\properties\modern-studio-apartment-design-with-bedroom-living-space.jpg" alt="Property" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <span class="text-sm text-blue-800 font-medium">250,000/Month</span>
                        <h3 class="text-xl font-semibold text-gray-800 mt-1">Modern Apartment</h3>
                        <p class="text-gray-600 mt-1">NKira, Bulindo</p>
                        <div class="flex items-center mt-2 text-gray-700 text-sm">
                            <span class="mr-4">3 Beds</span>
                            <span class="mr-4">2 Baths</span>
                            <span>1,200 sqft</span>
                        </div>
                        <a href="/properties/1" class="block mt-4 text-center py-2 border border-blue-800 text-blue-800 rounded hover:bg-blue-800 hover:text-white transition">View Details</a>
                    </div>
                </div>
                
                <!-- Property Card 2 -->
                <div class="property-card bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="h-48 bg-gray-200">
                        <img src="\uploads\properties\house-isolated-field.jpg" alt="Property" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <span class="text-sm text-blue-800 font-medium">450,000/Month</span>
                        <h3 class="text-xl font-semibold text-gray-800 mt-1">Family House</h3>
                        <p class="text-gray-600 mt-1">Ntinda</p>
                        <div class="flex items-center mt-2 text-gray-700 text-sm">
                            <span class="mr-4">4 Beds</span>
                            <span class="mr-4">3 Baths</span>
                            <span>2,400 sqft</span>
                        </div>
                        <a href="/properties/2" class="block mt-4 text-center py-2 border border-blue-800 text-blue-800 rounded hover:bg-blue-800 hover:text-white transition">View Details</a>
                    </div>
                </div>
                
                <!-- Property Card 3 -->
                <div class="property-card bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="h-48 bg-gray-200">
                        <img src="\uploads\properties\luxury-bedroom-suite-resort-high-rise-hotel-with-working-table.jpg" alt="Property" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <span class="text-sm text-blue-800 font-medium">180,000,000</span>
                        <h3 class="text-xl font-semibold text-gray-800 mt-1">Cozy Studio Apartment</h3>
                        <p class="text-gray-600 mt-1">Kololo, Lower Terrace</p>
                        <div class="flex items-center mt-2 text-gray-700 text-sm">
                            <span class="mr-4">1 Bed</span>
                            <span class="mr-4">1 Bath</span>
                            <span>650 sqft</span>
                        </div>
                        <a href="/properties/3" class="block mt-4 text-center py-2 border border-blue-800 text-blue-800 rounded hover:bg-blue-800 hover:text-white transition">View Details</a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-10">
                <a href="/properties" class="btn-primary">View All Properties</a>
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
                <a href="/register" class="btn-primary bg-white text-blue-800 hover:bg-gray-100">Register Now</a>
                <a href="/properties" class="btn-primary bg-transparent border border-white hover:bg-blue-900">Browse Properties</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">PropertyFinder</h3>
                    <p class="text-gray-400">Find your perfect property with ease. We provide the best properties across the country.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="/properties" class="text-gray-400 hover:text-white">Properties</a></li>
                        <li><a href="/about" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="/contact" class="text-gray-400 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Property Types</h4>
                    <ul class="space-y-2">
                        <li><a href="/properties?type=apartment" class="text-gray-400 hover:text-white">Apartments</a></li>
                        <li><a href="/properties?type=house" class="text-gray-400 hover:text-white">Houses</a></li>
                        <li><a href="/properties?type=land" class="text-gray-400 hover:text-white">Land</a></li>
                        <li><a href="/properties?type=commercial" class="text-gray-400 hover:text-white">Commercial</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact Us</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>Campus Mall</li>
                        <li>Wandegeya, Kampala</li>
                        <li>info@propertyfinder.com</li>
                        <li>+256 752627003</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 PropertyFinder. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>