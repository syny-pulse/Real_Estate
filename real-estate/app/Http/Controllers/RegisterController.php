<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show(){
        return view('register');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::defaults()],
            'phone' => ['required', 'numeric', 'digits:10'],
            'address' => ['nullable', 'string'],
            'role' => ['required', Rule::in(['admin', 'property owner', 'customer'])],
            'profile_image' => ['required', 'image', 'max:5120'], // Max 5MB
        ]);

           // Handle the profile image upload
    if ($request->hasFile('profile_image')) {
        $imagePath = $request->file('profile_image')->store('profile-images', 'public');
        $validated['profile_image'] = $imagePath;
    }

    // Hash the password
    $validated['password'] = Hash::make($validated['password']);

    // Set default status (not in form, but required for the table)
    $validated['status'] = 'active';

    // Create the user
    $user = User::create($validated);

    // Redirect with success message
    return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
}
