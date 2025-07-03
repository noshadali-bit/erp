<?php

namespace App\Http\Controllers;

use App\Models\DyeingBatch;
use App\Models\YarnInventory;
use Illuminate\Http\Request;

class DyeingBatchController extends Controller
{
    public function index()
    {
        $batches = DyeingBatch::with(['yarnInventory'])->latest()->paginate(10);
        return view('dyeing.index', compact('batches'));
    }

    public function create()
    {
        $yarns = YarnInventory::all();
        return view('dyeing.create', compact('yarns'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'yarn_inventory_id' => 'required|exists:yarn_inventory,id',
            'batch_number' => 'required|string|unique:dyeing_batches,batch_number',
            'color' => 'required|string',
            'weight' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'expected_completion_date' => 'required|date|after:start_date'
        ]);

        DyeingBatch::create([
            'yarn_inventory_id' => $request->yarn_inventory_id,
            'batch_number' => $request->batch_number,
            'color' => $request->color,
            'weight' => $request->weight,
            'start_date' => $request->start_date,
            'expected_completion_date' => $request->expected_completion_date,
            'status' => 'pending'
        ]);

        return redirect()->route('dyeing.index')->with('success', 'Dyeing batch created successfully');
    }

    public function updateStatus(Request $request, DyeingBatch $batch)
    {
        $request->validate([
            'status' => 'required|in:pending,in_process,completed,failed'
        ]);

        $batch->update([
            'status' => $request->status,
            'completion_date' => $request->status === 'completed' ? now() : null,
            'notes' => $request->notes
        ]);

        return redirect()->back()->with('success', 'Batch status updated successfully');
    }
}