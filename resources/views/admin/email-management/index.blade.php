@extends('admin.layouts.simple.master')

@section('title', 'Email Data')

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
    .data-search-form input.form-control, .data-search-form .btn {
   min-height: 50px;
}
.theme-form select, .theme-form select.form-control:not([size]):not([multiple]) {
   border-color: #cccccc;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center card-header d-flex justify-content-between">
                    <h5>Email Management</h5>
                    <a href="{{ route('email-management.create') }}" class="btn btn-primary">Add Email</a>
                </div>
                @if(Session::has('message'))
                <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                    <strong>Updates ! </strong> {{ Session::get('message') }}.
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
                </div>
                @endif
                <form class="form theme-form bold-labels data-search-form" action="" method="GET" enctype="multipart/form-data">
                      
                        <div class="card-body py-1 pb-3">
    
                            <div class="row">
                                <div class="col">
                                    <div class="row align-items-end">
    
                                        <div class="col-lg-2 col-md-4">
                                            <div class="">
                                                <label class=" col-form-label">Name</label>
                                                <div class="">
                                                    <input class="form-control" type="text" name="name" value="{{isset($search['name']) ? $search['name'] : '' }}" placeholder="Name" data-bs-original-title="" title="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-4">
                                            <div class="">
                                                <label class=" col-form-label">Brand</label>
                                                <div class="">
                                                    <select name="brand_id" class="form-control">
                                                        <option value="" selected>-- Select a Brand --</option>
                                                        @foreach($brands as $brand)
                                                        <option value="{{$brand->id}}" {{ (isset($search['brand_id']) && $search['brand_id'] == $brand->id) ? 'selected' : '' }}>{{$brand->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-4">
                                            <div class="">
                                                <button class="btn btn-primary" type="submit" data-bs-original-title="" title="">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Domain Name</th>
                                    <th>Brand</th>
                                    <th>Email</th>
                                    <th class="text-end  pe-5">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($emailData as $email)
                                <tr>
                                    <td>{{ $email->id }}</td>
                                    <td>{{ $email->name }}</td>
                                    <td>{{ $email->domain_name }}</td>
                                    <td>{{ $email->brand->name }}</td>
                                    <td>{{ $email->email }}</td>
                                    <td  class="text-end pe-5">
                                        <div class="btn-group">
                                            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions </button>
                                            <ul class="dropdown-menu dropdown-block text-start">
                                                <li><a class="dropdown-item" href="{{ route('email-management.edit', encrypt($email->id)) }}" title=""><i class="fa fa-pencil"></i> Edit</a></li>
                                                <form action="{{ route('email-management.destroy', encrypt($email->id)) }}" class="d-inline" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="dropdown-item">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>
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
</div>
@endsection