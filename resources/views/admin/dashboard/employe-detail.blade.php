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
<li class="breadcrumb-item active">{{$employe->department->name}}</li>
@endsection

@section('content')
@php
$user = Auth::user();
@endphp

 <!-- Container-fluid starts-->
 <div class="container-fluid">
    <div class="row widget-grid emp_row">
      <div class="col-md-5 box-col-12 emp_col1">
        <div class="card profile-box ">
          <div class="card-body">
            <div class="media media-wrapper justify-content-between">
              <div class="media-body">
                <div class="greeting-user">
                  <h4 class="f-w-600">{{$employe->name}} Performance</h4>
                  <p>Here You Will see Performance</p>
                  <form action="" class="month_search emp_detail_form" method="GET"> 
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
            <!--<div class="cartoon"><img class="img-fluid" src="{{asset('assets/admin/images/cartoon.svg')}}" alt="vector women with leptop"></div>-->
          </div>
        </div>
      </div>
      <div class="col-md-7 emp_col2">
        <div class="row">
            
          <div class="col-md-12">
            <div class="card height-equal radial-height">
                @if($employe->department->slug == 'design')
              <div class="card-body radial-progress-card d-table" >
                 <div class="row">
                      <h6 class="mb-0 col-12">{{$employe->name}}</h6>
                    <div class="row col-5 align-items-center">
                        <div class="col-7">
                            <!--<h6 class="mb-0">Target</h6>-->
                              <div class="sale-details">
                                <h5 class="font-primary mb-0">{{($employ->target($month) != 0) ? $employ->target($month) : $employ->totalTasks($month) }} Total Tasks</h5><span class="f-12 f-light f-w-500 mb-2"><i data-feather="check-circle"></i> Completed {{$employe->achiveTarget($month)}}</span>
                              </div>
                        </div>
                        <div class="col-5">
                            <div class="rount_chart">
                                <svg viewBox="0 0 100 100">
                                    <circle class="circle-bg" cx="50" cy="50" r="40" />
                                    <circle class="circle-progress" cx="50" cy="50" r="40" />
                                  </svg>
                                  <span data-progress="{{$employe->performance($month)}}">{{$employe->performance($month)}}%</span>
                            </div>
                        </div>
                      
                     
                    </div>
                     <div  class="row col-7 align-items-center">
                         <div class="col-6">
                              <!--<h6 class="mb-0">Target</h6>-->
                              <div class="sale-details">
                                <h5 class="font-primary mb-0">{{$employe->approvedTarget($month)}} Approved Tasks</h5><span class="f-12 f-light f-w-500"><i data-feather="check-circle"></i> Completed {{$employe->achiveApprovedTarget($month)}}</span>
                              </div>
                      </div>
                      <div class="col-6">
                            <div class="rount_chart">
                                <svg viewBox="0 0 100 100">
                                    <circle class="circle-bg" cx="50" cy="50" r="40" />
                                    <circle class="circle-progress" cx="50" cy="50" r="40" />
                                  </svg>
                                  <span data-progress="{{$employe->approvedPerformance($month)}}">{{$employe->approvedPerformance($month)}}%</span>
                            </div>
                        </div>
                    </div>
                 </div>
               
              
              </div>
              @else
               <div class="card-body radial-progress-card " >
                    <div>
                  <h6 class="mb-0">Target</h6>
                  <div class="sale-details">
                    <h5 class="font-primary mb-0">{{($employe->target($month) != 0) ? $employe->target($month) : $employe->totalTasks($month) }} Tasks</h5><span class="f-12 f-light f-w-500 mb-2"><i data-feather="check-circle"></i> Completed {{$employe->achiveTarget($month)}}</span>
                  </div>
                 
                </div>
               
                 
                        <div class="rount_chart">
                          <svg viewBox="0 0 100 100">
                            <circle class="circle-bg" cx="50" cy="50" r="40" />
                            <circle class="circle-progress" cx="50" cy="50" r="40" />
                          </svg>
                          <span data-progress="{{$employe->performance($month)}}">{{$employe->performance($month)}}%</span>
                        </div>
                       
                    
                
                </div>
              @endif
            </div>
          </div>
         
       
        </div>
      </div>
      <div class="col-sm-12">
        <div class="card">
            <div class="card-header align-items-center card-header d-flex justify-content-between">
                <h5>Tasks</h5>
                @if ($user->role_id == 3)
                <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add Tasks</a>
                
                @endif
            </div>
            @if(Session::has('message'))
            <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                <strong>Updates ! </strong> {{ Session::get('message') }}.
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>
            @endif
            <div class="card-body">
            <div class="dt-ext table-responsive">
                <table class="display emp_table" id="keytable">
                    <thead>
                        <tr>
                            <th scope="col" class="s_id_table">S.No</th>
                            <th scope="col" class="order_id_table">Order ID</th>
                            <!--<th scope="col">Details</th>-->
                            <th scope="col depatment_table" class="depatment_table">Department</th>
                            <!--<th scope="col">Manager</th>-->
                            <th scope="col" class="assign_date">Assign Date</th>
                            <th scope="col" class="due_date">Due Date</th>
                            <th scope="col" class="table_type">Type</th>
                          
                            <th scope="col" class="table_type">Rating</th>
                           
                            <th scope="col" clas="table_status">Status</th>
                            <th scope="col" class="table_action">Action</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $key => $task)
                        
                        <tr>
                            <td>{{ $key+1}}</td>
                            <td><p><b><a href="{{ route('tasks.detail', $task->id) }}"  target="_blank">{{ $task->name }}</a></b></p></td>
                            <!--<td>{!! $task->details !!}</td>-->
                            <td>{{ $task->user->department->name }}</td>
                            <!--<td>{{ ($task->user->department->manager) ? $task->user->department->manager->name : '--' }}</td>-->
                            <td>{{ $task->assign_date }}</td>
                            <td>{{ $task->due_date }}</td>
                            <td>
                             @if ($task->type == "1")
                                <span class="badge rounded-pill badge-info">Initial</span> 
                            @elseif ($task->type == "2")
                                <span class="badge rounded-pill badge-info">Revision</span> 
                            @elseif ($task->type == "3")
                                <span class="badge rounded-pill badge-info">Initial Brand</span>
                            @elseif ($task->type == "4")
                                <span class="badge rounded-pill badge-info">Brand Revison</span>
                            @elseif ($task->type == "5")
                                <span class="badge rounded-pill badge-info">Site live</span>
                            @elseif ($task->type == "6")
                                <span class="badge rounded-pill badge-info">Audio naration</span>
                            @elseif ($task->type == "7")
                                <span class="badge rounded-pill badge-info">SEO</span>
                            @elseif ($task->type == "8")
                                <span class="badge rounded-pill badge-info">Branding</span>
                            @elseif ($task->type == "9")
                                <span class="badge rounded-pill badge-info">ORM</span>
                            @endif
                       
                        </td>
                            <td>{{ $task->rating }}%</td>
                       
                            <td>
                               
                                    @if ($task->status == 0)
                                        <span class="badge rounded-pill badge-warning">Open</span> 
                                    @elseif ($task->status == 1)
                                        <span class="badge rounded-pill badge-success">Completed </span> 
                                    @elseif ($task->status == 2)
                                        <span class="badge rounded-pill badge-dark">Closed - Approved</span> 
                                    @elseif ($task->status == 3)
                                     <span class="badge rounded-pill badge-info">Delayed - Approved</span> 
                                    @elseif ($task->status == 4)
                                    <span class="badge rounded-pill badge-dark">Completed - Not Approved</span>
                                    @else
                                    <span class="badge rounded-pill badge-danger">Rejected</span> 
                                    @endif
                               
                            </td>
                            <td>
                                <div class="dropdown_list">
                                <img src="{{asset('assets/images/ellipsis-vertical-solid.svg')}}">
                                @if ($user->role_id == 2) 
                                 <ul class="action"> 
                                        <li  class="edit"><a href="javascript:;" title=""  data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-bs-taskid="{{$task->id}}" data-bs-status="{{$task->status}}">Select a Status</a></li>
                                        <li class="edit"> <a href="{{ route('tasks.detail', $task->id) }}">Task Detail</a></li>
                                        <li class="edit"> <a href="{{ route('tasks.edit', $task->id) }}">Edit</a></li>
                            
                                      {{-- <li class="delete"><a href="#"><i class="icon-trash"></i></a></li> --}}                                                                               
                                    </ul>
                                @elseif ($task->status == 0 && $user->role_id == 3)
                                <ul class="action"> 
                                    <li class="edit"> <a href="{{ route('tasks.detail', $task->id) }}">Task Detail</a></li>
                                        <li class="edit"> <a href="{{ route('tasks.edit', $task->id) }}">Edit</a></li>
                                        <li class="edit"> <a href="{{ route('tasks.delete', $task->id) }}">Delete</a></li>

                                </ul>
                                @else
                                <ul class="action"> 
                                    <li class="edit"> <a href="{{ route('tasks.detail', $task->id) }}">Task Detail</a></li>

                                </ul>
                                    @endif
                                    </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                       <tfooter>
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Order ID</th>
                            <!--<th scope="col">Details</th>-->
                            <th scope="col depatment_table">Department</th>
                            <!--<th scope="col">Manager</th>-->
                            <th scope="col">Assign Date</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Type</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                           
                        </tr>
                    </tfooter>
                </table>
            </div>
            </div>
        </div>
    </div>
    </div>
  
  </div>
  <!-- Container-fluid Ends-->
  
  


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Change Task Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
        </div>
        <div class="modal-body">
            <form class="form theme-form bold-labels" action="{{ route('tasks.status') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="taskid" class="task-id-inp" value="">
                <div class="my-3">
                    <label class=" col-form-label">Select a Status </label>
                    <div class="">
                        <select name="status" id="" class="form-control">
                           
                           <option value="0">Opened</option>
                           <option value="1">Completed</option>
                           <option value="2">Closed</option>
                           <option value="3">Delayed</option>
                           <option value="4">Completed Not Approved</option>
                           <option value="5">Rejected</option>
                        </select>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
       
      </div>
    </div>
  </div>
