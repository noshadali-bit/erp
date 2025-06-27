@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Yarn Purchase Orders</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('yarn.purchase.create') }}" class="btn btn-primary">Create New Order</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Supplier</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Total Items</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->supplier->name }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ $order->items->count() }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection