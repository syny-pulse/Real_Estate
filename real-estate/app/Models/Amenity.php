<?php

// Amenity.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    protected $fillable = [
        'property_id', 'has_wifi', 'has_parking', 'has_pool', 
        'has_balcony', 'has_gym', 'has_security', 'has_ac', 'has_heating'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}