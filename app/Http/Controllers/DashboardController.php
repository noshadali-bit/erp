<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Department;
use App\Models\Inquiry;
use App\Models\Subscribtion;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Nette\Utils\JsonException;

class DashboardController extends Controller
{
    public function dashboardpage()
    {
        $month = isset($_GET['month']) ? $_GET['month'] : Carbon::now()->format('Y-m');
        
        $user = Auth::user();
        if($user->role_id == 3){
            return redirect()->route('user-detail', $user->id);
        }
        if($user->role_id == 2){
            $departments = null; 
            $department = $user->department; 
            if($department){
                if($department->parent_id == null && $department->sub_departments->count() > 0){
                    $subDepartments = Department::where('parent_id', $department->id)->pluck('id')->toArray();
                    $users = User::whereIn('department_id', $subDepartments)->where('role_id', 3)->where('status', 1)->get();
                   if($users->count() == 0){
                        $users = User::where('role_id', 3)->where('department_id', $user->department_id)->get();    
                    }
                }else{
                    $users = User::where('department_id', $department->id)->where('role_id', 3)->where('status', 1)->get();
                   
                }
            }else{
                $users =null;
            }
        }else{
            $departments = Department::where('parent_id', null)->where('status', 1)->get();
            $users =null;
        }
        return view('admin.dashboard.index')->with(compact('departments','month','users','user'));
    }
    public function department_detail($slug)
    {
        $month = isset($_GET['month']) ? $_GET['month'] : Carbon::now()->format('Y-m');
        $department = Department::where('slug', $slug)->first();
        $employes = User::where('department_id', $department->id)->where('role_id', 3)->where('status', 1)->get();
        return view('admin.dashboard.department-detail')->with(compact('employes', 'department','month'));
    }
    public function user_detail($id)
    {
        $decryptedId = decrypt($id);
        $month = isset($_GET['month']) ? $_GET['month'] : Carbon::now()->format('Y-m');
        list($year, $monthNumber) = explode('-', $month);
        $employe = User::where('id', $decryptedId)->where('status', 1)->first();
        $tasks = Task::where('user_id', $decryptedId)
        ->whereMonth('due_date', $monthNumber)
        ->whereYear('due_date', $year)
        ->latest()
        ->get();
        return view('admin.dashboard.employe-detail')->with(compact('employe','month','tasks'));
    }
    public function inquiries()
    {
        $inquiries = Inquiry::latest()->get();
        return view('admin.inquiries-management.list')->with(compact('inquiries'));
    }
    public function inquiry_destroy($id)
    {
        $decryptedId = decrypt($id);
        $inquiry = Inquiry::where('id', $decryptedId)->first();
        if($inquiry){
            $inquiry->delete();
        }
        return redirect()->route('inquiries.index')->with('notify_success', 'Inquiry Deleted successfully.');
    }
    public function subscribtions()
    {
        $subscribtions = Subscribtion::latest()->get();
        return view('admin.subscribtions-management.list')->with(compact('subscribtions'));
    }
    public function subscribtions_suspend($id)
    {
        $decryptedId = decrypt($id);
        $subscribtion = Subscribtion::where('id', $decryptedId)->first();
        $subscribtion->status = ($subscribtion->status == 1) ? 0 : 1;
        $subscribtion->save();
        $message = ($subscribtion->status == 1) ? 'Subscribtion Activated successfully!' : 'Subscribtion Suspended successfully!';
        Session::flash('message', $message);
        return redirect()->back();
    }


 // ----------------------- Managers ----------------------- 


 public function managers_list()
 {
     $user = Auth::user();
     if($user->role_id == 2){
        $parentDepart = $user->department;
        $subDepartments = Department::where('parent_id',$parentDepart->id)->where('status', 1)->pluck('id')->toArray();
        $managers = User::where('role_id', 2)->whereIn('department_id', $subDepartments)->get();    
        // dd($managers);
     }else{
         
        $managers = User::where('role_id', 2)->get();
     }
    //  dd($user);
     return view('admin.users-management.manager-list')->with(compact('managers'));
 }

