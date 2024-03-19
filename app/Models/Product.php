<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'priority'
    ];

    protected $casts = [
        'description' => 'array',
        'short_description' => 'array',
        'title' => 'array',
        'price' => 'array'
    ];

    public function promocodes(): HasMany
    {
        return $this->hasMany(PromoCode::class,'product_id','id');
    }
}
