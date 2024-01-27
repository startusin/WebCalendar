<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'calendar_id',
        'title',
        'short_description',
        'description',
        'price',
        'max_qty',
    ];

    public function promocodes()
    {
        return $this->hasMany(PromoCode::class,'product_id','id');
    }

    protected $casts = [
        'description' => 'array',
        'short_description' => 'array',
        'title' => 'array',
    ];
}
