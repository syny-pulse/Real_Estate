<?php

namespace App\Http\Controllers;
use App\Models\Property;
use Illuminate\Support\Str;
use App\Models\Amenity;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class PropertiesController extends Controller
{
    public function create() {
        return view('owner.properties-create');
    }

    public function store(Request $request)
{
    // Validate the request
    $validated = $request->validate([
        'title' => 'required|string|max:100',
        'description' => 'required|string',
        'property_type' => 'required|in:apartment,house,land,commercial',
        'price' => 'required|numeric',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'address' => 'required|string|max:50',
        'bedrooms' => 'required|integer',
        'bathrooms' => 'required|integer',
        'area' => 'required|numeric',
        'thumbnail' => 'required|image|max:2048',
        'photos.*' => 'required|image|max:2048',// refers to each individual file in that array
        'photos' => 'required|array|min:4',//refers to the entire array of uploaded files
    ]);

    // Begin a database transaction
    DB::beginTransaction();

    try {
        // Create the property
        $property = new Property();
        $property->title = $request->title;
        $property->slug = Str::slug($request->title) . '-' . Str::random(5);
        $property->description = $request->description;
        $property->price = $request->price;
        $property->property_type = $request->property_type;
        $property->address = $request->address; // Using the location name from the map
        $property->latitude = $request->latitude;
        $property->longitude = $request->longitude;
        $property->owner_id = Auth::id();
        $property->bedrooms = $request->bedrooms;
        $property->bathrooms = $request->bathrooms;
        $property->area = $request->area;
        $property->save();

    // Upload and save the thumbnail (primary image)
    if ($request->hasFile('thumbnail')) {
        $thumbnailPath = $request->file('thumbnail')->store('property-images', 'public');

        $primaryImage = new PropertyImage();
        $primaryImage->property_id = $property->id;
        $primaryImage->image_path = $thumbnailPath;
        $primaryImage->is_primary = true;
        $primaryImage->save();
    }

                // Upload and save additional photos
                if ($request->hasFile('photos')) {
                    foreach ($request->file('photos') as $photo) {
                        $photoPath = $photo->store('property-images', 'public');

                        $propertyImage = new PropertyImage();
                        $propertyImage->property_id = $property->id;
                        $propertyImage->image_path = $photoPath;
                        $propertyImage->is_primary = false;
                        $propertyImage->save();
                    }
                }

                // Save the amenities
            $amenities = new Amenity();
            $amenities->property_id = $property->id;
            $amenities->has_wifi = $request->has('has_wifi') ? true : false;
            $amenities->has_parking = $request->has('has_parking') ? true : false;
            $amenities->has_pool = $request->has('has_pool') ? true : false;
            $amenities->has_balcony = $request->has('has_balcony') ? true : false;
            $amenities->has_gym = $request->has('has_gym') ? true : false;
            $amenities->has_security = $request->has('has_security') ? true : false;
            $amenities->has_ac = $request->has('has_ac') ? true : false;
            $amenities->has_heating = $request->has('has_heating') ? true : false;
            $amenities->save();

            // Commit the transaction
            DB::commit();

            return redirect()->route('property.owner.dashboard')
            ->with('success', 'Property submitted for approval successfully!');
    } catch (\Exception $e) {
        // If anything goes wrong, rollback the transaction
        DB::rollBack();

        return redirect()->back()
                ->with('error', 'There was an error creating the property: ' . $e->getMessage())
                ->withInput();
    }
}
}
