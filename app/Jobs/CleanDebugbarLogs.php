<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CleanDebugbarLogs implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $path = storage_path('debugbar');
        
        if (\Illuminate\Support\Facades\File::exists($path)) {
            \Illuminate\Support\Facades\File::cleanDirectory($path);
        }
    }
}
