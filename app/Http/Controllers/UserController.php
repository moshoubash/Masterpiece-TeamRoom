<?php

namespace App\Http\Controllers;

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

use function PHPUnit\Framework\isEmpty;

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
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'bio' => 'nullable|string|max:500',
            'phone_number' => 'nullable|string|max:15',
            'profile_picture_url' => 'nullable|url|max:255',
            'company_name' => 'nullable|string|max:255',
            'is_verified' => 'boolean',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'bio' => $request->bio,
            'phone_number' => $request->phone_number,
            'profile_picture_url' => $request->profile_picture_url ?? 'https://placehold.co/300x300',
            'company_name' => $request->company_name,
            'is_verified' => $request->is_verified ?? false,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return view('dashboard.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.users.show', compact('user'));
    }

    public function edit($id){
        return view('dashboard.users.edit', ['user' => User::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:8|confirmed',
            'bio' => 'nullable|string|max:500',
            'phone_number' => 'nullable|string|max:15',
            'profile_picture_url' => 'nullable|url|max:255',
            'company_name' => 'nullable|string|max:255',
            'is_verified' => 'boolean',
        ]);

        $user->update($request->all());

        return view('dashboard.users.index', ['users' => User::all()]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->is_deleted = true;
        $user->save();

        return back();
    }

    public function adminSettings(){
        return view('dashboard.settings.index', [
            'user' => Auth::user()
        ]);
    }

    public function updateAdminSettings(Request $request, string $id){
        $user = User::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:15',
        ]);

        if($request->hasFile('profile_picture_url')){
            $request->validate([
                'profile_picture_url' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $image = $request->file('profile_picture_url');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/profile-pictures');
            $image->move($destinationPath, $name);
            $user->profile_picture_url = '/images/profile-pictures/' . $name;
        }

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'updated_at' => now()
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function profile(string $slug){
        $user = User::where('slug', $slug)->first();
        
        if($user == null){
            return view('pages.404');
        }
        
        $role = strtoupper($user->roles()->first()->name);
        
        if($role == 'ADMIN' || $role == 'SUPERADMIN' || $user->is_deleted == true){
            return view('pages.404');
        }
        
        $name = $user->first_name . ' ' . $user->last_name;
        $created_at = $user->created_at->format('M d, Y');
        $profile_image = $user->profile_picture_url;
        
        if($role == 'HOST'){
            $spaces = Space::where('host_id', $user->id)->get();
            
            $average_rating = 0;
            $total_reviews = 0;
            if($spaces->count() > 0){
                foreach($spaces as $space){
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

    public function profileEdit(string $slug){
        
        $user = User::where('slug', $slug)->first();

        if($user == null){
            return view('pages.404');
        }

        if($user->is_deleted == true || $user->id != Auth::user()->id){
            return view('pages.404');
        }

        return view('pages.users.edit', ['user' => $user]);
    }

    public function updateProfile(Request $request, string $id){
        $user = User::findOrFail($id);
        
        $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:8|confirmed|required',
            'bio' => 'nullable|string|max:500',
            'phone_number' => 'nullable|string|max:15',
            'company_name' => 'nullable|string|max:255',
        ]);

        if($request->hasFile('profile_picture_url')){
            $request->validate([
                'profile_picture_url' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $image = $request->file('profile_picture_url');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/profile-pictures');
            $image->move($destinationPath, $name);
            $user->profile_picture_url = '/images/profile-pictures/' . $name;
        }
        
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'bio' => $request->bio,
            'phone_number' => $request->phone_number,
            'company_name' => $request->company_name,
            'updated_at' => now()
        ]);
        
        return back()->with('message', 'user updated successfully.');
    }

    public function updatePassword(Request $request, string $id){
        $user = User::where('id', $id)->first();

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        Auth::logout();

        return redirect('/login')->with('message', 'password updated successfully.');
    }

    public function search(Request $request){
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

    public function filter($option){
        if($option == 'verified'){
            $users = User::where('is_verified', true)->paginate(10);
        }

        if($option == 'unverified'){
            $users = User::where('is_verified', false)->paginate(10);
        }

        if($option == 'recent'){
            $users = User::orderBy('created_at', 'desc')->paginate(10);
        }

        if($option == 'deleted'){
            $users = User::where('is_deleted', true)->paginate(10);
        }

        return view('dashboard.users.index', ['users' => $users]);
    }

    public function restore($id){
        $user = User::findOrFail($id);
        $user->is_deleted = false;
        $user->save();

        return back()->with('message', 'user restored successfully.');
    }

    public function hostStats(string $slug){
        $host = User::where('slug', $slug)->first();

        if($host == null){
            return view('pages.404');
        }

        $totalBookings = 0;
        $hostRooms = $host->spaces()->count();
        
        $totalHostBookings = 0;

        $hostTotalBookingsOnSpces = DB::table('spaces')
            ->join('bookings', 'spaces.id', '=', 'bookings.space_id')
            ->where('spaces.host_id', $host->id)
            ->get();

        foreach($hostTotalBookingsOnSpces as $booking){
            $totalHostBookings += 1;
        }

        $hostProfits = 0;

        $hostProfitsOnSpces = DB::table('spaces')
            ->join('bookings', 'spaces.id', '=', 'bookings.space_id')
            ->where('spaces.host_id', $host->id)
            ->get();

        foreach($hostProfitsOnSpces as $booking){
            if($booking->status == 'completed'){
                $hostProfits += $booking->host_payout;
            }
        }

        $cancelledBookings = 0;

        $cancelledBookingsOnSpces = DB::table('spaces')
            ->join('bookings', 'spaces.id', '=', 'bookings.space_id')
            ->where('spaces.host_id', $host->id)
            ->where('bookings.status', 'cancelled')
            ->get();

        foreach($cancelledBookingsOnSpces as $booking){
            $cancelledBookings += 1;
        }

        $pendingBookingsOnSpces = DB::table('spaces')
            ->join('bookings', 'spaces.id', '=', 'bookings.space_id')
            ->join('users', 'bookings.renter_id', '=', 'users.id')
            ->where('spaces.host_id', $host->id)
            ->where('bookings.status', 'pending')
            ->select('bookings.id as booking_id', 'spaces.*', 'bookings.*', 'users.*')
            ->get();

        $mostBookedSpaces = DB::table('bookings')
            ->join('spaces', 'bookings.space_id', '=', 'spaces.id')
            ->select('spaces.id', 'spaces.title', DB::raw('COUNT(bookings.id) as bookings_count'))
            ->groupBy('spaces.id', 'spaces.title')
            ->orderByDesc('bookings_count')
            ->get()
            ->take(3);

        $recentBookings = DB::table('bookings')
            ->join('spaces', 'bookings.space_id', '=', 'spaces.id')
            ->join('users', 'bookings.renter_id', '=', 'users.id')
            ->where('spaces.host_id', $host->id)
            ->select('bookings.id as booking_id', 'spaces.*', 'bookings.*', 'users.*')
            ->paginate(6);

        return view('pages.users.host.stats', [
            'host' => $host,
            'totalBookings' => $totalBookings,
            'hostRooms' => $hostRooms,
            'totalHostBookings' => $totalHostBookings,
            'hostProfits' => $hostProfits,
            'cancelledBookings' => $cancelledBookings,
            'pendingBookingsOnSpces' => $pendingBookingsOnSpces,
            'mostBookedSpaces' => $mostBookedSpaces,
            'recentBookings' => $recentBookings
        ]);
    }
}