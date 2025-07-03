<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Department;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
class TaskController extends Controller
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
            }else{
            $users = User::where('department_id', $user->department->id)->where('role_id', 3)->pluck('id')->toArray();
            }
            $tasks = Task::whereIn('user_id',$users)->latest()->get();
        }else{
            $tasks = Task::latest()->get();
        }
        return view('admin.task-management.list', compact('tasks'));
    }
    
    public function detail($id){
        $decryptedId = decrypt($id);
        $task = Task::where('id',$decryptedId)->first();
        $task->is_read = 1;
        $task->save();
        return view('admin.task-management.detail', compact('task'));
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
        return View('admin.task-management.add', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // dd($description);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required',
            'description' => 'required|string',
            'assign_date' => 'required|string|max:255',
            'due_date' => 'required|string|max:255',
            'user' => 'required|string',
        ]);
        $description = str_replace(
            '<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>',
            '',
            $request->description
        );
        $blog =  Task::create([
            'name' => $request->title,
            'type' => $request->type,
            'details' => $description,
            'assign_date' => $request->assign_date,
            'due_date' => $request->due_date,
            'user_id' => $request->user,
        ]);

        Session::flash('message', 'Task created successfully!');
        $user = Auth::user();
        if($user->role_id == 3){
            return redirect()->route('user-detail', $user->id)->with('notify_success', 'Task Created');
        }else{
            return redirect()->route('tasks.index');
        }
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
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
        return view('admin.task-management.edit', compact('task','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $current_plan = Task::where('id', $task->id)->first();
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required',
            'description' => 'required|string',
            'assign_date' => 'required|string|max:255',
            'due_date' => 'required|string|max:255',
            'user' => 'required|string',
        ]);
        $description = str_replace(
            '<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>',
            '',
            $request->description
        );

        $course =  Task::where('id', $current_plan->id)->update([
            'name' => $request->title,
            'type' => $request->type,
            'details' => $description,
            'assign_date' => $request->assign_date,
            'due_date' => $request->due_date,
            'user_id' => $request->user,
        ]);
        
        Session::flash('message', 'Task Updated successfully!');
        $user = Auth::user();
        if($user->role_id == 3){
            return redirect()->route('user-detail', $user->id)->with('notify_success', 'Task Updated');
        }else{
            return redirect()->route('tasks.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        Session::flash('message', 'Task Deleted successfully!');
        return redirect()->back();
    }
    public function deletess($id)
    {
        $decryptedId = decrypt($id);
        $task = Task::findOrFail($decryptedId);
        $task->delete();
        Session::flash('message', 'Task Deleted successfully!');
        return redirect()->back();
    }
    
    public function status(Request $request)
    {
        $validated = $request->validate([
            'taskid' => 'required',
            'status' => 'required',
        ]);
        $task = Task::where('id', $request->taskid)->first();
        // dd($task->user->department->slug == 'design');
        if($task->user->department->slug == 'design'){
            $updateOthertaskWithSameId = Task::where('name', $task->name)->update([
                'status' => 4,
            ]);
        }
        if($request->status == 4){
            $course =  Task::where('id', $request->taskid)->update([
                'status' => $request->status,
                'approval_status' => 0,
            ]);
        }else{
           $course =  Task::where('id', $request->taskid)->update([
                'status' => $request->status,
                'approval_status' => 1,
                'is_read' => 1,
            ]); 
        }
        
        Session::flash('message', 'Task Status Changed Successfully');
        return redirect()->back();
    }
    
    public function bulkApprove(Request $request)
    {
        $ids = explode(',', $request->selectedids);
    
        // Optional: validate that these IDs exist
        Task::whereIn('id', $ids)->where('status', 0)->update(['status' => 1]); // Example: 2 = Closed - Approved
        Session::flash('message', 'All task Approved Successfully');
        return redirect()->route('tasks.index')->with('notify_success', 'Selected tasks have been approved.');
    }   
    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1,2,3,4,5',
        ]);
    
        $task = Task::findOrFail($id);
        $task->status = $request->status;
        $task->save();
    
        return response()->json(['message' => 'Status updated successfully.']);
    }
    public function updateRating(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|string',
        ]);
    
        $task = Task::findOrFail($id);
        $task->rating = $request->rating;
        if($task->status == 0){
            $task->status = 1;
        }
        $task->save();
    
        return redirect()->back()->with('notify_success', 'Rating Updated successfully.');
    }
    
}
