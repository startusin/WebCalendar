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
        Schema::table('calendar_settings', function (Blueprint $table) {
            $table->string('working_hr_start')->nullable();
            $table->string('working_hr_end')->nullable();
            $table->json('excluded_days')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calendar_settings', function (Blueprint $table) {
            $table->dropColumn('working_hr_start');
            $table->dropColumn('working_hr_end');
            $table->dropColumn('excluded_days');
        });
    }
};
