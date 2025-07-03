@extends('admin.layouts.simple.master')
@section('title', 'Tasks Detail')

@section('css')
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>

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
.task-rating {
    display: flex;
    align-items: center;
    flex-direction: column;
    width: 100%;
    gap: 23px;
}

.task-rating span.irs {
    width: 100%;
}
</style>
@endsection

@section('breadcrumb-title')
<h3>Tasks Detail</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">Tasks Detail</li>
@endsection

@section('content')
@php
$cuser = Auth::user();
@endphp
  <!-- Container-fluid starts                    -->
          <div class="container-fluid">
            <!-- Table Row Starts-->
            <div class="row">
              <div class="col-sm-12">
                <div class="card detail_card">
                  <div class="card-header">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <h4>Task Detail</h4>
                        </div>
                        <div class="col-md-4">
                            @if($cuser->role_id == 2 || $cuser->role_id == 1)
                            <form class="task-rating" action="{{ route('tasks.updateRating', $task->id) }}" method="POST" >
                                @csrf
                                <input type="text" class="js-range-slider" name="rating" value="{{$task->rating}}" />
                                <button type="submit" class="btn btn-primary">Update Rating</button>
                            </form>
                             @endif
                        </div>
                        <div class="col-md-4 text-end">
                            @if($cuser->role_id == 2 || $cuser->role_id == 1)
                            
                            <select  class="task-status-select" data-task-id="{{ $task->id }}">
                                <option value="0" {{ ($task->status == '0') ? 'selected' : '' }} >Opened</option>
                                <option value="1" {{ ($task->status == '1') ? 'selected' : '' }} >Completed</option>
                                <option value="2" {{ ($task->status == '2') ? 'selected' : '' }} >Closed</option>
                                <option value="3" {{ ($task->status == '3') ? 'selected' : '' }} >Delayed</option>
                                <option value="4" {{ ($task->status == '4') ? 'selected' : '' }} >Completed Not Approved</option>
                                <option value="5" {{ ($task->status == '5') ? 'selected' : '' }} >Rejected</option>
                            </select>
                            @endif
                        </div>
                    </div>
                    
                    
                    
                  </div>
                  <div>
                    <div class="card-block row">
                      <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <tbody>
                              <tr>
                                <td colspan="2"><b>Order Id</b></td>
                                
                                <td colspan="2"><span>{{$task->name}}</span></td>
                              </tr>
                               <tr>
                                <td colspan="2"><b>user</b></td>
                                
                                <td colspan="2"><span>{{$task->user->name}}</span></td>
                              </tr>
                              <tr>
                                <td><b>Assign Date</b></td>
                                <td><span>{{ \Carbon\Carbon::parse($task->assign_date)->format('d F, Y') }}</span></td>
                                <td><b>Due Date</b></td>
                                <td><span>{{ \Carbon\Carbon::parse($task->due_date)->format('d F, Y') }}</span></td>
                              </tr>
                               <tr>
                                <td><b>Status</b></td>
                                
                                <td class="detail_status"> 
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
                                
                                <td><b>Type</b></td>
                                
                                <td class="detail_type"> 
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
                                    @elseif ($task->type == "10")
                                        <span class="badge rounded-pill badge-info">Link Building</span>
                                    @endif

                                </td>
                              </tr>
                              <tr>
                                <td colspan="4"><b>Task Details</b></td>
                              </tr>
                              <tr>
                                <td colspan="4">
                                    {!! $task->details !!}
                                </td>
                              </tr>
                   
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Container-fluid Ends-->
            </div>
          </div>




@endsection

@section('script')
    <!--Plugin JavaScript file-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
<script>
$(document).ready(function() {
    $('.task-status-select').on('change', function() {
        let taskId = $(this).data('task-id');
        let newStatus = $(this).val();
        let url = "{{ route('tasks.updateStatus', ':id') }}".replace(':id', taskId);
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: newStatus
            },
            success: function(response) {
                 Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Task status updated successfully!',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        location.reload(); // Reloads the page after the alert disappears
                    });
                
            },
            error: function(xhr) {
                Swal.fire({
                  title: 'Error!',
                  text: 'Failed to update task status. Try Again in Few Minutes.',
                  icon: 'error',
                  confirmButtonText: 'OK'
                });
            }
        });
    });
    @if($cuser->role_id == 2 || $cuser->role_id == 1)
      $(".js-range-slider").ionRangeSlider({
        type: "single",
        skin: "round",
        min: 0,
        from: {{ $task->rating  }},
        max: 100,
        to: 100,
        step: 5,
        grid: true
    });
    
    @endif
});
</script>
@endsection