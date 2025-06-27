@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Suppliers</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('suppliers.create') }}" class="btn btn-primary">Add New Supplier</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Contact Person</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->contact }}</td>
                        <td>{{ $supplier->phone }}</td>
                        <td>{{ $supplier->email }}</td>
                        <td>
                            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-sm btn-info">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $suppliers->links() }}
        </div>
    </div>
</div>
@endsection