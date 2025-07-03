<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = user::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:20',
            'designation' => 'required|string|max:100',
            'base_salary' => 'required|numeric|min:0',
            'address' => 'nullable|string',
            'joining_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        user::create($request->all());

        return redirect()->route('users.index')
            ->with('success', 'user added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $decryptedId = decrypt($id);
        $user = user::findOrFail($decryptedId);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $decryptedId = decrypt($id);
        $user = user::findOrFail($decryptedId);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $decryptedId = decrypt($id);
        $user = user::findOrFail($decryptedId);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string|max:20',
            'designation' => 'required|string|max:100',
            'base_salary' => 'required|numeric|min:0',
            'address' => 'nullable|string',
            'joining_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->update($request->all());

        return redirect()->route('users.index')
            ->with('success', 'user updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $decryptedId = decrypt($id);
        $user = user::findOrFail($decryptedId);
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'user deleted successfully');
    }
    public function auth(Request $request)
    {
        //return $request;
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('dashboard'));
        }
    }
}
