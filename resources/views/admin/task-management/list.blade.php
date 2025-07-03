@extends('admin.layouts.simple.master')
@section('title', 'Tasks')

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
        /*color: #54BA4A;*/
    }

    [dir=rtl] div .action .edit {
        margin-left: 5px;
    }

    div .action .delete i {
        /*color: #FC4438;*/
    }
    .modal {
    z-index: 10;
}

.modal-backdrop {
    z-index: 9;
}
</style>
@endsection

@section('breadcrumb-title')
<h3>All Tasks</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Tasks</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
 <div class="col-sm-12">
        <div class="card">
            <div class="card-header align-items-center card-header d-flex justify-content-between">
                <h5>Tasks</h5>
                <div class="d-flex gap-3">
                    <form  id="approve-selected" class="d-none" action="{{ route('tasks.bulkApprove') }}" method="POST">
                        @csrf
                        <input type="hidden" name="selectedids" id="selected-ids">
                    <button class="btn btn-success ">Approve Selected</button>
                        
                    </form>
                <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add Tasks</a>
                </div>
            </div>
            @if(Session::has('message'))
            <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                <strong>Updates ! </strong> {{ Session::get('message') }}.
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
            </div>
            @endif
          <div class="card-body">
            <div class="dt-ext table-responsive">
              <table class="display" id="keytable">
                <thead>
                  <tr>
                    <th class="s_id_table"><input type="checkbox" name="" id="check-all" class="check-all-checkbox"></th>
                    <th class="table_id">#</th>
                    <th class="order_id">Order Id</th> 
                    <th class="table__user">User</th>
                    <th class="department">Department</th>
                    <!--<th class="manager">Manager</th>-->
                    <th class="assign_date">Assign Date</th>
                    <th class="due_date">Due Date</th>
                    <th class="table__type">Type</th>
                   
                        <th class="table__type">Rating</th>
                        
                    
                    <th class="table_statue">Status</th>
                    <th class="table_action">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $key => $task)
                    <tr>
                      <td><input type="checkbox" name="check" class="row-checkbox" value="{{$task->id}}" id=""></td>  
                      <td>{{ $key+1}}</td>
                        <td><p><a href="{{ route('tasks.detail', encrypt($task->id)) }}"  target="_blank">{{ $task->name }}</a></p></td>
                        <td>{{ $task->user->name }}</td>
                        <td>{{ $task->user->department->name }}</td>
                        {{-- <td>{{ ($task->user->department->manager) ? $task->user->department->manager->name : '--' }}</td> --}}
                        <td>{{ \Carbon\Carbon::parse($task->assign_date)->format('d F, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d F, Y') }}</td>                                                
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
                                <span class="badge rounded-pill badge-info">SEO Branding</span>
                            @elseif ($task->type == "9")
                                <span class="badge rounded-pill badge-info">ORM</span>
                            @elseif ($task->type == "10")
                                <span class="badge rounded-pill badge-info">Link Building</span>
                            @endif
                       
                        </td>
                        
                        <td>{{ $task->rating }}%</td>
                        
                        <td>
                             @if ($task->status == 0)
                                <span class="badge rounded-pill badge-warning">Open</span> 
                            @elseif ($task->status == 1)
                                <span class="badge rounded-pill badge-success">Completed</span> 
                            @elseif ($task->status == 2)
                                <span class="badge rounded-pill badge-dark">Closed - Approved</span> 
                            @elseif ($task->status == 3)
                             <span class="badge rounded-pill badge-info">Delayed - Approved</span> 
                            @elseif ($task->status == 4)
                            <span class="badge rounded-pill badge-dark">Completed-NA</span>
                            @else
                            <span class="badge rounded-pill badge-danger">Rejected</span> 
                            @endif
                       
                        </td>
                        <td class="action_list">
                            <div class="dropdown_list">
                                <img src="{{asset('assets/images/ellipsis-vertical-solid.svg')}}">
                                <ul class="action"> 
                                <li  class="edit"><a href="javascript:;" title=""  data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-bs-taskid="{{$task->id}}" data-bs-status="{{$task->status}}">Select a Status</i>
</a>
<!--<span clas="tooltip">Type</span>-->
</li>
                                <li class="edit"> <a href="{{ route('tasks.detail', encrypt($task->id)) }}" target="_blank">Task Details</a>
                                <li class="edit"> <a href="{{ route('tasks.edit', encrypt($task->id)) }}">Edit</a></li>
                            <!--  <li class="delete">-->
                            <!--    <form action="{{ route('tasks.destroy', $task->id) }}" class="d-inline" method="POST">-->
                            <!--        @method('DELETE')-->
                            <!--        @csrf-->
                            <!--       <button type="submit" class="p-0 border-0 bg-transparent">-->
                            <!--            <i class="icon-trash"></i>-->
                            <!--        </button>                                   -->
                            <!--    </form>-->
                            <!--</li>-->
                              {{-- <li class="delete"><a href="#"><i class="icon-trash"></i></a></li> --}}                                                                               
                            </ul>
                            </div>
                            
                          </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th><input type="checkbox" name="" id="" class="check-all-checkbox"></th>
                    <th>#</th>
                    <th>Order Id</th>
                    
                    <th>User</th>
                    <th>Department</th>
                    <!--<th>Manager</th>-->
                    <th>Assign Date</th>
                    <th>Due Date</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



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
@endsection

@section('script')
<script>
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