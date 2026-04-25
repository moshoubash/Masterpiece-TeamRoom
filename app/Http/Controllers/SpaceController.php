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
use App\Services\CreateNewActivity;
use Dotenv\Validator;
use Illuminate\Auth\Events\Validated;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use App\Http\Requests\Space\StoreSpaceRequest;
use App\Http\Requests\Space\UpdateSpaceRequest;
use App\Services\SpaceService;

class SpaceController extends Controller
{
    public function index()
    {
        return view('dashboard.spaces.index', ['spaces' => Space::latest()->paginate(10)]);
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

    public function deleteByHost($slug)
    {
        $space = Space::where('slug', $slug)->first();

        if ($space == null) {
            return view('pages.404');
        }

        $space->is_deleted = true;
        $space->save();

        (new CreateNewActivity(
            Auth::id(),
            'space',
            'Space Deleted',
            "Space '{$space->title}' was deleted"
        ))->execute();

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
        $space_availability = SpaceAvailability::where('space_id', $space->id)->get();

        // if space not available in this date and time
        $isAvailableNow = false;

        if ($space && !$space->is_deleted) {
            $today = now()->format('l');
            $currentTime = now()->format('H:i:s');

            $availabilityToday = SpaceAvailability::where('space_id', $space->id)
                ->where('day_of_week', $today)
                ->where('is_available', true)
                ->where('start_time', '<=', $currentTime)
                ->where('end_time', '>=', $currentTime)
                ->first();

            $isAvailableNow = $availabilityToday ? true : false;
        }

        return view('pages.spaces.details', ['space' => $space, 'availability' => $availability, 'hostSpaces' => $hostSpaces, 'avgReview' => $avgReview, 'reviewsCount' => $reviewsCount, 'space_availability' => $space_availability, 'isAvailableNow' => $isAvailableNow]);
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

    public function store(StoreSpaceRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['host_id'] = Auth::id();
            $validated['slug'] = Str::slug($request->title . '-' . time());

            $space = Space::create($validated);

            $spaceService = new SpaceService();

            // Handle image uploads if exist
            if ($request->hasFile('images')) {
                $spaceService->storeSpaceImages($request->file('images'), $space->id);
            }

            // Handle Amenities
            if ($request->has('amenities')) {
                $spaceService->storeSpaceAmenities($request->amenities, $space->id);
            }

            // Handle Availabilities
            if ($request->has('availability')) {
                $spaceService->storeSpaceAvailabilities($request->availability, $space->id);
            }

            $space->save();

            (new CreateNewActivity(
                Auth::id(),
                'space',
                'Space Created',
                "Space '{$space->title}' was created"
            ))->execute();

            ToastMagic::success('Space created successfully');

            return redirect()->route('user.profile', ['user' => Auth::user()->slug]);
        } catch (\Exception $e) {
            ToastMagic::error('Space created failed: ' . $e->getMessage());
            return back();
        }
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

    public function updateSpace(UpdateSpaceRequest $request, $slug)
    {
        try {
            $space = Space::where('slug', $slug)->first();

            if ($space == null) {
                return view('pages.404');
            }

            $validated = $request->validated();
            $validated['host_id'] = Auth::id();
            $validated['slug'] = Str::slug($request->title . '-' . time());
            $validated['is_active'] = true;
            $validated['is_deleted'] = false;
            $validated['updated_at'] = now();

            $space->update($validated);

            $spaceService = new SpaceService();

            // Handle image uploads if exist
            if ($request->hasFile('images')) {
                $spaceService->storeSpaceImages($request->file('images'), $space->id);
            }

            // Handle deleted images
            if ($request->has('deleted_images')) {
                $spaceService->deleteSpaceImages($request->deleted_images, $space->id);
            }

            // Handle Amenities
            if ($request->has('amenities')) {
                $spaceService->storeSpaceAmenities($request->amenities, $space->id);
            }

            // Handle Availabilities
            if ($request->has('availability')) {
                $spaceService->storeSpaceAvailabilities($request->availability, $space->id);
            }

            $space->save();

            (new CreateNewActivity(
                Auth::id(),
                'space',
                'Space Updated',
                "Space '{$space->title}' was updated"
            ))->execute();

            ToastMagic::success('Space updated successfully');

            return redirect()->route('rooms.details', ['room' => $space->slug]);
        } catch (\Exception $e) {
            ToastMagic::error('Space updated failed: ' . $e->getMessage());
            return back();
        }
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
