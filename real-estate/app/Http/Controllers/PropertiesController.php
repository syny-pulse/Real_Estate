<?php

namespace App\Http\Controllers;
use App\Models\Property;
use Illuminate\Support\Str;
use App\Models\Amenity;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PropertiesController extends Controller
{
    public function myWishedProperties()
    {
        $wishlistController = new WishlistController();
        $wishlistItems = $wishlistController->myWishlist();

        return view('owner.wishlist', compact('wishlistItems'));
    }
    public function myBookedProperties()
    {
        $bookingController = new BookingController();
        $bookings = $bookingController->myBookings();

        return view('owner.booked-properties', compact('bookings'));
    }
    public function index()
    {
        $properties = Property::with(['images' => function($query) {
                $query->where('is_primary', true);
            }])
            ->where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('properties.index', compact('properties'));
    }

    public function show(Property $property)
{
    $property->load('images');

    $amenities = $property->amenities ? $property->amenities->first() : null;

    $location = [
        'address' => $property->address,
        'latitude' => $property->latitude,
        'longitude' => $property->longitude
    ];
    return view('properties.show', compact('property', 'amenities', 'location'));
}
    public function edit(Property $property)
    {
        $property->load('images'); // Load images if necessary
        return view('owner.properties-edit', compact('property'));

    }

    public function myProperties()
{
    $properties = Property::where('user_id', auth()->id())
        ->with(['images' => function($query) {
            $query->where('is_primary', true)->first();
        }])
        ->orderBy('created_at', 'desc')
        ->get();

    return view('owner.properties', compact('properties'));
}

    public function create() {
        return view('owner.properties-create');
    }

    public function store(Request $request)
    {
        try {
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
                'thumbnail' => 'required|image|max:3072', // Max 3MB
                'photos.*' => 'required|image|max:3072', // refers to each individual file in that array
                'photos' => 'required|array' // refers to the entire array of uploaded files
            ]);

            // Begin a database transaction
            DB::beginTransaction();

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

        } catch (ValidationException $e) {
            // For validation exceptions, Laravel already redirects back with errors
            return back()->withErrors($e->validator)->withInput();

        } catch (\Exception $e) {
            // If anything goes wrong, rollback the transaction
            DB::rollBack();

            // Return to the form with a more specific error message
            return back()
                ->withErrors(['system_error' => 'There was an error creating the property: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        // Find the property and ensure it belongs to the authenticated owner
        $property = Property::where('id', $id)
                        ->where('owner_id', auth()->id())
                        ->firstOrFail();
        try {
            // Validate the request
            $validated = $request->validate([
                'title' => 'required|string|max:100',
                'description' => 'required|string',
                'property_type' => 'required|in:apartment,house,land,commercial',
                'price' => 'required|numeric',
                'availability_status' => 'required|in:available,booked,sold',
                'bedrooms' => 'required|integer',
                'bathrooms' => 'required|integer',
                'area' => 'required|numeric',
                'thumbnail' => 'nullable|image|max:3072', // Max 3MB
                'photos.*' => 'nullable|image|max:3072', // refers to each individual file in that array
                'photos' => 'nullable|array|min:4', // refers to the entire array of uploaded files
            ]);

            // Begin a database transaction
            DB::beginTransaction();

             // Update property fields
            $property->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title) . '-' . Str::random(5),
                'description' => $request->description,
                'price' => $request->price,
                'property_type' => $request->property_type,
                'availability_status' => $request->availability_status,
                'bedrooms' => $request->bedrooms,
                'bathrooms' => $request->bathrooms,
                'area' => $request->area,
            ]);

            // Update thumbnail if a new one is uploaded
        if ($request->hasFile('thumbnail')) {
            // Delete the old thumbnail from storage
            $oldThumbnail = PropertyImage::where('property_id', $property->id)->where('is_primary', true)->first();
            if ($oldThumbnail) {
                Storage::disk('public')->delete($oldThumbnail->image_path);
                $oldThumbnail->delete();
            }

            // Store new thumbnail
            $newThumbPath = $request->file('thumbnail')->store('property-images', 'public');
            PropertyImage::create([
                'property_id' => $property->id,
                'image_path' => $newThumbPath,
                'is_primary' => true,
            ]);
        }

        // Update additional photos if any are uploaded
        if ($request->hasFile('photos')) {
            // Delete old non-primary images
            $oldPhotos = PropertyImage::where('property_id', $property->id)
                ->where('is_primary', false)->get();

            foreach ($oldPhotos as $photo) {
                Storage::disk('public')->delete($photo->image_path);
                $photo->delete();
            }

            // Save new additional photos
            foreach ($request->file('photos') as $photo) {
                $photoPath = $photo->store('property-images', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $photoPath,
                    'is_primary' => false,
                ]);
            }
        }

            // Update amenities
            $amenities = Amenity::where('property_id', $property->id)->first();

            if ($amenities) {
                $amenities->update([
                    'has_wifi' => $request->has('has_wifi'),
                    'has_parking' => $request->has('has_parking'),
                    'has_pool' => $request->has('has_pool'),
                    'has_balcony' => $request->has('has_balcony'),
                    'has_gym' => $request->has('has_gym'),
                    'has_security' => $request->has('has_security'),
                    'has_ac' => $request->has('has_ac'),
                    'has_heating' => $request->has('has_heating'),
                ]);
            }

            // Commit the transaction
            DB::commit();

            return redirect()->route('property.owner.dashboard')
                ->with('status', 'Property updated successfully!');

        } catch (ValidationException $e) {
            // For validation exceptions, Laravel already redirects back with errors
            return back()->withErrors($e->validator)->withInput();

        } catch (\Exception $e) {
            // If anything goes wrong, rollback the transaction
            DB::rollBack();

            // Return to the form with a more specific error message
            return back()
                ->withErrors(['system_error' => 'Error updating property: ' . $e->getMessage()])
                ->withInput();
        }
    }
}
