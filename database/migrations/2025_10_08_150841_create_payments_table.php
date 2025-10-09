<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->string('transaction_id')->unique(); // Payment gateway transaction ID
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('USD');
            $table->enum('payment_method', ['credit_card', 'debit_card', 'paypal', 'bank_transfer', 'crypto']);
            $table->enum('status', ['pending', 'processing', 'completed', 'failed', 'refunded', 'cancelled'])->default('pending');
            $table->json('payment_details')->nullable(); // Store payment method details securely
            $table->json('gateway_response')->nullable(); // Raw response from payment gateway
            $table->string('gateway_name')->default('stripe'); // Payment gateway used
            $table->text('failure_reason')->nullable(); // Reason for failed payment
            $table->timestamp('processed_at')->nullable(); // When payment was processed
            $table->timestamp('refunded_at')->nullable(); // When payment was refunded
            $table->decimal('refund_amount', 10, 2)->default(0);
            $table->string('refund_reason')->nullable();
            $table->timestamps();

            // Indexes for better performance
            $table->index('transaction_id');
            $table->index('status');
            $table->index('payment_method');
            $table->index('processed_at');
            $table->index(['booking_id', 'status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
