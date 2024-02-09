<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'indent_id',
        'booking_id',
        'data'
    ];

    public $timestamps = false;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data' => 'array',
    ];
}
