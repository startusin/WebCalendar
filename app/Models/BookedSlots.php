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
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];
}