<script type="text/javascript">

	var session_layout = '{{ session()->get('layout ') }}';
    var exampleModal = document.getElementById('staticBackdrop')
    exampleModal.addEventListener('show.bs.modal', function (event) {

    var button = event.relatedTarget

    var taskId = button.getAttribute('data-bs-taskid')
    var status = button.getAttribute('data-bs-status')
    

    var taskIdinput = exampleModal.querySelector('.modal-body input.task-id-inp')
    var taskStatusInput = exampleModal.querySelector('.modal-body select')


    taskIdinput.value = taskId
    taskStatusInput.value = status.toString();

    })
    
    
$(document).ready(function () {
    $('#check-all').on('change', function () {
        $('.row-checkbox').prop('checked', this.checked);
        toggleApproveButton();
    });

    $('.row-checkbox').on('change', function () {
        const total = $('.row-checkbox').length;
        const checked = $('.row-checkbox:checked').length;
        $('#check-all').prop('checked', total === checked);
        toggleApproveButton();
    });

    function toggleApproveButton() {
        const selected = $('.row-checkbox:checked');
        if (selected.length > 0) {
            
            $('#approve-selected').removeClass('d-none');
            const ids = selected.map(function () {
                return $(this).val();
            }).get();
            $('#selected-ids').val(ids.join(','));
        } else {
            $('#approve-selected').addClass('d-none');
            $('#selected-ids').val('');
        }
    }
});
</script>
@endsection

@section('script')

@endsection
