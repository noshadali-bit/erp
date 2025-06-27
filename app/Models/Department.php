<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'type',
        'description'
    ];

    public function inventory()
    {
        return $this->hasMany(YarnInventory::class);
    }

    public function incomingMovements()
    {
        return $this->hasMany(YarnMovement::class, 'to_department_id');
    }

    public function outgoingMovements()
    {
        return $this->hasMany(YarnMovement::class, 'from_department_id');
    }
}