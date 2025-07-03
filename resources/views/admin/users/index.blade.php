@extends('admin.layouts.simple.master')
@section('title', 'users')

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
<h3>All users</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">users</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
 <div class="col-sm-12">
        <div class="card">
            <div class="card-header align-items-center card-header d-flex justify-content-between">
                <h5>users</h5>
                <div class="d-flex gap-3">
                    
                <a href="{{ route('users.create') }}" class="btn btn-primary">Add user</a>
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
                    <th>S:No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Designation</th>
                    <th>Base Salary</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                    <tr>
                        <td>{{ $key+1}}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->designation }}</td>
                        <td>{{ number_format($user->base_salary, 2) }}</td>
                        
                        <td class="action_list">
                            <div class="dropdown_list">
                                <img src="{{asset('assets/images/ellipsis-vertical-solid.svg')}}">
                                <ul class="action"> 
                                    <li  class="edit"><a href="{{ route('users.show', encrypt($user->id)) }}">View Detail</i>
                                    <li class="edit"> <a href="{{ route('users.edit', encrypt($user->id)) }}" target="_blank">Edit</a>
                                    <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', encrypt($user->id)) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                      </li>
                                </ul>
                            </div>
                            
                          </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>S:No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Designation</th>
                    <th>Base Salary</th>
                    <th>Actions</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
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

</script>
@endsection
