@extends('admin.layouts.simple.master')

@section('title', 'Task')

@section('css')

@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Task</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Task</li>
@endsection

@section('content')
@php
$cuser = Auth::user();
@endphp
<div class="container-fluid">
    <div class="row second-chart-list third-news-update">
        <div class="col-xl-12 xl-100 dashboard-sec box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Task</h5>
                </div>
                <form class="form theme-form bold-labels" action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
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
                                            <label class=" col-form-label">Title </label>
                                            <div class="">
                                                <input class="form-control" type="text" required name="title" value="{{ $task->name }}" placeholder="Task Title" data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                    @if ($cuser->role_id == 3)
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class=" col-form-label">user </label>
                                            <div class="">

                                                <select name="user" id="" class="form-control">
                                                  
                                                    <option value="{{$cuser->id}}" selected>{{$cuser->name}}</option>
                                                   
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class=" col-form-label">User </label>
                                            <div class="">

                                                <select name="user" id="" class="form-control">
                                                    <option value="" selected disabled>-- Select a User --</option>
                                                    @foreach($users as $user)
                                                    <option value="{{$user->id}}" {{ ($task->user_id == $user->id) ? 'selected' : '' }}>{{$user->name}}</option>
                                                    @endforeach


                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                   
                                     <div class="col-4">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Type </label>
                                            <div class="">
                                                <select name="type" id="" class="form-control">
                                                    <option value="" selected disabled>-- Select a user --</option>
                                                    <option value="1" {{ ( $task->type == '1' ) ? 'selected' : '' }} >Initial</option>
                                                    <option value="2" {{ ( $task->type == '2' ) ? 'selected' : '' }} >Revision</option>
                                                    <option value="3" {{ ( $task->type == '3' ) ? 'selected' : '' }} >Initial Brand</option>
                                                    <option value="4" {{ ( $task->type == '4' ) ? 'selected' : '' }} >Brand Revison</option>
                                                    <option value="5" {{ ( $task->type == '5' ) ? 'selected' : '' }} >Site live </option>
                                                    <option value="6" {{ ( $task->type == '6' ) ? 'selected' : '' }} >Audio naration</option>
                                                    <option value="7" {{ ( $task->type == '7') ? 'selected' : '' }} >SEO</option>
                                                    <option value="8" {{ ( $task->type == '8') ? 'selected' : '' }} >Branding</option>
                                                    <option value="9" {{ ( $task->type == '9') ? 'selected' : '' }} >ORM</option>
                                                    <option value="10" {{ ( $task->type == '10') ? 'selected' : '' }} >Link Building</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">

                                        <div class="mb-3 ">
                                            <label class=" col-form-label">Description</label>
                                            <div>
                                                <!-- <textarea id="example" name="wysiwg_text"></textarea> -->
                                                <textarea class="form-control " id="editor" rows="5" required cols="5" name="description" placeholder="Task Description">{{ $task->details }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Assign Date </label>
                                            <div class="">
                                                <input class="form-control" type="date" required name="assign_date" value="{{ $task->assign_date }}" placeholder="Assign Date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Due Date </label>
                                            <div class="">
                                                <input class="form-control" type="date" required name="due_date" value="{{ $task->due_date }}" placeholder="Due Date">
                                            </div>
                                        </div>
                                    </div>




                                </div>






                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary" type="submit" data-bs-original-title="" title="">Update Task</button>
                            @if($cuser->role_id == 2)
                            <a href="{{ route('tasks.index') }}" class="btn btn-light">Cancel</a>
                            @else
                            <a href="{{route('user-detail', $cuser->id)}}" class="btn btn-light">Cancel</a>    
                            @endif
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