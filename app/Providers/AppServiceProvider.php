<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Notification;
use App\Models\Space;
use App\Models\Booking;
use App\Observers\NotificationObserver;
use App\Observers\SpaceObserver;
use App\Observers\BookingObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        // Register observers
        Notification::observe(NotificationObserver::class);
        Space::observe(SpaceObserver::class);
        Booking::observe(BookingObserver::class);
    }
}