 public function managers_add()
 {
     $user = Auth::user();
     if($user->role_id == 2){
        $parentDepart = $user->department;
        $departments = Department::where('parent_id',$parentDepart->id)->where('status', 1)->get();
     }else{
        $departments = Department::where('status', 1)->get();
     }
    
    return view('admin.users-management.manager-add',compact('departments'));
 }
 public function managers_edit($id)
 {
    $decryptedId = decrypt($id);
    $manager = User::where('id',$decryptedId)->first();
    $user = Auth::user();
     if($user->role_id == 2){
        $parentDepart = $user->department;
        $departments = Department::where('parent_id',$parentDepart->id)->where('status', 1)->get();
     }else{
        $departments = Department::where('parent_id', null)->where('status', 1)->get();
     }
     return view('admin.users-management.manager-edit')->with(compact('manager','departments'));
 }
 public function managers_store(Request $request)
 {
     $validated = $request->validate([
         'name' => 'required|string|max:255',
         'email' => 'required|max:250|unique:users',
         'department' => 'required',
         'base_salary' => 'required',
         'password' => 'required|string|min:6|max:16',
         'image' => 'sometimes|image|mimes:jpg,jpeg,png,jfif|max:500',
     ]);

     $agent =  User::create([
         'name' => $request->name,
         'email' => $request->email,
         'department_id' => $request->department,
         'base_salary' => $request->base_salary,
         'password' => bcrypt($request->password),
         'role_id' => 2,
      
     ]);
     if($request->hasFile('image')) {
     $agent->addMediaFromRequest('image')
         ->toMediaCollection('thumbnail');
     }
     Session::flash('message', 'Manager created successfully!');

     return redirect()->route('managers_list')->with('notify_success', 'Manager Created successfully.');
 }
 public function managers_update(Request $request)
 {
     $manager = User::where('id', $request->id)->first();
     $validated = $request->validate([
         'name' => 'required|string|max:255',
         'email' => [
             'required',
             Rule::unique('users')->ignore($manager->id), // Ignore the current user's email
             'max:255',
         ],
         'base_salary' => 'required',
         'department' => 'required',
         'password' => 'nullable|string|min:6|max:16',
         'image' => 'sometimes|image|mimes:jpg,jpeg,png,jfif|max:500',
     ]);
     $upstudent =  User::where('id', $manager->id)->update([
         'name' => $request->name,
         'email' => $request->email,
         'department_id' => $request->department,
         'base_salary' => $request->base_salary,
         'role_id' => 2,
     ]);
  
     if (!empty($validated['password'])) {
        $manager->password = bcrypt($validated['password']);
        $manager->save();
    }

      if ($request->hasFile('image')) {
         $manager->clearMediaCollection('thumbnail');
         $manager->addMediaFromRequest('image')
         ->toMediaCollection('thumbnail');
     }
     Session::flash('message', 'Manager Updated successfully!');
     return redirect()->route('managers_list')->with('notify_success', 'Manager Updated successfully.');
 }
 public function managers_suspend($id)
 {
    $decryptedId = decrypt($id);
     $user = User::where('id', $decryptedId)->first();
     $user->status = ($user->status == 1) ? 0 : 1;
     $user->save();
     $message = ($user->status == 1) ? 'Manager Activated successfully!' : 'Manager Suspended successfully!';
     Session::flash('message', $message);
     return redirect()->back();
 }
 public function managers_extra_access($id)
 {
    $decryptedId = decrypt($id);
     $user = User::where('id', $decryptedId)->first();
     $user->extra_access = ($user->extra_access == 1) ? 0 : 1;
     $user->save();
     $message = ($user->extra_access == 1) ? 'Extra access added successfully!' : 'Extra access removed successfully!';
     Session::flash('message', $message);
     return redirect()->back();
 }

// ----------------------- Managers ----------------------- 


// ----------------------- Employs ----------------------- 


public function employes_list()
{
    $user = Auth::user();
    if($user->role_id == 2){
    // dd($user->department);
        if($user->department->parent_id == null && $user->department->sub_departments->count() > 0){
            $subDepartments = Department::where('parent_id', $user->department->id)->pluck('id')->toArray();

            $employes = User::where('role_id', 3)->whereIn('department_id', $subDepartments)->get();
            if($employes->count() == 0){
                $employes = User::where('role_id', 3)->where('department_id', $user->department_id)->get();    
            }
            
        }else{
            $employes = User::where('role_id', 3)->where('department_id', $user->department_id)->get();
        }
    }else{
        $employes = User::where('role_id', 3)->get();
    }
    return view('admin.users-management.employe-list')->with(compact('employes'));
}
public function employes_add()
{
   $departments = Department::where('status', 1)->get();
   return view('admin.users-management.employe-add',compact('departments'));
}
public function employes_edit($id)
{
    $decryptedId = decrypt($id);
   $employe = User::where('id',$decryptedId)->first();
   $departments = Department::where('status', 1)->get();
    return view('admin.users-management.employe-edit')->with(compact('employe','departments'));
}
public function employes_store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|max:250|unique:users',
        'department' => 'required',
        'password' => 'required|string|min:6|max:16',
        'image' => 'sometimes|image|mimes:jpg,jpeg,png,jfif|max:500',
    ]);
    
    $employe =  User::create([
        'name' => $request->name,
        'email' => $request->email,
        'department_id' => $request->department,
        'password' => bcrypt($request->password),
        'role_id' => 3,
        'base_salary' => $request->base_salary,
    ]);
    if($request->hasFile('image')) {
    $employe->addMediaFromRequest('image')
        ->toMediaCollection('thumbnail');
    }
    Session::flash('message', 'Employe created successfully!');

    return redirect()->route('employes_list')->with('notify_success', 'Employe Created successfully.');
}
public function employes_update(Request $request)
{
    $employe = User::where('id', $request->id)->first();
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => [
            'required',
            Rule::unique('users')->ignore($employe->id), // Ignore the current user's email
            'max:255',
        ],
        'department' => 'required',
        'password' => 'nullable|string|min:6|max:16',
        'image' => 'sometimes|image|mimes:jpg,jpeg,png,jfif|max:500',
    ]);
    $upstudent =  User::where('id', $employe->id)->update([
        'name' => $request->name,
        'email' => $request->email,
        'department_id' => $request->department,
        'role_id' => 3,
    ]);
 
    if (!empty($validated['password'])) {
       $employe->password = bcrypt($validated['password']);
       $employe->save();
   }

     if ($request->hasFile('image')) {
        $employe->clearMediaCollection('thumbnail');
        $employe->addMediaFromRequest('image')
        ->toMediaCollection('thumbnail');
    }
    Session::flash('message', 'Employe Updated successfully!');
    return redirect()->route('employes_list')->with('notify_success', 'Employe Updated successfully.');
}
public function employes_suspend($id)
{
    $decryptedId = decrypt($id);
    $user = User::where('id', $decryptedId)->first();
    $user->status = ($user->status == 1) ? 0 : 1;
    $user->save();
    $message = ($user->status == 1) ? 'Employe Activated successfully!' : 'Employe Suspended successfully!';
    Session::flash('message', $message);
    return redirect()->back();
}

