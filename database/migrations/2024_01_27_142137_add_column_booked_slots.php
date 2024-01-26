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
        Schema::table('booked_slots', function (Blueprint $table) {
            $table->foreignId('calendar_id')->after('language')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booked_slots', function (Blueprint $table) {
            $table->dropColumn('calendar_id');
        });
    }
};
