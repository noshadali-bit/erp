<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PharIo\Manifest\Email;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'joining_date' => 'date',
        'is_active' => 'boolean',
        'base_salary' => 'decimal:2'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getTotalBookingAttribute()
    {
        return $this->bookings()->count();
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public static function last()
    {
        return static::all()->last();
    }
    public function batch()
    {
        return $this->belongsTo('App\Models\Batch', 'batch_id');
    }
    public function attended_quizzes()
    {
        return $this->hasMany('App\Models\AttendedQuizzes', 'user_id');
    }

    public function fees()
    {
        return $this->hasMany('App\Models\Fees', 'student_id');
    }
    public function attendace()
    {
        return $this->hasMany('App\Models\Attendance', 'student_id');
    }
    public function reviews()
    {
        return $this->hasMany('App\Models\Review', 'user_id');
    }
    public function tasks()
    {
        return $this->hasMany('App\Models\Task', 'user_id');
    }
    public function targets()
    {
        return $this->hasMany('App\Models\Target', 'user_id');
    }
    public function saved_datas()
    {
        return $this->hasMany('App\Models\SavedData', 'user_id');
    }
    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id');
    }

    public function approvedTarget($month = null)
    {
        if($month == null){
            $currentMonth = Carbon::now()->format('Y-m');
        }else{
            $currentMonth = $month;
        }
        $target =  Target::where('user_id', $this->id)->where('month', $currentMonth)->first();
        return ($target) ? $target->approved_tasks : 0;
    }
    public function achiveApprovedTarget($month = null)
    {
        if($month == null){
            $currentMonth = Carbon::now()->format('Y-m');
        }else{
            $currentMonth = $month;
        }
        list($year, $monthNumber) = explode('-', $currentMonth);
        $completedTasks = Task::where('user_id', $this->id)
            ->whereMonth('due_date', $monthNumber)
            ->whereYear('due_date', $year)
            ->whereIn('status', [1, 2, 3]) // Approved, Closed, Delayed
            ->where('approval_status', 1)
            ->count();
        return $completedTasks;
    }
    public function target($month = null)
    {
        if($month == null){
            $currentMonth = Carbon::now()->format('Y-m');
        }else{
            $currentMonth = $month;
        }
        $target =  Target::where('user_id', $this->id)->where('month', $currentMonth)->first();
        return ($target) ? $target->target : 0;
    }
    public function totalTasks($month = null)
    {
        if($month == null){
            $currentMonth = Carbon::now()->format('Y-m');
        }else{
            $currentMonth = $month;
        }
        list($year, $monthNumber) = explode('-', $currentMonth);
        $allTasks = Task::where('user_id', $this->id)
            ->whereMonth('due_date', $monthNumber)
            ->whereYear('due_date', $year)
            ->count();
        return $allTasks;
    }
    
    public function achiveTarget($month = null)
    {
        if($month == null){
            $currentMonth = Carbon::now()->format('Y-m');
        }else{
            $currentMonth = $month;
        }
        list($year, $monthNumber) = explode('-', $currentMonth);
        $completedTasks = Task::where('user_id', $this->id)
            ->whereMonth('due_date', $monthNumber)
            ->whereYear('due_date', $year)
            ->whereIn('status', [1, 2, 3, 4]) // Approved, Closed, Delayed , Not Approved(For design team)
            ->count();
        return $completedTasks;
    }
    public function performance($month = null)
    {
        if($month == null){
            $currentMonth = Carbon::now()->format('Y-m');
        }else{
            $currentMonth = $month;
        }
        list($year, $monthNumber) = explode('-', $currentMonth);
        $targetEntry =  Target::where('user_id', $this->id)->where('month', $currentMonth)->first();
        if($targetEntry){
            $target = $targetEntry->target;
        }else{
            $target = 0;
        }

        $completedTasks = Task::where('user_id', $this->id)
        ->whereMonth('due_date', $monthNumber)
            ->whereYear('due_date', $year)
        ->whereIn('status', [1, 2, 3,4]) // Approved, Closed, Delayed
        ->count();

         if($target == 0){
             $allTasks = Task::where('user_id', $this->id)
            ->whereMonth('due_date', $monthNumber)
            ->whereYear('due_date', $year)
            ->whereIn('status', [1, 2, 3, 4]) // Approved, Closed, Delayed
            ->get();
            
            $averageRating = $allTasks->avg('rating'); 
            $progress = $averageRating ?? 0; 
        }else{
            $progress = ($completedTasks / $target) * 100;
        }

        if($progress > 100){
            return 100;
        }else{
            return round($progress, 2);
        }
        
    }
     public function approvedPerformance($month = null)
    {
        if($month == null){
            $currentMonth = Carbon::now()->format('Y-m');
        }else{
            $currentMonth = $month;
        }
        list($year, $monthNumber) = explode('-', $currentMonth);
        $targetEntry =  Target::where('user_id', $this->id)->where('month', $currentMonth)->first();
        if($targetEntry){
            $target = $targetEntry->approved_tasks;
        }else{
            $target = 0;
        }

        $completedTasks = Task::where('user_id', $this->id)
        ->whereMonth('due_date', $monthNumber)
            ->whereYear('due_date', $year)
        ->whereIn('status', [1, 2, 3]) // Approved, Closed, Delayed
        ->where('approval_status', 1)
        ->count();
        if($target == 0){
            $progress =0;
        }else{
            $progress = ($completedTasks / $target) * 100;
        }

        if($progress > 100){
            return 100;
        }else{
            return round($progress, 2);
        }
        
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }

    public function calculateMonthlyAttendance($month, $year)
    {
        return $this->attendances()
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get()
            ->groupBy('status')
            ->map->count();
    }
}

