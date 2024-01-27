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
        Schema::table('booked_brunches', function (Blueprint $table) {
            $table->foreignId('brunch_id')->nullable()->on('brunches');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booked_brunches', function (Blueprint $table) {
            $table->dropColumn('brunch_id');
        });
    }
};
