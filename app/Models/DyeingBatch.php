<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DyeingBatch extends Model
{
    protected $fillable = [
        'batch_no',
        'color_info',
        'dye_type',
        'process_status',
        'quantity',
        'unit_type'
    ];
}