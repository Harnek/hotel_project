@extends('layouts.app')

@section('header_extras')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="attraction">
        <div class="container">
            <div class="row mt-4">
                <div class="col-12">
                    <h1>Area Attractions</h1>
                    <p class="mb-4">
                        The hotel is nestled in the bounties of nature, serving
                        tranquility and composure. breathe fresh air and find yourself
                        amidst a heart-warming environment, brimming with smiles, laughter
                        and content. You may find a lot of attractions in the
                        surroundings, from amusement parks, adventure spots to historical
                        monuments.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="hotelActivities py-3 mb-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Hotel Activities</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 activity_hover">
                    <div class="p-4 main">
                        <img src="{{ asset('images/spa2.jpg') }}" alt="spa" class="img-fluid" />
                        <h4 class="mt-2 px-2">Lotus Spa</h4>
                        <p class="p-2 activity_description">
                            Release your stress and anxiety to the powers of universe. Enjoy
                            the calming nature of finest quality spa. Our services promise
                            to envelope your spirit with peace and bliss.
                            Professionally-trained and highly qualified medicos help you
                            attain another level of ethereal contentment. Our services
                            contain yoga programs, physiological sessions, meditation,
                            massages, and skincare sessions. Our motive is to promote the
                            ideals of “eternal beauty and significance”.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 activity_hover">
                    <div class="p-4 main">
                        <img src="{{ asset('images/ball_room.jpeg') }}" alt="ball room" class="img-fluid" />
                        <h4 class="mt-2 px-2">Ball Room</h4>
                        <p class="p-2 activity_description">
                            The hotel provides a variety of services catered for your
                            ‘frolications’. The premises inhibit a clean swimming pool,
                            provided with complete safety of our guests. It is a gorgeously
                            carved pool, which serves as a therapy at dusk and dawn. The
                            breath-taking view is worth every penny. One can spend their day
                            along the scenery and have their meals served along by the staff
                            of the hotel. The landscape is a perfect recipe of romance and
                            fun!
                        </p>
                    </div>
                </div>
                <div class="col-md-6 activity_hover pt-4">
                    <div class="p-4 main">
                        <img src="{{ asset('images/restuarant3.jpg') }}" alt="restuarant" class="img-fluid" />
                        <h4 class="mt-2 px-2">Regency Restaurant</h4>
                        <p class="p-2 activity_description">
                            Embellished with flavours, our restaurant is known for its taste and variety. 
                            With highly-trained industry experts, our chefs plate one of the finest cuisines. 
                            We serve three-course meals and the walk-in restaurant is open for all. 
                            It also offers an aesthetic outlook for our food bloggers. Savour the true 
                            deliciousness of food at our doorstep!
                        </p>
                    </div>
                </div>
                <div class="col-md-6 activity_hover pt-4">
                    <div class="p-4 main">
                        <img src="{{ asset('images/bike.jpg') }}" alt="bike stand" class="img-fluid" />
                        <h4 class="mt-2 px-2">Rent A Bike</h4>
                        <p class="p-2 activity_description">
                            We promise fun and convenience. Well, on parallel tracks, Sunshine feels ecstatic 
                            to provide the facility of hiring a bike from the hotel premises for wandering 
                            and appreciating the bounties of this ethereal place. The charges may variate in 
                            accordance to the number of hours one may hire the bike.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="areaActivities py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Area Activities</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 activity_hover">
                    <div class="p-4 main">
                        <img src="{{ asset('images/river_rafting.jpg') }}" alt="river rafting" class="img-fluid" />
                        <h4 class="mt-2 px-2">River Rafting</h4>
                        <p class="p-2 activity_description">
                            When Avicii said, "one day you'll leave this world behind, so live a life you will remember"
                            We all felt that! 

                            Craft a super soulful stay with us and relish the adventures of Rishikesh's River Rafting. 
                            Sunshine puts forth an awesome opportunity for its guests, promising safety and frolicsome! 
                            You can't afford to miss this wholesome delight.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 activity_hover">
                    <div class="p-4 main">
                        <img src="{{ asset('images/laxman_jhula.jpg') }}" alt="laxman jhula" class="img-fluid" />
                        <h4 class="mt-2 px-2">Lakshman Jhula</h4>
                        <p class="p-2 activity_description">
                            Lakshman Jhula is an iron suspension bridge over the holy river Ganga at Rishikesh. 
                            A famous landmark place in Rishikesh, Lakshman Jhula is 450 feet length connecting 
                            Pauri district with Tehri district. Lakshman Jhula also offers a panoramic view of 
                            river Ganga and Rishikesh city having number of temples.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 activity_hover">
                    <div class="p-4 main">
                        <img src="{{ asset('images/yoga.jpg') }}" alt="yoga capital" class="img-fluid" />
                        <h4 class="mt-2 px-2">Yoga Capital of the World</h4>
                        <p class="p-2 activity_description">
                            The celestial city of Rishikesh is a hermit’s hermitage, a sage’s abode and an adventure 
                            lover’s hub. This lively city is among the holiest places of Hindus. The tranquil and sometimes
                            raging river of Ganges flows in eternity in this holy city, providing nourishment and life to 
                            many the earthly beings. After having a rendezvous with Rishikesh, the river Ganga leaves the
                            Shivalik hills behind and flows into the plains of northern India.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 activity_hover">
                    <div class="p-4 main">
                        <img src="{{ asset('images/ganga_aarti.jpg') }}" alt="ganga aarti" class="img-fluid" />
                        <h4 class="mt-2 px-2">Ganga Aarti</h4>
                        <p class="p-2 activity_description">
                            The holy Ganges is worshipped at various ghats in Rishikesh
                            among which the Ganga Aarti at Parmarth Niketan and Triveni Ghat
                            are distinctively famous.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 activity_hover">
                    <div class="p-4 main">
                        <img src="{{ asset('images/bungee.jpg') }}" alt="bungee jumping" class="img-fluid" />
                        <h4 class="mt-2 px-2">Jumpin Heights - Bungee Jumping</h4>
                        <p class="p-2 activity_description">
                            Jumpin Heights is a completely adventure lover place located in Mohan Chatti near Rishikesh. 
                            Famous site among fun and adventure enthusiasts, Jumpin Heights has a fixed platform for
                            Bungee of 83 meters over the river Hall, a tributary of river Ganga. Operated by a highly
                            experienced team from New Zealand, Jumpin Heights offers Bungee Jumping and Giant Swing.
                            Jumpin Heights also has the Asia's longest flying fox of 1 km.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_extras')

@endsection
