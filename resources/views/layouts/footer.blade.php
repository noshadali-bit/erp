
<footer class="footer" data-aos="fade-up" data-aos-duration="1200">
    <div class="container">
        <div class="f-main">
             <div class="row">
            <div class="col-lg-6">
                
                    <div class="footer-logo footer-links">
                        <a href="{{route('home')}}"><img src="{{$setting['logo']}}"></a>
                        <ul>
                            <li>{{$setting['address']}}</li>
                            <li><a href="{{$setting['email']}}">{{$setting['email']}}</a></li>
                            <li><a href="{{$setting['phone']}}">{{$setting['phone']}}</a></li>
                        </ul>
                    </div>
                
            </div>
            
                    <div class="col-lg-3">
                        <div class="footer-links">
                            <h2>Quick Links</h2>
                            <ul>
                                <li><a href="{{route('home')}}">Home</a></li>
                                <li><a href="{{route('about')}}">About Us</a></li>

                                <li><a href="{{route('memberships')}}">Memberships</a></li>

                                <li><a href="{{route('contact')}}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="footer-links">
                            <h2>Services</h2>
                            <ul>
                                <li><a href="{{route('services-ac-installation')}}">AC Installation</a></li>
                                        <li><a href="{{route('services-heating')}}">Heating Services</a></li>
                                        <li><a href="{{route('services-boilers')}}">Boiler Services</a></li>
                                        <li><a href="{{route('services-freezers-and-coolers')}}">Walk-In Freezers & Coolers</a>
                                        </li>
                            </ul>
                        </div>
                    </div>
                
        </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    {{-- <div class="copyright">
                        <p>Designed by <a href="https://thedigitalsamurais.com/" target="_blank"> The Digital Samurais</a> </p>
                    </div> --}}
                </div>
                <div class="col-lg-6">
                    <div class="copyright text-align-right">
                        <p>{{$setting['copyright']}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Top To Button -->

<div class="m-backtotop" aria-hidden="true">
    <div class="arrow">
        <i class="fa fa-arrow-up"></i>
    </div>
    <div class="text">
        Back to top
    </div>
</div>

