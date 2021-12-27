@extends('layouts.app')

@section('header_extras')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="roomsMain">
        <div class="container py-5 banner">
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible" role="alert" id="liveAlert">
                    {{ session()->get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session()->has('fail'))
                <div class="alert alert-danger alert-dismissible" role="alert" id="liveAlert">
                    {{ session()->get('fail') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-8 p-2 banner_content">
                    <h3 class="pt-4 px-4 pb-2">Rooms</h3>
                    <p class="p-4">
                        Sunshine offers a cozy, comforting, and friendly stay with world-class amenities. 
                        Our guests enjoy high-speed wireless Internet access, relaxing beds for a hectic and 
                        restful stay, and a variety of hotel services to match your requirements on every trip; 
                        from a family vacation or weekend getaway to a full-scale conference or wedding. <br />
                        <br />
                        Each room bestows our guests with high-speed internet, hot and cold water with 
                        24*7 availability, power-backups, smart-television, biometric unlocking, and laundry 
                        convenience. Each day, we are committed to creating exceptional experiences, 
                        like none else, for every person, every moment, and strive to make our guests feel the 
                        brew of true refreshment and restoration whilst their visit. The hotel displays amazing 
                        room services, smoothening your experience and stay with us!
                    </p>
                </div>
                <div class="col-md-4 p-0 banner_image">
                    <img src="{{ asset('images/hotel_outside.jpg') }}" alt="hotel image" class="img-fluid" style="height: 100%; object-fit: cover;" />
                    <div class="overlay">
                        <div class="text banner_overlay"><span style="text-decoration: bold;">Rooms</span> <br /><br />Sunshine offers a cozy, comforting, and friendly stay with world-class amenities.</div>
                    </div>
                </div>
            </div>
           
            <div id="rooms" class="rooms_suites row py-5">
                <div class="col-12">
                    <h2 class="mb-4">Rooms</h2>
                    <div class="row">
                        
                        @foreach ($categories as $category)    
                            <div class="col-md-6 pb-4">
                                <img src="{{ asset('images/' . $category->image) }}" alt="sunshine" class="img-fluid" />
                                <h4 class="mt-2 px-2">{{ $category->name }}</h4>
                                <p class="p-2 room_description">
                                    {{ $category->description }}
                                </p>
                                <button class="btn" onclick="location.href='{{ url('booking/' . $category->slug) }}'">BOOK NOW</button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_extras')

@endsection
