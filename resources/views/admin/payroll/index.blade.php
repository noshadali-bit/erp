@extends('admin.layouts.simple.master')
@section('title', 'Monthly Payroll')

@section('css')
@endsection

@section('style')
<style>
    div .action {
        display: flex;
    }

    div .action i {
        font-size: 16px;
    }

    .modal {
        z-index: 10;
    }

    .modal-backdrop {
        z-index: 9;
    }
</style>
@endsection

@section('breadcrumb-title')
<h3>Monthly Payroll</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Payroll</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header align-items-center card-header d-flex justify-content-between">
                    <h5>Payroll Records</h5>
                    <div class="d-flex gap-3">
                        <div class="form-group mb-0">
                            <input type="month" id="month" name="month" class="form-control" value="{{ date('Y-m') }}">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display" id="keytable">
                            <thead>
                                <tr>
                                    <th class="table_id">#</th>
                                    <th>user</th>
                                    <th>Designation</th>
                                    <th>Month</th>
                                    <th>Base Salary</th>
                                    <th>Present Days</th>
                                    <th>Absent Days</th>
                                    <th>Bonus</th>
                                    <th>Deductions</th>
                                    <th>Net Salary</th>
                                </tr>
                            </thead>
                            <tbody id="payrollTable">
                                <tr>
                                    <td colspan="10" class="text-center">Please select a month to view payroll details</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function formatCurrency(amount) {
    return new Intl.NumberFormat('en-IN', {
        style: 'currency',
        currency: 'PKR'
    }).format(amount);
}

function formatMonth(dateString) {
    const date = new Date(dateString);
    return date.toLocaleString('en-US', { month: 'long', year: 'numeric' });
}

function loadPayrollData() {
    const month = document.getElementById('month').value;
    fetch(`/admin/payroll/monthly?month=${month}`)
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('payrollTable');
            tbody.innerHTML = '';
            
            data.forEach((row, index) => {
                tbody.innerHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${row.user_name}</td>
                        <td>${row.designation}</td>
                        <td>${formatMonth(row.month)}</td>
                        <td>${formatCurrency(row.base_salary)}</td>
                        <td>${row.present_days}</td>
                        <td>${row.absent_days}</td>
                        <td>${formatCurrency(row.bonus)}</td>
                        <td>${formatCurrency(row.deductions)}</td>
                        <td>${formatCurrency(row.net_salary)}</td>
                    </tr>
                `;
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

document.getElementById('month').addEventListener('change', loadPayrollData);

// Load initial data
loadPayrollData();
</script>
@endpush
@endsection