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
        Schema::create('calendar_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calendar_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('primary_color')->nullable();
            $table->string('secondary_color')->nullable();
            $table->string('bg_color')->nullable();
            $table->string('logo')->nullable();
            $table->integer('default_quantity')->default(3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendar_settings');
    }
};
