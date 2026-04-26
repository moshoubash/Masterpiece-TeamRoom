<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;
use App\Models\Space;
use Carbon\Carbon;

class CleanupSoftDeletedRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cleanup-soft-deleted';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permanently delete soft-deleted users and spaces older than 30 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cutoffDate = Carbon::now()->subDays(30);

        $deletedUsers = User::onlyTrashed()
            ->where('deleted_at', '<=', $cutoffDate)
            ->forceDelete();

        $deletedSpaces = Space::onlyTrashed()
            ->where('deleted_at', '<=', $cutoffDate)
            ->forceDelete();

        $this->info("Cleaned up {$deletedUsers} users and {$deletedSpaces} spaces.");
    }
}
