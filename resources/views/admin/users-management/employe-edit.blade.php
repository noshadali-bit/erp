@extends('admin.layouts.simple.master')

@section('title', 'Edit Employe')

@section('css')

@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Employe</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Employe</li>
@endsection

@section('content')
@php
$user = Auth::user();
@endphp
<div class="container-fluid">
    <div class="row second-chart-list third-news-update">
        <div class="col-xl-12 xl-100 dashboard-sec box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Employe</h5>
                </div>
                <form class="form theme-form bold-labels" action="{{ route('employes_update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $employe->id }}" name="id">
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
                                                <input class="form-control" type="text" required name="name" value="{{ $employe->name }}" placeholder="employe Name" data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Email</label>
                                            <div class="">
                                                <input class="form-control" type="email" required name="email" value="{{ $employe->email }}" placeholder="employe Email" data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Password</label>
                                            <div class="">
                                                <input class="form-control" type="text" name="password" value="" placeholder="employe Password" data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                    @if ($user->role_id == 2)
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Department </label>
                                            <div class="">

                                                <select name="department" id="" class="form-control">
                                                   
                                                    <option value="{{$user->department->id}}" selected>{{$user->department->name}}</option>
                                                   
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Department </label>
                                            <div class="">

                                                <select name="department" id="" class="form-control">
                                                    <option value="" selected disabled>-- Select a Department --</option>
                                                    @foreach($departments as $department)
                                                    <option value="{{$department->id}}" {{ ($employe->department_id == $department->id) ? 'selected' : '' }}>{{$department->name}}</option>
                                                    @endforeach


                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">base_salary</label>
                                            <div class="">
                                                <input class="form-control" type="number" required name="base_salary" value="{{ $employe->base_salary }}" placeholder="Base Salary" data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Image</label>
                                            <div class="">
                                                <label class="instruction_label">Thumbnail image (360 width)</label><br>
                                                <input class="form-control" onchange="thumb(this);" name="image" type="file" />
            
                                                @if((isset($employe)) && ($employe->hasMedia('thumbnail')))
                                                        <img src="{{ $employe->getFirstMediaUrl('thumbnail') }}" width="200" class="thumbnail-img" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>




                       
                        



                    </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <div class="col-sm-9 offset-sm-3">
                <button class="btn btn-primary" type="submit" data-bs-original-title="" title="">Update employe</button>
                <a href="{{ route('employes_list') }}" class="btn btn-light">Cancel</a>
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

@endsection