@extends('admin.layouts.simple.master')
@section('title', 'Monthly Salary Calculator')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Monthly Salary Calculator</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Monthly Salary</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row second-chart-list third-news-update">
        <div class="col-xl-12 xl-100 dashboard-sec box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Monthly Salary Calculator</h5>
                </div>
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
                                    <th>Base Salary</th>
                                    <th>Present Days</th>
                                    <th>Absent Days</th>
                                    <th>Net Salary</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>
                                        <div>{{ $user->name }}</div>
                                        <small>{{ $user->user_id }}</small>
                                    </td>
                                    <td>{{ number_format($user->base_salary, 2) }}</td>
                                    <td class="present-days" data-user-id="{{ $user->id }}">-</td>
                                    <td class="absent-days" data-user-id="{{ $user->id }}">-</td>
                                    <td>
                                        <input type="number" class="form-control net-salary" data-user-id="{{ $user->id }}" value="0" step="0.01">
                                    </td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button onclick="saveAllSalaries()" class="btn btn-primary">Save All Salaries</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Function to calculate salary for all users
function calculateAllSalaries() {
    const month = document.getElementById('month').value;
    const users = document.querySelectorAll('[data-user-id]');
    const userIds = new Set();
    
    users.forEach(el => userIds.add(el.dataset.userId));
    
    userIds.forEach(userId => calculateSalary(userId));
}

// Add event listener for month change
document.getElementById('month').addEventListener('change', calculateAllSalaries);

// Calculate all salaries when page loads
document.addEventListener('DOMContentLoaded', calculateAllSalaries);

function calculateSalary(userId) {
    const month = document.getElementById('month').value;
    
    // First get the base salary
    fetch(`/admin/get-user-base-salary/${userId}`)
        .then(response => response.json())
        .then(data => {
            const baseSalary = data.base_salary;
            
            // Then calculate attendance and update the table
            fetch(`/admin/calculate-monthly-salary`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    user_id: userId,
                    month: month,
                    base_salary: baseSalary
                })
            })
            .then(response => response.json())
            .then(data => {
                document.querySelector(`.present-days[data-user-id="${userId}"]`).textContent = data.present_days;
                document.querySelector(`.absent-days[data-user-id="${userId}"]`).textContent = data.absent_days;
                // Calculate and display net salary
                const presentDays = parseInt(data.present_days);
                const workingDays = presentDays + parseInt(data.absent_days);
                const perDaySalary = baseSalary / workingDays;
                const netSalary = (perDaySalary * presentDays).toFixed(2);
                document.querySelector(`.net-salary[data-user-id="${userId}"]`).value = netSalary;
            })
            .catch(error => console.error('Error:', error));
        })
        .catch(error => console.error('Error:', error));
}
function saveAllSalaries() {
    const month = document.getElementById('month').value;
    const salaryData = [];
    
    document.querySelectorAll('.net-salary').forEach(input => {
        const userId = input.dataset.userId;
        const netSalary = parseFloat(input.value);
        const presentDays = parseInt(document.querySelector(`.present-days[data-user-id="${userId}"]`).textContent);
        const absentDays = parseInt(document.querySelector(`.absent-days[data-user-id="${userId}"]`).textContent);
        const baseSalary = parseFloat(document.querySelector(`tr:has([data-user-id="${userId}"]) td:nth-child(2)`).textContent.replace(/,/g, ''));
        
        salaryData.push({
            user_id: userId,
            month: month,
            base_salary: baseSalary,
            present_days: presentDays,
            absent_days: absentDays,
            net_salary: netSalary
        });
    });
    
    fetch('/admin/store-bulk-salaries', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ salaries: salaryData })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert('All salaries have been saved successfully!');
            window.location.href = '/salaries';
        } else {
            alert('Error saving salaries. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error saving salaries. Please try again.');
    });
}
</script>
@endpush
@endsection