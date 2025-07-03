@extends('admin.layouts.simple.master')

@section('title', 'Default')

@section('css')
<style>
    select.form-control.marketplaces-select option:disabled {
        font-size: 18px;
        color: #000;
        font-weight: 500;
    }

    select.form-control.marketplaces-select option:first-child:disabled {
        font-size: 14px;
    }
</style>
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3></h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Download Orders</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row second-chart-list third-news-update">
        <div class="col-xl-8 xl-100 dashboard-sec box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Download Orders</h5>
                </div>
                <form class="form theme-form bold-labels" action="{{ route('order-download-submit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @if(Session::has('notify_error'))
                        <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                            <strong>Updates ! </strong> No Ordes Found.
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




                            <div class="col-sm-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-12 col-form-label">Marketplace </label>
                                    <div class="col-sm-12">
                                        <select name="marketplace" class="form-control marketplaces-select" required>
                                            <option value="" disabled selected>Select Marketplaces</option>
                                            @if($setting['marketplace_region'] == 'EU')
                                            <option value="A1RKKUPIHCS9HS"> Spain ES </option>
                                            <option value="A1F83G8C2ARO7P"> United Kingdom UK </option>
                                            <option value="A13V1IB3VIYZZH"> France FR </option>
                                            <option value="AMEN7PMS3EDWL"> Belgium BE </option>
                                            <option value="A1805IZSGTT6HS"> Netherlands NL </option>
                                            <option value="A1PA6795UKMFR9"> Germany DE </option>
                                            <option value="APJ6JRA9NG5V4"> Italy IT </option>
                                            <option value="A2NODRKZP88ZB9"> Sweden SE </option>
                                            <option value="AE08WJ6YKNBMC"> South Africa ZA </option>
                                            <option value="A1C3SOZRARQ6R3"> Poland PL </option>
                                            <option value="ARBP9OOSHTCHU"> Egypt EG </option>
                                            <option value="A33AVAJ2PDY3EV"> Turkey TR </option>
                                            <option value="A17E79C6D8DWNP"> Saudi Arabia SA </option>
                                            <option value="A2VIGQ35RCS4UG"> United Arab Emirates AE </option>
                                            <option value="A21TJRUUN4KGV"> India IN </option>
                                            @elseif($setting['marketplace_region'] == 'FE')
                                            <option value="A19VAU5U5O7RUS"> Singapore SG </option>
                                            <option value="A39IBJ37TRP1C6"> Australia AU </option>
                                            <option value="A1VC38T7YXB528"> Japan JP </option>
                                            @else
                                            <option value="A2EUQ1WTGCTBG2"> Canada CA </option>
                                            <option value="ATVPDKIKX0DER"> United States of America US </option>
                                            <option value="A1AM78C64UM0Y8"> Mexico MX </option>
                                            <option value="A2Q3Y263D00KWC"> Brazil BR </option>
                                            @endif
                                        </select>
                                        <!-- <input class="form-control" type="text" name="lwaClientId" placeholder="Enter lwaClientId" value="{{$setting['lwaClientId']}}"> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-12 col-form-label">Orders type</label>
                                    <div class="col-sm-12">
                                        <select name="order_type" id="" class="form-control" required>
                                            <option value="">Select Order Type</option>
                                            <option value="Shipped">Shipped</option>
                                            <option value="Pending">Pending</option>
                                            <option value="un-shipped">Un-Shipped</option>
                                            <option value="Canceled">Canceled</option>
                                            <option value="Unfulfillable">Unfulfillable</option>
                                            <option value="InvoiceUnconfirmed">InvoiceUnconfirmed</option>



                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-12 col-form-label">From Date</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="date" name="from_date" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3 row">
                                    <label class="col-sm-12 col-form-label">To Date</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="date" name="to_date" placeholder="" required>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary" type="submit" data-bs-original-title="" title="">Submit</button>
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