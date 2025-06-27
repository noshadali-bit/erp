@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Dyeing Batches</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('dyeing.create') }}" class="btn btn-primary">Create New Batch</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Batch Number</th>
                        <th>Yarn Type</th>
                        <th>Color</th>
                        <th>Weight</th>
                        <th>Start Date</th>
                        <th>Expected Completion</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($batches as $batch)
                    <tr>
                        <td>{{ $batch->batch_number }}</td>
                        <td>{{ $batch->yarnInventory->yarn_type }}</td>
                        <td>{{ $batch->color }}</td>
                        <td>{{ $batch->weight }}</td>
                        <td>{{ $batch->start_date }}</td>
                        <td>{{ $batch->expected_completion_date }}</td>
                        <td>
                            <span class="badge bg-{{ $batch->status === 'completed' ? 'success' : ($batch->status === 'failed' ? 'danger' : 'warning') }}">
                                {{ ucfirst($batch->status) }}
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#statusModal{{ $batch->id }}">Update Status</button>
                        </td>
                    </tr>

                    <!-- Status Update Modal -->
                    <div class="modal fade" id="statusModal{{ $batch->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update Batch Status</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('dyeing.update-status', $batch) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="pending" {{ $batch->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="in_process" {{ $batch->status === 'in_process' ? 'selected' : '' }}>In Process</option>
                                                <option value="completed" {{ $batch->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="failed" {{ $batch->status === 'failed' ? 'selected' : '' }}>Failed</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="notes" class="form-label">Notes</label>
                                            <textarea name="notes" id="notes" class="form-control" rows="3">{{ $batch->notes }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update Status</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
            {{ $batches->links() }}
        </div>
    </div>
</div>
@endsection