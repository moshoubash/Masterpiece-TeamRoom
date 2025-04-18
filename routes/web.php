<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\SpaceController;
use App\Models\Notification;
use App\Models\Space;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('dashboard');
});

Route::prefix('dashboard')->group(function () {
    Route::get('/bookings', [BookingController::class, 'index']);

    Route::get('/messages', function () {
        return view('dashboard.messages.index');
    });

    Route::get('/spaces', [SpaceController::class, 'index']);

    Route::get('/users', [UserController::class, 'index']);

    Route::get('/reviews', function () {
        return view('dashboard.reviews.index');
    });

    Route::get('/payments', function () {
        return view('dashboard.payments.index');
    });

    Route::get('/reports', function () {
        return view('dashboard.reports.index');
    });

    Route::get('/roles', [RoleController::class, 'index']);

    Route::get('/activities', [ActivityController::class, 'index']);

    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index']);

    Route::get('/transactions', function () {
        return view('dashboard.transactions.index');
    });

    Route::get('/settings', function () {
        return view('dashboard.settings.index');
    });
});

// Route for the Users

Route::get('/dashboard/users/{id}/show', [UserController::class, 'show']);

Route::get('/dashboard/users/{id}/edit', [UserController::class, 'edit']);

Route::post('/dashboard/users/{id}/update', [UserController::class, 'update'])->name('users.update');

Route::post('/dashboard/users/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy');

// Route for the Roles

Route::resource('/dashboard/roles', RoleController::class);

// Route for the Permissions

Route::resource('/dashboard/permissions', PermissionController::class);

// Route for the Spaces

Route::resource('/dashboard/spaces', SpaceController::class);

// Route for the Booking

Route::resource('/dashboard/bookings', BookingController::class);

// Route for Profile Settings

