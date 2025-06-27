@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Create Dyeing Batch</h2>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('dyeing.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="yarn_inventory_id" class="form-label">Yarn Type</label>
                        <select name="yarn_inventory_id" id="yarn_inventory_id" class="form-control" required>
                            <option value="">Select Yarn</option>
                            @foreach($yarns as $yarn)
                                <option value="{{ $yarn->id }}">{{ $yarn->yarn_type }} (Stock: {{ $yarn->quantity }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="batch_number" class="form-label">Batch Number</label>
                        <input type="text" name="batch_number" id="batch_number" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="color" class="form-label">Color</label>
                        <input type="text" name="color" id="color" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="weight" class="form-label">Weight</label>
                        <input type="number" name="weight" id="weight" class="form-control" required min="0" step="0.01">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="expected_completion_date" class="form-label">Expected Completion Date</label>
                        <input type="date" name="expected_completion_date" id="expected_completion_date" class="form-control" required>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Create Batch</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection