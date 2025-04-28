<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Space;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->roles->first()->name !== 'admin' && Auth::user()->roles->first()->name !== 'superadmin') {
            abort(403);
        }

        $totalRevenue = Booking::where('status', 'completed')->sum('total_price');
        $totalUsers = User::count();
        $totalSpaces = Space::where('is_active', true)->count();
        $totalBookings = Booking::count();

        $spaces = Space::paginate(10);
        $doughnutChartSpaces = Space::all()->count();

        $dailyRevenue = DB::table('transactions')
            ->selectRaw('DATE(created_at) as date, SUM(amount) as total')
            ->where('status', 'completed')
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get();

        $topSpaceBookings = DB::table('spaces')
            ->select('spaces.id', 'spaces.title as SpaceName', DB::raw('COUNT(spaces.id) as SpaceBookings'))
            ->join('bookings', 'spaces.id', '=', 'bookings.space_id')
            ->groupBy('bookings.space_id', 'spaces.id', 'spaces.title')
            ->get();
        
        return view('dashboard', [
            'totalRevenue' => $totalRevenue,
            'totalUsers' => $totalUsers,
            'totalSpaces' => $totalSpaces,
            'totalBookings' => $totalBookings,
            'spaces' => $spaces,
            'doughnutChartSpaces' => $doughnutChartSpaces,
            'dailyRevenue' => $dailyRevenue,
            'topSpaceBookings' => $topSpaceBookings
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        if (str_contains($query, 'space')) {
            return redirect('/dashboard/spaces');
        }

        if (str_contains($query, 'user')) {
            return redirect('/dashboard/users');
        }

        if (str_contains($query, 'booking')) {
            return redirect('/dashboard/bookings');
        }

        if (str_contains($query, 'review')) {
            return redirect('/dashboard/reviews');
        }

        if (str_contains($query, 'transaction')) {
            return redirect('/dashboard/transactions');
        }

        if (str_contains($query, 'notification')) {
            return redirect('/dashboard/notifications');
        }

        if (str_contains($query, 'role')) {
            return redirect('/dashboard/roles');
        }

        if (str_contains($query, 'activity')) {
            return redirect('/dashboard/activities');
        }

        if (str_contains($query, 'kyc')) {
            return redirect('/dashboard/kyc/requests');
        }

        if (str_contains($query, 'setting')) {
            return redirect('/dashboard/settings');
        }

        return view('/dashboard');
    }
}
