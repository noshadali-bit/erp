@extends('admin.layouts.simple.master')
@section('title', 'User Detail')

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
<h3>User Detail</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">User Detail</li>
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
                        <div class="col-md-12">
                            <h4>User Detail</h4>
                        </div>
                    </div>
                    
                  </div>
                  <div>
                    <div class="card-block row">
                      <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <tbody>
                              @foreach ($user->getAttributes() as $key => $item)
                                @if ($item!=null && $key!='id' && $key!='password' && $key!='is_admin' && $key!='status')
                                <tr>
                                  <td ><b> {{ $key }}</b></td>
                                  <td >
                                    @if (is_array($item))
                                      @foreach ($item as $subItem)
                                        <span>
                                          {{ $subItem }}<br>
                                        </span>
                                      @endforeach
                                    @elseif ($key=='role_id')
                                    <span>{!! $user->role->name !!}</span></td>
                                    @elseif ($key=='department_id')
                                    <span>{!! $user->department->name !!}</span></td>
                                    @else
                                    <span>{!! $item !!}</span></td>
                                    @endif
                                </tr>
                                @endif
                              @endforeach
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






