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
        Schema::create('booked_brunches', function (Blueprint $table) {
            $table->id();
            $table->dateTime('brunch_date');
            $table->integer('quantity');
            $table->foreignId('calendar_id')->on('users');
            $table->foreignId('booking_id')->on('bookings');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booked_brunches');
    }
};
