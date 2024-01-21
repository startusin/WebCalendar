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
        Schema::rename('available_slots', 'custom_slots');

        Schema::table('custom_slots', function (Blueprint $table) {
            $table->boolean('is_available')->default(false)->after('attendee_qty');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_slots', function (Blueprint $table) {
            $table->dropColumn('is_available');
        });

        Schema::rename('custom_slots', 'available_slots');
    }
};
