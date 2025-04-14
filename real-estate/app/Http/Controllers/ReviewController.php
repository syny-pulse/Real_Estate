<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'booking_id' => 'required|exists:bookings,id',
            'rating' => 'required|integer|between:0,5',
            'comment' => 'nullable|string|max:500'
        ]);

        // Verify the booking belongs to the authenticated user
        $booking = Booking::where('id', $request->booking_id)
            ->where('customer_id', Auth::id())
            ->where('property_id', $request->property_id)
            ->firstOrFail();

        Review::create([
            'property_id' => $request->property_id,
            'customer_id' => Auth::id(),
            'booking_id' => $request->booking_id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }
}
