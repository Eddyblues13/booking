<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->string('code', 3)->unique(); // IATA code (e.g., DAC, DOH)
            $table->string('name');
            $table->string('city');
            $table->string('country');
            $table->string('timezone')->default('UTC');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->integer('terminal_count')->default(1);
            $table->boolean('is_active')->default(true);
            $table->text('description')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes for better performance
            $table->index('code');
            $table->index('city');
            $table->index('country');
            $table->index('is_active');
        });
    }

    public function down()
    {
        Schema::dropIfExists('airports');
    }
};
