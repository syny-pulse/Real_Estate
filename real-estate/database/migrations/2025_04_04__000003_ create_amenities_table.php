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
            $table->boolean('has_wifi')->default(false); //Wifi
            $table->boolean('has_parking')->default(false); //Parking
            $table->boolean('has_pool')->default(false); //Swimming Pool
            $table->boolean('has_balcony')->default(false);//Balcony
            $table->boolean('has_gym')->default(false); //Gym
            $table->boolean('has_security')->default(false); //Security
            $table->boolean('has_ac')->default(false); //AC
            $table->boolean('has_heating')->default(false); //Heating
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
