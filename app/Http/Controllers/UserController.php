<?php

namespace App\Http\Controllers;

use Devrabiul\ToastMagic\Facades\ToastMagic;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Review;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\UserService;
use App\Http\Requests\User\UpdateAdminSettingsRequest;
use App\Http\Requests\User\UpdatePasswordRequest;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.users.index', ['users' => User::paginate(10)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['created_at'] = now();
        $validated['updated_at'] = now();
        $validated['password'] = bcrypt($validated['password']);
        $validated['is_verified'] = $validated['is_verified'] ?? false;
        $validated['profile_picture_url'] = $validated['profile_picture_url'] ?? 'https://placehold.co/300x300';

        User::create($validated);

        ToastMagic::success('User created successfully.');

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.users.show', compact('user'));
    }

    public function edit($id)
    {
        return view('dashboard.users.edit', ['user' => User::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage. (for admins)
     */
    public function update(UpdateUserRequest $request, string $id, UserService $userService)
    {
        $user = User::findOrFail($id);

        $validated = $request->validated();
        $validated['updated_at'] = now();

        if ($request->hasFile('profile_picture_url')) {
            $validated['profile_picture_url'] = $userService->uploadProfilePicture($request->file('profile_picture_url'));
        }

        $user->update($validated);

        ToastMagic::success('User updated successfully.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back();
    }

    public function adminSettings()
    {
        return view('dashboard.settings.index', [
            'user' => Auth::user()
        ]);
    }

    public function updateAdminSettings(UpdateAdminSettingsRequest $request, string $id, UserService $userService)
    {
        $user = User::findOrFail($id);

        $validated = $request->validated();

        if ($request->hasFile('profile_picture_url')) {
            $user->profile_picture_url = $userService->uploadProfilePicture($request->file('profile_picture_url'));
        }

        $user->update([
            'first_name' => $validated['first_name'] ?? $user->first_name,
            'last_name' => $validated['last_name'] ?? $user->last_name,
            'phone_number' => $validated['phone_number'] ?? $user->phone_number,
            'updated_at' => now()
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function profile(string $slug)
    {
        $user = User::where('slug', $slug)->first();

        if ($user == null) {
            return view('pages.404');
        }

        $role = strtoupper($user->roles()->first()->name);

        if ($role == 'ADMIN' || $role == 'SUPERADMIN') {
            return view('pages.404');
        }

        $name = $user->first_name . ' ' . $user->last_name;
        $created_at = $user->created_at->format('M d, Y');
        $profile_image = $user->profile_picture_url;

        if ($role == 'HOST') {
            $spaces = Space::where('host_id', $user->id)->get();

            $average_rating = 0;
            $total_reviews = 0;
            if ($spaces->count() > 0) {
                foreach ($spaces as $space) {
                    $average_rating += $space->reviews()->avg('rating');
                    $total_reviews += $space->reviews()->count();
                }
                $average_rating = $average_rating / $spaces->count();
            }

            return view('pages.users.profile', [
                'user' => $user,
                'role' => $role,
                'name' => $name,
                'created_at' => $created_at,
                'profile_image' => $profile_image,
                'spaces' => $spaces,
                'is_verified' => $user->kyc_status == 'approved' ? true : false,
                'average_rating' => $average_rating,
                'total_reviews' => $total_reviews
            ]);
        }

        $bookings = $user->bookingsAsRenter()->with('space')->get();
        $renterId = $bookings[0]->renter_id ?? $user->id;
        $userReviews = Review::where('reviewee_id', $renterId)->get();

        return view('pages.users.profile', [
            'user' => $user,
            'role' => $role,
            'name' => $name,
            'created_at' => $created_at,
            'profile_image' => $profile_image,
            'is_verified' => $user->is_verified,
            'bookings' => $bookings,
            'renterId' => $renterId,
            'userReviews' => $userReviews
        ]);
    }

    public function profileEdit(string $slug)
    {

        $user = User::where('slug', $slug)->first();

        if ($user == null) {
            return view('pages.404');
        }

        if ($user->id != Auth::user()->id) {
            return view('pages.404');
        }

        return view('pages.users.edit', ['user' => $user]);
    }

    public function updateProfile(UpdateProfileRequest $request, string $id, UserService $userService)
    {
        $user = User::findOrFail($id);

        if (Auth::id() != $id && !Auth::user()->hasRole('admin') && !Auth::user()->hasRole('superadmin')) {
            return back()->withErrors(['error' => 'Unauthorized action.']);
        }

        $data = $request->validated();

        $data['updated_at'] = now();

        if ($request->hasFile('profile_picture_url')) {
            $data['profile_picture_url'] = $userService->uploadProfilePicture($request->file('profile_picture_url'));
        }

        $user->update($data);

        ToastMagic::success('User updated successfully.');

        return back();
    }

    public function updatePassword(UpdatePasswordRequest $request, string $id)
    {
        if (Auth::id() != $id && !Auth::user()->hasRole('admin') && !Auth::user()->hasRole('superadmin')) {
            return back()->withErrors(['error' => 'Unauthorized action.']);
        }

        $user = User::where('id', $id)->first();

        $user->password = Hash::make($request->password);
        $user->save();

        Auth::logout();

        return redirect('/login')->with('message', 'password updated successfully.');
    }

    public function updatePasswordAdmin(UpdatePasswordRequest $request, string $id)
    {
        $user = User::where('id', $id)->first();

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'User password updated successfully.');
    }

    public function search(Request $request)
    {
        $query = User::query();

        $searchTerm = $request->input('query');

        $query->where(function ($q) use ($searchTerm) {
            $q->where('first_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('email', 'like', '%' . $searchTerm . '%')
                ->orWhere('phone_number', 'like', '%' . $searchTerm . '%');
        });

        $users = $query->paginate(10);

        return view('dashboard.users.index', ['users' => $users]);
    }

    public function filter($option)
    {
        if ($option == 'verified') {
            $users = User::where('is_verified', true)->paginate(10);
        }

        if ($option == 'unverified') {
            $users = User::where('is_verified', false)->paginate(10);
        }

        if ($option == 'recent') {
            $users = User::orderBy('created_at', 'desc')->paginate(10);
        }

        if ($option == 'deleted') {
            $users = User::onlyTrashed()->paginate(10);
        }

        return view('dashboard.users.index', ['users' => $users]);
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return back()->with('message', 'user restored successfully.');
    }

    public function hostStats(string $slug, UserService $userService)
    {
        $host = User::where('slug', $slug)->first();

        if ($host == null) {
            return view('pages.404');
        }

        $stats = $userService->getHostStats($host);

        return view('pages.users.host.stats', [
            'host' => $host,
            'totalBookings' => $stats['totalBookings'],
            'hostRooms' => $stats['hostRooms'],
            'totalHostBookings' => $stats['totalHostBookings'],
            'hostProfits' => $stats['hostProfits'],
            'cancelledBookings' => $stats['cancelledBookings'],
            'pendingBookingsOnSpces' => $stats['pendingBookingsOnSpces'],
            'mostBookedSpaces' => $stats['mostBookedSpaces'],
            'recentBookings' => $stats['recentBookings']
        ]);
    }
}