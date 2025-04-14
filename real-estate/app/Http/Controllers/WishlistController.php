<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id'
        ]);

        Wishlist::firstOrCreate([
            'customer_id' => Auth::id(),
            'property_id' => $request->property_id
        ]);

        return back()->with('success', 'Property added to wishlist!');
    }

    public function destroy($id)
    {
        Wishlist::where([
            'customer_id' => Auth::id(),
            'property_id' => $id
        ])->delete();

        return back()->with('success', 'Property removed from wishlist!');
    }
}
