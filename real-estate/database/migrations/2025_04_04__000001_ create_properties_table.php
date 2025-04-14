<?php

// Properties Table

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->decimal('price', 12, 2);
            $table->enum('property_type', ['apartment', 'house', 'land', 'commercial']);
            $table->text('address');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->integer('bedrooms')->default(0);
            $table->integer('bathrooms')->default(0);
            $table->decimal('area', 10, 2)->nullable();
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('availability_status', ['available', 'booked', 'sold'])->default('available');
            $table->timestamps();

            // Indexing for faster searches
            $table->index(['property_type', 'status', 'availability_status']);
            $table->index('owner_id');
            $table->index('price');
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
};
