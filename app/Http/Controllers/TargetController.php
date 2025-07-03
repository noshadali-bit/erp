<?php

namespace App\Http\Controllers;

use App\Models\Target;
use App\Models\User;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TargetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if($user->role_id == 2){
            if($user->department->parent_id == null && $user->department->sub_departments->count() > 0){
                $subDepartments = Department::where('parent_id', $user->department->id)->pluck('id')->toArray();
                $users = User::whereIn('department_id', $subDepartments)->where('role_id', 3)->pluck('id')->toArray();
                $targets = Target::whereIn('user_id',$users)->latest()->get();
            }else{
                $users = User::where('department_id', $user->department->id)->where('role_id', 3)->pluck('id')->toArray();
                $targets = Target::whereIn('user_id',$users)->latest()->get();
            }
          
        }else{
            $targets = Target::latest()->get();
        }
        return view('admin.target-management.list', compact('targets'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        if($user->role_id == 2){
             if($user->department->parent_id == null && $user->department->sub_departments->count() > 0){
                 $subDepartments = Department::where('parent_id', $user->department->id)->pluck('id')->toArray();
                 $users = User::whereIn('department_id', $subDepartments)->where('role_id', 3)->get();
             }else{
                $users = User::where('department_id', $user->department->id)->where('role_id', 3)->get();
             }
            

        }else{
            $users = User::where('role_id', 3)->get();
        }
        return View('admin.target-management.add',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $user = User::with('department')->find($request->user);

        if (!$user) {
            return redirect()->back()->withErrors(['user' => 'Selected user not found.'])->withInput();
        }
    
        // Base validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'sometimes',
            'month' => 'required|string|max:255',
            'target' => 'required|string|max:255',
            'user' => 'required|string',
        ];
    
        // Conditionally require 'approved_tasks' if department is 'design'
        if ($user->department && $user->department->slug === 'design') {
            $rules['approved_tasks'] = 'required|min:0';
        }
    
        // Run validation
        $validated = $request->validate($rules);
    
        $checkTarget = Target::where('user_id',$request->user)->where('month', $request->month)->first();
        if($checkTarget != null){
            return redirect()->back()->withErrors(['target' => 'A target for this user and month already exists.'])->withInput();
        }
        $description = str_replace(
            '<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>',
            '',
            $request->description
        );
        $blog =  Target::create([
            'name' => $request->name,
            'description' => $description,
            'month' => $request->month,
            'approved_tasks' => $request->approved_tasks,
            'target' => $request->target,
            'user_id' => $request->user,
        ]);
 
        Session::flash('message', 'Target created successfully!');

        return redirect()->route('targets.index');
    }
      
    /**
     * Display the specified resource.
     */
    public function show(Target $target)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Target $target)
    {
        $user = Auth::user();
        if($user->role_id == 2){
            if($user->department->parent_id == null && $user->department->sub_departments->count() > 0){
                 $subDepartments = Department::where('parent_id', $user->department->id)->pluck('id')->toArray();
                 $users = User::whereIn('department_id', $subDepartments)->where('role_id', 3)->get();
             }else{
                $users = User::where('department_id', $user->department->id)->where('role_id', 3)->get();
             }

        }else{
            $users = User::where('role_id', 3)->get();
        }
        return view('admin.target-management.edit', compact('target','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Target $target)
    {
        $current_plan = Target::where('id', $target->id)->first();
        $user = User::with('department')->find($request->user);

        if (!$user) {
            return redirect()->back()->withErrors(['user' => 'Selected user not found.'])->withInput();
        }
    
        // Base validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'sometimes',
            'month' => 'required|string|max:255',
            'target' => 'required|string|max:255',
            'user' => 'required|string',
        ];
    
        // Conditionally require 'approved_tasks' if department is 'design'
        if ($user->department && $user->department->slug === 'design') {
            $rules['approved_tasks'] = 'required|min:0';
        }
    
        // Run validation
        $validated = $request->validate($rules);
        
        
        // $current_plan = Target::where('id', $target->id)->first();
        // $validated = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'description' => 'sometimes',
        //     'month' => 'required|string|max:255',
        //     'target' => 'required|string|max:255',
        //     'user' => 'required|string',
        // ]);
        $description = str_replace(
            '<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>',
            '',
            $request->description
        );
        $course =  Target::where('id', $current_plan->id)->update([
            'name' => $request->name,
            'description' => $description,
            'month' => $request->month,
            'approved_tasks' => $request->approved_tasks,
            'target' => $request->target,
            'user_id' => $request->user,
        ]);
        
        Session::flash('message', 'Target Updated successfully!');

        return redirect()->route('targets.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Target $target)
    {
        $target->delete();
        Session::flash('message', 'Task Deleted successfully!');
        return redirect()->back();
    }
    public function status(Target $target)
    {
        $target->status = ($target->status == 1) ? 0 : 1;
        $target->save();
        $message = ($target->status == 1) ? 'Target Activated successfully!' : 'Target Suspended successfully!';
        Session::flash('message', $message);
        return redirect()->back();
    }
}
