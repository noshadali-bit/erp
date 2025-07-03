<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if($user->role_id == 2){
            $departments = Department::where('parent_id', $user->department_id)->orderBy('created_at', 'desc')->get();
        }else{
            $departments = Department::orderBy('created_at', 'desc')->get();
        }
        return view('admin.department-management.list', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        if($user->role_id == 2){
            $departments = Department::where('id', $user->department_id)->get();
        }else{
            $departments = Department::where('parent_id',null)->get();
        }
        
        return view('admin.department-management.add',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:departments|string|max:255',
        ]);
        $blog =  Department::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name, '-'),
        ]);

        Session::flash('message', 'Department created successfully!');

        return redirect()->route('departments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        $department = Department::where('id', $department->id)->first();
        $user = Auth::user();
        if($user->role_id == 2){
            $departments = Department::where('id', $user->department_id)->get();
        }else{
            $departments = Department::where('parent_id',null)->get();
        }
        // dd($quiz->questions);
        return view('admin.department-management.edit', compact('department','departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                Rule::unique('departments')->ignore($department->id),
                'max:255',
            ],
        ]);

        $upquiz = Department::where('id', $department->id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name, '-'),
        ]);
        Session::flash('message', 'Department Updated successfully!');

        return redirect()->route('departments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        Session::flash('message', 'Dsepartment Deleted successfully!');
        return redirect()->back();
    }
    public function suspend($id)
    {
        $decryptedId = decrypt($id);
        $department = Department::where('id', $decryptedId)->first();
        $department->status = ($department->status == 1) ? 0 : 1;
        $department->save();
        $message = ($department->status == 1) ? 'Department Activated successfully!' : 'Department Suspended successfully!';
        Session::flash('message', $message);
        return redirect()->back();
    }
}
