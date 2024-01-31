<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('calendar_settings')->update([
            'working_hr_start' => null,
            'working_hr_end' => null,
        ]);

        Schema::table('calendar_settings', function (Blueprint $table) {
            $table->json('working_hr_start')->nullable()->change();
            $table->json('working_hr_end')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calendar_settings', function (Blueprint $table) {
            $table->string('working_hr_start')->default('08:00')->change();
            $table->string('working_hr_end')->default('20:00')->change();
        });
    }
};
