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
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
            $table->dropColumn('is_deleted');
        });

        Schema::table('spaces', function (Blueprint $table) {
            $table->softDeletes();
            $table->dropColumn('is_deleted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->boolean('is_deleted')->default(false);
        });

        Schema::table('spaces', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->boolean('is_deleted')->default(false);
        });
    }
};
