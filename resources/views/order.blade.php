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

            <h2 class="text-center mt-3 mb-4">Booking Successful</h2>
            <div class="row p-3" style="background: #f3f3f3; border-radius: 0.5rem; line-height: 1.4rem;">
                <div class="col-md-6 mt-4">
                    <p class="card-text py-1">
                        <span class="fw-bold">Booking Details:</span>
                    </p>
                    <p class="card-text py-1">
                        <span class="fw-bold">Order Id: </span>{{ $order->order_id }}
                    </p>
                    <p class="card-text py-1">
                        <span class="fw-bold">Check in: </span>{{ date('j M, Y', strtotime($order->check_in)) }}
                    </p>
                    <p class="card-text py-1">
                        <span class="fw-bold">Check out: </span>{{ date('j M, Y', strtotime($order->check_out)) }}
                    </p>
                    <p class="card-text py-1">
                        <span class="fw-bold">Number of Rooms: </span>{{ $order->rooms }}
                    </p>
                    <p class="card-text py-1">
                        <span class="fw-bold">Invoice: </span><a href="{{ url('/invoice/' . $order->order_id) }}">Download</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection