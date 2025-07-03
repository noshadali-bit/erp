@extends('admin.layouts.simple.master')

@section('title', 'Default')

@section('css')

@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3></h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Setting</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row second-chart-list third-news-update">
        <div class="col-xl-8 xl-100 dashboard-sec box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Profile Page</h5>
                </div>
                <form class="form theme-form bold-labels" action="{{ route('profile-password-update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @if(Session::has('message'))
                        <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                            <strong>Updates ! </strong> {{ Session::get('message') }}.
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
                        </div>
                        @endif
                        @if($errors->any())

                        <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                            {!! implode('', $errors->all('<div>:message</div>')) !!}
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
                        </div>
                        @endif

                        <div class="row">
                           
                            <div class="col-sm-12">
                                <div class="mb-3 row">
                                    <label class="col-sm-12 col-form-label">Password</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="password" name="password" placeholder="Enter Password" value="{{old('password')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3 row">
                                    <label class="col-sm-12 col-form-label">Confirm Password</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password" value="{{old('password_confirmation')}}">
                                    </div>
                                </div>
                            </div>
                            
                        
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary" type="submit" data-bs-original-title="" title="">Update Password</button>
                        </div>
                    </div>
                </form> 
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    var session_layout = '{{ session()->get("layout") }}';
</script>
@endsection

@section('script')

@endsection