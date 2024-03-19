<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookedSlots extends Model
{
    use HasFactory;

    protected $fillable = [
      'start_date',
      'end_date',
      'timestamp',
      'language',
      'calendar_id',
      'booking_id',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function booking(){
        return $this->belongsTo(Bookings::class, 'booking_id','id');
    }
}
