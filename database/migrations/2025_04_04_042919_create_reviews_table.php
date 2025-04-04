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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->unique()->constrained('bookings', 'id');
            $table->foreignId('reviewer_id')->constrained('users', 'id');
            $table->foreignId('reviewee_id')->constrained('users', 'id');
            $table->foreignId('space_id')->constrained('spaces', 'id');
            $table->integer('rating')->comment('between 1 and 5');
            $table->text('review_text')->nullable();
            $table->text('response_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
