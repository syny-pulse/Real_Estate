<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:20',
        ]);

        //auth()->user()->update($request->only(['name', 'email', 'phone']));

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function updateImage(Request $request)
{
    $request->validate([
        'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = auth()->user();

    if ($request->hasFile('profile_image')) {
        // Delete old image
        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }

        // Store new image and get its path (e.g., profile-images/xyz.jpg)
        $path = $request->file('profile_image')->store('profile-images', 'public');

        // Store the path only (not the full URL)
        $user->update([
            'profile_image' => $path,
        ]);

        return redirect()->back()->with('status', 'Profile image updated successfully.');
    }

    return redirect()->back()->with('error', 'Failed to upload image.');
}

}
