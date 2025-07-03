<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderBy('created_at', 'desc')->get();
        return view('admin.brand-management.list', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand-management.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $validated = $request->validate([  
            'name' => 'required|unique:brands|string|max:255',
            'url' => 'required|string|max:255',
            
        ]);
        $brand =  Brand::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'url' => $request->url,
        ]);

        Session::flash('message', 'Brand created successfully!');

        return redirect()->route('brands.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        $decryptedId = decrypt($brand);
        $brand = Brand::where('id', $decryptedId)->first();
        // dd($quiz->questions);
        return view('admin.brand-management.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $decryptedId = decrypt($brand);
        $validated = $request->validate([
            'name' => [
                'required',
                Rule::unique('brands')->ignore($decryptedId),
                'max:255',
            ],
            'url' => 'required|string|max:255',
        ]);

        $upquiz = Brand::where('id', $decryptedId)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'url' => $request->url,
        ]);
        Session::flash('message', 'Brand Updated successfully!');

        return redirect()->route('brands.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        Session::flash('message', 'Brand Deleted successfully!');
        return redirect()->back();
    }

    public function suspend($id)
    {
        $decryptedId = decrypt($id);
        $brand = Brand::where('id', $decryptedId)->first();
        $brand->status = ($brand->status == 1) ? 0 : 1;
        $brand->save();
        $message = ($brand->status == 1) ? 'Brand Activated successfully!' : 'Brand Suspended successfully!';
        Session::flash('message', $message);
        return redirect()->back();
    }
}
