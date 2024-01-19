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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('slot_id')->references('id')->on('available_slots');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('company_name')->nullable();
            $table->string('region')->nullable();
            $table->string('street_name')->nullable();
            $table->string('place')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone')->nullable();
            $table->json('stripe_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
