<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YarnPurchaseOrder extends Model
{
    protected $fillable = [
        'supplier_id',
        'expected_delivery_date',
        'status'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function items()
    {
        return $this->hasMany(YarnPurchaseOrderItem::class);
    }
}