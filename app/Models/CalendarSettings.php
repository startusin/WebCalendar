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
    ];
}
