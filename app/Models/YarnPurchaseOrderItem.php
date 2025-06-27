<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YarnPurchaseOrderItem extends Model
{
    protected $fillable = [
        'yarn_purchase_order_id',
        'yarn_type',
        'count',
        'quantity',
        'rate'
    ];

    public function purchaseOrder()
    {
        return $this->belongsTo(YarnPurchaseOrder::class, 'yarn_purchase_order_id');
    }
}