<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];


    public function users()
    {
        return $this->hasMany('App\Models\User', 'department_id')->where('role_id', 3);
    }

    public function manager()
    {
        return $this->hasOne('App\Models\User', 'department_id')->where('role_id', 2);
    }
    public function parent()
    {
        return $this->belongsTo('App\Models\Department', 'parent_id');
    }

    public function sub_departments()
    {
        return $this->hasMany('App\Models\Department', 'parent_id');
    }

    public function target($month = null)
    {
        if($month == null){
            $currentMonth = Carbon::now()->format('Y-m');
        }else{
            $currentMonth = $month;
        }
        $department = Department::where('id', $this->id)->first();
        if($department->parent_id == null && $department->sub_departments->count() > 0){
            $subDepartments = Department::where('parent_id', $department->id)->pluck('id')->toArray();
            $employesIds = User::whereIn('department_id', $subDepartments)->where('role_id', 3)->pluck('id')->toArray();
        }else{
            $employesIds = User::where('department_id', $department->id)->where('role_id', 3)->pluck('id')->toArray();
        }

        $targetEntries =  Target::whereIn('user_id', $employesIds)->where('month', $currentMonth)->get();
        $target = 0;
        foreach($targetEntries as $targetEntry){
            $target = $target+$targetEntry->target;
        }
        return $target;
    }
    public function achiveTarget($month = null)
    {
        if($month == null){
            $currentMonth = Carbon::now()->format('Y-m');
        }else{
            $currentMonth = $month;
        }
        list($year, $monthNumber) = explode('-', $currentMonth);
        $department = Department::where('id', $this->id)->first();
        if($department->parent_id == null && $department->sub_departments->count() > 0){
            $subDepartments = Department::where('parent_id', $department->id)->pluck('id')->toArray();
            $employesIds = User::whereIn('department_id', $subDepartments)->where('role_id', 3)->pluck('id')->toArray();
        }else{
            $employesIds = User::where('department_id', $department->id)->where('role_id', 3)->pluck('id')->toArray();
        }
        $completedTasks = Task::whereIn('user_id', $employesIds)
            ->whereMonth('due_date', $monthNumber) // Filter by month from $currentMonth
            ->whereYear('due_date', $year) // Filter by year from $currentMonth
            ->whereIn('status', [1, 2, 3]) // Approved, Closed, Delayed
            ->count();
        return $completedTasks;
    } 
    
    public function allTasks($month = null)
    {
        if($month == null){
            $currentMonth = Carbon::now()->format('Y-m');
        }else{
            $currentMonth = $month;
        }
        list($year, $monthNumber) = explode('-', $currentMonth);
        $department = Department::where('id', $this->id)->first();
        if($department->parent_id == null && $department->sub_departments->count() > 0){
        // dd($department);
            $subDepartments = Department::where('parent_id', $department->id)->pluck('id')->toArray();
            $employesIds = User::whereIn('department_id', $subDepartments)->where('role_id', 3)->pluck('id')->toArray();
        }else{
            $employesIds = User::where('department_id', $department->id)->where('role_id', 3)->pluck('id')->toArray();
        }
        $completedTasks = Task::whereIn('user_id', $employesIds)
            ->whereMonth('due_date', $monthNumber) // Filter by month from $currentMonth
            ->whereYear('due_date', $year)
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

        $department = Department::where('id', $this->id)->first();
        if($department->parent_id == null && $department->sub_departments->count() > 0){
            $subDepartments = Department::where('parent_id', $department->id)->pluck('id')->toArray();
            $employesIds = User::whereIn('department_id', $subDepartments)->where('role_id', 3)->pluck('id')->toArray();
        }else{
            $employesIds = User::where('department_id', $department->id)->where('role_id', 3)->pluck('id')->toArray();
        }

        $targetEntries =  Target::whereIn('user_id', $employesIds)->where('month', $currentMonth)->get();
        $target = 0;
        foreach($targetEntries as $targetEntry){
            $target = $target+$targetEntry->target;
        }
        $completedTasks = Task::whereIn('user_id', $employesIds)
        ->whereMonth('due_date', $monthNumber) // Filter by month from $currentMonth
        ->whereYear('due_date', $year) // Filter by year from $currentMonth
        ->whereIn('status', [1, 2, 3]) // Approved, Closed, Delayed
        ->count();
        

        if($completedTasks == 0){
            $progress =0;
            
        }else{
            if($target == 0){
                $allTasks = Task::whereIn('user_id', $employesIds)
                ->whereMonth('due_date', $monthNumber) // Filter by month from $currentMonth
                ->whereYear('due_date', $year) // Filter by year from $currentMonth
                ->whereIn('status', [1, 2, 3]) // Approved, Closed, Delayed
                ->get();
                
                $averageRating = $allTasks->avg('rating'); 
                $progress = $averageRating ?? 0; 
            }else{
            $progress = ($completedTasks / $target) * 100;
                
            }
            // dd($completedTasks / $target);
        }
        if($progress > 100){
            return 100;
        }else{
            return round($progress, 2);
        }
        
    }
}
