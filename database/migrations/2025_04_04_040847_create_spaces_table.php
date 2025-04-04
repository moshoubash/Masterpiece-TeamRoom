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
        Schema::create('spaces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('host_id')->constrained('users', 'user_id');
            $table->string('title', 255);
            $table->text('description');
            $table->string('street_address', 255);
            $table->string('city', 255);
            $table->string('state', 255)->nullable();
            $table->string('postal_code', 255);
            $table->string('country', 255);
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->integer('capacity');
            $table->decimal('hourly_rate', 10, 2);
            $table->integer('min_booking_duration')->comment('in hours');
            $table->integer('max_booking_duration')->nullable()->comment('in hours');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spaces');
    }
};
