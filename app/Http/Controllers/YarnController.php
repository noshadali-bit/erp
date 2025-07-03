<?php

namespace App\Http\Controllers;

use App\Models\YarnPurchaseOrder;
use App\Models\Supplier;
use Illuminate\Http\Request;

class YarnController extends Controller
{
    public function index()
    {
        $orders = YarnPurchaseOrder::all();
        return view('yarn.index', compact('orders'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('yarn.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $order = YarnPurchaseOrder::create($request->all());
        return redirect()->route('yarn.index');
    }
}