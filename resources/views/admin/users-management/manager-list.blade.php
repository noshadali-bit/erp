@php
$user = Auth::user();

$text = ($user->role_id == 2)? 'Team Lead' : 'Manager';
@endphp 

@extends('admin.layouts.simple.master')
@section('title', 'Managers')

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
</style>
@endsection

@section('breadcrumb-title')
<h3>All Managers</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">{{$text}}s</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header align-items-center card-header d-flex justify-content-between">
                    <h5>{{$text}}s</h5>
                    <a href="{{ route('managers_add') }}" class="btn btn-primary">Add {{$text}}</a>
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
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Department</th>
                                <th scope="col">Email</th>
                                <th scope="col">users</th>
                                @if($user->role_id != 2)
                                <th scope="col">Extra Access</th>
                                @endif
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($managers as $key => $manager)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <img src="{{ ( empty($manager->getFirstMediaUrl('thumbnail')) )  ?  asset('user-image.webp') : $manager->getMedia('thumbnail')->last()->getUrl()  }}" width="50" />
                                </td>
                                <td>{{ ($manager->name != null) ? $manager->name : '--' }}</td>
                                <td>{{ ($manager->department_id != null) ? $manager->department->name : '--' }}</td>

                                <td>{{ ($manager->email != null) ? $manager->email : '--' }}</td>
                                <td>{{$manager->department->users->count()}}</td>
                                @if($user->role_id != 2)
                                <td>
                                    @if($manager->extra_access == 1)
                                        <span class="badge rounded-pill badge-success">Yes</span>
                                    @else
                                        <span class="badge rounded-pill badge-danger">No</span>
                                    @endif
                                </td>
                                @endif
                                <td>
                                    @if($manager->status == 1)
                                        <span class="badge rounded-pill badge-success">Active</span>
                                    @else
                                        <span class="badge rounded-pill badge-danger">Not Active</span>
                                    @endif
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions </button>
                                        <ul class="dropdown-menu dropdown-block text-start">
                                            <li><a class="dropdown-item" href="{{ route('managers_edit', encrypt($manager->id)) }}"><i class="fa fa-pencil"></i> Edit</a></li>
                                            <li><a class="dropdown-item" href="{{ route('managers_suspend', encrypt($manager->id)) }}" title=""><i class="fa fa-pencil"></i> {{ ($manager->status == 1) ? 'In Active' : 'Active' }}</a></li>
                                            @if($user->role_id != 2)
                                            <li><a class="dropdown-item" href="{{ route('managers_extra_access', encrypt($manager->id)) }}" title=""><i class="fa fa-pencil"></i> {{ ($manager->extra_access == 1) ? 'Remove Extra Access' : 'Add Extra Access' }}</a></li>
                                            @endif
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