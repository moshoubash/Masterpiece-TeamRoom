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
        // Check if it was "deleted" (custom flag)
        if ($space->isDirty('is_deleted') && $space->is_deleted) {
            (new CreateNewActivity(
                Auth::id() ?? $space->host_id,
                'space',
                'Space Deleted',
                "Space '{$space->title}' was deleted"
            ))->execute();
            return;
        }

        // Standard update
        (new CreateNewActivity(
            Auth::id() ?? $space->host_id,
            'space',
            'Space Updated',
            "Space '{$space->title}' was updated"
        ))->execute();
    }
}
