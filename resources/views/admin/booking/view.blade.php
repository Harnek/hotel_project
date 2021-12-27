@extends('layouts.admin')

@section('content')
<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <h1 class="app-page-title">Booking Details</h1>
            <div class="row gy-4">
                
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Booking</h3>
                    <div class="section-intro">Details for the booking.</div>
                </div>

                <div class="col-12 col-md-8">
                    <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                        
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="app-icon-holder">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-sliders"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <h4 class="app-card-title">Booking Details</h4>
                                </div>
                            </div>    
                        </div>
                        
                        <div class="app-card-body px-4 w-100">
                            
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Room Type</strong></div>
                                        <div class="item-data">{{ $category->name }}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Room Number</strong></div>
                                        <div class="item-data">{{ $booking->room_number ?? "Not Set" }}</div>
                                    </div>
                                </div>    
                            </div>
                            
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Check In</strong></div>
                                        <div class="item-data">{{ date('j M, Y', strtotime($booking->check_in)) }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Check Out</strong></div>
                                        <div class="item-data">{{ date('j M, Y', strtotime($booking->check_out)) }}</div>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Customer Name</strong></div>
                                        <div class="item-data">
                                            {{ $customer->firstname . ' ' . $customer->lastname }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Phone Number</strong></div>
                                        <div class="item-data">
                                            {{ $customer->phone }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Email Address</strong></div>
                                        <div class="item-data">
                                            {{ $customer->email }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Status</strong></div>
                                        @if ($booking->cancelled)
                                            <div class="item-data"><span class="badge bg-info">Cancelled</span></div>
                                        @else
                                            <div class="item-data"><span class="badge bg-success">Confirmed</span></div>
                                        @endif                                            
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="app-card-footer p-4 mt-auto">
                            <a class="btn app-btn-secondary" href="{{ url('/admin/bookings/' . $booking->id . '/edit') }}">Modify Booking</a>
                            {{-- <a class="btn app-btn-secondary" href="{{ url('/admin/customers/' . $customer->id) }}">View Customer</a> --}}
                            <a class="btn app-btn-secondary" href="{{ url('/admin/rooms/' . $booking->room_id) }}">View Room</a>
                            <a class="btn app-btn-secondary" href="{{ url('/admin/orders/' . $booking->order_id) }}">View Order</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    

</div>
@endsection
