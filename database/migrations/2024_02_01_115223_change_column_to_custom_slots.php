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
        Schema::table('custom_slots', function (Blueprint $table) {
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            $table->json('period_type')->nullable()->after('language');
            $table->integer('priority')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_slots', function (Blueprint $table) {
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->dropColumn('period_type');
            $table->dropColumn('priority');
        });
    }
};
