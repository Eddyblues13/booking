<?php
// 2025_10_08_145410_create_bookings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('flight_id')->constrained()->onDelete('cascade');
            $table->string('booking_reference')->unique();
            $table->integer('passenger_count');
            $table->decimal('total_amount', 10, 2);
            $table->decimal('base_fare', 10, 2);
            $table->decimal('taxes', 10, 2);
            $table->decimal('service_fee', 10, 2);
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->string('contact_phone_secondary')->nullable();
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');
            $table->text('special_requests')->nullable();
            $table->enum('status', ['pending_payment', 'confirmed', 'cancelled', 'refunded'])->default('pending_payment');
            $table->enum('payment_status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->string('payment_method')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes for better performance
            $table->index('booking_reference');
            $table->index('user_id');
            $table->index('flight_id');
            $table->index('status');
            $table->index('payment_status');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
