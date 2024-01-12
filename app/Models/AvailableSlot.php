<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableSlot extends Model
{
    use HasFactory;
    protected $fillable = [
        'calendar_id' ,
        'language',
        'attendee_qty',
        'start_date',
        'end_date',
    ];
    protected $casts = [
        'language' => 'array',
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];
}
