<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function benefits(){

        return view('owner.benefits');
    }

    public function dashboard(){
        $user = Auth::user();

        // Get property statistics
        $stats = [
            'approved' => Property::where('owner_id', $user->id)->where('status', 'approved')->count(),
            'pending' => Property::where('owner_id', $user->id)->where('status', 'pending')->count(),
            'rejected' => Property::where('owner_id', $user->id)->where('status', 'rejected')->count(),
            'total' => Property::where('owner_id', $user->id)->count()
        ];

        // Get properties for each tab
        $properties = Property::where('owner_id', $user->id)->get();
        return view('owner.dashboard', compact('stats', 'properties'));
    }

    public function terms(){
        return view('owner.terms');
    }

    public function privacy(){
        return view('owner.privacy');
    }
}
