<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Space;
use App\Models\SpaceImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Amenity;
use App\Models\SpaceAvailability;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class SpaceController extends Controller
{
    public function index()
    {
        return view('dashboard.spaces.index', ['spaces' => Space::paginate(10)]);
    }

    public function show(string $id)
    {
        $space = Space::findOrFail($id);
        return view('dashboard.spaces.show', ['space' => $space]);
    }

    public function edit(string $id)
    {
        $space = Space::findOrFail($id);
        return view('dashboard.spaces.edit', ['space' => $space]);
    }

    public function update(Request $request, string $id)
    {
        $space = Space::findOrFail($id);
        $space->update($request->all());

        return back();
    }

    public function destroy(string $id)
    {
        $space = Space::findOrFail($id);
        $space->is_deleted = true;
        $space->save();

        return back();
    }

    public function explore(Request $request)
    {
        $spaces = Space::with(['images', 'host']);

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $spaces->orderBy('hourly_rate', 'asc');
                    break;
                case 'price_desc':
                    $spaces->orderBy('hourly_rate', 'desc');
                    break;
                default:
                    break;
            }
        }

        if ($request->filled('search')) {
            $spaces->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('city', 'like', '%' . $request->search . '%');
            });
        }

        // Capacity filter
        if ($request->filled('capacity')) {
            $spaces->where('capacity', '>=', $request->capacity);
        }

        // Date filter
        if ($request->filled('date')) {
            $selectedDay = Carbon::parse($request->date)->format('l');

            $spaces->whereHas('availability', function ($q) use ($selectedDay) {
                $q->where('day_of_week', $selectedDay);
            });
        }

        // Time Range filter
        if ($request->filled('start_time') && $request->filled('end_time')) {
            $spaces->whereHas('availability', function ($query) use ($request) {
                $query->where('start_time', '<=', $request->start_time)
                    ->where('end_time', '>=', $request->end_time);
            });
        }

        // Amenities filter (assuming pivot table or JSON column)
        if ($request->filled('amenities')) {
            foreach ($request->amenities as $amenityId) {
                $spaces->whereHas('amenities', function ($q) use ($amenityId) {
                    $q->where('id', $amenityId);
                });
            }
        }

        // Location filter
        if ($request->filled('location')) {
            $spaces->where('city', $request->location);
        }

        // Price Range filter
        if ($request->filled('min_price')) {
            $spaces->where('hourly_rate', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $spaces->where('hourly_rate', '<=', $request->max_price);
        }

        // Paginate and pass to view
        $spaces = $spaces->paginate(10)->appends($request->query());

        // Assuming $amenities for sidebar
        $amenities = Amenity::all();

        $cities = Space::distinct()->pluck('city');

        return view('pages.explore', [
            'rooms' => $spaces,
            'amenities' => $amenities,
            'cities' => $cities
        ]);
    }

    public function roomDetails(string $slug)
    {
        $space = Space::with('images')->where('slug', $slug)->first();
        $availability = SpaceAvailability::where('space_id', $space->id)->where('day_of_week', now()->dayOfWeek)->first();
        $hostSpaces = Space::where('host_id', $space->host_id)->get();
        $avgReview = Review::where('space_id', $space->id)->avg('rating') ?? 0.0;
        $reviewsCount = Review::where('space_id', $space->id)->count() ?? 0;

        return view('pages.spaces.details', ['space' => $space, 'availability' => $availability, 'hostSpaces' => $hostSpaces, 'avgReview' => $avgReview, 'reviewsCount' => $reviewsCount]);
    }

    public function create()
    {
        $currentStep = 1;
        $completionPercentage = 20;

        $amenities = Amenity::all();

        return view('pages.spaces.create', [
            'currentStep' => $currentStep,
            'completionPercentage' => $completionPercentage,
            'amenities' => $amenities
        ]);
    }

    public function store(Request $request)
    {
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
            'slug' => Str::slug($request->title . '-' . time()),
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

        return redirect()->route('user.profile', ['user' => Auth::user()->slug]);
    }

    public function editSpace($slug)
    {
        $space = Space::where('slug', $slug)->first();
        $amenities = Amenity::all();

        if ($space == null) {
            return view('pages.404');
        }

        return view('pages.spaces.edit', compact('space', 'amenities'));
    }

    public function updateSpace(Request $request, $slug)
    {
        $space = Space::where('slug', $slug)->first();

        if ($space == null) {
            return view('pages.404');
        }
        $space->update([
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
            'slug' => Str::slug($request->title . '-' . time()),
            'updated_at' => now()
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

        // Handle deleted images
        if ($request->has('deleted_images')) {
            foreach ($request->deleted_images as $imageId) {
                $image = SpaceImage::find($imageId);
                if ($image) {
                    Storage::delete($image->image_url); // delete from disk
                    $image->delete();
                }
            }
        }

        // Handle Amenities
        if ($request->has('amenities')) {
            if ($space->amenities()->count() > 0) {
                $space->amenities()->detach();
            }
            $space->amenities()->attach($request->amenities);
        }

        // Handle Availabilities
        if ($request->has('availability')) {
            if ($space->availability()->count() > 0) {
                $spaceAvailabilities = SpaceAvailability::where('space_id', $space->id)->get();
                foreach ($spaceAvailabilities as $spaceAvailability) {
                    $spaceAvailability->delete();
                }
            }

            foreach ($request->availability as $day => $data) {
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

        $availability = SpaceAvailability::where('space_id', $space->id)->where('day_of_week', now()->dayOfWeek)->first();
        $hostSpaces = Space::where('host_id', $space->host_id)->get();
        $avgReview = Review::where('space_id', $space->id)->avg('rating') ?? 0.0;
        $reviewsCount = Review::where('space_id', $space->id)->count() ?? 0;

        return view('pages.spaces.details', ['space' => $space, 'availability' => $availability, 'hostSpaces' => $hostSpaces, 'avgReview' => $avgReview, 'reviewsCount' => $reviewsCount]);
    }

    public function filter(Request $request)
    {
        $query = Space::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('city', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%')
                    ->orWhere('street_address', 'like', '%' . $request->search . '%')
                    ->orWhere('country', 'like', '%' . $request->search . '%')
                    ->orWhere('postal_code', 'like', '%' . $request->search . '%')
                    ->orWhere('capacity', 'like', '%' . $request->search . '%')
                    ->orWhere('hourly_rate', 'like', '%' . $request->search . '%')
                    ->orWhere('min_booking_duration', 'like', '%' . $request->search . '%')
                    ->orWhere('max_booking_duration', 'like', '%' . $request->search . '%')
                    ->orWhere('host_id', 'like', '%' . $request->search . '%');
            });
        }

        $spaces = $query->paginate(10);

        return view('dashboard.spaces.index', ['spaces' => $spaces]);
    }
}
