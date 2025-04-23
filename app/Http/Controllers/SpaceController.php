<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Space;
use App\Models\SpaceImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Amenity;
use App\Models\SpaceAvailability;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.spaces.index', ['spaces' => Space::paginate(10)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $space = Space::findOrFail($id);
        return view('dashboard.spaces.show', ['space' => $space]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $space = Space::findOrFail($id);
        return view('dashboard.spaces.edit', ['space' => $space]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $space = Space::findOrFail($id);
        $space->update($request->all());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $space = Space::findOrFail($id);
        $space->is_deleted = true;
        $space->save();

        return back();
    }

    public function explore() {
        return view('pages.explore', ['rooms' => Space::with('images')->paginate(10)]);
    }

    public function roomDetails(string $slug) {
        $space = Space::with('images')->where('slug', $slug)->first();
        return view('pages.spaces.details', ['space' => $space]);
    }

    public function create(){
        if(Auth::user()->roles->first()->name == 'renter') {
            return back();
        }
        
        $currentStep = 1;
        $completionPercentage = 20;

        $amenities = Amenity::all();
        
        return view('pages.spaces.create', [
            'currentStep' => $currentStep,
            'completionPercentage' => $completionPercentage,
            'amenities' => $amenities
        ]);
    }

    public function store(Request $request) {
        $space = Space::create([
            'host_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'capacity' => $request->capacity,
            'hourly_rate' => $request->hourly_rate,
            'min_booking_duration' => $request->min_booking_duration,
            'max_booking_duration' => $request->max_booking_duration,
            'is_active' => true,
            'is_deleted' => false,
            'slug' => Str::slug($request->title . '-' . time()), // Unique slug
        ]);
    
        // Handle image uploads if exist
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('space_images', 'public');
                
                SpaceImage::create([
                    'space_id' => $space->id,
                    'image_url' => $path,
                    'caption' => $space->title
                ]);
            }
        }

        // Handle Amenities
        if ($request->has('amenities')) {
            $space->amenities()->attach($request->amenities);
        }

        // Handle Availabilities
        if ($request->has('availability')) {
            foreach ($request->availability as $day => $data) {
                // Save only if checkbox is ticked
                if (isset($data['is_available'])) {
                    SpaceAvailability::create([
                        'space_id' => $space->id,
                        'day_of_week' => $day,
                        'start_time' => $data['start_time'],
                        'end_time' => $data['end_time'],
                        'is_available' => true,
                    ]);
                }
            }
        }

        $space->save();

        return view('welcome');
    }
}