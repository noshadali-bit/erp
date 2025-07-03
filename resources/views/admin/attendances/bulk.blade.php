@extends('admin.layouts.simple.master')
@section('title', 'Bulk Attendance')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Bulk Attendance</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Bulk Attendance</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row second-chart-list third-news-update">
        <div class="col-xl-12 xl-100 dashboard-sec box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Bulk Attendance</h5>
                </div>
                <form class="form theme-form" action="{{ route('attendances.bulk.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @if(session('success'))
                        <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                            <strong>Success! </strong> {{ session('success') }}
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
                        </div>
                        @endif

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="col-form-label">Date</label>
                                    <input type="date" name="date" id="date" required class="form-control" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>user</th>
                                        <th class="text-center">Attendance Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>
                                            {{ $user->name }}
                                            <input type="hidden" name="users[]" value="{{ $user->id }}">
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status[{{ $user->id }}]" value="present" checked>
                                                    <label class="form-check-label">Present</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status[{{ $user->id }}]" value="absent">
                                                    <label class="form-check-label">Absent</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">Submit Attendance</button>
                        <a href="{{ route('attendances.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection