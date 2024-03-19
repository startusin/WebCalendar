<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bookings extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'booking_products', 'booking_id', 'product_id');
    }

    public function bookingProducts()
    {
        return $this->hasMany(BookingProduct::class, 'booking_id');
    }

    public function slots()
    {
        return $this->hasMany(BookedSlots::class, 'booking_id');
    }

    public function brunches()
    {
        return $this->hasMany(BookedBrunch::class, 'booking_id');
    }

    public function comments()
    {
        return $this->hasMany(OrderComments::class, 'order_id');
    }
}
