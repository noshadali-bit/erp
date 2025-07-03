@extends('admin.layouts.simple.master')
@section('title', 'Process Salary')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Process Salary</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Process Salary</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row second-chart-list third-news-update">
        <div class="col-xl-12 xl-100 dashboard-sec box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Process Salary</h5>
                </div>
                <form class="form theme-form bold-labels" action="{{ route('salaries.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="col-form-label">user</label>
                                            <select name="user_id" id="user_id" class="form-control" required>
                                                <option value="">Select user</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }} - {{ $user->designation }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="col-form-label">Month</label>
                                            <input type="month" name="month" id="month" value="{{ old('month', date('Y-m')) }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="col-form-label">Base Salary</label>
                                            <input type="number" name="base_salary" id="base_salary" value="{{ old('base_salary') }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="col-form-label">Allowances</label>
                                            <input type="number" name="allowances" id="allowances" value="{{ old('allowances', 0) }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="col-form-label">Deductions</label>
                                            <input type="number" name="deductions" id="deductions" value="{{ old('deductions', 0) }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="col-form-label">Remarks</label>
                                            <textarea name="remarks" id="remarks" class="form-control" rows="3">{{ old('remarks') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary" type="submit">Process Salary</button>
                            <a href="{{ route('salaries.index') }}" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('user_id').addEventListener('change', function() {
        const userId = this.value;
        const baseSalaryField = document.getElementById('base_salary');
        
        if (userId) {
            fetch(`/user/${userId}/base-salary`)
                .then(response => response.json())
                .then(data => {
                    baseSalaryField.value = data.base_salary;
                })
                .catch(error => console.error('Error:', error));
        } else {
            baseSalaryField.value = '';
        }
    });
</script>
@endpush

@endsection