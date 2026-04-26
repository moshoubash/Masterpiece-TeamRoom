<?php

namespace App\Observers;

use App\Models\Space;
use App\Services\CreateNewActivity;
use Illuminate\Support\Facades\Auth;

class SpaceObserver
{
    /**
     * Handle the Space "created" event.
     */
    public function created(Space $space): void
    {
        (new CreateNewActivity(
            Auth::id() ?? $space->host_id,
            'space',
            'Space Created',
            "Space '{$space->title}' was created"
        ))->execute();
    }

    /**
     * Handle the Space "updated" event.
     */
    public function updated(Space $space): void
    {
        // Standard update
        (new CreateNewActivity(
            Auth::id() ?? $space->host_id,
            'space',
            'Space Updated',
            "Space '{$space->title}' was updated"
        ))->execute();
    }

    /**
     * Handle the Space "deleted" event.
     */
    public function deleted(Space $space): void
    {
        (new CreateNewActivity(
            Auth::id() ?? $space->host_id,
            'space',
            'Space Deleted',
            "Space '{$space->title}' was deleted"
        ))->execute();
    }
}
