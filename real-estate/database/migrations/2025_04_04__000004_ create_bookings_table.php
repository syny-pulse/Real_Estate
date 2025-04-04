<?php
// create_bookings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->date('check_in');
            $table->integer('booking_period'); // in days
            $table->integer('guests')->default(1);
            $table->decimal('total_price', 12, 2);
            $table->enum('status', ['pending', 'confirmed', 'completed', 'canceled'])->default('pending');
            $table->timestamps();
            
            // Indexing for booking queries
            $table->index(['property_id', 'check_in', 'status']);
            $table->index('customer_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};