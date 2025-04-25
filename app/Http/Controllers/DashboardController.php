<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Space;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->roles->first()->name !== 'admin') {
            abort(403);
        }

        $totalRevenue = Booking::where('status', 'completed')->sum('total_price');
        $totalUsers = User::count();
        $totalSpaces = Space::where('is_active', true)->count();
        $totalBookings = Booking::count();

        return view('dashboard', [
            'totalRevenue' => $totalRevenue,
            'totalUsers' => $totalUsers,
            'totalSpaces' => $totalSpaces,
            'totalBookings' => $totalBookings
        ]);
    }
}
