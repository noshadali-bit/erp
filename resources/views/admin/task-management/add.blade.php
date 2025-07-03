@extends('admin.layouts.simple.master')

@section('title', 'Add Task')

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
                    <h5>Add Task</h5>
                </div>
                <form class="form theme-form bold-labels" action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Order ID </label>
                                            <div class="">
                                                <input class="form-control" type="text" required name="title" value="{{ old('title') }}" placeholder="Task ID" data-bs-original-title="" title="">
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
                                    @endif
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Type </label>
                                            <div class="">

                                                <select name="type" id="" class="form-control">
                                                    <option value="" selected disabled>-- Select a Order Type --</option>
                                                    <option value="1" {{ (old('type') == '1') ? 'selected' : '' }} >Initial</option>
                                                    <option value="2" {{ (old('type') == '2') ? 'selected' : '' }} >Revision</option>
                                                    <option value="3" {{ (old('type') == '3') ? 'selected' : '' }} >Initial Brand</option>
                                                    <option value="4" {{ (old('type') == '4') ? 'selected' : '' }} >Brand Revison</option>
                                                    <option value="5" {{ (old('type') == '5') ? 'selected' : '' }} >Site live </option>
                                                    <option value="6" {{ (old('type') == '6') ? 'selected' : '' }} >Audio naration</option>
                                                    <option value="7" {{ (old('type') == '7') ? 'selected' : '' }} >SEO</option>
                                                    <option value="8" {{ (old('type') == '8') ? 'selected' : '' }} >Branding</option>
                                                    <option value="9" {{ (old('type') == '9') ? 'selected' : '' }} >ORM</option>
                                                    <option value="10" {{ (old('type') == '10') ? 'selected' : '' }} >Link Building</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">

                                        <div class="mb-3 ">
                                            <label class=" col-form-label">Task Detail</label>
                                            <div>
                                                <!-- <textarea id="example" name="wysiwg_text"></textarea> -->
                                                <textarea rows="5" class="form-control ckeditor" id="long_desc_editor" name="description" placeholder="Enter Long Description">{{ old('description') }}</textarea>
                                                <!--<textarea class="form-control " id="editor" rows="5" required cols="5" name="description" placeholder="Task Detail">{{ old('description') }}</textarea>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Assign Date </label>
                                            <div class="">
                                                <input class="form-control" type="date" required name="assign_date" value="{{ old('assign_date') }}" placeholder="Assign Date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Due Date </label>
                                            <div class="">
                                                <input class="form-control" type="date" required name="due_date" value="{{ old('due_date') }}" placeholder="Due Date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary" type="submit" data-bs-original-title="" title="">Add Task</button>
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
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<!--<script src="https://cdn.ckeditor.com/ckeditor5//ckeditor5.umd.js"></script>-->

<script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
  <script src="{{ asset('assets/js/ckeditor/config.js') }}"></script>
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
    // tinymce.init({
    //     selector: 'textarea',
    //     plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
    //     toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    //     tinycomments_mode: 'embedded',
    //     tinycomments_author: 'Author name',
    //     mergetags_list: [{
    //             value: 'First.Name',
    //             title: 'First Name'
    //         },
    //         {
    //             value: 'Email',
    //             title: 'Email'
    //         },
    //     ],
    //     ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
    // });


    // var editor = new Quill('.text-editor');
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