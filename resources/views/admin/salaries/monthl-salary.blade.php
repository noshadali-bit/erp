@extends('admin.layouts.simple.master')
@section('title', 'Monthly Payroll')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Monthly Payroll</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Monthly Payroll</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row second-chart-list third-news-update">
        <div class="col-xl-12 xl-100 dashboard-sec box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Monthly Payroll</h5>
                </div>
                <form id="salaryForm" class="salary-form">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="col-form-label">Select Month</label>
                                    <input type="month" id="month" name="month" class="form-control" value="{{ date('Y-m') }}">
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>user</th>
                                        <th>Designation</th>
                                        <th>Month</th>
                                        <th>Base Salary</th>
                                        <th>Present Days</th>
                                        <th>Absent Days</th>
                                        <th>Bonus</th>
                                        <th>Deductions</th>
                                        <th>Net Salary</th>
                                        <th>Pay Salary</th>
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
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">Add Salary</button>
                    </div>
                </form>
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

document.getElementById('salaryForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const salaryInputs = document.querySelectorAll('.salary-input');
    const salaryData = [];
    
    salaryInputs.forEach(input => {
        salaryData.push({
            user_id: input.dataset.userId,
            amount: input.value
        });
    });

    fetch('/payroll/process-salaries', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            month: document.getElementById('month').value,
            salaries: salaryData
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert('Salaries processed successfully!');
            loadPayrollData();
        } else {
            alert('Error processing salaries: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error processing salaries');
    });
});

function loadPayrollData() {
    const month = document.getElementById('month').value;
    fetch(`/payroll/monthly?month=${month}`)
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('payrollTable');
            tbody.innerHTML = '';
            
            data.forEach(row => {
                tbody.innerHTML += `
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${row.user_name}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${row.designation}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${formatMonth(row.month)}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right">${formatCurrency(row.base_salary)}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">${row.present_days}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">${row.absent_days}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right">${formatCurrency(row.bonus)}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right">${formatCurrency(row.deductions)}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-right">${formatCurrency(row.net_salary)}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-right">
                            <input type="number" class="salary-input border rounded px-2 py-1 w-32" data-user-id="${row.user_id}" value="${row.net_salary}">
                        </td>
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