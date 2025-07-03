@extends('admin.layouts.simple.master')
 @section('title', 'Departments')

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
 </style>
 @endsection

 @section('breadcrumb-title')
 <h3>All Departments</h3>
 @endsection

 @section('breadcrumb-items')
 <li class="breadcrumb-item">Dashboard</li>
 <li class="breadcrumb-item active">Departments</li>
 @endsection

 @section('content')
 <div class="container-fluid">
     <div class="row">
         <div class="col-sm-12">
             <div class="card">
                 <div class="card-header align-items-center card-header d-flex justify-content-between">
                     <h5>Departments</h5>
                     <a href="{{ route('departments.create') }}" class="btn btn-primary">Add Department</a>
                 </div>
                 @if(Session::has('message'))
                 <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                     <strong>Updates ! </strong> {{ Session::get('message') }}.
                     <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
                 </div>
                 @endif
                 <div class="table-responsive">
                     <table class="table">
                         <thead>
                             <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Name</th>
                                 <th scope="col">This Month Performance</th>
                                 <th scope="col">Status</th>
                                 <th scope="col" class="text-end pe-5">Action</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach($departments as $key => $department)
                             <tr>
                                 <td>{{$key+1}}</td>
                                 <td>{{ $department->name }} {{ ($department->parent !=null) ? ' - '.$department->parent->name : '' }}</td>
                                 <td>
                                    <div class="chart_progress" data="{{$department->performance()}}">
                                        <div class="chart_progress_bar"></div>
                                      </div>
                                </td>
                                 <td>{{ ($department->status == 1) ? 'Active' : 'Non Active' }}</td>
                                 <td  class="text-end pe-5">
                                     <div class="btn-group">
                                         <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions </button>
                                         <ul class="dropdown-menu dropdown-block text-start">
                                             <li><a class="dropdown-item" href="{{ route('departments.edit', encrypt($department->id)) }}" title=""><i class="fa fa-pencil"></i> Edit</a></li>
                                             <li><a class="dropdown-item" href="{{ route('departments.suspend', encrypt($department->id)) }}" title=""><i class="fa fa-pencil"></i> {{ ($department->status == 1) ? 'Suspend' : 'Active' }}</a></li>
                                             <form action="{{ route('departments.destroy', encrypt($department->id)) }}" class="d-inline" method="POST">
                                                     @method('DELETE')
                                                     @csrf
                                                     <button class="dropdown-item">
                                                         <i class="fa fa-trash"></i> Delete
                                                     </button>
                                                 </form>
                                                 <!-- <a class="dropdown-item" href="#">What are you doing?</a></li-->
                                         </ul>
                                     </div>

                                 </td>
                             </tr>
                             @endforeach
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
 </div>
 @endsection

 @section('script')
 @endsection