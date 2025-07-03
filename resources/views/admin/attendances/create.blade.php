@extends('admin.layouts.simple.master')
@section('title', 'Record Attendance')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Record Attendance</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Attendance</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row second-chart-list third-news-update">
        <div class="col-xl-12 xl-100 dashboard-sec box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Record Attendance</h5>
                </div>
                <form class="form theme-form bold-labels" action="{{ route('attendances.store') }}" method="POST">
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
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="col-form-label">Date</label>
                                            <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="col-form-label">Status</label>
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="present" {{ old('status') == 'present' ? 'selected' : '' }}>Present</option>
                                                <option value="absent" {{ old('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                                                <option value="leave" {{ old('status') == 'leave' ? 'selected' : '' }}>Leave</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12" id="attendance-time">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label class="col-form-label">Check In Time</label>
                                                    <input type="time" name="check_in" id="check_in" value="{{ old('check_in') }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label class="col-form-label">Check Out Time</label>
                                                    <input type="time" name="check_out" id="check_out" value="{{ old('check_out') }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
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
                            <button class="btn btn-primary" type="submit">Record Attendance</button>
                            <a href="{{ route('attendances.index') }}" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('status').addEventListener('change', function() {
        const attendanceTime = document.getElementById('attendance-time');
        const checkIn = document.getElementById('check_in');
        const checkOut = document.getElementById('check_out');

        if (this.value === 'present') {
            attendanceTime.style.display = 'block';
            checkIn.required = true;
            checkOut.required = true;
        } else {
            attendanceTime.style.display = 'none';
            checkIn.required = false;
            checkOut.required = false;
            checkIn.value = '';
            checkOut.value = '';
        }
    });

    // Trigger the change event on page load
    document.getElementById('status').dispatchEvent(new Event('change'));
</script>
@endpush

@endsection