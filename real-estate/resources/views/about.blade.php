@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="hero-section h-64 flex items-center">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">About PropertyFinder</h1>
        <p class="text-xl text-white max-w-2xl mx-auto">Your trusted partner in finding the perfect property solution.</p>
    </div>
</section>

<!-- Our Story -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Our Story</h2>
                <p class="text-gray-600 mb-4">Founded in 2018, PropertyFinder began with a simple mission: to make property hunting easier and more accessible for everyone. What started as a small team of real estate enthusiasts has grown into a nationwide platform connecting thousands of property seekers with their dream homes.</p>
                <p class="text-gray-600 mb-4">We understand that finding the perfect property is more than just a transaction—it's about finding a place where memories will be made and lives will unfold. That's why we're committed to providing a seamless, transparent experience for all our users.</p>
                <p class="text-gray-600">Today, PropertyFinder is proud to be one of the leading property platforms in the country, with a diverse portfolio of residential, commercial, and land properties available for rent, lease, and sale.</p>
            </div>
            <div class="rounded-lg overflow-hidden shadow-lg">
                <img src="/uploads/properties/team-photo.jpg" alt="Our Team" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
</section>

<!-- Our Values -->
<section class="py-16 bg-blue-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center">Our Values</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Transparency</h3>
                <p class="text-gray-600">We believe in honest, clear communication with all our clients, ensuring you have all the information you need to make informed decisions.</p>
            </div>

            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Community</h3>
                <p class="text-gray-600">We're not just connecting people with properties; we're building communities and helping to create spaces where people can thrive.</p>
            </div>

            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Innovation</h3>
                <p class="text-gray-600">We constantly strive to improve our platform and services, utilizing the latest technology to make property hunting easier and more efficient.</p>
            </div>
        </div>
    </div>
</section>

<!-- Our Team -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center">Meet Our Leadership Team</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Team Member 1 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="h-64 bg-gray-200">
                    <img src="/uploads/team/team-member-1.jpg" alt="Team Member" class="w-full h-full object-cover">
                </div>
                <div class="p-4 text-center">
                    <h3 class="text-xl font-semibold text-gray-800">Mugisha Modern</h3>
                    <p class="text-blue-800 mt-1">CEO & Founder</p>
                </div>
            </div>

            <!-- Team Member 2 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="h-64 bg-gray-200">
                    <img src="/uploads/team/team-member-2.jpg" alt="Team Member" class="w-full h-full object-cover">
                </div>
                <div class="p-4 text-center">
                    <h3 class="text-xl font-semibold text-gray-800">Kisomose Anorld Patrick</h3>
                    <p class="text-blue-800 mt-1">Chief Operations Officer</p>
                </div>
            </div>

            <!-- Team Member 3 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="h-64 bg-gray-200">
                    <img src="/uploads/team/team-member-3.jpg" alt="Team Member" class="w-full h-full object-cover">
                </div>
                <div class="p-4 text-center">
                    <h3 class="text-xl font-semibold text-gray-800">Kabalebe Joshua</h3>
                    <p class="text-blue-800 mt-1">Head of Marketing</p>
                </div>
            </div>

            <!-- Team Member 4 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="h-64 bg-gray-200">
                    <img src="/uploads/team/team-member-4.jpg" alt="Team Member" class="w-full h-full object-cover">
                </div>
                <div class="p-4 text-center">
                    <h3 class="text-xl font-semibold text-gray-800">Kuikiriza Sinai</h3>
                    <p class="text-blue-800 mt-1">Property Relations Manager</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-16 bg-blue-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center">What Our Clients Say</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="h-12 w-12 rounded-full bg-gray-200 mr-4">
                        <img src="/uploads/testimonials/client-1.jpg" alt="Client" class="h-full w-full rounded-full object-cover">
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Robert Mukasa</h4>
                        <p class="text-sm text-gray-600">Homeowner</p>
                    </div>
                </div>
                <p class="text-gray-600">"PropertyFinder made selling my house so easy. Their platform reached the right buyers quickly, and their team was professional and supportive throughout the process."</p>
            </div>

            <!-- Testimonial 2 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="h-12 w-12 rounded-full bg-gray-200 mr-4">
                        <img src="/uploads/testimonials/client-2.jpg" alt="Client" class="h-full w-full rounded-full object-cover">
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Amina Nantaba</h4>
                        <p class="text-sm text-gray-600">First-time Buyer</p>
                    </div>
                </div>
                <p class="text-gray-600">"As a first-time homebuyer, I was nervous about the process. PropertyFinder's resources and responsive customer service made everything clear and manageable."</p>
            </div>

            <!-- Testimonial 3 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="h-12 w-12 rounded-full bg-gray-200 mr-4">
                        <img src="/uploads/testimonials/client-3.jpg" alt="Client" class="h-full w-full rounded-full object-cover">
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">John Ssekandi</h4>
                        <p class="text-sm text-gray-600">Property Investor</p>
                    </div>
                </div>
                <p class="text-gray-600">"I've been using PropertyFinder for my investment properties for years. Their platform consistently connects me with high-quality tenants and buyers."</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-blue-800 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Ready to Work With Us?</h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto">Join thousands of satisfied clients who've found their perfect property solution with PropertyFinder.</p>
        <div class="space-x-4">
            <a href="{{route('register.show')}}" class="btn-primary bg-white text-blue-800 hover:bg-gray-100">Register Now</a>
            <a href="/contact" class="btn-primary bg-transparent border border-white hover:bg-blue-900">Contact Us</a>
        </div>
    </div>
</section>

@endsection