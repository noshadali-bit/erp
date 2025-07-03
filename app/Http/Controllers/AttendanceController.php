<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $attendances = Attendance::with('user')->latest()->paginate(10);
        $attendances = Attendance::with('user')->latest()->get();
        return view('admin.attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.attendances.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,leave',
            'check_in' => 'required_if:status,present|nullable|date_format:H:i',
            'check_out' => 'required_if:status,present|nullable|date_format:H:i|after:check_in',
            'remarks' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = $request->all();
        if ($data['status'] === 'absent' || $data['status'] === 'leave') {
            $data['check_in'] = Carbon::now()->format('Y-m-d H:m:i');
            $data['check_out'] = null;
        }
        Attendance::create($data);

        return redirect()->route('attendances.index')
            ->with('success', 'Attendance recorded successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attendance = Attendance::with('user')->findOrFail($id);
        return view('admin.attendances.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $users = User::all();
        return view('admin.attendances.edit', compact('attendance', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $attendance = Attendance::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,leave',
            'check_in' => 'required_if:status,present|nullable|date_format:H:i',
            'check_out' => 'required_if:status,present|nullable|date_format:H:i|after:check_in',
            'remarks' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $attendance->update($request->all());

        return redirect()->route('attendances.index')
            ->with('success', 'Attendance updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return redirect()->route('attendances.index')
            ->with('success', 'Attendance deleted successfully');
    }

    /**
     * Show the form for bulk attendance.
     */
    public function bulkCreate()
    {
        $users = User::all();
        return view('admin.attendances.bulk', compact('users'));
    }

    /**
     * Store bulk attendance records.
     */
    public function bulkStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'users' => 'required|array',
            'users.*' => 'exists:users,id',
            'status' => 'required|array',
            'status.*' => 'required|in:present,absent'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $date = $request->date;
        $users = $request->users;
        $statuses = $request->status;

        foreach ($users as $userId) {
            $data = [
                'user_id' => $userId,
                'date' => $date,
                'status' => $statuses[$userId],
                'check_in' => $statuses[$userId] === 'present' ? '09:00' : null,
                'check_out' => null,
                'remarks' => null
            ];

            Attendance::create($data);
        }

        return redirect()->route('attendances.index')
            ->with('success', 'Bulk attendance recorded successfully');
    }
}
