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

        auth()->user()->update($request->only(['name', 'email', 'phone']));

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if (auth()->user()->profile_image) {
                $oldPath = str_replace('/storage', 'public', auth()->user()->profile_image);
                if (Storage::exists($oldPath)) {
                    Storage::delete($oldPath);
                }
            }

            // Store new image
            $path = $request->file('profile_image')->store('public/profile-images');
            $url = Storage::url($path);

            auth()->user()->update([
                'profile_image' => $url,
            ]);

            return redirect()->back()->with('success', 'Profile image updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to upload image');
    }
}