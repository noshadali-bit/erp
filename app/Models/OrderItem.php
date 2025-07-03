<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_type',
        'quantity',
        'unit_type'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}