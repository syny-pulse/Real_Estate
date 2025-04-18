@extends('layouts.owner')

@section('content')
<main class="flex flex-col lg:flex-row min-h-screen bg-gray-50">
    <!-- Include the sidebar partial -->
    @include('admin.partials.sidebar')

    <!-- Main Content Area -->
    <div class="flex-1 md:ml-64">
        <div class="container mx-auto p-4 lg:p-6 max-w-7xl">
    <h1 class="text-2xl font-bold mb-6">Property Details</h1>

    <div class="mb-4">
        <a href="{{ route('admin.properties') }}" class="text-blue-600 hover:underline">&larr; Back to Properties</a>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-2">{{ $property->title }}</h2>
        <p class="mb-2">{{ $property->description }}</p>
        <p class="mb-2"><strong>Price:</strong> ${{ number_format($property->price, 2) }}</p>
        <p class="mb-2"><strong>Type:</strong> {{ ucfirst($property->property_type) }}</p>
        <p class="mb-2"><strong>Address:</strong> {{ $property->address }}</p>
        <p class="mb-2"><strong>Status:</strong> <span class="capitalize">{{ $property->status }}</span></p>
        <p class="mb-2"><strong>Owner:</strong> {{ $property->owner->name ?? 'N/A' }} ({{ $property->owner->email ?? 'N/A' }})</p>

        <div class="mb-4">
            <h3 class="font-semibold mb-2">Amenities</h3>
            <ul class="list-disc list-inside">
                @if($property->amenities)
                    @foreach($property->amenities->getAttributes() as $key => $value)
                        @if($key !== 'property_id' && $key !== 'id' && $value)
                            <li>{{ ucwords(str_replace('_', ' ', $key)) }}</li>
                        @endif
                    @endforeach
                @else
                    <li>No amenities listed.</li>
                @endif
            </ul>
        </div>

        <div class="mb-4">
            <h3 class="font-semibold mb-2">Images</h3>
            <div class="grid grid-cols-3 gap-4">
                @foreach($property->images as $image)
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Property Image" class="w-full h-auto rounded">
                @endforeach
            </div>
        </div>

        @if($property->status === 'pending')
        <div class="flex space-x-4">
            <form action="{{ route('admin.properties.approve', $property->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Approve</button>
            </form>
            <form action="{{ route('admin.properties.reject', $property->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Reject</button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection
