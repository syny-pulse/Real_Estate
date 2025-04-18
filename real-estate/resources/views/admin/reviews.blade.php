@extends('layouts.owner')

@section('content')
<main class="flex flex-col lg:flex-row min-h-screen bg-gray-50">
    <!-- Include the sidebar partial -->
    @include('admin.partials.sidebar')

    <!-- Main Content Area -->
    <div class="flex-1 md:ml-64">
        <div class="container mx-auto p-4 lg:p-6 max-w-7xl">
            <h1 class="text-2xl font-bold mb-6">Reviews</h1>

    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Property</th>
                <th class="py-2 px-4 border-b">User</th>
                <th class="py-2 px-4 border-b">Rating</th>
                <th class="py-2 px-4 border-b">Comment</th>
                <th class="py-2 px-4 border-b">Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
            <tr>
                <td class="py-2 px-4 border-b">{{ $review->property->title ?? 'N/A' }}</td>
                <td class="py-2 px-4 border-b">{{ $review->customer->name ?? 'N/A' }}</td>
                <td class="py-2 px-4 border-b">{{ $review->rating }}</td>
                <td class="py-2 px-4 border-b">{{ $review->comment }}</td>
                <td class="py-2 px-4 border-b">{{ $review->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
