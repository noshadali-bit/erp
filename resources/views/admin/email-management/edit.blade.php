@extends('admin.layouts.app')

@section('title', 'Edit Email Data')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Email Management</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Email Management</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row second-chart-list third-news-update">
        <div class="col-xl-12 xl-100 dashboard-sec box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Email</h5>
                </div>
                <form class="form theme-form bold-labels" action="{{ route('email-management.update', $emailData->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                            {!! implode('', $errors->all('<div>:message</div>')) !!}
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
                        </div>
                        @endif
                        @if(Session::has('message'))
                        <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                            <strong>Updates ! </strong> {{ Session::get('message') }}.
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class="col-form-label">Name</label>
                                            <div class="">
                                                <input class="form-control" type="text" name="name" value="{{ old('name', $emailData->name) }}" placeholder="Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class="col-form-label">Domain Name</label>
                                            <div class="">
                                                <input class="form-control" type="text" name="domain_name" value="{{ old('domain_name', $emailData->domain_name) }}" placeholder="Domain Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class="col-form-label">Brand</label>
                                            <div class="">
                                                <select name="brand_id" class="form-control">
                                                    <option value="" selected disabled>-- Select a Brand --</option>
                                                    @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}" {{ (old('brand_id', $emailData->brand_id) == $brand->id) ? 'selected' : '' }}>{{$brand->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="col-form-label">Email</label>
                                            <div class="">
                                                <input class="form-control" type="email" name="email" value="{{ old('email', $emailData->email) }}" placeholder="Email" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="col-form-label">Password</label>
                                            <div class="">
                                                <input class="form-control" type="password" name="password" value="{{ old('password', $emailData->password) }}" placeholder="Password" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary" type="submit">Update Email</button>
                            <a href="{{ route('email-management.index') }}" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection