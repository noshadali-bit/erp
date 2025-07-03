<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailData;
use App\Models\Brand;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class EmailDataController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->only(['name', 'brand_id']);
        $query = EmailData::with('brand');

        if (isset($search['name'])) {
            $query->where('name', 'like', '%' . $search['name'] . '%');
        }

        if (isset($search['brand_id']) && $search['brand_id'] !== '') {
            $query->where('brand_id', $search['brand_id']);
        }

        $emailData = $query->get();
        $brands = Brand::all();
        return view('admin.email-management.index', compact('emailData', 'brands', 'search'));
    }

    public function create()
    {
        $brands = Brand::all();
        return view('admin.email-management.create', compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'domain_name' => 'required',
            'brand_id' => 'required|exists:brands,id',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        EmailData::create($request->all());
        return redirect()->route('email-management.index')
            ->with('success', 'Email data created successfully.');
    }

    public function edit($id)
    {
        $emailData = EmailData::where('id', $id)->first();
        $brands = Brand::all();
        return view('admin.email-management.edit', compact('emailData', 'brands'));
    }

    public function update(Request $request, $id)
    {
        $emailData = EmailData::where('id', $id)->first();
        $request->validate([
            'name' => 'required',
            'domain_name' => 'required',
            'brand_id' => 'required|exists:brands,id',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $emailData->update($request->all());
        Session::flash('message', 'Email updated successfully');
        return redirect()->route('email-management.index')
            ->with('success', 'Email data updated successfully.');
    }

    public function destroy($id)
    {
        $emailData = EmailData::where('id', $id)->first();
        // dd($emailData);
        $emailData->delete();
        Session::flash('message', 'Email Deleted');
        return redirect()->back();
    }
}