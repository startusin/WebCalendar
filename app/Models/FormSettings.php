<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_required',
        'key',
        'calendar_id'
    ];
}
