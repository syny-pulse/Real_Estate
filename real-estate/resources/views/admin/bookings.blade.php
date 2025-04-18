@extends('layouts.owner')

@section('content')
<main class="flex flex-col lg:flex-row min-h-screen bg-gray-50">
    <!-- Include the sidebar partial -->
    @include('admin.partials.sidebar')

    <!-- Main Content Area -->
    <div class="flex-1 md:ml-64">
        <div class="container mx-auto p-4 lg:p-6 max-w-7xl">
            <h1 class="text-2xl font-bold mb-6">Bookings</h1>

    <div class="mb-4">
        <form method="GET" action="{{ route('admin.bookings') }}" class="flex items-center space-x-4">
            <label for="status" class="font-semibold">Filter by Status:</label>
            <select name="status" id="status" class="border border-gray-300 rounded px-3 py-1">
                <option value="" {{ $status == '' ? 'selected' : '' }}>All</option>
                <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $status == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ $status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                <option value="cancelled" {{ $status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700">Filter</button>
        </form>
    </div>

    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Property</th>
                <th class="py-2 px-4 border-b">Owner</th>
                <th class="py-2 px-4 border-b">Customer</th>
                <th class="py-2 px-4 border-b">Amount</th>
                <th class="py-2 px-4 border-b">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td class="py-2 px-4 border-b">{{ $booking->property->title ?? 'N/A' }}</td>
                <td class="py-2 px-4 border-b">{{ $booking->property->owner->name ?? 'N/A' }}</td>
                <td class="py-2 px-4 border-b">{{ $booking->customer->name ?? 'N/A' }}</td>
                <td class="py-2 px-4 border-b">${{ number_format($booking->amount, 2) }}</td>
                <td class="py-2 px-4 border-b capitalize">{{ $booking->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
