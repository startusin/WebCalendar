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
        Schema::table('booking_products', function (Blueprint $table) {
            $table->foreignId('slot_id')->after('promocode_id')->on('booked_slots');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking_products', function (Blueprint $table) {
            $table->dropColumn('slot_id');
        });
    }
};
