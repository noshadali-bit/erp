@extends('admin.layouts.simple.master')
@section('title', 'Targets')

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

    div .action .edit i {
        color: #54BA4A;
    }

    [dir=rtl] div .action .edit {
        margin-left: 5px;
    }

    div .action .delete i {
        color: #FC4438;
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
<h3>All Targets</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Targets</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header align-items-center card-header d-flex justify-content-between">
                    <h5>targets</h5>
                    <a href="{{ route('targets.create') }}" class="btn btn-primary">Add Targets</a>
                </div>
                @if(Session::has('message'))
                <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                    <strong>Updates ! </strong> {{ Session::get('message') }}.
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Target</th>
                                <th scope="col">Details</th>
                                <th scope="col">User</th>
                                <th scope="col">Department</th>
                                <th scope="col">Manager</th>
                                <th scope="col">Month</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($targets as $key => $target)
                       
                            <tr>
                                <td>{{ $key+1}}</td>
                                <td>{{ $target->name }}</td>
                                <td>
                                    {{ $target->target }} Tasks
                                    @if($target->user->department->slug == 'design')
                                        <br> {{ ($target->approved_tasks) ?? '0' }} Approved Tasks
                                    @endif
                                </td>
                                <td>{!! $target->description !!}</td>
                                <td>{{ $target->user->name }}</td>
                                <td>{{ $target->user->department->name }}</td>
                                <td>{{ ($target->user->department->manager) ? $target->user->department->manager->name : '--' }}</td>
                                <td>{{ $target->month }}</td>
                                
                                
                                <td>
                                    @if ($target->status == 0)
                                        <span class="badge rounded-pill badge-danger">Not Active</span> 
                                    @elseif ($target->status == 1)
                                        <span class="badge rounded-pill badge-success">Active</span> 
                                    @else
                                        <span class="badge rounded-pill badge-danger">Not Active</span> 
                                    @endif
                                </td>
                                <td>

                                    <div class="btn-group">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions </button>
                                        <ul class="dropdown-menu dropdown-block text-start">
                                            <li><a class="dropdown-item" href="{{ route('targets.edit', $target->id) }}" title=""><i class="fa fa-pencil"></i> Edit</a></li>
                                            <li><a class="dropdown-item" href="{{ route('targets.status', $target->id) }}" title=""><i class="fa fa-pencil"></i> {{ ($target->status == 1) ? 'Suspend' : 'Active' }}</a></li>
                                            <form action="{{ route('targets.destroy', $target->id) }}" class="d-inline" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="dropdown-item">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                                <!-- <a class="dropdown-item" href="#">What are you doing?</a></li-->
                                        </ul>
                                    </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')

@endsection