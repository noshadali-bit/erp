<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\user;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SalaryController extends Controller
{
    public function getuserBaseSalary($id)
    {
        // $decryptedId = decrypt($id);
        $user = user::find($id);
        return response()->json(['base_salary' => $user->base_salary]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salaries = Salary::with('user')->latest()->get();
        return view('admin.salaries.index', compact('salaries'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = user::all();
        return view('admin.salaries.create', compact('users'));
    }

    public function monthly()
    {
        $users = user::all();
        return view('admin.salaries.monthly-salary', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'month' => 'required|date_format:Y-m',
            'base_salary' => 'required|numeric|min:0',
            'allowances' => 'nullable|numeric|min:0',
            'deductions' => 'nullable|numeric|min:0',
            'remarks' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Calculate attendance based salary
        $month = $request->month;
        $workingDays = date('t', strtotime($month));
        
        $absentDays = Attendance::where('user_id', $request->user_id)
            ->whereYear('date', date('Y', strtotime($month)))
            ->whereMonth('date', date('m', strtotime($month)))
            ->where('status', 'absent')
            ->count();
            
        $perDaySalary = $request->base_salary / $workingDays;
        $earnedSalary = $perDaySalary * $absentDays;

        $totalSalary = $request->base_salary - $earnedSalary;
        $totalSalary = $totalSalary + ($request->allowances ?? 0) - ($request->deductions ?? 0);

        $presentDays = Attendance::where('user_id', $request->user_id)
        ->whereYear('date', date('Y', strtotime($month)))
        ->whereMonth('date', date('m', strtotime($month)))
        ->where('status', 'present')
        ->count();
        Salary::create([
            'user_id' => $request->user_id,
            'month_year' => date('Y-m-d', strtotime($request->month . '-01')),
            'base_salary' => $request->base_salary,
            'total_days' => ($presentDays + $absentDays),
            'present_days' => $presentDays,
            'absent_days' => $absentDays,
            'leave_days' => 0,
            'deductions' => $request->deductions ?? 0,
            'bonus' => $request->allowances ?? 0,
            'net_salary' => $totalSalary
        ]);

        return redirect()->route('salaries.index')
            ->with('success', 'Salary processed successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $decryptedId = decrypt($id);
        $salary = Salary::with('user')->findOrFail($decryptedId);
        return view('admin.salaries.show', compact('salary'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $decryptedId = decrypt($id);
        $salary = Salary::findOrFail($decryptedId);
        $users = user::all();
        return view('admin.salaries.edit', compact('salary', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $decryptedId = decrypt($id);
        $salary = Salary::findOrFail($decryptedId);

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'month' => 'required|date_format:Y-m',
            'base_salary' => 'required|numeric|min:0',
            'allowances' => 'nullable|numeric|min:0',
            'deductions' => 'nullable|numeric|min:0',
            'remarks' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Recalculate attendance based salary
        $month = $request->month;
        $workingDays = date('t', strtotime($month));
        
        $presentDays = Attendance::where('user_id', $request->user_id)
            ->whereYear('date', date('Y', strtotime($month)))
            ->whereMonth('date', date('m', strtotime($month)))
            ->where('status', 'present')
            ->count();

        $perDaySalary = $request->base_salary / $workingDays;
        $earnedSalary = $perDaySalary * $presentDays;
        
        $totalSalary = $earnedSalary + ($request->allowances ?? 0) - ($request->deductions ?? 0);

        $salary->update([
            'user_id' => $request->user_id,
            'month' => $request->month,
            'base_salary' => $request->base_salary,
            'allowances' => $request->allowances,
            'deductions' => $request->deductions,
            'working_days' => $workingDays,
            'present_days' => $presentDays,
            'total_salary' => $totalSalary,
            'remarks' => $request->remarks
        ]);

        return redirect()->route('salaries.index')
            ->with('success', 'Salary updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $decryptedId = decrypt($id);
        $salary = Salary::findOrFail($decryptedId);
        $salary->delete();

        return redirect()->route('salaries.index')
            ->with('success', 'Salary record deleted successfully');
    }

    public function storeBulkSalaries(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'salaries' => 'required|array',
            'salaries.*.user_id' => 'required|exists:users,id',
            'salaries.*.month' => 'required|date_format:Y-m',
            'salaries.*.base_salary' => 'required|numeric|min:0',
            'salaries.*.present_days' => 'required|integer|min:0',
            'salaries.*.absent_days' => 'required|integer|min:0',
            'salaries.*.net_salary' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            foreach ($request->salaries as $salaryData) {
                Salary::create([
                    'user_id' => $salaryData['user_id'],
                    'month_year' => date('Y-m-d', strtotime($salaryData['month'] . '-01')),
                    'base_salary' => $salaryData['base_salary'],
                    'total_days' => $salaryData['present_days'] + $salaryData['absent_days'],
                    'present_days' => $salaryData['present_days'],
                    'absent_days' => $salaryData['absent_days'],
                    'leave_days' => 0,
                    'deductions' => 0,
                    'bonus' => 0,
                    'net_salary' => $salaryData['net_salary']
                ]);
            }

            DB::commit();
            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error saving salaries'], 500);
        }
    }

    public function calculateMonthlySalary(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'month' => 'required|date_format:Y-m'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = user::find($request->user_id);
        $month = $request->month;
        $workingDays = date('t', strtotime($month));
        $presentDays = Attendance::where('user_id', $request->user_id)
            ->whereYear('date', date('Y', strtotime($month)))
            ->whereMonth('date', date('m', strtotime($month)))
            ->where('status', 'present')
            ->count();
        
        $absentDays = Attendance::where('user_id', $request->user_id)
            ->whereYear('date', date('Y', strtotime($month)))
            ->whereMonth('date', date('m', strtotime($month)))
            ->where('status', 'absent')
            ->count();

        $perDaySalary = $user->base_salary / $workingDays;
        $earnedSalary = $perDaySalary * $presentDays;
        
        return response()->json([
            'base_salary' => $user->base_salary,
            'working_days' => $workingDays,
            'present_days' => $presentDays,
            'absent_days' => $absentDays,
            'per_day_salary' => round($perDaySalary, 2),
            'earned_salary' => round($earnedSalary, 2)
        ]);
    }
}
