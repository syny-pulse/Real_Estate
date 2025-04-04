<?php

// create_amenities_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('amenities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->boolean('has_wifi')->default(false);
            $table->boolean('has_parking')->default(false);
            $table->boolean('has_pool')->default(false);
            $table->boolean('has_balcony')->default(false);
            $table->boolean('has_gym')->default(false);
            $table->boolean('has_security')->default(false);
            $table->boolean('has_ac')->default(false);
            $table->boolean('has_heating')->default(false);
            $table->timestamps();
            
            // One amenity record per property
            $table->unique('property_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('amenities');
    }
};
