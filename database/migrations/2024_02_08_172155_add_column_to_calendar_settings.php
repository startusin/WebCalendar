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
            $table->json('cs_email')->nullable();
            $table->json('cs_email_title')->nullable();
            $table->json('purchase_email')->nullable();
            $table->json('sms_reminder')->nullable();
            $table->json('purchase_email_title')->nullable();
            $table->json('item_email')->nullable();
            $table->integer('remind_time')->default(60);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calendar_settings', function (Blueprint $table) {
            $table->dropColumn('cs_email');
            $table->dropColumn('purchase_email');
            $table->dropColumn('item_email');
            $table->dropColumn('sms_reminder');
            $table->dropColumn('remind_time');
        });
    }
};
