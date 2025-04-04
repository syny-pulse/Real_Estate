<?php

// Booking.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'property_id', 'customer_id', 'check_in', 'booking_period',
        'guests', 'total_price', 'status'
    ];

    protected $casts = [
        'check_in' => 'date',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function getCheckOutAttribute()
    {
        return $this->check_in->addDays($this->booking_period);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}
