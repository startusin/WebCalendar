<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookedBrunch extends Model
{
    use HasFactory;

    protected $fillable = [
      'brunch_date',
      'quantity',
      'calendar_id',
      'booking_id',
    ];
}
