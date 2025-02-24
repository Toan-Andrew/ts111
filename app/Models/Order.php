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
        'price',
        'img',
        'order_time'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}