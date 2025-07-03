@extends('admin.layouts.simple.master')
@section('title', 'Salaries')

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

    div .action .pdf i {
        font-size: 20px;
        color: #FC4438;
    }

    div .action .edit {
        margin-right: 5px;
    }

    [dir=rtl] div .action .edit {
        margin-left: 5px;
    }

    div .action .delete i {
        /*color: #FC4438;*/
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
<h3>All Salaries</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Salaries</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header align-items-center card-header d-flex justify-content-between">
                    <h5>Salary Records</h5>
                    <div class="d-flex gap-3">
                        <a href="{{ route('salaries.create') }}" class="btn btn-primary">Process Salary</a>
                        <a href="{{ route('salaries.monthly') }}" class="btn btn-primary">Monthly Salary</a>
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
                                    <th>Month</th>
                                    <th>Working Days</th>
                                    <th>Present Days</th>
                                    <th>Base Salary</th>
                                    <th>Total Salary</th>
                                    <th class="table_action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($salaries as $key => $salary)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $salary->user->name }}</td>
                                    <td>{{ date('F Y', strtotime($salary->month_year)) }}</td>
                                    <td>{{ $salary->total_days }}</td>
                                    <td>{{ $salary->present_days }}</td>
                                    <td>{{ number_format($salary->base_salary, 2) }}</td>
                                    <td>{{ number_format($salary->net_salary, 2) }}</td>
                                    <td class="action_list">
                                        <div class="dropdown_list">
                                            <img src="{{asset('assets/images/ellipsis-vertical-solid.svg')}}">
                                            <ul class="action">
                                                <li class="edit"><a href="{{ route('salaries.show', encrypt($salary->id)) }}">View</a></li>
                                                <li class="edit"><a href="{{ route('salaries.edit', encrypt($salary->id)) }}">Edit</a></li>
                                                <form action="{{ route('salaries.destroy', encrypt($salary->id)) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>user</th>
                                    <th>Month</th>
                                    <th>Working Days</th>
                                    <th>Present Days</th>
                                    <th>Base Salary</th>
                                    <th>Total Salary</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- 
<div class="mt-4">
    {{ $salaries->links() }}
</div> --}}
@endsection
