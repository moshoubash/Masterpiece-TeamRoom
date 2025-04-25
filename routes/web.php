<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PaymentController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', function() {
        return view('dashboard');
    });
    
    Route::get('/bookings', [BookingController::class, 'index']);

    Route::get('/messages', function () {
        return view('dashboard.messages.index');
    });

    Route::get('/spaces', [SpaceController::class, 'index']);

    Route::get('/users', [UserController::class, 'index']);

    Route::get('/reviews', [ReviewController::class, 'index']);

    Route::get('/reports', function () {
        return view('dashboard.reports.index');
    });

    Route::get('/roles', [RoleController::class, 'index']);

    Route::get('/activities', [ActivityController::class, 'index']);

    Route::get('/notifications', [NotificationController::class, 'index']);

    Route::get('/transactions', [TransactionController::class, 'index']);

    Route::get('/settings', [UserController::class, 'adminSettings']);
});

Route::middleware('auth')->group(function () {
    // Route for the Users
    Route::get('/dashboard/users/{id}/show', [UserController::class, 'show']);

    Route::get('/dashboard/users/{id}/edit', [UserController::class, 'edit']);

    Route::post('/dashboard/users/{id}/update', [UserController::class, 'update'])->name('users.update');

    Route::post('/dashboard/users/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy');

    // Route for the Roles

    Route::resource('/dashboard/roles', RoleController::class);

    // Route for the Spaces

    Route::resource('/dashboard/spaces', SpaceController::class);

    // Route for the Booking

    Route::resource('/dashboard/bookings', BookingController::class);

    // Route for the Reviews

    Route::resource('/dashboard/reviews', ReviewController::class);

    // Route for Transactions

    Route::resource('/dashboard/transactions', TransactionController::class);

    // Route for the Notifications

    Route::resource('/dashboard/notifications', NotificationController::class);
    Route::put('/dashboard/notifications/{id}/markAsRead', [NotificationController::class, 'markAsRead']);

});

// Routes for public website

Route::get('/explore', [SpaceController::class, 'explore'])->name('explore');
Route::get('/rooms/details/{room}', [SpaceController::class, 'roomDetails'])->name('rooms.details');
Route::get('/user/profile/{user}', [UserController::class, 'profile'])->name('user.profile');
Route::get('/room/create', [SpaceController::class, 'create'])->name('room.create')->middleware('auth');
Route::post('/room/store', [SpaceController::class, 'store'])->name('rooms.store')->middleware('auth');
Route::post('/booking/store', [BookingController::class, 'store'])->name('spaces.book')->middleware('auth');
Route::post('/booking/checkout', [PaymentController::class, 'checkout'])->name('booking.checkout')->middleware('auth');
Route::post('/booking/process', [PaymentController::class, 'process'])->name('payment.process')->middleware('auth');
Route::get('/bookings/confirmation/{booking}', [PaymentController::class, 'confirmation'])->name('bookings.confirmation')->middleware('auth');

Route::get('/user/edit/{user}', [UserController::class, 'profileEdit'])->name('user.edit')->middleware('auth');
Route::put('/user/edit/{id}', [UserController::class, 'updateProfile'])->name('user.update')->middleware('auth');
Route::put('/user/password/edit/{user}', [UserController::class, 'updatePassword'])->name('user.password.update')->middleware('auth');

Route::get('/contact', function () {
    return view('pages.contact');
});

Route::get('/about', function () {
    return view('pages.about');
});

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');


Route::get('/booking/details/{booking}', [BookingController::class, 'info'])->name('bookings.details');

require __DIR__.'/auth.php';