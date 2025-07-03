<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailData extends Model
{
    use HasFactory;
    
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }
}