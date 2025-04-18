<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Property;
use App\Models\Booking;
use App\Models\Review;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get statistics for all properties
        $totalUsers = User::count();
        $totalProperties = Property::count();
        $approvedProperties = Property::where('status', 'approved')->count();
        $pendingProperties = Property::where('status', 'pending')->count();
        $rejectedProperties = Property::where('status', 'rejected')->count();

        // Prepare stats array for blade view
        $stats = [
            'approved' => $approvedProperties,
            'pending' => $pendingProperties,
            'rejected' => $rejectedProperties,
        ];

        // Fetch all properties grouped by status for tabs
        $allProperties = Property::all();
        $approvedProps = $allProperties->where('status', 'approved');
        $pendingProps = $allProperties->where('status', 'pending');
        $rejectedProps = $allProperties->where('status', 'rejected');

        // Flag to disable add property button in view
        $disableAddProperty = true;

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProperties',
            'stats',
            'allProperties',
            'approvedProps',
            'pendingProps',
            'rejectedProps',
            'disableAddProperty'
        ));
    }

    // Fetch all properties and show in admin properties view
    public function index()
    {
        $properties = Property::with('owner')->get();
        return view('admin.properties', compact('properties'));
    }

    // Show details of a single property
    public function show($id)
    {
        $property = Property::with(['owner', 'amenities', 'images'])->findOrFail($id);
        return view('admin.property-show', compact('property'));
    }

    // Approve a property listing
    public function approve($id)
    {
        $property = Property::findOrFail($id);
        $property->status = 'approved';
        $property->save();

        return redirect()->route('admin.properties')->with('success', 'Property approved successfully.');
    }

    // Reject a property listing
    public function reject($id)
    {
        $property = Property::findOrFail($id);
        $property->status = 'rejected';
        $property->save();

        return redirect()->route('admin.properties')->with('success', 'Property rejected successfully.');
    }

    // Fetch all bookings with filtering by status
    public function bookings(Request $request)
    {
        $status = $request->query('status');

        $query = Booking::with(['property.owner', 'customer']);

        if ($status) {
            $query->where('status', $status);
        }

        $bookings = $query->get();

        return view('admin.bookings', compact('bookings', 'status'));
    }

    // Fetch all reviews
    public function reviews(Request $request)
    {
        $reviews = Review::with(['customer', 'property'])->get();

        return view('admin.reviews', compact('reviews'));
    }
}
