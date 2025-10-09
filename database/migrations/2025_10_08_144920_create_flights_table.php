<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('flight_number');

            // Foreign keys
            $table->foreignId('airline_id')->constrained('airlines')->onDelete('cascade');
            $table->foreignId('departure_airport_id')->constrained('airports')->onDelete('cascade');
            $table->foreignId('arrival_airport_id')->constrained('airports')->onDelete('cascade');

            // Flight details
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->integer('duration'); // in minutes
            $table->decimal('price', 10, 2);
            $table->integer('available_seats');
            $table->enum('class', ['economy', 'premium_economy', 'business', 'first']);
            $table->enum('status', ['scheduled', 'boarding', 'in_air', 'landed', 'cancelled', 'delayed'])->default('scheduled');
            $table->timestamps();

            // Indexes for optimization
            $table->index(['departure_airport_id', 'arrival_airport_id']);
            $table->index('departure_time');
            $table->index('class');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
