@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="hero-section h-64 flex items-center">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Contact Us</h1>
        <p class="text-xl text-white max-w-2xl mx-auto">We're here to help with all your property needs.</p>
    </div>
</section>

<!-- Contact Information -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <!-- Office Address -->
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Our Office</h3>
                <p class="text-gray-600 mb-2">Room S17, Dunia House </p>
                <p class="text-gray-600 mb-2">Kampala Business Center</p>
                <p class="text-gray-600">Kampala, Uganda</p>
            </div>

            <!-- Contact Details -->
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Contact Details</h3>
                <p class="text-gray-600 mb-2">Phone: +256 700 123 456</p>
                <p class="text-gray-600 mb-2">Email: info@propertyfinder.com</p>
                <p class="text-gray-600">Support: support@propertyfinder.com</p>
            </div>

            <!-- Business Hours -->
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Business Hours</h3>
                <p class="text-gray-600 mb-2">Monday - Friday: 8:00 AM - 6:00 PM</p>
                <p class="text-gray-600 mb-2">Saturday: 9:00 AM - 4:00 PM</p>
                <p class="text-gray-600">Sunday: Closed</p>
            </div>
        </div>

        <!-- Contact Form and Map -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Contact Form -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Send Us a Message</h3>
                <form>
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 mb-2">Full Name</label>
                        <input type="text" id="name" name="name" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 mb-2">Email Address</label>
                        <input type="email" id="email" name="email" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="subject" class="block text-gray-700 mb-2">Subject</label>
                        <select id="subject" name="subject" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="">Select a subject</option>
                            <option value="general">General Inquiry</option>
                            <option value="viewing">Property Viewing</option>
                            <option value="listing">List My Property</option>
                            <option value="support">Technical Support</option>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="message" class="block text-gray-700 mb-2">Your Message</label>
                        <textarea id="message" name="message" rows="5" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                    </div>
                    <button type="submit" class="btn-primary w-full">Send Message</button>
                </form>
            </div>

            <!-- Map -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold text-gray-800 mb-6">Our Location</h3>
                <div class="h-96 bg-gray-200 rounded-lg">
                    <!-- Replace with actual map embed code -->
                    <div class="w-full h-full flex items-center justify-center bg-gray-300 text-gray-600">
                        <p>Map Embed Goes Here</p>
                        <!-- You would typically add a Google Maps or OpenStreetMap embed here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 bg-blue-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center">Frequently Asked Questions</h2>
        <div class="max-w-3xl mx-auto">
            <!-- FAQ Item 1 -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">How do I schedule a property viewing?</h3>
                <p class="text-gray-600">You can schedule a viewing by contacting us through this form, calling our office, or using the "Book a Visit" button on any property listing page.</p>
            </div>

            <!-- FAQ Item 2 -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">How can I list my property on PropertyFinder?</h3>
                <p class="text-gray-600">To list your property, you'll need to create an account and select the "Add Property" option from your dashboard. Alternatively, you can contact our team, and we'll assist you with the listing process.</p>
            </div>

            <!-- FAQ Item 3 -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">What areas do you cover?</h3>
                <p class="text-gray-600">PropertyFinder currently covers all major cities in Uganda, with a particular focus on Kampala, Entebbe, Jinja, and Mbarara. We're constantly expanding our reach to include more locations.</p>
            </div>

            <!-- FAQ Item 4 -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Do you charge any fees to buyers or renters?</h3>
                <p class="text-gray-600">PropertyFinder does not charge any fees to property searchers. Our platform is free to use for anyone looking to buy, rent, or lease a property.</p>
            </div>

            <!-- FAQ Item 5 -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">How quickly can I expect a response to my inquiry?</h3>
                <p class="text-gray-600">We aim to respond to all inquiries within 24 hours during business days. For urgent matters, we recommend calling our office directly.</p>
            </div>
        </div>
    </div>
</section>

<!-- Social Media Section -->
<section class="py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Connect With Us</h2>
        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">Follow us on social media for the latest property listings, market updates, and real estate tips.</p>
        <div class="flex justify-center space-x-6">
            <a href="#" class="text-blue-800 hover:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                </svg>
            </a>
            <a href="#" class="text-blue-800 hover:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                </svg>
            </a>
            <a href="https://x.com/15ybh" class="text-blue-800 hover:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                </svg>
            </a>
            <a href="#" class="text-blue-800 hover:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z" />
                </svg>
            </a>
            <a href="#" class="text-blue-800 hover:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-blue-800 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Ready to Get Started?</h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto">Whether you're looking to buy, rent, or sell a property, our team is here to help you every step of the way.</p>
        <div class="space-x-4">
            <a href="{{route('register.show')}}" class="btn-primary bg-white text-blue-800 hover:bg-gray-100">Register Now</a>
            <a href="/properties" class="btn-primary bg-transparent border border-white hover:bg-blue-900">Browse Properties</a>
        </div>
    </div>
</section>

@endsection