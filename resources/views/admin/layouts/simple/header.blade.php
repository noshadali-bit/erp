<div class="page-header">
  <div class="header-wrapper row m-0">
    <form class="form-inline search-full col" action="#" method="get">
      <div class="mb-3 w-100">
        <div class="Typeahead Typeahead--twitterUsers">
          <div class="u-posRelative">
            <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Cuba .." name="q" title="" autofocus>
            <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div>
            <i class="close-search" data-feather="x"></i>
          </div>
          <div class="Typeahead-menu"></div>
        </div>
      </div>
    </form>
    <div class="header-logo-wrapper col-auto p-0">
      <div class="logo-wrapper"><a href="{{route('index')}}"><img class="img-fluid" src="{{asset('assets/admin/images/logo/logo.png')}}" alt=""></a></div>
      <!-- <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div> -->
    </div>
    <div class="left-header col horizontal-wrapper ps-0">
      
    </div>
    <div class="nav-right col-8 pull-right right-header p-0">
      <ul class="nav-menus">
        @php
        $user = Auth::user();
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
         @if($unReadtasks != null)
           <li class="onhover-dropdown"> 
                <div class="notification-box">
                  <svg>
                    <use href="{{asset('assets/admin/svg/icon-sprite.svg#notification')}}"></use>
                  </svg><span class="badge rounded-pill badge-danger">{{$unReadtasks->count()}} </span>
                </div>
                <div class="onhover-show-div notification-dropdown">
                  <h6 class="f-18 mb-0 dropdown-title">Notitications                               </h6>
                  <ul>
                      
                     
                    @foreach ($unReadtasks->take(4) as $unReadtask)
                    <li class="b-l-secondary border-4">
                      <p><span class="not-text">{{$unReadtask->name}}</span> <span class="font-danger date">{{ $unReadtask->created_at->diffForHumans() }}</span></p>
                    </li>
                    @endforeach
                   @if($unReadtasks->count() > 0)
                    <li><a class="f-w-700" href="{{route('tasks.index')}}">View All</a></li>
                  @endif
                  </ul>
                </div>
              </li>
               @endif
        <li class="profile-nav onhover-dropdown p-0 me-0">
          <div class="media profile-media" id='logout'>
            <img class="b-r-10" src="{{asset('assets/admin/images/dashboard/profile.jpg')}}" alt="">
            <div class="media-body">
              <span>{{ Auth::user()->name }}</span>
              <p class="mb-0 font-roboto">User <i class="middle fa fa-angle-down"></i></p>
            </div>
          </div>
          <ul class="profile-dropdown logout_menu onhover-show-div">
            <li><a href="{{ route('admin_logout') }}"><i data-feather="log-out"> </i><span>Log out</span></a></li>
          </ul>
        </li>
      </ul>
    </div>
    <script class="result-template" type="text/x-handlebars-template">
      <div class="ProfileCard u-cf">                        
      <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
      <div class="ProfileCard-details">
      <div class="ProfileCard-realName">@{{name}}</div>
      </div>
      </div>
    </script>
    <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
  </div>
</div>
