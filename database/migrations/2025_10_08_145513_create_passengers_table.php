<?php
// database/migrations/2025_10_08_145411_create_passengers_table.php

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
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->string('title', 10);
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('nationality', 2);
            $table->string('passport_number', 20);
            $table->date('passport_expiry');
            $table->string('passport_country', 2);
            $table->string('email');
            $table->string('phone', 20);
            $table->string('frequent_flyer_number', 20)->nullable();
            $table->timestamps();

            // Indexes for better performance
            $table->index('booking_id');
            $table->index('passport_number');
            $table->index(['first_name', 'last_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passengers');
    }
};
