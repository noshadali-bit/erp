@extends('admin.layouts.simple.master')

@section('title', 'Edit Manager')

@section('css')

@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Managers</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Manager</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row second-chart-list third-news-update">
        <div class="col-xl-12 xl-100 dashboard-sec box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Manager</h5>
                </div>
                <form class="form theme-form bold-labels" action="{{ route('managers_update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $manager->id }}" name="id">
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
                                                <input class="form-control" type="text" required name="name" value="{{ $manager->name }}" placeholder="manager Name" data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Email</label>
                                            <div class="">
                                                <input class="form-control" type="email" required name="email" value="{{ $manager->email }}" placeholder="manager Email" data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Password</label>
                                            <div class="">
                                                <input class="form-control" type="text" name="password" value="" placeholder="manager Password" data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Department </label>
                                            <div class="">

                                                <select name="department" id="" class="form-control">
                                                    <option value="" selected disabled>-- Select a Department --</option>
                                                    @foreach($departments as $department)
                                                    <option value="{{$department->id}}" {{ ($manager->department_id == $department->id) ? 'selected' : '' }}>{{$department->name}}</option>
                                                    @endforeach


                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">base_salary</label>
                                            <div class="">
                                                <input class="form-control" type="number" required name="base_salary" value="{{ $manager->base_salary }}" placeholder="{{$text}} Base Salary" data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Image</label>
                                            <div class="">
                                                <label class="instruction_label">Thumbnail image (360 width)</label><br>
                                                <input class="form-control" onchange="thumb(this);" name="image" type="file" />
            
                                                @if((isset($manager)) && ($manager->hasMedia('thumbnail')))
                                                        <img src="{{ $manager->getFirstMediaUrl('thumbnail') }}" width="200" class="thumbnail-img" />
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
                <button class="btn btn-primary" type="submit" data-bs-original-title="" title="">Update manager</button>
                <a href="{{ route('managers_list') }}" class="btn btn-light">Cancel</a>
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