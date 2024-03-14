<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarCountry extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
