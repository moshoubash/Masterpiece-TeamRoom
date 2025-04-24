<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Space;
use Illuminate\Http\Request;

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
        $user = User::findOrFail($id)->with('roles')->first();
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

    public function profile(string $id){
        $user = User::findOrFail($id);
        
        $role = strtoupper($user->roles()->first()->name);
        if($role == 'ADMIN' || $user->is_deleted == true){
            return back();
        }

        $name = $user->first_name . ' ' . $user->last_name;
        $created_at = $user->created_at->format('M d, Y');
        $profile_image = $user->profile_picture_url;

        if($role == 'HOST'){
            $spaces = Space::where('host_id', $id)->get();

            return view('pages.users.profile', [
                'user' => $user,
                'role' => $role,
                'name' => $name,
                'created_at' => $created_at,
                'profile_image' => $profile_image,
                'spaces' => $spaces,
                'is_verified' => $user->is_verified
            ]);
        }

        $bookings = $user->bookingsAsRenter()->with('space')->get();

        return view('pages.users.profile', [
            'user' => $user,
            'role' => $role,
            'name' => $name,
            'created_at' => $created_at,
            'profile_image' => $profile_image,
            'is_verified' => $user->is_verified,
            'bookings' => $bookings
        ]);
    }
}