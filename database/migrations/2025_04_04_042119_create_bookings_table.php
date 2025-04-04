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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('space_id')->constrained('spaces', 'id');
            $table->foreignId('renter_id')->constrained('users', 'id');
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->integer('num_attendees')->nullable();
            $table->string('status', 255)->default('pending')->comment('pending, confirmed, cancelled, completed');
            $table->decimal('total_price', 10, 2);
            $table->decimal('service_fee', 10, 2);
            $table->decimal('host_payout', 10, 2);
            $table->text('cancellation_reason')->nullable();
            $table->foreignId('cancelled_by')->nullable()->constrained('users', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
