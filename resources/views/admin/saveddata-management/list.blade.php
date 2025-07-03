@extends('admin.layouts.simple.master')
 @section('title', 'Domain and Hosting Data')

 @section('css')
 @endsection

 @section('style')
 <style>
     div .action {
         display: flex;
     }

     div .action i {
         font-size: 16px;
     }

     div .action .pdf i {
         font-size: 20px;
         color: #FC4438;
     }

     div .action .edit {
         margin-right: 5px;
     }

     div .action .edit i {
         color: #54BA4A;
     }

     [dir=rtl] div .action .edit {
         margin-left: 5px;
     }

     div .action .delete i {
         color: #FC4438;
     }
     .data-search-form input.form-control, .data-search-form .btn {
    min-height: 50px;
}
.theme-form select, .theme-form select.form-control:not([size]):not([multiple]) {
    border-color: #cccccc;
}
 </style>
 @endsection

 @section('breadcrumb-title')
 <h3>All Domain and Hosting Data</h3>
 @endsection

 @section('breadcrumb-items')
 <li class="breadcrumb-item">Dashboard</li>
 <li class="breadcrumb-item active">Domain and Hosting Data</li>
 @endsection

 @section('content')
 <div class="container-fluid">
     <div class="row">
         <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Search Data</h5>
                </div>
             
                    <form class="form theme-form bold-labels data-search-form" action="" method="GET" enctype="multipart/form-data">
                      
                        <div class="card-body py-1 pb-3">
    
                            <div class="row">
                                <div class="col">
                                    <div class="row align-items-end">
    
    
                                        <div class="col-lg-2 col-md-4">
                                            <div class="">
                                                <label class=" col-form-label">Order Id</label>
                                                <div class="">
                                                    <input class="form-control" type="text" name="order" value="{{isset($search['order']) ? $search['order'] : '' }}" placeholder="Order Id" data-bs-original-title="" title="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-4">
                                            <div class="">
                                                <label class=" col-form-label">Brand</label>
                                                <div class="">
                                                   
                                                    <select name="brand_id" id="" class="form-control">
                                                        <option value="" selected disabled>-- Select a Brand --</option>
                                                        @foreach($brands as $brand)
                                                            @if(isset($search['brand_id']))
                                                            <option value="{{$brand->id}}"   {{ ($search['brand_id'] == $brand->id) ? 'selected' : '' }}>{{$brand->name}}</option>
                                                            @else
                                                            <o.ption value="{{$brand->id}}">{{$brand->name}}</option>
                                                            @endif
                                                               @endforeach
                                                    </select>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-lg-2 col-md-4">
                                            <div class="">
                                                <label class=" col-form-label">Status</label>
                                                <div class="">
                                                   
                                                    <select name="status" id="" class="form-control">
                                                        <option value="" selected disabled>-- Select a Status --</option>
                                                        <option value="active" {{(isset($search['status']) && $search['status'] == 'active') ? 'selected' : '' }}>Active</option>
                                                        <option value="expiring-soon" {{(isset($search['status']) && $search['status'] == 'expiring-soon') ? 'selected' : '' }}>Expiring Soon</option>
                                                        <option value="expired" {{(isset($search['status']) && $search['status'] == 'expired') ? 'selected' : '' }}>Expired</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
    
    
                                        <div class="col-3">
                                            <button class="btn btn-primary" type="submit" data-bs-original-title="" title="">Search</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
              
            </div>
             <div class="card">
                 <div class="card-header align-items-center card-header d-flex justify-content-between">
                     <h5>Domain and Hosting Data</h5>
                     <a href="{{ route('saveddata.create') }}" class="btn btn-primary">Add Data</a>
                 </div>
                 @if(Session::has('message'))
                 <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                     <strong>Updates ! </strong> {{ Session::get('message') }}.
                     <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
                 </div>
                 @endif
                 <div class="table-responsive">
                     <table class="table brand_table">
                         <thead>
                             <tr>
                                 <th scope="col">#</th>
                                 <th scope="col" class="table_name">Name</th>
                                 <th scope="col" class="brand_name">Brand</th>
                                 <th scope="col" class="brand_order_id">Order Id</th>
                                 <th scope="col" class="buy_source">Buy Source</th>
                                 <th scope="col" class="client_name">Client Name</th>
                                 <th scope="col" class="client_email">Client Email</th>
                                 <th scope="col" class="purhase_date">Purhase Date</th>
                                 <th scope="col" class="expire_date">Expire Date</th>
                                 <th scope="col" class="brand_Status">Status</th>
                                 <th scope="col" class="text-end table_action pe-5">Action</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach($savedDatas as $key => $savedData)
                             @php
                                $today = \Carbon\Carbon::today();
                                $expireDate = \Carbon\Carbon::parse($savedData->expire_date);
                                $purchaseDate = \Carbon\Carbon::parse($savedData->purchase_date);
                             @endphp
                      
                             <tr>
                                 <td>{{$key+1}}</td>
 
                                 <td>{{ $savedData->name }}</td>
                                 <td>{{ $savedData->brand->name??' - '}}</td>
                                 <td>{{ $savedData->order }}</td>
                                 <td>{{ $savedData->buy_source }}</td>
                                 <td>{{ $savedData->client_name }}</td>
                                 <td>{{ $savedData->client_email }}</td>
                                 <td>{{ $purchaseDate->format('d F Y') }}</td>
                                 <td>{{ $expireDate->format('d F Y') }}</td>
                                 <td>
                                    
                                    @if ($expireDate->isPast())
                                        <span class="badge rounded-pill badge-danger">Expired</span>
                                    @elseif ($expireDate->diffInDays($today) <= 30)
                                        <span class="badge rounded-pill badge-warning">Expiring Soon</span>
                                    @else
                                        <span class="badge rounded-pill badge-success">Active</span>
                                    @endif
                                </td>
                                 <td  class="text-end pe-5">
                                     <div class="dropdown_list">
                                <img src="{{asset('assets/images/ellipsis-vertical-solid.svg')}}">
                                
                               <ul class="action"> 
                                <li  class="edit"><a href="{{ route('saveddata.edit', encrypt($savedData->id)) }}" title=""> Edit</a></li>
                                <li class="edit"> 
                                                 <form action="{{ route('saveddata.destroy', encrypt($savedData->id)) }}" class="d-inline" method="POST">
                                                     @method('DELETE')
                                                     @csrf
                                                     <button> Delete </button>
                                                 </form></li>
                              {{-- <li class="delete"><a href="#"><i class="icon-trash"></i></a></li> --}}                                                                               
                            </ul>
                            </div>
                                     <!--<div class="btn-group">-->
                                     <!--    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions </button>-->
                                     <!--    <ul class="dropdown-menu dropdown-block text-start">-->
                                     <!--        <li><a class="dropdown-item" href="{{ route('saveddata.edit', $savedData->id) }}" title=""><i class="fa fa-pencil"></i> Edit</a></li>-->
                                     <!--        {{-- <li><a class="dropdown-item" href="{{ route('saveddata.suspend', $savedData) }}" title=""><i class="fa fa-pencil"></i> {{ ($savedData->status == 1) ? 'Suspend' : 'Active' }}</a></li> --}}-->
                                     <!--        <li >-->
                                              
                                     <!--            <form action="{{ route('saveddata.destroy', $savedData->id) }}" class="d-inline" method="POST">-->
                                     <!--                @method('DELETE')-->
                                     <!--                @csrf-->
                                     <!--                <button class="dropdown-item">-->
                                     <!--                    <i class="fa fa-trash"></i> Delete-->
                                     <!--                </button>-->
                                     <!--            </form>-->
                                     <!--        </li>-->
                                                 
                                     <!--    </ul>-->
                                     <!--</div>-->

                                 </td>
                             </tr>
                             @endforeach
                         </tbody>
                         <tfoot>
                                 <th scope="col">#</th>
                                 <th scope="col">Name</th>
                                 <th scope="col">Brand</th>
                                 <th scope="col">Order Id</th>
                                 <th scope="col">Buy Source</th>
                                 <th scope="col">Client Name</th>
                                 <th scope="col">Client Email</th>
                                 <th scope="col">Purhase Date</th>
                                 <th scope="col">Expire Date</th>
                                 <th scope="col">Status</th>
                                 <th scope="col" class="text-end pe-5">Action</th>
                </tfoot>
                     </table>
                 </div>
             </div>
         </div>
     </div>
 </div>
 @endsection

 @section('script')
 @endsection