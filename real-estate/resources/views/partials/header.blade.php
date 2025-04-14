<header class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{route('home')}}" class="text-2xl font-bold text-blue-800">{{ config('app.name', 'PropertyFinder') }}</a>
        <nav class="hidden md:flex space-x-6">
            <a href="{{route('home')}}" class="font-medium text-blue-800">Home</a>
            <a href="{{route('properties.index')}}" class="font-medium text-gray-600 hover:text-blue-800">Listed Properties</a>
            <a href="{{route('property.owner.benefits')}}" class="font-medium text-gray-600 hover:text-blue-800">Property Owner</a>
            <a href="/about" class="font-medium text-gray-600 hover:text-blue-800">About Us</a>
            <a href="/contact" class="font-medium text-gray-600 hover:text-blue-800">Contact Us</a>
        </nav>
        <div class="flex items-center space-x-4">
            <a href="{{route('login.show')}}" class="font-medium text-gray-600 hover:text-blue-800">Login</a>
            <a href="{{route('register.show')}}" class="btn-primary">Register</a>
        </div>
    </div>
</header>
