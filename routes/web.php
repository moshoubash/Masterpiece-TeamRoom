<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    BookingController,
    SpaceController,
    UserController,
    ReviewController,
    RoleController,
    ActivityController,
    AdminController,
    ContactController,
    HomeController,
    NotificationController,
    TransactionController,
    ReportController,
    PaymentController,
    VerificationController,
    WishlistController,
    CompanyController,
    AmenityController
};

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/explore', [SpaceController::class, 'explore'])->name('explore');
Route::get('/rooms/details/{room}', [SpaceController::class, 'roomDetails'])->name('rooms.details');
Route::get('/booking/details/{booking}', [BookingController::class, 'info'])->name('bookings.details');
Route::get('/user/profile/{user}', [UserController::class, 'profile'])->name('user.profile');

Route::view('/contact', 'pages.contact')->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::view('/about', 'pages.about')->name('about');
Route::view('/terms', 'pages.terms')->name('terms');
Route::view('/privacy', 'pages.privacy')->name('privacy');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // User Profile & Settings
    Route::controller(UserController::class)->group(function () {
        Route::get('/user/edit/{user}', 'profileEdit')->name('user.edit');
        Route::put('/user/edit/{id}', 'updateProfile')->name('user.update');
        Route::put('/user/password/edit/{user}', 'updatePassword')->name('user.password.update');
    });

    // Bookings & Payments
    Route::post('/booking/store', [BookingController::class, 'store'])->name('spaces.book');
    Route::controller(PaymentController::class)->group(function () {
        Route::post('/booking/checkout', 'checkout')->name('booking.checkout');
        Route::post('/booking/process', 'process')->name('payment.process');
        Route::get('/bookings/confirmation/{booking}', 'confirmation')->name('bookings.confirmation');
        Route::post('/refund/{booking}', 'refund')->name('refund');
    });

    // Space Interaction
    Route::get('/space/edit/{space}', [SpaceController::class, 'editSpace'])->name('space.edit');
    Route::put('/space/update/{slug}', [SpaceController::class, 'updateSpace'])->name('space.update');
    Route::post('/reviews/store/{booking}', [ReviewController::class, 'store'])->name('reviews.store');

    // Wishlist
    Route::controller(WishlistController::class)->prefix('wishlist')->name('wishlist.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/add/{space}', 'add')->name('add');
        Route::delete('/remove/{space}', 'remove')->name('remove');
    });

    // Notifications (Common)
    Route::controller(NotificationController::class)->group(function () {
        Route::get('/notifications', 'allNotifications')->name('notifications.all');
        Route::put('/notifications/{id}/mark-read', 'markAsRead')->name('notifications.markRead');
        Route::post('/notifications/markAllAsRead/{user}', 'markAllAsRead')->name('notifications.markAllAsRead');
    });

    // Booking Actions
    Route::controller(BookingController::class)->group(function () {
        Route::put('/booking/confirm/{booking}', 'approve')->name('booking.confirm');
        Route::put('/booking/cancel/{booking}', 'reject')->name('booking.cancel');
    });

    /*
    |--------------------------------------------------------------------------
    | Host Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('host')->group(function () {
        Route::get('/host/stats/{host}', [UserController::class, 'hostStats'])->name('host.stats');
        Route::put('/booking/complete/{booking}', [BookingController::class, 'complete'])->name('booking.complete');
        Route::put('/room/delete/{slug}', [SpaceController::class, 'deleteByHost'])->name('room.deleteByHost');

        // KYC Verification
        Route::controller(VerificationController::class)->prefix('host/verification')->name('verification.')->group(function () {
            Route::get('/', 'verification')->name('page');
            Route::post('/submit', 'submit')->name('submit');
        });

        // Space Management (Verified Hosts)
        Route::middleware('id.verified')->group(function () {
            Route::get('/room/create', [SpaceController::class, 'create'])->name('room.create');
            Route::post('/room/store', [SpaceController::class, 'store'])->name('rooms.store');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Admin & Dashboard Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('admin')->group(function () {

        // Global Dashboard Search & Exports (No Dashboard Prefix in original)
        Route::get('/spaces/search', [SpaceController::class, 'filter'])->name('spaces.search');
        Route::get('/bookings/status/{status}', [BookingController::class, 'filter'])->name('bookings.search');
        Route::get('/transactions/search', [TransactionController::class, 'filter'])->name('transactions.filter');
        Route::get('/companies/filter', [CompanyController::class, 'filter'])->name('companies.filter');

        Route::controller(ReportController::class)->prefix('export')->name('export.')->group(function () {
            Route::get('/{table}/excel', 'exportExcel')->name('excel');
            Route::get('/{table}/csv', 'exportCsv')->name('csv');
            Route::get('/{table}/pdf', 'exportPdf')->name('pdf');
        });

        // Dashboard Prefixed Routes
        Route::prefix('dashboard')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('/search', [DashboardController::class, 'search'])->name('search.page');

            // Static Dashboard Views
            Route::view('/messages', 'dashboard.messages.index');
            Route::view('/reports', 'dashboard.reports.index');

            // Resources
            Route::resources([
                'roles' => RoleController::class,
                'spaces' => SpaceController::class,
                'bookings' => BookingController::class,
                'reviews' => ReviewController::class,
                'transactions' => TransactionController::class,
                'companies' => CompanyController::class,
                'amenities' => AmenityController::class,
            ]);

            Route::get('activities', [ActivityController::class, 'index'])->name('activity.all');

            // User Management
            Route::controller(UserController::class)->prefix('users')->name('users.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/search', 'search')->name('search');
                Route::get('/filter/{option}', 'filter')->name('filter');
                Route::get('/{id}/show', 'show')->name('show');
                Route::get('/{id}/edit', 'edit')->name('edit');
                Route::post('/{id}/update', 'update')->name('update');
                Route::post('/{id}/destroy', 'destroy')->name('destroy');
                Route::put('/{id}/restore', 'restore')->name('user.restore');
            });

            // Specialized Admin Actions
            Route::get('/reviews/{review}', [ReviewController::class, 'filter'])->name('reviews.search');
            Route::get('/activities/{type}', [ActivityController::class, 'filter'])->name('activity.filter');
            Route::put('/companies/{id}/restore', [CompanyController::class, 'restore'])->name('companies.restore');

            // Admin Notifications
            Route::controller(NotificationController::class)->prefix('notifications')->name('notifications.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/filter', 'filter')->name('filter');
                Route::post('/store', 'store')->name('store');
                Route::put('/{id}/markAsRead', 'markAsRead');
                Route::delete('/{id}', 'destroy')->name('destroy');
            });

            // Settings & Password
            Route::controller(UserController::class)->group(function () {
                Route::get('/settings', 'adminSettings')->name('admin.settings');
                Route::put('/admin/settings/{user}', 'updateAdminSettings')->name('admin.settings.update');
                Route::put('/user/update/{user}', 'updateProfile')->name('settings.update');
                Route::put('/user/passwordchangeing/{id}', 'updatePasswordAdmin')->name('user.password.change.admin');
            });

            // KYC Requests
            Route::controller(VerificationController::class)->prefix('kyc')->group(function () {
                Route::get('/requests', 'requests')->name('requests.page');
                Route::post('/approve/{user}', 'approve')->name('kyc.approve');
                Route::post('/reject/{user}', 'reject')->name('kyc.reject');
            });

            // Superadmin Only
            Route::middleware('superadmin')->group(function () {
                Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
                Route::put('/admins/{user_id}/change-role', [AdminController::class, 'changeRole'])->name('admins.changeRole');
            });
        });
    });
});

/*
|--------------------------------------------------------------------------
| System Routes
|--------------------------------------------------------------------------
*/

Route::fallback(function () {
    return view('pages.404');
});

require __DIR__ . '/auth.php';