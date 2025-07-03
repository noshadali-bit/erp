 <!--Responsive Menu-->
 <div class="responsive-menu">
  <div class="responsive-menu-main">
    <div class="responsive-logo">
      <a href="{{route('home')}}"><img src="{{$setting['logo']}}"></a>
    </div>
    <div class="responsive-links">
        <ul>
            <li><a href="{{route('home')}}">Home</a></li>
                                  <li><a href="{{route('about')}}">About</a></li>
                                  <li>
                                      <a href="{{route('services')}}">Services <i class="fas fa-sort-down"></i></a>
                                      <ul>
                                          <li><a href="{{route('services-ac-installation')}}">AC Installation</a></li>
                                          <li><a href="{{route('services-heating')}}">Heating Services</a></li>
                                          <li><a href="{{route('services-boilers')}}">Boiler Services</a></li>
                                          <li><a href="{{route('services-freezers-and-coolers')}}">Walk-In Freezers & Coolers</a>
                                          </li>
                                      </ul>
                                  </li>
                                  <li><a href="{{route('memberships')}}">Memberships</a></li>

                                  <li><a href="{{route('contact')}}">Contact</a></li>
                              </ul>
    </div>
    <div class="responsive-icon">
      <a href="javascript:;" class="menu-close"><i class="far fa-times"></i></a>
    </div>
    <!--<div class="resp-social">-->
    <!--	<ul>-->
    <!--		<li><a href="" target="_blank"><i class="fab fa-facebook-f"></i></a></li>-->
    <!--		<li><a href="" target="_blank"><i class="fab fa-instagram"></i></a></li>-->
    <!--		<li><a href="" target="_blank"><i class="fab fa-google"></i></a></li>-->
    <!--	</ul>-->
    <!--</div>-->
  </div>
</div>
  <!-- Header -->
  
  <header class="header">
      <div class="container-fluid p-0">
          <div class="row align-items-center">
              <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8 col-8">
                  <div class="header-logo">
                      <a href="{{route('home')}}"><img src="{{$setting['logo']}}"></a>
                  </div>
              </div>
              <div class="col-xl-9 col-lg-8 col-md-6 col-sm-4 col-4">
                  <div class="header-links">
                      <div class="navigations">
                          <nav>
                              <ul>
                                <li><a href="{{route('about')}}">About</a></li>
                                <li>
                                    <a href="{{route('services')}}">Services <i class="fas fa-chevron-down"></i></a>
                                
                                      <ul>
                                        <li><a href="{{route('services-ac-installation')}}">AC Installation</a></li>
                                        <li><a href="{{route('services-heating')}}">Heating Services</a></li>
                                        <li><a href="{{route('services-boilers')}}">Boiler Services</a></li>
                                        <li><a href="{{route('services-freezers-and-coolers')}}">Walk-In Freezers & Coolers</a>
                                        </li>
                                      </ul>
                                  </li>
                                  <li><a href="{{route('memberships')}}">Memberships</a></li>

                                  <li><a href="{{route('contact')}}">Contact</a></li>
                                  {{-- @dd(Auth::user()) --}}
                                  {{-- @if(Auth::user())
                                  <li><a href="{{route('profile')}}">Profile</a></li>
                                  <li><a href="{{route('logout')}}">Logout</a></li>
                                  @else
                                  <li><a href="{{route('login')}}">Login</a></li>
                                  @endif --}}
                              </ul>
                          </nav>
                      </div>
                      <div class="header-btns">
                          <div class="header-contact">
                              <a href="tel:{{$setting['phone']}}">{{$setting['phone']}}</a>
                          </div>
                          <div class="header-btn">
                              <a href="javascript:;">Schedule Now</a>
                          </div>
                          <div class="responsive-btn web-btn d-xl-none">
                              <a href="javascript:;" class="open-menu"><i class="far fa-bars"></i></a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </header>

    {{-- <header class="th-header header-layout10">
      <div class="header-top">
        <div class="container">
          <div class="row justify-content-center justify-content-md-between align-items-center gy-2">
            <div class="col-auto d-none d-md-block">
              <div class="header-links">
                <ul>
                  <li><i class="fal fa-phone"></i><a href="tel:{{$setting['phone']}}">{{$setting['phone']}}</a></li>
                  <li class="d-none d-xl-inline-block"><i class="fal fa-location-dot"></i>{{$setting['address']}}</li>
                  <li><i class="fal fa-clock"></i>{{$setting['timing']}}</li>
                </ul>
              </div>
            </div>
            <div class="col-auto">
              <div class="header-links">
                <ul>
                  <li class="d-none d-lg-inline-block">
                    @if(Auth::check())
                  
                    @else
                    <i class="far fa-user"></i><a href="{{route('login')}}">Login / Register</a>
                    @endif
                  </li>
                  <li>
                    <div class="header-social">
                      <span class="social-title">Follow Us:</span>
                      <a href="{{$setting['facebook']}}"><i class="fab fa-facebook-f"></i></a>
                      <a href="{{$setting['twitter']}}"><i class="fab fa-twitter"></i></a>
                      <a href="{{$setting['linkedin']}}"><i class="fab fa-linkedin-in"></i></a>
                      <a href="{{$setting['instagram']}}"><i class="fab fa-instagram"></i></a>
                      <a href="{{$setting['youtube']}}"><i class="fab fa-youtube"></i></a>
                    </div>
                  </li>
                </ul>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="sticky-wrapper">
        <div class="sticky-active">
          <!-- Main Menu Area -->
          <div class="menu-area">
            <div class="container">
              <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                  <div class="header-logo">
                    <a href="{{route('home')}}"><img src="{{$setting['logo']}}" alt="Edura"></a>
                  </div>
                </div>
                <div class="col-auto">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <nav class="main-menu d-none d-lg-inline-block">
                        <ul>
                          <li>
                            <a href="{{route('home')}}">Home</a>

                          </li>
                          <li>
                            <a href="{{route('about')}}">About Us</a>
                          </li>
      
                          <li>
                            <a href="{{route('blogs')}}">Blogs</a>

                          </li>

                          <li>
                            <a href="{{route('contact')}}">Contact</a>
                          </li>
                        </ul>
                      </nav>
                      <button type="button" class="th-menu-toggle d-inline-block d-lg-none"><i class="far fa-bars"></i></button>
                    </div>
                    <div class="col-auto d-none d-xxl-block">
                      <div class="header-button">
                        <button type="button" class="icon-btn searchBoxToggler"><i class="far fa-search"></i></button>

                        @if(Auth::check())
                        <a href="{{route('logout')}}" class="th-btn ml-25">Logout<i class="fas fa-sign-out ms-1"></i></a>
                        @else
                        <a href="{{route('login')}}" class="th-btn ml-25">Login <i class="fas fa-arrow-right ms-1"></i></a>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header> --}}