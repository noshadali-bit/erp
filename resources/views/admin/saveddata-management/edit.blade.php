@extends('admin.layouts.simple.master')

@section('title', 'Edit Hostings and Domains Data')

@section('css')

@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Hostings and Domains Data</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Hostings and Domains Data</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row second-chart-list third-news-update">
        <div class="col-xl-12 xl-100 dashboard-sec box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Hostings and Domains Data</h5>
                </div>
                <form class="form theme-form bold-labels" action="{{ route('saveddata.update', $savedData->id) }}" method="POST" enctype="multipart/form-data">
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
                                            <label class=" col-form-label">Name </label>
                                            <div class="">
                                                <input class="form-control" type="text" required name="name" value="{{ $savedData->name }}" placeholder="Brand Name" data-bs-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Brand </label>
                                            <div class="">

                                                <select name="brand_id" id="" class="form-control">
                                                    <option value="" selected disabled>-- Select a Brand --</option>
                                                    @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}" {{ ($savedData->brand_id == $brand->id) ? 'selected' : '' }}>{{$brand->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Order ID</label>
                                            <div class="">
                                                <input class="form-control" type="text" name="order_id" value="{{ $savedData->order }}" placeholder="Order ID" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Buy Source</label>
                                            <div class="">
                                                <input class="form-control" type="text" required name="buy_source" value="{{ $savedData->buy_source }}" placeholder="Namecheap/Hostinger etc..">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Client Name</label>
                                            <div class="">
                                                <input class="form-control" type="text" name="client_name" value="{{ $savedData->client_name }}" placeholder="Client Name" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Client Email</label>
                                            <div class="">
                                                <input class="form-control" type="email" name="client_email" value="{{ $savedData->client_email }}" placeholder="Client Email" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">

                                        <div class="mb-3 ">
                                            <label class=" col-form-label">Description</label>
                                            <div>
                                                <!-- <textarea id="example" name="wysiwg_text"></textarea> -->
                                                <textarea class="form-control " id="editor" rows="5" cols="5" name="description" placeholder="Description">{!! $savedData->description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Amount Paid</label>
                                            <div class="">
                                                <input class="form-control" type="text" name="amount_paid" value="{{ $savedData->amount_paid }}" placeholder="Amount Paid" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Purchase Date</label>
                                            <div class="">
                                                <input class="form-control" type="date" name="purchase_date" value="{{ $savedData->purchase_date }}" placeholder="Purchase Date" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class=" col-form-label">Expire Date</label>
                                            <div class="">
                                                <input class="form-control" type="date" name="expire_date" value="{{ $savedData->expire_date }}" placeholder="Expire Date" >
                                            </div>
                                        </div>
                                    </div>
                                </div>






                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary" type="submit" data-bs-original-title="" title="">Update Data</button>
                            <a href="{{ route('saveddata.index') }}" class="btn btn-light">Cancel</a>
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