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
        Schema::create('space_amenities', function (Blueprint $table) {
            $table->foreignId('space_id')->constrained('spaces', 'id');
            $table->foreignId('amenity_id')->constrained('amenities', 'id');
            $table->primary(['space_id', 'amenity_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('space_amenities');
    }
};
