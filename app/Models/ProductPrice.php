<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'price' ,
        'product_id',
        'calendar_id'
    ];

    protected $casts = [
        'price' => 'array'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
