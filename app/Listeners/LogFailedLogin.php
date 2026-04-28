<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Failed;
use App\Services\CreateNewActivity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogFailedLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Failed $event): void
    {
        $userId = $event->user ? $event->user->id : null;
        $email = $event->credentials['email'] ?? 'unknown';

        (new CreateNewActivity(
            $userId,
            'Security',
            'Failed Login Attempt',
            "A failed login attempt was recorded for email: {$email}"
        ))->execute();
    }
}
