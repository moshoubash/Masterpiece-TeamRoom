<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('space_availabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('space_id')->constrained('spaces', 'id');
            $table->enum('day_of_week', [
                'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
            ]);
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('is_available')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('space_availabilities');
    }
};
