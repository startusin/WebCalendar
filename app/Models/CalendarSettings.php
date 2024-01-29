<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarSettings extends Model
{
    use HasFactory;
    protected $fillable = [
        'calendar_id',
        'primary_color',
        'secondary_color',
        'bg_color',
        'logo',
        'default_quantity',
        'brunch_text',
        'banner',
        'excluded_days',
        'working_hr_start',
        'working_hr_end',
        'interval',
        'language'
    ];

    protected $casts = [
        'brunch_text' => 'array',
        'excluded_days' => 'array',
    ];
}
