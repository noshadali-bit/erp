@extends('admin.layouts.simple.master')

@section('title', 'Edit user')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Edit user</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">user</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row second-chart-list third-news-update">
        <div class="col-xl-12 xl-100 dashboard-sec box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Edit user</h5>
                </div>
                <form class="form theme-form bold-labels" action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
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
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Name </label>
                                            <div class="">
                                                <input class="form-control" type="text" required name="name" value="{{ old('name', $user->name) }}" placeholder="user Name" data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Email</label>
                                            <div class="">
                                                <input class="form-control" type="email" required name="email" value="{{ old('email', $user->email) }}" placeholder="user Email" data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Phone</label>
                                            <div class="">
                                                <input class="form-control" type="text" required name="phone" value="{{ old('phone', $user->phone) }}" placeholder="user Phone" data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Designation </label>
                                            <div class="">
                                                <input class="form-control" type="text" required name="designation" value="{{ old('designation', $user->designation) }}" placeholder="user Designation" data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Base Salary </label>
                                            <div class="">
                                                <input class="form-control" type="number" required name="base_salary" value="{{ old('base_salary', $user->base_salary) }}" placeholder="user Base Salary" data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Address</label>
                                            <div class="">
                                                <textarea class="form-control" name="address" id="" placeholder="user Address" data-bs-original-title="" title="">{{ old('address', $user->address) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Joining Date</label>
                                            <div class="">
                                                <input class="form-control" type="date" required name="joining_date" value="{{ old('joining_date', $user->joining_date) }}" placeholder="user Joining Date" data-bs-original-title="" title="">
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary" type="submit" data-bs-original-title="" title="">Update user</button>
                            <a href="{{ route('users.index') }}" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var session_layout = "{{ session()->get('layout ') }}";
</script>
@endsection

@section('script')
<script>
    function thumb(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.thumbnail-img')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection