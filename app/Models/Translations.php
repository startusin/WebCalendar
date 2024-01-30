<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translations extends Model
{
    use HasFactory;
    protected $fillable = [
        'calendar_id',
        'translations',
    ];

    protected $casts = [
        'translations' => 'array',
    ];
}
