<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bookings extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'booking_products', 'booking_id', 'product_id');
    }

    public function bookingProducts(): HasMany
    {
        return $this->hasMany(BookingProduct::class, 'booking_id');
    }

    public function slots(): HasMany
    {
        return $this->hasMany(BookedSlots::class, 'booking_id');
    }

    public function brunches(): HasMany
    {
        return $this->hasMany(BookedBrunch::class, 'booking_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(OrderComments::class, 'order_id');
    }
}
