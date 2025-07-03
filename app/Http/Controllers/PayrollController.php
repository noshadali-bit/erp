<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\user;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayrollController extends Controller
{
    public function processSalaries(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $month = $request->month;
            $salaries = $request->salaries;
            
            foreach ($salaries as $salaryData) {
                $salary = Salary::where('user_id', $salaryData['user_id'])
                    ->whereYear('month_year', date('Y', strtotime($month)))
                    ->whereMonth('month_year', date('m', strtotime($month)))
                    ->first();
                
                if (!$salary) {
                    $salary = new Salary();
                    $salary->user_id = $salaryData['user_id'];
                    $salary->month_year = date('Y-m-d', strtotime($month));
                }
                
                $salary->net_salary = $salaryData['amount'];
                $salary->save();
            }
            
            DB::commit();
            return response()->json(['success' => true]);
            
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function index()
    {
        return view('admin.payroll.index');
    }

    public function getMonthlyPayroll(Request $request)
    {
        $month = $request->month;
        $users = user::where('is_active', true)->get();
        $payrollData = [];

        foreach ($users as $user) {
            $workingDays = date('t', strtotime($month));
            
            $presentDays = Attendance::where('user_id', $user->id)
                ->whereYear('date', date('Y', strtotime($month)))
                ->whereMonth('date', date('m', strtotime($month)))
                ->where('status', 'present')
                ->count();

            $absentDays = Attendance::where('user_id', $user->id)
                ->whereYear('date', date('Y', strtotime($month)))
                ->whereMonth('date', date('m', strtotime($month)))
                ->where('status', 'absent')
                ->count();

            $perDaySalary = $user->base_salary / $workingDays;
            $earnedSalary = $perDaySalary * $presentDays;

            // Get existing salary record if any
            $salary = Salary::where('user_id', $user->id)
                ->whereYear('month_year', date('Y', strtotime($month)))
                ->whereMonth('month_year', date('m', strtotime($month)))
                ->first();

            $deductions = $salary ? $salary->deductions : 0;
            $bonus = $salary ? $salary->bonus : 0;
            $netSalary = $earnedSalary + $bonus - $deductions;

            $payrollData[] = [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'designation' => $user->designation,
                'base_salary' => $user->base_salary,
                'present_days' => $presentDays,
                'absent_days' => $absentDays,
                'total_days' => $workingDays,
                'deductions' => $deductions,
                'bonus' => $bonus,
                'net_salary' => $netSalary,
                'month' => date('Y-m', strtotime($month)),
            ];
        }

        return response()->json($payrollData);
    }
}