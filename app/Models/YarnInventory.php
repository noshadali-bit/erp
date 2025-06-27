<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YarnInventory extends Model
{
    protected $table = 'yarn_inventory';

    protected $fillable = [
        'department_id',
        'yarn_type',
        'bags',
        'cones',
        'kg',
        'pieces'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}