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
        $space->delete();

        return back();
    }

    public function deleteByHost($slug)
    {
        $space = Space::where('slug', $slug)->first();

        if ($space == null) {
            return view('pages.404');
        }

        if (Auth::user()->cannot('delete', $space)) {
            (new CreateNewActivity(
                Auth::id(),
                'Security',
                'Unauthorized Space Deletion Attempt',
                "User tried to delete space with slug: {$slug}"
            ))->execute();
            return back()->with('error', 'Unauthorized action.');
        }

        $space->delete();

        return back();
    }

    public function explore(Request $request)
    {
        $spaces = Space::with(['images', 'host'])
            ->filter($request->all())
            ->paginate(10)
            ->appends($request->query());

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
        $space = Space::with('images')->where('slug', $slug)->firstOrFail();
        $availability = $space->availability()->where('day_of_week', now()->dayOfWeek)->first();
        $hostSpaces = Space::where('host_id', $space->host_id)->get();
        $space_availability = $space->availability;

        return view('pages.spaces.details', [
            'space' => $space,
            'availability' => $availability,
            'hostSpaces' => $hostSpaces,
            'avgReview' => $space->average_rating,
            'reviewsCount' => $space->reviews_count,
            'space_availability' => $space_availability,
            'isAvailableNow' => $space->is_available_now
        ]);
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

        if ($space == null) {
            return view('pages.404');
        }

        if (Auth::user()->cannot('update', $space)) {
            (new CreateNewActivity(
                Auth::id(),
                'Security',
                'Unauthorized Space Edit Attempt',
                "User tried to edit space with slug: {$slug}"
            ))->execute();
            return back()->with('error', 'Unauthorized action.');
        }

        $amenities = Amenity::all();

        return view('pages.spaces.edit', compact('space', 'amenities'));
    }

    public function updateSpace(UpdateSpaceRequest $request, $slug)
    {
        try {
            $space = Space::where('slug', $slug)->first();

            if ($space == null) {
                return view('pages.404');
            }

            if ($request->user()->cannot('update', $space)) {
                (new CreateNewActivity(
                    Auth::id(),
                    'Security',
                    'Unauthorized Space Update Attempt',
                    "User tried to update space with slug: {$slug}"
                ))->execute();
                return back()->with('error', 'Unauthorized action.');
            }

            $validated = $request->validated();
            $validated['host_id'] = Auth::id();
            $validated['slug'] = Str::slug($request->title . '-' . time());
            $validated['is_active'] = true;
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
