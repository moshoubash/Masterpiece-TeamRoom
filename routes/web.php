<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::prefix('dashboard')->group(function () {
    Route::get('/bookings', function () {
        return view('dashboard.booking.index');
    });

    Route::get('/messages', function () {
        return view('dashboard.messages.index');
    });

    Route::get('/spaces', function () {
        return view('dashboard.spaces.index');
    });

    Route::get('/users', function () {
        return view('dashboard.users.index');
    });

    Route::get('/reviews', function () {
        return view('dashboard.reviews.index');
    });

    Route::get('/payments', function () {
        return view('dashboard.payments.index');
    });

    Route::get('/reports', function () {
        return view('dashboard.reports.index');
    });

    Route::get('/roles', function () {
        return view('dashboard.roles.index');
    });

    Route::get('/activities', function () {
        return view('dashboard.activities.index');
    });

    Route::get('/notifications', function () {
        return view('dashboard.notifications.index');
    });

    Route::get('/transactions', function () {
        return view('dashboard.transactions.index');
    });

    Route::get('/settings', function () {
        return view('dashboard.settings.index');
    });
});

// Route for the Users

Route::get('/dashboard/users', function() {
    return view('dashboard.users.index');
})->name('users.index');

Route::get('/dashboard/users/{id}/show', function ($id) {
    return view('dashboard.users.show', ['id' => $id, 
                                         'user' => App\Models\User::findOrFail($id), 
                                         'address' => App\Models\Address::where('user_id', $id)->first(),
                                         'userRoles' => App\Models\User::findOrFail($id)->roles]);
});

Route::get('/dashboard/users/{id}/edit', function ($id) {
    return view('dashboard.users.edit', ['id' => $id, 
                                         'user' => App\Models\User::findOrFail($id), 
                                         'address' => App\Models\Address::where('user_id', $id)->first()]);
});

// Route for the Roles

Route::get('/dashboard/roles', function() {
    return view('dashboard.roles.index');
})->name('roles.index');

Route::get('/dashboard/roles/{id}/edit', function ($id) {
    $role = App\Models\Role::findOrFail($id);
    return view('dashboard.roles.edit', ['id' => $id, 
                                         'role' => App\Models\Role::findOrFail($id),
                                         'permissions' => App\Models\Permission::all()]);});

// Route for the Spaces

Route::get('/dashboard/spaces', function() {
    return view('dashboard.spaces.index');
})->name('spaces.index');

Route::get('/dashboard/spaces/{id}/edit', function ($id) {
    return view('dashboard.spaces.edit', ['id' => $id, 
                                        'space' => App\Models\Space::findOrFail($id)]);});

Route::get('/dashboard/spaces/{id}/show', function ($id) {
    return view('dashboard.spaces.show', ['id' => $id, 
                                            'space' => App\Models\Space::findOrFail($id)]); 
});

// Route for the Booking

Route::get('/dashboard/bookings', function() {
    return view('dashboard.booking.index');
})->name('bookings.index');

Route::get('/dashboard/bookings/{id}/edit', function ($id) {
    return view('dashboard.booking.edit', ['id' => $id, 
                                        'booking' => App\Models\Booking::findOrFail($id)]);});

Route::get('/dashboard/bookings/{id}/show', function ($id) {
    return view('dashboard.booking.show', ['id' => $id, 
                                            'booking' => App\Models\Booking::findOrFail($id)]); 
});