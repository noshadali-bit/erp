@extends('admin.layouts.simple.master')

@section('title', 'Add Target')

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
                    <h5>Add Target</h5>
                </div>
                <form class="form theme-form bold-labels" action="{{ route('targets.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
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
                                                <input class="form-control" type="text" required name="name" value="{{ old('name') }}" placeholder="target Title" data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">user </label>
                                            <div class="">

                                                <select name="user" id="" class="form-control">
                                                    <option value="" selected disabled>-- Select a user --</option>
                                                    @foreach($users as $user)
                                                    <option value="{{$user->id}}" {{ (old('user') == $user->id) ? 'selected' : '' }}>{{$user->name}} - {{$user->department->name}}</option>
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
                                                <textarea class="form-control " id="editor" rows="5" required cols="5" name="description" placeholder="target Description">{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Tageted tasks </label>
                                            <div class="">
                                                <input class="form-control" type="number" required name="target" value="{{ old('target') }}" placeholder="Assign Target">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Tageted Approved Tasks (Only For Design Department)</label>
                                            <div class="">
                                                <input class="form-control" type="number"  name="approved_tasks" value="{{ old('approved_tasks') }}" placeholder="Assign Approved Target">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Month </label>
                                            <div class="">
                                                <input class="form-control" type="month" required name="month" value="{{ old('month') }}" placeholder="Month">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary" type="submit" data-bs-original-title="" title="">Add target</button>
                            <a href="{{ route('targets.index') }}" class="btn btn-light">Cancel</a>
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
    $(document).ready(function() {
        $('.tags-select').select2({
            placeholder: 'Select Tags',
        });
    });
    
    var options = {
        debug: 'info',
        modules: {
            toolbar: '#in_toolbar'
        },
        placeholder: 'Compose an epic...',
        readOnly: true,
        theme: 'snow'
    };
    var editor = new Quill('#in_editor', options);
</script>
@endsection