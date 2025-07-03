@extends('admin.layouts.simple.master')

@section('title', 'Target')

@section('css')

@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Target</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Target</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row second-chart-list third-news-update">
        <div class="col-xl-12 xl-100 dashboard-sec box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Target</h5>
                </div>
                <form class="form theme-form bold-labels" action="{{ route('targets.update', $target->id) }}" method="POST" enctype="multipart/form-data">
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
                                            <label class=" col-form-label">Title </label>
                                            <div class="">
                                                <input class="form-control" type="text" required name="name" value="{{ $target->name }}" placeholder="Target Title" data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">User </label>
                                            <div class="">

                                                <select name="user" id="" class="form-control">
                                                    <option value="" selected disabled>-- Select a User --</option>
                                                    @foreach($users as $user)
                                                    <option value="{{$user->id}}" {{ ($target->user_id == $user->id) ? 'selected' : '' }}>{{$user->name}}</option>
                                                    @endforeach


                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <div class="col-12">

                                        <div class="mb-3 ">
                                            <label class=" col-form-label">Description</label>
                                            <div>
                                                <!-- <textarea id="example" name="wysiwg_text"></textarea> -->
                                                <textarea class="form-control " id="editor" rows="5" required cols="5" name="description" placeholder="Task Description">{{ $target->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Tageted Tasks </label>
                                            <div class="">
                                                <input class="form-control" type="number" required name="target" value="{{ $target->target }}" placeholder="Assign Target">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Tageted Approved Tasks (Only For Design Department)</label>
                                            <div class="">
                                                <input class="form-control" type="number"  name="approved_tasks" value="{{ $target->approved_tasks }}" placeholder="Assign Approved Target">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Month </label>
                                            <div class="">
                                                <input class="form-control" type="month" required name="month" value="{{ $target->month }}" placeholder="Month">
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
                            <a href="{{ route('tasks.index') }}" class="btn btn-light">Cancel</a>
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