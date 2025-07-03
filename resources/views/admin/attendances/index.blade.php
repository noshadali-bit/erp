@extends('admin.layouts.simple.master')
@section('title', 'Attendance')

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
<h3>All Attendance</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Attendance</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header align-items-center card-header d-flex justify-content-between">
                    <h5>Attendance Records</h5>
                    <div class="d-flex gap-3">
                        <a href="{{ route('attendances.bulk.create') }}" class="btn btn-primary">Bulk Attendance</a>
                        <a href="{{ route('attendances.create') }}" class="btn btn-primary">Record Attendance</a>
                    </div>
                </div>
                @if(Session::has('success'))
                <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                    <strong>Success! </strong> {{ Session::get('success') }}.
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
                </div>
                @endif
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="display" id="keytable">
                            <thead>
                                <tr>
                                    <th class="table_id">#</th>
                                    <th>user</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th class="table_action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendances as $key => $attendance)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $attendance->user->name }}</td>
                                    <td>{{ $attendance->date->format('D d M Y') }}</td>
                                    <td>
                                        <span class="@if($attendance->status == 'present') badge badge-success @elseif($attendance->status == 'absent') badge badge-danger @else badge badge-warning @endif">
                                            {{ ucfirst($attendance->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $attendance->check_in ?? '-' }}</td>
                                    <td>{{ $attendance->check_out ?? '-' }}</td>
                                    <td class="action_list">
                                        <div class="dropdown_list">
                                            <img src="{{asset('assets/images/ellipsis-vertical-solid.svg')}}">
                                            <ul class="action">
                                                <li class="edit"><a href="{{ route('attendances.edit', $attendance->id) }}">Edit</a></li>
                                                <li class="delete">
                                                    <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Are you sure?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="mt-4">
                        {{ $attendances->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection