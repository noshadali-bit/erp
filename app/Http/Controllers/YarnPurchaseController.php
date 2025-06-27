<?php

namespace App\Http\Controllers;

use App\Models\YarnPurchaseOrder;
use App\Models\YarnPurchaseOrderItem;
use App\Models\Supplier;
use Illuminate\Http\Request;

class YarnPurchaseController extends Controller
{
    public function index()
    {
        $orders = YarnPurchaseOrder::with(['supplier', 'items'])->latest()->paginate(10);
        return view('yarn.purchase.index', compact('orders'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('yarn.purchase.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'order_date' => 'required|date',
            'expected_delivery_date' => 'required|date',  // Add this line
            'items.*.yarn_type' => 'required|string',
            'items.*.quantity' => 'required|numeric|min:0',
            'items.*.unit_price' => 'required|numeric|min:0'
        ]);

        $order = YarnPurchaseOrder::create([
            'supplier_id' => $request->supplier_id,
            'order_date' => $request->order_date,
            'expected_delivery_date' => $request->expected_delivery_date,  // Add this line
            'status' => 'pending'
        ]);

        foreach ($request->items as $item) {
            YarnPurchaseOrderItem::create([
                'yarn_purchase_order_id' => $order->id,
                'yarn_type' => $item['yarn_type'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price']
            ]);
        }

        return redirect()->route('yarn.purchase.index')->with('success', 'Purchase order created successfully');
    }
}