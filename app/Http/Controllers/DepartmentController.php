<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('department.index', compact('departments'));
    }

    public function store(Request $request)
    {
        Department::create($request->all());
        return redirect()->back();
    }
}