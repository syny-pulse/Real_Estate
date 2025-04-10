<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function benefits(){
        return view('owner.benefits');
    }

    public function dashboard(){
        return view('owner.dashboard');
    }

    public function terms(){
        return view('owner.terms');
    }

    public function privacy(){
        return view('owner.privacy');
    }
}
