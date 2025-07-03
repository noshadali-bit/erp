<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YarnMovement extends Model
{
    protected $fillable = [
        'from_department_id',
        'to_department_id',
        'quantity',
        'unit_type',
        'movement_date'
    ];

    public function fromDepartment()
    {
        return $this->belongsTo(Department::class, 'from_department_id');
    }

    public function toDepartment()
    {
        return $this->belongsTo(Department::class, 'to_department_id');
    }
}