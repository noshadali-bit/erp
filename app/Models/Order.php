<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_no',
        'buyer_name',
        'buyer_details',
        'status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}