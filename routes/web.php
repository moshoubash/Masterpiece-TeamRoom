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
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\BackupController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('dashboard')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    
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
    Route::put('/user/update/{user}', [UserController::class, 'updateProfile'])->name('settings.update');

    Route::get('/companies', [CompanyController::class, 'index']);
});

Route::middleware('auth', 'admin')->group(function () {
    // Route for the Users
    Route::get('/dashboard/users/{id}/show', [UserController::class, 'show']);
    Route::get('/dashboard/users/{id}/edit', [UserController::class, 'edit']);
    Route::post('/dashboard/users/{id}/update', [UserController::class, 'update'])->name('users.update');
    Route::post('/dashboard/users/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/dashboard/users/search', [UserController::class, 'search'])->name('users.search');
    Route::get('/dashboard/users/{option}', [UserController::class, 'filter'])->name('users.filter');
    Route::put('/dashboard/user/{id}/restore', [UserController::class, 'restore'])->name('user.restore');

    // Route for the Roles
    Route::resource('/dashboard/roles', RoleController::class);

    // Route for the Spaces

    Route::resource('/dashboard/spaces', SpaceController::class);
    Route::get('/spaces/search', [SpaceController::class, 'filter'])->name('spaces.search');

    // Route for the Booking

    Route::resource('/dashboard/bookings', BookingController::class);
    Route::get('/bookings/status/{status}', [BookingController::class, 'filter'])->name('bookings.search');

    // Route for the Reviews

    Route::resource('/dashboard/reviews', ReviewController::class);
    Route::get('/dashboard/reviews/{review}', [ReviewController::class, 'filter'])->name('reviews.search');
    // Route for Transactions

    Route::resource('/dashboard/transactions', TransactionController::class);
    Route::get('/transactions/search', [TransactionController::class, 'filter'])->name('transactions.filter');

    // Route for the Notifications

    // Route::resource('/dashboard/notifications', NotificationController::class);
    Route::put('/dashboard/notifications/{id}/markAsRead', [NotificationController::class, 'markAsRead']);
    Route::get('/dashboard/notifications/filter', [NotificationController::class, 'filter'])->name('notifications.filter');
    Route::post('/dashboard/notifications/store', [NotificationController::class, 'store'])->name('notifications.store');
    Route::delete('/dashboard/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    
    // Routes for activities
    Route::get('/dashboard/activities/{type}', [ActivityController::class, 'filter'])->name('activity.filter');
    Route::resource('/dashboard/activities', ActivityController::class);
    // Routes for settings
    Route::put('/dashboard/admin/settings/{user}', [UserController::class, 'updateAdminSettings'])->name('admin.settings.update');

    // Routes for the Companies
    Route::resource('/dashboard/companies', CompanyController::class);
    Route::get('/companies/filter', [CompanyController::class, 'filter'])->name('companies.filter');

    // Routes for the admins
    Route::get('/dashboard/admins', [AdminController::class, 'index'])->name('admins.index')->middleware('auth', 'superadmin');
    Route::put('/dashboard/admins/{user_id})/change-role', [AdminController::class, 'changeRole'])->name('admins.changeRole')->middleware('auth', 'superadmin');
});

// Routes for public website

Route::get('/explore', [SpaceController::class, 'explore'])->name('explore');
Route::get('/user/profile/{user}', [UserController::class, 'profile'])->name('user.profile');

Route::get('/rooms/details/{room}', [SpaceController::class, 'roomDetails'])->name('rooms.details');

Route::get('/room/create', [SpaceController::class, 'create'])->name('room.create')->middleware('auth', 'host', 'id.verified');
Route::post('/room/store', [SpaceController::class, 'store'])->name('rooms.store')->middleware('auth', 'host', 'id.verified');

Route::get('/space/edit/{space}', [SpaceController::class, 'editSpace'])->name('space.edit')->middleware('auth');
Route::put('/space/update/{slug}', [SpaceController::class, 'updateSpace'])->name('space.update')->middleware('auth');

Route::post('/booking/store', [BookingController::class, 'store'])->name('spaces.book')->middleware('auth');
Route::post('/booking/checkout', [PaymentController::class, 'checkout'])->name('booking.checkout')->middleware('auth');
Route::post('/booking/process', [PaymentController::class, 'process'])->name('payment.process')->middleware('auth');
Route::get('/bookings/confirmation/{booking}', [PaymentController::class, 'confirmation'])->name('bookings.confirmation')->middleware('auth');
Route::get('/booking/details/{booking}', [BookingController::class, 'info'])->name('bookings.details');
Route::post('/refund/{booking}', [PaymentController::class, 'refund'])->name('refund');

Route::get('/user/edit/{user}', [UserController::class, 'profileEdit'])->name('user.edit')->middleware('auth');
Route::put('/user/edit/{id}', [UserController::class, 'updateProfile'])->name('user.update')->middleware('auth');
Route::put('/user/password/edit/{user}', [UserController::class, 'updatePassword'])->name('user.password.update')->middleware('auth');

Route::get('/contact', function () { return view('pages.contact'); });
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::get('/about', function () { return view('pages.about'); });
Route::get('/terms', function () { return view('pages.terms'); });
Route::get('/privacy', function () { return view('pages.privacy'); });

Route::get('/host/stats/{host}', [UserController::class, 'hostStats'])->name('host.stats')->middleware('auth', 'host');
Route::post('/notifications/markAllAsRead/{user}', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead')->middleware('auth');

Route::put('/booking/confirm/{booking}', [BookingController::class, 'approve'])->name('booking.confirm')->middleware('auth');
Route::put('/booking/cancel/{booking}', [BookingController::class, 'reject'])->name('booking.cancel')->middleware('auth');
Route::put('/booking/complete/{booking}', [BookingController::class,'complete'])->name('booking.complete')->middleware('auth', 'host');

Route::post('/reviews/store/{booking}', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');

// Route for the KYC
// Admin Routes

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard/kyc/requests', [VerificationController::class, 'requests'])->name('requests.page');
    Route::post('/dashboard/kyc-approve/{user}', [VerificationController::class, 'approve'])->name('kyc.approve');
    Route::post('/dashboard/kyc-reject/{user}', [VerificationController::class, 'reject'])->name('kyc.reject');

    Route::get('/dashboard/search/', [DashboardController::class, 'search'])->name('search.page');
});

// Host Routes
Route::middleware(['auth', 'host'])->group(function () {
    Route::get('/host/verification', [VerificationController::class, 'verification'])->name('verification.page');
    Route::post('/host/verification/submit', [VerificationController::class, 'submit'])->name('verification.submit');
});

Route::get('/export/{table}/excel', [ReportController::class, 'exportExcel'])->name('export.excel')->middleware('auth', 'admin');
Route::get('/export/{table}/csv', [ReportController::class, 'exportCsv'])->name('export.csv')->middleware('auth', 'admin');
Route::get('/export/{table}/pdf', [ReportController::class, 'exportPdf'])->name('export.pdf')->middleware('auth', 'admin');

// Wishlist
Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{space}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{space}', [WishlistController::class, 'remove'])->name('wishlist.remove');
});

Route::fallback(function () {
    return view('pages.404');
});

require __DIR__.'/auth.php';