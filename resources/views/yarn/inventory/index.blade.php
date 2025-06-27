@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Yarn Inventory</h2>
        </div>
        <div class="col-md-6 text-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#movementModal">
                Record Movement
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Yarn Type</th>
                        <th>Current Stock</th>
                        <th>Last Movement</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventory as $item)
                    <tr>
                        <td>{{ $item->yarn_type }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->movements->last()?->date ?? 'N/A' }}</td>
                        <td>{{ $item->movements->last()?->department->name ?? 'N/A' }}</td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="viewHistory({{ $item->id }})">History</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $inventory->links() }}
        </div>
    </div>
</div>

<!-- Movement Modal -->
<div class="modal fade" id="movementModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Record Yarn Movement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('yarn.inventory.movement') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="yarn_inventory_id" class="form-label">Yarn Type</label>
                        <select name="yarn_inventory_id" id="yarn_inventory_id" class="form-control" required>
                            <option value="">Select Yarn</option>
                            @foreach($inventory as $item)
                                <option value="{{ $item->id }}">{{ $item->yarn_type }} (Current: {{ $item->quantity }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="department_id" class="form-label">Department</label>
                        <select name="department_id" id="department_id" class="form-control" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="movement_type" class="form-label">Movement Type</label>
                        <select name="movement_type" id="movement_type" class="form-control" required>
                            <option value="in">In</option>
                            <option value="out">Out</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" required min="0">
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date" id="date" class="form-control" required value="{{ date('Y-m-d') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Movement</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- History Modal -->
<div class="modal fade" id="historyModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Movement History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="historyContent">
                Loading...
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function viewHistory(id) {
    const modal = new bootstrap.Modal(document.getElementById('historyModal'));
    modal.show();
    
    fetch(`/yarn/inventory/${id}/history`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('historyContent').innerHTML = html;
        });
}
</script>
@endpush
@endsection