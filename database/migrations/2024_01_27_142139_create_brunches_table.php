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
        Schema::create('brunches', function (Blueprint $table) {
            $table->id();
            $table->string('time');
            $table->json('excluded_days')->nullable();
            $table->integer('quantity');
            $table->double('price');
            $table->foreignId('calendar_id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brunches');
    }
};
