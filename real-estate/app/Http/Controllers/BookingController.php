<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'check_in' => 'required|date|after_or_equal:today',
            'guests' => 'required|integer|min:1',
            'booking_period' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0'
        ]);

        Booking::create([
            'property_id' => $request->property_id,
            'customer_id' => Auth::id(),
            'check_in' => $request->check_in,
            'guests' => $request->guests,
            'booking_period' => $request->booking_period,
            'total_price' => $request->total_price,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Booking request submitted successfully!');
    }
}
