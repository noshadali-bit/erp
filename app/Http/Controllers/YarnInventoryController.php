<?php

namespace App\Http\Controllers;

use App\Models\YarnInventory;
use App\Models\YarnMovement;
use App\Models\Department;
use Illuminate\Http\Request;

class YarnInventoryController extends Controller
{
    public function index()
    {
        $inventory = YarnInventory::with('movements')->latest()->paginate(10);
        $departments = \App\Models\Department::all();
        return view('yarn.inventory.index', compact('inventory', 'departments'));
    }

    public function movement(Request $request)
    {
        $request->validate([
            'yarn_inventory_id' => 'required|exists:yarn_inventory,id',
            'department_id' => 'required|exists:departments,id',
            'quantity' => 'required|numeric',
            'movement_type' => 'required|in:in,out',
            'date' => 'required|date'
        ]);

        YarnMovement::create([
            'yarn_inventory_id' => $request->yarn_inventory_id,
            'department_id' => $request->department_id,
            'quantity' => $request->quantity,
            'movement_type' => $request->movement_type,
            'date' => $request->date
        ]);

        $inventory = YarnInventory::find($request->yarn_inventory_id);
        $inventory->quantity += ($request->movement_type == 'in' ? $request->quantity : -$request->quantity);
        $inventory->save();

        return redirect()->back()->with('success', 'Yarn movement recorded successfully');
    }

    public function history($id)
    {
        $movements = YarnMovement::with('department')
            ->where('yarn_inventory_id', $id)
            ->orderBy('date', 'desc')
            ->get();

        return view('yarn.inventory.history', compact('movements'));
    }
}