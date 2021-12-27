@extends('layouts.app')

@section('header_extras')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <!-- branding -->
    <div class="branding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 bg-branding" style="background: url({{ asset('images/banner.jpg') }});  background-position: bottom; background-repeat: no-repeat; background-size: cover; background-attachment: fixed;"></div>
            </div>
        </div>
        <div class="container">
            <div class="row branding_content">
                <div class="col-12 text-end">
                    <button class="btn explore" onclick="location.href=&#39;{{ route('gallery') }}&#39;">Explore our hotel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="alertSection">
        <div class="container alertSection_border">
            <div class="row">
                <div class="col-2 my-auto text-center">
                    <i class="fas fa-exclamation-circle fa-3x"></i>
                </div>
                <div class="col-10">
                    <p>
                        The safety and wellbeing of our guests and colleagues is always a
                        top priority.
                    </p>
                    <p>
                        In light of COVID-19 and for precautionary measures, fitness
                        center, swimming pool and spa are temporarily closed until April
                        30, 2021 or until further notice from Department of Health &
                        Family Welfare, Tamil Nadu Administration. The restaurants and bar
                        have limited services until further notice. For inquiries, please
                        contact the hotel directly.
                    </p>
                    <ul>
                        <li>
                            <b>Face masks or coverings</b> - Required in hotel indoor public
                            areas and when moving around in outdoor areas.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5 banner">
        <div class="row">
            <div class="col-md-8 p-2 banner_content">
                <h3 class="pt-4 px-4 pb-2">Luxury Hotel in Tamil Nadu</h3>
                <p class="p-4">
                    Amidst the laps of nature, Sunshine enjoys the serenity of this prime location, Tamil Nadu.
                    Well-connected as the tri-city is, Tamil Nadu also puts forth a very peaceful and sacred 
                    environment with high-class amenities and an easily accessible market for our guests. 
                    charming river on one side, and breath-taking mounts on the other, Tamil Nadu, ascertains 
                    an alluring and heavenly view. <br />
                    <br />
                    Sunshine Hotel is a celebrated luxury hotel in Tamil Nadu. It offers a magnificent view of 
                    the Landscape Mountains wrapped with green plants and trees. Sunshine Hotel, as the name suggests, 
                    is a sunshine for people on travelling spree.
                </p>
            </div>
            <div class="col-md-4 p-0 banner_image">
                <img src="{{ asset('images/hotel_outside.jpg') }}" alt="hotel image" class="img-fluid" />
                <div class="overlay">
                    <div class="text banner_overlay"><span class="banner_overlay_title">Sunshine Hotel</span> <br /><br />Amidst the laps of nature, Sunshine enjoys the serenity of this prime location</div>
                </div>
            </div>
        </div>
    </div>

    <div class="commitment">
        <div class="commitment_inner">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 my-auto">
                        <h2>Our Commitment to Care</h2>
                        <p>
                            We're committed to enhanced levels of cleanliness, as we
                            reimagine the hotel experience.
                        </p>
                    </div>
                    <div class="col-md-3 commitment_image">
                        <img src="{{ asset('images/logo.png')}}" alt="logo image" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="rooms banner">
        <div class="container-fluid">
            <div class="row py-2">
                <div class="col-12">
                    <h2>Rooms</h2>
                </div>
            </div>
            <div class="row">
                {{-- <div class="col-12 banner_image" style="background: url({{ asset('images/sunshine14.jpg') }});  background-position: center; background-repeat: no-repeat; background-size: cover;"></div> --}}
                <div class="col-12 px-0 banner_image" style="min-height: 20rem;" >
                    <img src="{{ asset('images/rooms.jpg') }}" alt="rooms image" class="img-fluid" />
                    <a href="{{ route('rooms') . '#rooms' }}">
                        <div class="overlay" style="background-color: #df6f4d87 !important;">
                            <div class="text banner_overlay">
                                BOOK NOW
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="services">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center">Services</h2>
                </div>
            </div>
            <div class="row py-4 services_cards">
                <div class="col-6 col-md-2 col-sm-6 my-auto text-center services_card">
                    <i class="fas fa-spa fa-2x"></i>
                    <p>Spa</p>
                </div>
                <div class="col-6 col-md-2 col-sm-6 my-auto text-center services_card">
                    <i class="fas fa-glass-cheers fa-2x "></i>
                    <p>Restaurants On-Site</p>
                </div>
                <div class="col-6 col-md-2 col-sm-6 my-auto text-center services_card">
                    <i class="fas fa-concierge-bell fa-2x"></i>
                    <p>Room Service</p>
                </div>
                <div class="col-6 col-md-2 col-sm-6 my-auto text-center services_card">
                    <i class="fas fa-wifi fa-2x"></i>
                    <p>Free Internet Access</p>
                </div>
                <div class="col-6 col-md-2 col-sm-6 my-auto text-center services_card">
                    <i class="fas fa-shower fa-2x"></i>
                    <p>Hot and Cold Water</p>
                </div>
                <div class="col-6 col-md-2 col-sm-6 my-auto text-center services_card">
                    <i class="fas fa-fan fa-2x"></i>
                    <p>Air-Conditioned Rooms</p>
                </div>
                <div class="col-6 col-md-2 col-sm-6 my-auto text-center services_card">
                    <i class="fas fa-tv fa-2x"></i>
                    <p>Smart Television</p>
                </div>
                <div class="col-6 col-md-2 col-sm-6 my-auto text-center services_card">
                    <i class="fas fa-utensils fa-2x"></i>
                    <p>Banquet Hall</p>
                </div>
                <div class="col-6 col-md-2 col-sm-6 my-auto text-center services_card">
                    <i class="fas fa-biking fa-2x"></i>
                    <p>Rented Bikes</p>
                </div>
                <div class="col-6 col-md-2 col-sm-6 my-auto text-center services_card">
                    <i class="fas fa-mug-hot fa-2x"></i>
                    <p>Tea & Coffee Maker</p>
                </div>
                <div class="col-6 col-md-2 col-sm-6 my-auto text-center services_card">
                    <i class="fas fa-car fa-2x"></i>
                    <p>Parking</p>
                </div>
                <div class="col-6 col-md-2 col-sm-6 my-auto text-center services_card">
                    <i class="fas fa-tshirt fa-2x"></i>
                    <p>Laundry</p>
                </div>
            </div>
        </div>
    </div>

    <div class="showcase2">
        <div class="container">
            <div class="row bgShowCase" style="background: url({{ asset('images/sunset.jpg') }}); background-position: top; background-repeat: no-repeat; background-size: cover;">
                <div class="col-5 first">
                    <h3>Enrapturing beauty, exhilarating souls!</h3>
                    <hr />
                    <p style="line-height: 1.4rem;">
                        Ahnn, undoubtedly with the extreme quality services provided by our 24*7 staff, 
                        we have designed an atmosphere of fulfilment and convenience! 
                    </p>
                </div>
                <div class="col-7"></div>
            </div>
        </div>
    </div>
    <div class="rooms banner mb-4">
        <div class="container-fluid">
            <div class="row py-2">
                <div class="col-12">
                    <h2>Front Desk / Lobby</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12 px-0 banner_image" style="min-height: 18rem;" >
                    <img src="{{ asset('images/front_desk_lobby.jpg') }}" alt="rooms image" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>
    <!-- Our Hotel -->
    <div class="our_hotel">
        <div class="container banner">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center">Our Hotel</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 p-0 banner_image">
                    <img src="{{ asset('images/spa.jpg') }}" alt="hotel image" class="img-fluid" />
                    <div class="overlay">
                        <div class="text banner_overlay"><span class="banner_overlay_title">Lotus Spa</span> <br /><br /> Release your stress and anxiety.</div>
                    </div>
                </div>
                <div class="col-md-6 p-2 banner_content">
                    <h3 class="pt-4 px-4 pb-0">Lotus Spa</h3>
                    <p class="p-4 banner_description">
                        Release your stress and anxiety to the powers of universe. Enjoy
                        the calming nature of finest quality spa. Our services promise
                        to envelope your spirit with peace and bliss.
                        <br />
                        <br />
                        We are dedicated to serving professionalism at the highest level.
                        Spa provides both physical and mental benefits.
                        <br />
                        <br />
                        Operational hours: 6:00 a.m. to 09:00 p.m. daily<br />
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 p-0 banner_image">
                    <img src="{{ asset('images/ball_room.jpg') }}" alt="hotel" class="img-fluid" />
                    <div class="overlay">
                        <div class="text banner_overlay"><span class="banner_overlay_title">Ball Room</span> <br /><br /> Remember good times with our luxurious events.</div>
                    </div>
                </div>
                <div class="col-md-6 p-2 banner_content">
                    <h3 class="pt-4 px-4 pb-0">Ball Room</h3>
                    <p class="p-4 banner_description">
                        Spacious, Scintillating and Well-furnished with vibrant colors, our hall portrays 
                        a fine picture of sophistication. <br />
                        <br />
                        The Hall is cozy enough to fit 150-200 people. It is an astounding location to
                        organise your luxurious events, from corporate meetings to wedding ceremonies.<br />
                        <br />
                        You can host services which can be as varied from the marriage, meeting, conference etc.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- photos -->
    <div class="gallery_container">
        <div class="container">
            <div class="row">
                <div class="col-12">
                <h1 class="text-center">Gallery</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 p-0">
                    <img src="{{ asset('images/gallery_1.jpg') }}" alt="hotel image"
                            class="img-fluid" />
                </div>
                <div class="col-md-6 p-0">
                    <img src="{{ asset('images/gallery_2.jpg') }}" alt="hotel image"
                            class="img-fluid" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 p-0">
                    <img src="{{ asset('images/gallery_3.jpg') }}" alt="hotel image"
                            class="img-fluid" />
                </div>
                <div class="col-md-3 p-0">
                    <img src="{{ asset('images/gallery_4.jpg') }}" alt="hotel image"
                            class="img-fluid" />
                </div>
                <div class="col-md-3 p-0">
                    <img src="{{ asset('images/gallery_5.jpg') }}" alt="hotel image"
                            class="img-fluid" />
                </div>
                <div class="col-md-3 p-0">
                    <img src="{{ asset('images/gallery_6.jpg') }}" alt="hotel image"
                            class="img-fluid" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 p-0">
                    <img src="{{ asset('images/gallery_7.jpg') }}" alt="hotel image"
                            class="img-fluid" />
                </div>
                <div class="col-md-3 p-0">
                    <img src="{{ asset('images/gallery_8.jpg') }}" alt="hotel image"
                            class="img-fluid" />
                </div>
                <div class="col-md-3 p-0">
                    <img src="{{ asset('images/gallery_9.jpg') }}" alt="hotel image"
                            class="img-fluid" />
                </div>
                <div class="col-md-3 p-0">
                    <img src="{{ asset('images/gallery_10.jpg') }}" alt="hotel image"
                            class="img-fluid" />
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_extras')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/slick.js') }}"></script>
@endsection
