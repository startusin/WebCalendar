<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'calendar_id' ,
        'period_type'
    ];

    protected $casts = [
        'period_type' => 'array',
    ];
}
