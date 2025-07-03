<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ConfigController extends Controller
{
    public function index()
    {
        $configs = Config::all();
        return view('admin.configs.index', compact('configs'));
    }

    public function edit()
    {
        $configs = Config::all();
        return view('admin.configs.edit', compact('configs'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'office_start_time' => 'required|date_format:H:i',
            'office_end_time' => 'required|date_format:H:i|after:office_start_time'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // Handle logo upload if provided
        if ($request->hasFile('site_logo')) {

            $configLogo = Config::where('flag_key', 'site_logo')->first();

            if (!$configLogo) {
                $configLogo = Config::create(['flag_key' => 'site_logo', 'flag_value' => '']);
            }
    
            $configLogo->clearMediaCollection('site_logo');
            $configLogo->addMediaFromRequest('site_logo')->toMediaCollection('site_logo');
        }

        // Update office timings
        Config::setConfig('office_start_time', $request->office_start_time);
        Config::setConfig('office_end_time', $request->office_end_time);

        return redirect()->route('configs.index')
            ->with('success', 'Settings updated successfully');
    }
}