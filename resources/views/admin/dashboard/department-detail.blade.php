@extends('admin.layouts.simple.master')

@section('title', 'Home')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/vendors/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/vendors/chartist.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/vendors/date-picker.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Home</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">{{$department->name}}</li>
@endsection
  
@section('content')  
 <!-- Container-fluid starts-->
 <div class="container-fluid">
    <div class="row widget-grid">
      <div class="col-xxl-12 col-sm-12 box-col-12">
        <div class="card profile-box ">
          <div class="card-body">
            <div class="media media-wrapper justify-content-between">
              <div class="media-body">
                <div class="greeting-user">
                  <h4 class="f-w-600">{{$department->name}} - {{($department->manager) ? $department->manager->name : ''}} Team Performance</h4>
                  <p>Here You Will see {{$department->name}} Deaprtments Performance</p>
                  <form action="" class="month_search" method="GET"> 
                    <input type="month" value="{{$month}}" name="month">
                    <button type="submit" class="btn btn-primary">search</button>
                  </form>
                </div>
              </div>
              <div>
                <div class="clockbox">
                  <svg id="clock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600">
                    <g id="face">
                      <circle class="circle" cx="300" cy="300" r="253.9"></circle>
                      <path class="hour-marks" d="M300.5 94V61M506 300.5h32M300.5 506v33M94 300.5H60M411.3 107.8l7.9-13.8M493 190.2l13-7.4M492.1 411.4l16.5 9.5M411 492.3l8.9 15.3M189 492.3l-9.2 15.9M107.7 411L93 419.5M107.5 189.3l-17.1-9.9M188.1 108.2l-9-15.6"></path>
                      <circle class="mid-circle" cx="300" cy="300" r="16.2"></circle>
                    </g>
                    <g id="hour">
                      <path class="hour-hand" d="M300.5 298V142"></path>
                      <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                    </g>
                    <g id="minute">
                      <path class="minute-hand" d="M300.5 298V67"> </path>
                      <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                    </g>
                    <g id="second">
                      <path class="second-hand" d="M300.5 350V55"></path>
                      <circle class="sizing-box" cx="300" cy="300" r="253.9"> </circle>
                    </g>
                  </svg>
                </div>
                <div class="badge f-10 p-0" id="txt"></div>
              </div>
            </div>
            <div class="cartoon"><img class="img-fluid" src="{{asset('assets/admin/images/cartoon.svg')}}" alt="vector women with leptop"></div>
            <div class="laptop_img department-detai_cartoon">
              <img src="{{asset('assets/admin/images/laptop2.gif')}}" alt="">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
            @if($department->parent_id == null && $department->sub_departments->count() > 0)
             @foreach ($department->sub_departments as $depart)
              <div class="col-xxl-4 col-xl-7 col-md-6 col-sm-5 box-col-6">
                <div class="card height-equal">
                  <div class="card-header card-no-border">
                    <div class="header-top">
                      <h5>{{($depart->manager) ? $depart->manager->name.' -' : ''}}  <span>{{$depart->name}}</span></h5>
            
                    </div>
                  </div>
                  <div class="card-body pt-0">
                    <div class="row recent-wrapper">
                      <div class="col-xl-6">
                        <div class="recent-chart" data="{{$depart->performance($month)}}">
                          <div class="recentchart"></div>
                        </div>
                      </div>
                      <div class="col-xl-6">
                        <ul class="order-content">
                          <li> <span class="recent-circle bg-primary"> </span>
                            <div> <span class="f-light f-w-500">Total Task</span>
                              <h4 class="mt-1 mb-0">{{ ($depart->target($month) != 0) ? $depart->target($month) : $depart->allTasks($month) }}<span class="f-light f-14 f-w-400 ms-1">({{ Carbon\Carbon::createFromFormat('Y-n', $month)->format('F Y');}}) </span></h4>
                            </div>
                          </li>
                          <li> <span class="recent-circle bg-info"></span>
                            <div> <span class="f-light f-w-500">Complete Task</span>
                              <h4 class="mt-1 mb-0">{{$depart->achiveTarget($month)}}</h4>
                            </div>
                          </li>
                          <li>
                            <div class="see_team">
                              <a href="{{route('department-detail', $depart->slug )}}" class="btn btn-primary">Team Details</a>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            @else
            
            @foreach ($employes as $employ)
          <div class="col-md-3">
            <div class="card height-equal radial-height">
              <div class="card-body radial-progress-card">
                <div>
                  <h6 class="mb-0">{{$employ->name}}</h6>
                  <div class="sale-details">
                    <h5 class="font-primary mb-0">{{($employ->target($month) != 0) ? $employ->target($month) : $employ->totalTasks($month) }}</h5><span class="f-12 f-light f-w-500"><i data-feather="check-circle"></i> {{($employ->achiveTarget($month) != 0) ? $employ->achiveTarget($month) : $employ->totalTasks($month) }}</span>
                  </div>
                  <a href="{{route('user-detail', $employ->id )}}" class="btn btn-secondary">Detail</a>
                  {{-- <p class="f-light"> The point of using Lorem Ipsum</p> --}}
                </div>
                <div class="rount_chart">
                  <svg viewBox="0 0 100 100">
                    <circle class="circle-bg" cx="50" cy="50" r="40" />
                    <circle class="circle-progress" cx="50" cy="50" r="40" />
                  </svg>
                  <span data-progress="{{$employ->performance($month)}}">{{$employ->performance($month)}}%</span>
                </div>
              
              </div>
            </div>
          </div>
          @endforeach
          @endif
     
        </div>
      </div>
    </div>
    <div class="row">

      <div class="col-xxl-12 col-xl-12 col-md-12 col-sm-12 box-col-12">
        <div class="card height-equal">
          <div class="card-header card-no-border">
            <div class="header-top">
              <h5>{{$department->name}} - {{($department->manager) ? $department->manager->name : ''}}</h5>
              
            </div>
          </div>
          <div class="card-body pt-0">
            <div class="row recent-wrapper">
              <div class="col-xl-6">
                <div class="recent-chart" data="{{$department->performance($month)}}">
                  <div class="recentchart"></div>
                </div>
              </div>
              <div class="col-xl-6">
                <ul class="order-content">
                  <li
                  class="d-table w-100"
                  > 
                    <div><span class="recent-circle bg-primary d-inline-block"> </span>  <span class="f-light f-w-500 d-inline-block">Total Task</span>
                      <h4 class="mt-1 mb-0 mx-3">{{ ($department->target($month) != 0) ? $department->target($month) : $department->allTasks($month) }}<span class="f-light f-14 f-w-400 ms-1">({{ Carbon\Carbon::createFromFormat('Y-n', $month)->format('F Y');}}) </span></h4>
                    </div>
                  </li>
                  <li 
                  class="d-table w-100"
                  >
                    <div> <span class="recent-circle bg-info d-inline-block"></span> <span class="f-light f-w-500 d-inline-block">Complete Task</span>
                      <h4 class="mt-1 mb-0 mx-3">{{$department->achiveTarget($month)}}</h4>
                    </div>
                  </li>
               
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
   
      
    </div>
  </div>
  <!-- Container-fluid Ends-->
<script type="text/javascript">
	var session_layout = '{{ session()->get('
	layout ') }}';
</script>
@endsection

@section('script')

@endsection