<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brunch extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'time',
        'excluded_days',
        'quantity',
        'price',
        'calendar_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'excluded_days' => 'array',
    ];
}
