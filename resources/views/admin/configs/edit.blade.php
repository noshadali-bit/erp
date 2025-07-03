@extends('admin.layouts.simple.master')
@section('title', 'Site Configuration')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Edit Site Configuration</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Site Configuration</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row second-chart-list third-news-update">
        <div class="col-xl-12 xl-100 dashboard-sec box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Site Configuration</h5>
                </div>
                <form class="form theme-form bold-labels" action="{{ route('configs.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="col-form-label">Site Logo</label>
                                            <input type="file" name="site_logo" id="site_logo" class="form-control">
                                            <p class="text-muted mt-1">Current logo: {{ \App\Models\Config::getConfig('site_logo') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="col-form-label">Office Start Time</label>
                                            <input type="time" name="office_start_time" id="office_start_time" 
                                                   value="{{ \App\Models\Config::getConfig('office_start_time') }}" 
                                                   class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="col-form-label">Office End Time</label>
                                            <input type="time" name="office_end_time" id="office_end_time" 
                                                   value="{{ \App\Models\Config::getConfig('office_end_time') }}" 
                                                   class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary" type="submit">Update Settings</button>
                            <a href="{{ route('configs.index') }}" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection