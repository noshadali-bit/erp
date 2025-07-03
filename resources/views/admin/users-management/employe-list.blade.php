@extends('admin.layouts.simple.master')
@section('title', 'Employes')

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
<h3>All Employes</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Employes</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header align-items-center card-header d-flex justify-content-between">
                    <h5>Employes</h5>
                    <a href="{{ route('employes_add') }}" class="btn btn-primary">Add Employe</a>
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
                                <th scope="col">This Month Performance</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employes as $key => $employe)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <img src="{{ ( empty($employe->getFirstMediaUrl('thumbnail')) )  ?  asset('user-image.webp') : $employe->getMedia('thumbnail')->last()->getUrl()  }}" width="50" />
                                </td>
                                <td>{{ ($employe->name != null) ? $employe->name : '--' }}</td>
                                <td>{{ ($employe->department_id != null) ? $employe->department->name : '--' }}</td>

                                <td>{{ ($employe->email != null) ? $employe->email : '--' }}</td>
                                <td>
                                    <div class="chart_progress" data="{{$employe->performance()}}">
                                        <div class="chart_progress_bar"></div>
                                      </div>
                                </td>
                                <td>{{ ($employe->status == 1) ? 'Active' : 'In Active' }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions </button>
                                        <ul class="dropdown-menu dropdown-block text-start">

                                            <li><a class="dropdown-item" href="{{ route('users.show', encrypt($employe->id)) }}"><i class="fa fa-pencil"></i> View Detail</a></li>
                                            <li><a class="dropdown-item" href="{{ route('employes_edit', encrypt($employe->id)) }}"><i class="fa fa-pencil"></i> Edit</a></li>
                                            <li><a class="dropdown-item" href="{{ route('employes_suspend', encrypt($employe->id)) }}" title=""><i class="fa fa-pencil"></i> {{ ($employe->status == 1) ? 'In Active' : 'Active' }}</a></li>
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