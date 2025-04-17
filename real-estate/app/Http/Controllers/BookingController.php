<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function myBookings()
    {
        $bookings = Booking::with('property')
            ->where('customer_id', Auth::id())
            ->get();

        return $bookings;
    }
    /**
     * Display the active bookings for properties owned by the user.
     *
     * @return \Illuminate\View\View
     */
    public function activeBookings()
    {
    // Get current user (property owner)
        $user = auth()->user();
    
        // Define what "active" means - current date is between check-in and check-out date
        $today = now()->format('Y-m-d');
    
        // Get properties owned by this user
        $propertiesOwned = Property::where('owner_id', $user->id)->pluck('id');
    
        if ($propertiesOwned->isEmpty()) {
            // Return view with empty bookings if user has no properties
            return view('bookings.active-bookings', ['activeBookings' => collect()]);
        }
    
        // Get active bookings for all properties owned by the current user
        $activeBookings = Booking::with(['property.images', 'customer'])
            ->whereIn('property_id', $propertiesOwned)
            ->whereDate('check_in', '<=', $today)
            ->whereRaw('DATE_ADD(check_in, INTERVAL booking_period DAY) >= ?', [$today])
            ->orderBy('check_in', 'asc')
            ->paginate(10);
    
        return view('bookings.active-bookings', compact('activeBookings'));
    }
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
