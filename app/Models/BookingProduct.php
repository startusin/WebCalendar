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
        'slot_id',
        'sold_price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function booking()
    {
        return $this->belongsTo(Bookings::class, 'booking_id', 'id');
    }

    public function slot()
    {
        return $this->belongsTo(BookedSlots::class, 'slot_id', 'id');
    }
}
