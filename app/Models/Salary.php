<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'user_id',
        'month_year',
        'base_salary',
        'total_days',
        'present_days',
        'absent_days',
        'leave_days',
        'deductions',
        'bonus',
        'net_salary',
        'payment_status',
        'payment_date'
    ];

    protected $casts = [
        'month_year' => 'date',
        'payment_date' => 'date',
        'base_salary' => 'decimal:2',
        'total_days' => 'decimal:2',
        'present_days' => 'decimal:2',
        'absent_days' => 'decimal:2',
        'leave_days' => 'decimal:2',
        'deductions' => 'decimal:2',
        'bonus' => 'decimal:2',
        'net_salary' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calculateNetSalary()
    {
        $perDaySalary = $this->base_salary / $this->total_days;
        $earnedSalary = $perDaySalary * $this->present_days;
        $this->net_salary = $earnedSalary + $this->bonus - $this->deductions;
        return $this->net_salary;
    }
}
