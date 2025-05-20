<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Services\CreateNewActivity;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        (new CreateNewActivity(
            Auth::id(),
            'user',
            'User Login',
            "User logged in successfully"
        ))->execute();

        $user = Auth::user();

        if ($user->is_deleted == 1) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account is not active.');
        }

        return $user->roles->first()->name == 'admin' || $user->roles->first()->name == 'superadmin'  ? redirect()->intended('/dashboard') : redirect()->intended('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        (new CreateNewActivity(
            Auth::id(),
            'user', 
            'User Logged out',
            "User logged out successfully"
        ))->execute();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
