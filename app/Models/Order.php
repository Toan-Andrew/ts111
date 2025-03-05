<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'phone',
        'address',
        'email',
        'quantity',
        'price',
        'img',
        'order_time',
        'status',
        'user_id',
        'img'        => ''
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
};