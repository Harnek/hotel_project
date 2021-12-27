@extends('layouts.app')

@section('header_extras')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="py-4">
        <div class="container">

            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible" role="alert" id="liveAlert">
                    {{ session()->get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('fail'))
                <div class="alert alert-danger alert-dismissible" role="alert" id="liveAlert">
                    {{ session()->get('fail') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <h2 class="text-center mt-3 mb-4">Booking Search</h2>
            <div class="row p-3" style="background: #f3f3f3; border-radius: 0.5rem; line-height: 1.4rem;">
                <div class="col-md-6">
                    <img src="{{ asset('images/' . $category->image) }}" class="card-img-top" alt="Property1" />
                </div>
                <div class="col-md-6">
                    {{-- <h5 class="card-title">House Number</h5> --}}
                    <p class="card-text py-1">
                        <span class="fw-bold">Room Type:</span>
                        {{ $category->name }}
                    </p>
                    <p class="card-text py-1">
                        <span class="fw-bold">Room Description:</span>
                        {{ $category->description }}
                    </p>
                    <p class="card-text py-1 pb-4">
                        <span class="fw-bold">Amenities:</span>
                        Free Wifi, Spa, Hot Water, Room Service, Smart Television
                    </p>
                    <p class="card-text py-1">
                        <span class="fw-bold">Contact Details:</span>
                        3, Vaigai Street, Besant Nagar, Chennai, 600090, Tamil Nadu, India
                    </p>
                </div>
                <div class="col-md-6 mt-4">
                    <p class="card-text py-1">
                        <span class="fw-bold">Booking Details:</span>
                    </p>
                    <p class="card-text py-1">
                        <span class="fw-bold">Check in: </span>{{ date('j M, Y', strtotime($check_in)) }}
                    </p>
                    <p class="card-text py-1">
                        <span class="fw-bold">Check out: </span>{{ date('j M, Y', strtotime($check_out)) }}
                    </p>
                    <p class="card-text py-1">
                        <span class="fw-bold">Number of Rooms: </span>{{ $rooms }}
                    </p>
                    <p class="card-text py-1">
                        <span class="fw-bold">Number of Guests: </span>{{ $guests }}
                    </p>
                </div>
                <div class="col-md-6 mt-4">
                    <form action="{{ route('booking.redirectPay') }}" method="POST">
                        @csrf

                        <input type="hidden" name="category_id" value="{{ $category->id }}">
                        <input type="hidden" name="check_in" value="{{ $check_in }}" />
                        <input type="hidden" name="check_out" value="{{ $check_out }}" />
                        <input type="hidden" name="rooms" value="{{ $rooms }}" />
                        <input type="hidden" name="guests" value="{{ $guests }}" />

                        <div class="col-12 px-0">
                            <label class="form-label fw-bold" for="price">Choose Meal Options</label>
                            <select class="form-control" name="price" id="price">
                                <option value="price1"><span>&#8377;</span>{{ $category->price1 }}: food not included</option>
                                <option value="price2"><span>&#8377;</span>{{ $category->price2 }}: Includes Breakfast
                                </option>
                                <option value="price3"><span>&#8377;</span>{{ $category->price3 }}: Includes Breakfast
                                    with lunch or dinner</option>
                                <option value="price4"><span>&#8377;</span>{{ $category->price4 }}: Includes Full Meal
                                    Course</option>
                            </select>
                            @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid pt-3">
                            <button type="submit" class="btn btn-primary">Book Now</a>
                        </div>
                    </form>
                    <div class="d-grid pt-3">
                        <button onclick="location.href='{{ url('booking' . '/' . $category->slug) }}'"
                            class="btn btn-primary">Go Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection