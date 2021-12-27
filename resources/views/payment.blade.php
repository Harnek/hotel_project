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

            <h2 class="text-center mt-3 mb-4">Payment</h2>
            <div class="row p-3" style="background: #f3f3f3; border-radius: 0.5rem; line-height: 1.4rem;">
                <div class="col-md-6">
                    <img src="{{ asset('images/' . $category->image) }}" class="card-img-top" alt="Property1" />
                </div>
                <div class="col-md-6">
                    <h5 class="card-title fw-bold">Booking Details</h5>
                    <p class="card-text py-1">
                        <span class="fw-bold">Room Type: </span>{{ $category->name }}
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
                    <p class="card-text py-1">
                        <span class="fw-bold">Food: </span>{{ $price_name }}
                    </p>
                </div>
                <form action="{{ route('payment.pay') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mt-4">
                            <h5 class="card-title fw-bold">Your Details</h5>

                            <input type="hidden" name="category_id" value="{{ old('category_id') ?? $category->id }}">
                            <input type="hidden" name="check_in" value="{{ old('check_in') ?? $check_in }}" />
                            <input type="hidden" name="check_out" value="{{ old('check_out') ?? $check_out }}" />
                            <input type="hidden" name="rooms" value="{{ old('rooms') ?? $rooms }}" />
                            <input type="hidden" name="guests" value="{{ old('guests') ?? $guests }}" />
                            <input type="hidden" name="price" value="{{ old('price') ?? $price }}" />

                            <div class="col-12 mb-3">
                                <label class="form-label" for="firstname">Firstname</label>
                                <input type="text" name="firstname" class="form-control"
                                    placeholder="Firstname" value="{{ old('firstname') }}" />
                                @error('firstname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="lastname">Lastname</label>
                                <input type="text" name="lastname" class="form-control"
                                    placeholder="Lastname" value="{{ old('lastname') }}" />
                                @error('lastname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control"
                                    placeholder="Phone" value="{{ old('phone') }}" />
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="Email" value="{{ old('email') }}" />
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <h5 class="card-title fw-bold">Payment Details</h5>
                            <p class="card-text py-1">
                                <span class="fw-bold">Amount: </span><span>&#8377;</span>{{ $amount }}
                            </p>
                            <p class="card-text py-1">
                                <span class="fw-bold">Tax: </span>{{ $tax_percentage }}%
                            </p>
                            <p class="card-text py-1">
                                <span class="fw-bold">Discount: </span><span>&#8377;</span>{{ $discount }}
                            </p>
                            <p class="card-text py-1">
                                <span class="fw-bold">Total: </span><span>&#8377;</span>{{ $total }}
                            </p>
                            <div class="d-grid pt-3">
                                <button type="submit" class="btn btn-primary">Pay Now</a>
                            </div>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection