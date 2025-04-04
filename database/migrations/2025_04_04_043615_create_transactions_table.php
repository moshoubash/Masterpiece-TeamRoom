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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings', 'id');
            $table->foreignId('payment_method_id')->nullable()->constrained('payment_methods', 'id');
            $table->string('transaction_type', 255)->comment('payment, refund, payout');
            $table->decimal('amount', 10, 2);
            $table->string('status', 255)->comment('pending, completed, failed');
            $table->string('provider_transaction_id', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
