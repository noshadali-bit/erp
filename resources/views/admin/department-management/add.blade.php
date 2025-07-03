@extends('admin.layouts.simple.master')

@section('title', 'Add Departments')

@section('css')

@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Department</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Department</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row second-chart-list third-news-update">
        <div class="col-xl-12 xl-100 dashboard-sec box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Add Department</h5>
                </div>
                <form class="form theme-form bold-labels" action="{{ route('departments.store') }}" method="POST" enctype="multipart/form-data">
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
                                            <label class=" col-form-label">Name </label>
                                            <div class="">
                                                <input class="form-control" type="text" required name="name" value="{{ old('name') }}" placeholder="Department Name" data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                    $user = Auth::user();
                                    @endphp
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Parent Department </label>
                                            <div class="">

                                                <select name="parent_id" id="" class="form-control">
                                                    <option value="" selected disabled>-- Select a Department --</option>
                                                    @if($user->role_id == 2)
                                                        
                                                        <option value="{{$departments[0]->id}}" selected> {{$departments[0]->name}}</option>
                                                        
                                                    @else
                                                        @foreach($departments as $department)
                                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                                        @endforeach
                                                    @endif
                                                    


                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>






                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary" type="submit" data-bs-original-title="" title="">Add Department</button>
                            <a href="{{ route('departments.index') }}" class="btn btn-light">Cancel</a>
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