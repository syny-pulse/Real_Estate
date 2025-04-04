<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProperties = Property::active()
            ->featured()
            ->with(['images'])
            ->take(3)
            ->get();
            
        return view('home', compact('featuredProperties'));
    }
}