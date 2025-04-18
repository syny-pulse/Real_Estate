@extends('layouts.owner')

@section('content')
<main class="flex flex-col lg:flex-row min-h-screen bg-gray-50">
    <!-- Include the sidebar partial -->
    @include('admin.partials.sidebar')

    <!-- Main Content Area -->
    <div class="flex-1 md:ml-64">
        <div class="container mx-auto p-4 lg:p-6 max-w-7xl">
    <h1 class="text-2xl font-bold mb-6">Property Submissions</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Title</th>
                <th class="py-2 px-4 border-b">Owner</th>
                <th class="py-2 px-4 border-b">Price</th>
                <th class="py-2 px-4 border-b">Status</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($properties as $property)
            <tr>
                <td class="py-2 px-4 border-b">{{ $property->title }}</td>
                <td class="py-2 px-4 border-b">{{ $property->owner->name ?? 'N/A' }}</td>
                <td class="py-2 px-4 border-b">${{ number_format($property->price, 2) }}</td>
                <td class="py-2 px-4 border-b capitalize">{{ $property->status }}</td>
                <td class="py-2 px-4 border-b">
                    <a href="{{ route('admin.properties.show', $property->id) }}" class="text-blue-600 hover:underline mr-2">View</a>

                    @if($property->status !== 'approved')
                    <form action="{{ route('admin.properties.approve', $property->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-green-600 hover:underline mr-2">Approve</button>
                    </form>
                    @endif

                    @if($property->status !== 'rejected')
                    <form action="{{ route('admin.properties.reject', $property->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:underline">Reject</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
