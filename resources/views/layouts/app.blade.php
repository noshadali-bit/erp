<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
  <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="pixelstrap">
  <link rel="icon" href="{{asset('assets/images/techfav.png')}}" type="image/x-icon">
  <link rel="shortcut icon" href="{{asset('assets/images/techfav.png')}}" type="image/x-icon">
  <title>@yield(section: 'title')</title>
  <!-- Google font-->
  <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
  @include('admin.layouts.simple.css')
  @yield('style')
  @php
  $color = $setting["color"];
  @endphp
  <style>
    :root {
      --theme-deafult: @php echo $color @endphp;
      --theme-secondary: @php echo $color @endphp;
    }
  </style>
</head>

<body @if(Route::current()->getName() == 'index') onload="startTime()" @endif>
  
<div class="page-loader">
  <div class="loader-dots"><span></span></div>
  <svg>
    <defs></defs>
    <filter id="goo">
      <feGaussianBlur in="SourceGraphic" stdDeviation="11" result="blur"></feGaussianBlur>
      <feColorMatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"></feColorMatrix>
    </filter>
  </svg>
</div>

<div class="tap-top"><i data-feather="chevrons-up"></i></div>
  <div class="page-wrapper compact-wrapper" id="pageWrapper">
    @include('admin.layouts.simple.header')
    <!-- Page Header Ends  -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
      <!-- Page Sidebar Start-->
      @include('admin.layouts.simple.sidebar')
      <!-- Page Sidebar Ends-->
      <div class="page-body">
        <div class="container-fluid">
          <div class="page-title">
            <div class="row">
              <div class="col-6">
                @yield('breadcrumb-title')
              </div>
              <div class="col-6">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('index') }}"> <i data-feather="home"></i></a></li>
                  @yield('breadcrumb-items')
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- Container-fluid starts-->
        @yield('content')
        <!-- Container-fluid Ends-->
      </div>
      <!-- footer start-->
      @stack('scripts')
<script> 
    window.addEventListener("load", function () {
        document.querySelector(".page-loader").style.display = "none";
    });
    
    document.querySelectorAll('.open_detail').forEach(function (el) {
        el.addEventListener("click", function () {
        const detail = this.getAttribute('data-detail');
      document.getElementById('modalDetailBody').innerHTML = detail;

      const modal = new bootstrap.Modal(document.getElementById('detailModal'));
      modal.show();
    });
  });
   
    
</script>
<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Task Detail</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalDetailBody">
        <!-- dynamic content will go here -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


      @include('admin.layouts.simple.footer')

    </div>
  </div>
  
  
  <!-- latest jquery-->
  @include('admin.layouts.simple.script')
  <!-- Plugin used-->

  <script type="text/javascript">
  
  $(document).ready(function(){
    $(".dropdown_list").on('click', function () {
  $(this).find('.action').toggleClass('active');
});

  $('.sidebar_open').click(function(){
    $('.sidebar-wrapper').toggleClass('sidebar_show');
  });
  
  $(document).ready(function () {
  $('#logout').click(function () {
    $('.logout_menu').addClass('logout_show');
    // Stop propagation to prevent the click event from reaching the document
    event.stopPropagation();
  });

  $(document).click(function () {
    // Check if the clicked element is not within the .login_logout section
    if (!$(event.target).closest('#logout').length) {
      $('.logout_menu').removeClass('logout_show');
    }
  });

});
});
  
    if ($(".page-wrapper").hasClass("horizontal-wrapper")) {
      $(".according-menu.other").css("display", "none");
      $(".sidebar-submenu").css("display", "block");
    }
  </script>
  <script>
    @if(Session::has('notify_success'))
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: '{{ Session::get("notify_success")}}',
      showConfirmButton: false,
      timer: 2000
    });
    @endif

    @if(Session::has('error'))

    Swal.fire({
      title: 'Error!',
      text: '{{ Session::get("error")}}',
      icon: 'error',
      confirmButtonText: 'OK'
    });
    @endif
  </script>
  @yield('script')
</body>

</html>