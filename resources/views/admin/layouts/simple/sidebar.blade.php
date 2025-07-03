@php
$currentRoute = Route::currentRouteName();
$user = Auth::user();

@endphp
<div class="sidebar-wrapper">
	<div>
		<div class="logo-wrapper">
			<a href="{{route('index')}}"><img class="img-fluid for-light" src="{{ $setting['logo'] }}" alt=""><img class="img-fluid for-dark" src="{{ $setting['logo_2'] }}" alt=""></a>
		</div>
		<div class="logo-icon-wrapper"><a href="{{route('index')}}"><img class="img-fluid" src="{{ asset('assets/admin/images/logo/logo-icon.png') }}" alt=""></a></div>
		<nav class="sidebar-main">
			<div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
			<div id="sidebar-menu">
				<ul class="sidebar-links" id="simple-bar">
					<li></li>
					@if ($user->role_id == 1 || $user->role_id == 2)
					<li class="sidebar-main-title sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'index' ? 'active' : '' }}" href="{{route('index')}}">
							<i data-feather="file-text"> </i><span>Dashboard</span>
						</a>
					</li>
					@endif
					@if ($user->role_id == 3)
					<li class="sidebar-main-title sidebar-list">
						<a class="sidebar-link sidebar-title link-nav active" href="{{route('user-detail', $user->id)}}">
							<i data-feather="file-text"> </i><span>Dashboard</span>
						</a>
					</li>
					@endif

					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav active" href="javascript:;">
							<i data-feather="user"></i><span>ERP </span>
							<div class="according-menu d-block">
								<i class="fa fa-angle-down"></i>
							</div>
						</a>
						<ul class="sidebar-submenu ">

							<li class="sidebar-list">
								<a class="sidebar-link sidebar-title link-nav " href="javascript:;">
									<i data-feather="user"></i><span>Suppliers </span>
									<div class="according-menu d-block">
										<i class="fa fa-angle-down"></i>
									</div>
								</a>
								<ul class="sidebar-submenu ">
									<li><a href="{{route('suppliers.index')}}" class="{{ Str::startsWith($currentRoute, 'suppliers') ? 'active' : '' }}">All Suppliers</a></li>
									<li><a href="{{route('suppliers.create')}}" class="{{ Str::startsWith($currentRoute, 'suppliers') ? 'active' : '' }}">Add New Supplier</a></li>
		
								</ul>
							</li>

							<li class="sidebar-list">
								<a class="sidebar-link sidebar-title link-nav active" href="javascript:;">
									<i data-feather="user"></i><span>Yarn </span>
									<div class="according-menu d-block">
										<i class="fa fa-angle-down"></i>
									</div>
								</a>
								<ul class="sidebar-submenu ">
									<li><a href="{{route('yarn.purchase.index')}}" class="{{ Str::startsWith($currentRoute, 'yarn') ? 'active' : '' }}"> Purchase Orders</a></li>
									<li><a href="{{route('yarn.purchase.create')}}" class="{{ Str::startsWith($currentRoute, 'yarn') ? 'active' : '' }}">New Purchase Order</a></li>
									<li><a href="{{route('yarn.inventory.index')}}" class="{{ Str::startsWith($currentRoute, 'yarn') ? 'active' : '' }}">Inventory</a></li>
								</ul>
							</li>

							<li class="sidebar-list">
								<a class="sidebar-link sidebar-title link-nav active" href="javascript:;">
									<i data-feather="user"></i><span>Dyeing Department </span>
									<div class="according-menu d-block">
										<i class="fa fa-angle-down"></i>
									</div>
								</a>
								<ul class="sidebar-submenu ">
									<li><a href="{{route('dyeing.index')}}" class="{{ Str::startsWith($currentRoute, 'dyeing') ? 'active' : '' }}">All Batches</a></li>
									<li><a href="{{route('dyeing.create')}}" class="{{ Str::startsWith($currentRoute, 'dyeing') ? 'active' : '' }}">Add New Batch</a></li>
		
								</ul>
							</li>


							<li class="sidebar-list">
								<a class="sidebar-link sidebar-title link-nav active" href="javascript:;">
									<i data-feather="user"></i><span>Suppliers </span>
									<div class="according-menu d-block">
										<i class="fa fa-angle-down"></i>
									</div>
								</a>
								<ul class="sidebar-submenu ">
									<li><a href="{{route('suppliers.index')}}" class="{{ Str::startsWith($currentRoute, 'suppliers') ? 'active' : '' }}">All Suppliers</a></li>
									<li><a href="{{route('suppliers.create')}}" class="{{ Str::startsWith($currentRoute, 'suppliers') ? 'active' : '' }}">Add New Supplier</a></li>
		
								</ul>
							</li>

						</ul>
					</li>

					@if ($user->role_id == 1 || $user->role_id == 2)
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Str::startsWith($currentRoute, 'managers') ? 'active' : '' }} {{ Str::startsWith($currentRoute, 'employes') ? 'active' : '' }}" href="javascript:;">
							<i data-feather="user"></i><span>Users </span>
							<div class="according-menu d-block">
								@if(Str::startsWith($currentRoute, 'managers') || Str::startsWith($currentRoute, 'employes'))
								<i class="fa fa-angle-down"></i>
								@else
								<i class="fa fa-angle-right"></i>
								@endif </div>
						</a>
						<ul class="sidebar-submenu " style="display: {{ Str::startsWith($currentRoute, 'managers') || Str::startsWith($currentRoute, 'employes') ? 'block' : 'none' }} ;">
							
							<li><a href="{{route('managers_list')}}" class="{{ Str::startsWith($currentRoute, 'managers') ? 'active' : '' }}">{{ ($user->role_id == 2) ? 'Team Leads' : 'Managers'}}</a></li>

							<li><a href="{{route('employes_list')}}" class="{{ Str::startsWith($currentRoute, 'employes') ? 'active' : '' }}">Employes</a></li>
						</ul>
					</li>

					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Str::startsWith($currentRoute, 'attendances')  ? 'active' : '' }}" href="{{route('attendances.index')}}">
							<i data-feather="calendar"> </i><span>Attendances </span>
						</a>
					</li>

					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Str::startsWith($currentRoute, 'salaries')  ? 'active' : '' }}" href="{{route('salaries.index')}}">
							<i data-feather="dollar-sign"> </i><span>Salaries </span>
						</a>
					</li>

					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Str::startsWith($currentRoute, 'payroll')  ? 'active' : '' }}" href="{{route('payroll.index')}}">
							<i data-feather="file-text"> </i><span>Payroll </span>
						</a>
					</li>
					@endif

					@if ($user->role_id == 4)
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav  active" href="{{route('index')}}">
							<i data-feather="layers"></i><span>Departments </span>
							<div class="according-menu d-block">
								<i class="fa fa-angle-down"></i>
							</div>
						</a>
						<ul class="sidebar-submenu " style="display: block ;">
							@php
							$departments = App\Models\Department::where('parent_id',null)->where('status',1)->get();
							@endphp
							@foreach ($departments as $department)
							<li><a href="{{route('department-detail', $department->slug)}}" class="{{ Str::startsWith($currentRoute, 'department') ? 'active' : '' }}">{{$department->name}}</a></li>
							@endforeach
						</ul>
					</li>
					@endif
					@if ($user->role_id == 1)
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Str::startsWith($currentRoute, 'departments')  ? 'active' : '' }}" href="{{route('departments.index')}}">
							<i data-feather="layers"> </i><span>Departments </span>
						</a>
					</li> 
					@endif
					@if ($user->role_id == 2 && $user->department->parent_id == null)
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Str::startsWith($currentRoute, 'departments')  ? 'active' : '' }}" href="{{route('departments.index')}}">
							<i data-feather="layers"> </i><span>Departments </span>
						</a>
					</li> 
					@endif
					@if ($user->role_id == 1 || $user->role_id == 2)
					@if($user->extra_access == 1)
					
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Str::startsWith($currentRoute, 'brands')  ? 'active' : '' }}" href="{{route('brands.index')}}">
							<i data-feather="package"> </i><span>Brands </span>
						</a>
					</li> 

					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Str::startsWith($currentRoute, 'saveddata')  ? 'active' : '' }}" href="{{route('saveddata.index')}}">
							<i data-feather="server"> </i><span>Hosting/Domain Data </span>
							{{-- <i data-feather="hard-drive"> </i><span>Hosting/Domain Data </span> --}}
						</a>
					</li>

					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Str::startsWith($currentRoute, 'email-management')  ? 'active' : '' }}" href="{{route('email-management.index')}}">
							<i data-feather="mail"> </i><span>Email Data </span>
						</a>
					</li> 
					@endif
					@endif

					@if ($user->role_id == 1 || $user->role_id == 2)
					@php
						if($user->role_id == 1){
                          $unReadtasks = App\Models\Task::where('is_read', 0)->latest()->get();
                        }elseif($user->role_id == 2){
                           if($user->department->parent_id == null && $user->department->sub_departments->count() > 0){
                                $subDepartments = App\Models\Department::where('parent_id', $user->department->id)->pluck('id')->toArray();
                                $users = App\Models\User::whereIn('department_id', $subDepartments)->where('role_id', 3)->pluck('id')->toArray();
                            }else{
                                $users = App\Models\User::where('department_id', $user->department->id)->where('role_id', 3)->pluck('id')->toArray();
                            }
                          $unReadtasks = App\Models\Task::whereIn('user_id',$users)->where('is_read', 0)->latest()->get();
                          }else{
                          $unReadtasks = null;
                          }
					@endphp
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Str::startsWith($currentRoute, 'tasks')  ? 'active' : '' }}" href="{{route('tasks.index')}}">
							<i data-feather="check-square"> </i><span> @if($unReadtasks != null) <label class="badge badge-light-primary">{{$unReadtasks->count()}}</label> @endif Tasks </span>
						</a>
					</li> 

					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Str::startsWith($currentRoute, 'targets')  ? 'active' : '' }}" href="{{route('targets.index')}}">
							<i data-feather="crosshair"> </i><span>Targets </span>
						</a>
					</li> 
					@endif
					
					@if ($user->role_id == 1)
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'configs' ? 'active' : '' }} " href="{{route('configs.index')}}">
							<i data-feather="sliders"> </i><span>Configs</span>
						</a>
					</li>

					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'settings' ? 'active' : '' }} " href="{{route('settings')}}">
							<i data-feather="settings"> </i><span>Setting</span>
						</a>
					</li>
					@endif
					@if ($user->role_id == 2 || $user->role_id == 3)
					<li class="sidebar-list">
						<a class="sidebar-link sidebar-title link-nav {{ Route::currentRouteName() == 'profile' ? 'active' : '' }} " href="{{route('profile')}}">
							<i data-feather="users"> </i><span>Profile</span>
						</a>
					</li>
					@endif

				</ul>
			</div>
			<div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
		</nav>
	</div>
	
	<a href"javascript:;" class="sidebar_open"><i class="fa fa-bars"></i></a>
</div>