<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'booking_id',
        'quantity',
        'promocode_id',
        'sold_price'
    ];
}
