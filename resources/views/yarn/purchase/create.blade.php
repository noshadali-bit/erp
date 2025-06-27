@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Create Purchase Order</h2>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('yarn.purchase.store') }}" method="POST" id="purchaseForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="supplier_id" class="form-label">Supplier</label>
                        <select name="supplier_id" id="supplier_id" class="form-control" required>
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="order_date" class="form-label">Order Date</label>
                        <input type="date" name="order_date" id="order_date" class="form-control" required>
                    </div>
                </div>

                <div id="items">
                    <div class="item-row row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Yarn Type</label>
                            <input type="text" name="items[0][yarn_type]" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" name="items[0][quantity]" class="form-control" required min="0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Unit Price</label>
                            <input type="number" name="items[0][unit_price]" class="form-control" required min="0" step="0.01">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <button type="button" class="btn btn-secondary" id="addItem">Add Item</button>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Create Purchase Order</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    let itemCount = 1;
    document.getElementById('addItem').addEventListener('click', function() {
        const itemsDiv = document.getElementById('items');
        const newRow = document.createElement('div');
        newRow.className = 'item-row row mb-3';
        newRow.innerHTML = `
            <div class="col-md-4">
                <label class="form-label">Yarn Type</label>
                <input type="text" name="items[${itemCount}][yarn_type]" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Quantity</label>
                <input type="number" name="items[${itemCount}][quantity]" class="form-control" required min="0">
            </div>
            <div class="col-md-3">
                <label class="form-label">Unit Price</label>
                <input type="number" name="items[${itemCount}][unit_price]" class="form-control" required min="0" step="0.01">
            </div>
            <div class="col-md-2">
                <label class="form-label">&nbsp;</label>
                <button type="button" class="btn btn-danger form-control remove-item">Remove</button>
            </div>
        `;
        itemsDiv.appendChild(newRow);
        itemCount++;

        newRow.querySelector('.remove-item').addEventListener('click', function() {
            newRow.remove();
        });
    });
</script>
@endpush