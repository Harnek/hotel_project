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
                    <img src="{{ asset('images/' . $category->image) }}" class="card-img-top" alt="Room Type" />
                </div>
                <div class="col-md-6">
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
                {{-- </div> --}}
                {{-- <div class="col-md-6 pt-3"> --}}
                    {{-- <p class="card-text py-1">
                        <span class="fw-bold">Contact Details:</span>
                        3, Vaigai Street, Besant Nagar, Chennai, 600090, Tamil Nadu, India
                    </p> --}}
                {{-- </div>
                <div class="col-md-6 pt-3"> --}}
                    <form action="{{ route('booking.search') }}" method="POST">
                        @csrf

                        <input type="hidden" name="category_id" value="{{ old('category_id') ?? $category->id }}">
                        <div class="row">
                            <div class="col-5">
                                <label class="form-label fw-bold" for="check_in">Check in:</label>
                                <input id="check_in" placeholder="Y / M / D" type="text" name="check_in"
                                    class="form-control" onfocus="(this.type='date')" onblur="(this.type='text')"
                                    min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" />
                                @error('check_in')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-2 my-auto text-center">To</div>
                            <div class="col-5">
                                <label class="form-label fw-bold" for="check_out">Check out:</label>
                                <input id="check_out" placeholder="Y / M / D" type="text" name="check_out"
                                    class="form-control" onfocus="(this.type='date')" onblur="(this.type='text')"
                                    min="{{ (new DateTime('tomorrow'))->format('Y-m-d') }}"
                                    value="{{ (new DateTime('tomorrow'))->format('Y-m-d') }}" />
                                @error('check_out')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-6">
                                <label class="form-label fw-bold" for="rooms">Number of Rooms:</label>
                                <input type="number" name="rooms" min="1" class="form-control"
                                    placeholder="Number of rooms" value="{{ old('rooms') ?? '1' }}" />
                                @error('rooms')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-bold" for="guests">Number of Guests:</label>
                                <input type="number" name="guests" min="1" class="form-control"
                                    placeholder="Number of guests" value="{{ old('guests') ?? '2' }}" />
                                @error('guests')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid pt-3">
                            <button type="submit" class="btn btn-primary">Check Availability</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection