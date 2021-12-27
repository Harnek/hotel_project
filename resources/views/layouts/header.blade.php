<div class="customNavbar shadow">
    <div class="topNavbar">
        <div class="container">
            <div class="navigationBar">
                <nav>
                    <ul>
                        <li class="right-border dropdown_menu">
                            <a href="#"><i class="fas fa-bars"><i class="fas fa-chevron-down"></i></i></a>
                            <div class="dropdown">
                                <nav>
                                    <ul>
                                        <li><a href="{{ route('home') }}">Hotel</a></li>
                                        <li><a href="{{ route('rooms') }}">Rooms</a></li>

                                        <li>
                                            <a href="{{ route('gallery') }}">Photos</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('contact') }}">Contact Us</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </li>
                        <li>
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('images/logo.png') }}" alt="sunshine logo" class="img-fluid" />
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="bookNow">
    <div class="container">
        <div class="row">
            <div class="col-md-2" style="margin: auto;">
                <img src="{{ asset('images/logo.png') }}" alt="sunshine logo" />
            </div>
            <div class="col-md-8 my-auto secondTab p-2">
                <p class="heading">Hotel Sunshine</p>
                <p class="gray">
                    <i class="fas fa-street-view"></i>
                    <a  
                        href="https://goo.gl/maps/lorem"
                        >
                        <span style="line-height: 1.4rem;">
                        3, Vaigai Street, Besant Nagar, Chennai, 600090, Tamil Nadu, India
                        </span>
                    </a>
                </p>
                <p class="gray"><i class="fas fa-phone-alt"></i><a href="tel:+91 61998 64461">+91 61998 64461</a>, <a href="tel:+91 79313 03871">+91 79313 03871</a></p>
                <p class="rating gray">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                    class="fas fa-star"></i><i class="fas fa-star"></i>
                    <a href="{{ route('contact') . '#testimonial'}}" style="text-decoration: none;">
                        15 Reviews
                    </a>
                </p>
            </div>
            <div class="col-md-2 my-auto">
                @if( Route::is('rooms') )    
                    <button class="btn bookBtn" onclick="location.href=&#39;#rooms&#39;">BOOK NOW</button>
                @else
                    <button class="btn bookBtn" onclick="location.href=&#39;{{ route('rooms') . '#rooms'  }}&#39;">BOOK NOW</button>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="navBaar sticky-top shadow">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid p-0">
                <a class="navbar-brand" href="#"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link{{ Route::currentRouteNamed('home') ? ' active' : '' }}" aria-current="page" href="{{ route('home') }}">Hotel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{{ Route::currentRouteNamed('rooms') ? ' active' : '' }}" href="{{ route('rooms') }}">Rooms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{{ Route::currentRouteNamed('gallery') ? ' active' : '' }}" href="{{ route('gallery') }}">Photos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{{ Route::currentRouteNamed('contact') ? ' active' : '' }}" href="{{ route('contact') }}">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>