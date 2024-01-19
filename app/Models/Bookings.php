<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;
    protected $guarded = false;
    public function products()
    {
        return $this->belongsToMany(Product::class, 'booking_products', 'booking_id', 'product_id');
    }
}