// ----------------------- Employs ----------------------- 
   
    public function students_list()
    {
        $students = User::where('role_id', 3)->get();
        return view('admin.student-management.list')->with(compact('students'));
    }

    public function students_add()
    {
        $batches = Batch::where('is_active', 1)->get();
        return view('admin.student-management.add')->with(compact('batches'));
    }
    public function students_edit($id)
    {
        $decryptedId = decrypt($id);
        $batches = Batch::where('is_active', 1)->get();
        $student = User::where('id', $decryptedId)->first();
        return view('admin.student-management.edit')->with(compact('student', 'batches'));
    }
    public function students_store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:6|max:16',
            'phone' => 'required|string|max:50',
            'batch' => 'required',
            'pay_status' => 'required',
        ]);
        $student =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->phone,
            'password' => bcrypt($request->password),
            'role_id' => 3,
            'batch_id' => $request->batch,
            'pay_status' => ($request->pay_status == 'paid') ? 1 : 0,
            'fees_amount' => $request->fees_amount,
        ]);
        // $student->assignRole('Student');
        Session::flash('message', 'Stuent created successfully!');

        return redirect()->route('students_list')->with('notify_success', 'Student Created successfully.');
    }
    public function students_update(Request $request)
    {
        $student = User::where('id', $request->id)->first();
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'email' => [
                'required',
                Rule::unique('users')->ignore($student->id), // Ignore the current user's email
                'max:255',
            ],
            'phone' => 'required|string|max:50',
            'batch' => 'required',
            'pay_status' => 'required',
        ]);

        $upstudent =  User::where('id', $student->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->phone,
            'batch_id' => $request->batch,
            'pay_status' => ($request->pay_status == 'paid') ? 1 : 0,
            'fees_amount' => $request->fees_amount,
        ]);
        if ($request->password) {
            $pvalidated = $request->validate([
                'password' => 'string|min:6',
            ]);
            $student->password = bcrypt($request->password);
            $student->save();
        }

        Session::flash('message', 'Stuent Updated successfully!');
        return redirect()->route('students_list')->with('notify_success', 'Student Updated successfully.');
    }



    // Teachers

    public function teachers_list()
    {
        $teachers = User::where('role_id', 2)->get();
        return view('admin.teacher-management.list')->with(compact('teachers'));
    }

    public function teachers_add()
    {
        return view('admin.teacher-management.add');
    }
    public function teachers_edit($id)
    {
        $decryptedId = decrypt($id);
        $student = User::where('id', $decryptedId)->first();
        return view('admin.teacher-management.edit')->with(compact('student'));
    }
    public function teachers_store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'phone' => 'required|string|max:50',
            'email' => 'required|max:250|unique:users',
            'password' => 'required|string|min:6|max:8',
            'image' => 'required|image|mimes:jpg,jpeg,png,jfif|max:500',
        ]);

        $teacher =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->phone,
            'password' => bcrypt($request->password),
            'role_id' => 2,

        ]);
        // dd($request->image);

        $teacher->addMediaFromRequest('image')
            ->toMediaCollection('thumbnail');

        // $student->assignRole('Student');
        Session::flash('message', 'Teacher created successfully!');

        return redirect()->route('teachers_list')->with('notify_success', 'Teacher Created successfully.');
    }
    public function teachers_update(Request $request)
    {
        $student = User::where('id', $request->id)->first();
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'email' => [
                'required',
                Rule::unique('users')->ignore($student->id), // Ignore the current user's email
                'max:255',
            ],
            'phone' => 'required|string|max:50',
        ]);

        $upstudent =  User::where('id', $student->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->phone,

        ]);
        if ($request->password) {
            $pvalidated = $request->validate([
                'password' => 'string|min:6',
            ]);
            $student->password = bcrypt($request->password);
            $student->save();
        }

        Session::flash('message', 'Stuent Updated successfully!');
        return redirect()->route('teachers_list')->with('notify_success', 'Student Updated successfully.');
    }
    public function check_slug(Request $request)
    {
        $slug = Str::slug($request->name, '-');
        return response()->json(['slug' => $slug]);
    }

    public function students_status($id)
    {
        $decryptedId = decrypt($id);
        $user = User::where('id', $decryptedId)->first();
        $user->status = ($user->status == 1) ? 0 : 1;
        $user->save();
        $message = ($user->status == 1) ? 'user Activated successfully!' : 'user Suspended successfully!';
        Session::flash('message', $message);
        return redirect()->back();
    }
}
