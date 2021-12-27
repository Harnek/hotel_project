@extends('layouts.admin')

@section('content')
<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

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

            <h1 class="app-page-title">Order Details</h1>
            <div class="row gy-4">
                
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Order</h3>
                    <div class="section-intro">Details for the order.</div>
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
                                    <h4 class="app-card-title">Order Details</h4>
                                </div>
                            </div>    
                        </div>
                        
                        <div class="app-card-body px-4 w-100">
                            
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Order Id</strong></div>
                                        <div class="item-data">{{ $order->order_id }}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Rooms Booked</strong></div>
                                        <div class="item-data">{{ $order->rooms }}</div>
                                    </div>
                                </div>    
                            </div>
                            
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Check In</strong></div>
                                        <div class="item-data">{{ date('j M, Y', strtotime($order->check_in)) }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Check Out</strong></div>
                                        <div class="item-data">{{ date('j M, Y', strtotime($order->check_out)) }}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Customer Name</strong></div>
                                        <div class="item-data">{{ $customer->firstname . ' ' . $customer->lastname }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Phone Number</strong></div>
                                        <div class="item-data">{{ $customer->phone }}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Email Address</strong></div>
                                        <div class="item-data">{{ $customer->email }}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Payment Method</strong></div>
                                        @if ($order->payment_method == 'paytm')
                                            <div class="item-data">Paytm</div>
                                        @elseif ($order->payment_method == 'cash')
                                            <div class="item-data">Cash</div>
                                        @else
                                            <div class="item-data">Other</div>
                                        @endif                                            
                                    </div>
                                </div>
                            </div>

                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Payment Status</strong></div>
                                        @if ($order->payment_status == 'paid')
                                            <div class="item-data"><span class="badge bg-success">Paid</span></div>
                                        @elseif ($order->payment_status == 'refunded')
                                            <div class="item-data"><span class="badge bg-info">Refunded</span></div>
                                        @elseif ($order->payment_status == 'pending')
                                            <div class="item-data"><span class="badge bg-warning">Pending</span></div>
                                        @else
                                            <div class="item-data"><span class="badge bg-danger">Failed</span></div>
                                        @endif                                            
                                    </div>
                                </div>
                            </div>

                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Order Status</strong></div>
                                        @if ($order->order_status == 'processed')
                                            <div class="item-data"><span class="badge bg-success">Processed</span></div>
                                        @elseif($order->order_status == 'pending')
                                            <div class="item-data"><span class="badge bg-warning">Pending</span></div>
                                        @elseif($order->order_status == 'cancelled')
                                            <div class="item-data"><span class="badge bg-info">Cancelled</span></div>
                                        @else
                                            <div class="item-data"><span class="badge bg-danger">Failed</span></div>
                                        @endif                                        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Total</strong></div>
                                        <div class="item-data"><span>&#8377;</span>{{ $order->total }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="app-card-footer p-4 mt-auto">
                            <a class="btn app-btn-secondary" 
                                href="{{ url(route('admin.orders') . '/' . $order->id . '/invoice') }}"
                                >Download Invoice</a>
                            @if ($order->payment_method == 'paytm' && $order->payment_status != 'paid')
                                <a class="btn app-btn-secondary" href="{{ url(route('admin.orders') . '/' . $order->id . '/updatepayment') }}">Refresh Payment Status</a>
                            @endif
                            @if ($order->payment_method != 'paytm')
                                <a class="btn app-btn-primary" 
                                    href="{{ url(route('admin.orders') . '/' . $order->id . '/edit') }}"
                                    >Edit Order</a>
                            @endif
                            @if (($order->order_status == 'pending' || $order->order_status == 'processed') && ($order->payment_status == 'paid'))
                                <a class="btn app-btn-primary"
                                    href="{{ url(route('admin.orders') . '/' . $order->id . '/cancel') }}"
                                    onclick="return confirm('Are you sure, you want to cancel order?')"
                                    >Cancel Order</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Bookings</h1>
                </div>
            </div>

            <div class="app-card app-card-orders-table shadow-sm mb-5">
                <div class="app-card-body">
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left">
                            <thead>
                                <tr>
                                    <th class="cell">Index</th>
                                    <th class="cell">Customer</th>
                                    <th class="cell">Check In</th>
                                    <th class="cell">Check Out</th>
                                    <th class="cell">Status</th>
                                    <th class="cell"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td class="cell">{{ 1 + $loop->index }}</td>
                                        <td class="cell">{{ $customer->firstname . ' ' . $customer->lastname }}</td>
                                        <td class="cell"><span>{{ date('j M, Y', strtotime($booking->check_in)) }}</span></span></td>
                                        <td class="cell"><span>{{ date('j M, Y', strtotime($booking->check_out)) }}</span></span></td>
                                        @if ($booking->cancelled)
                                            <td class="cell"><span class="badge bg-info">Cancelled</span></td>
                                        @else
                                            <td class="cell"><span class="badge bg-success">Confirmed</span></td>                                            
                                        @endif
                                        <td class="cell"><a class="btn-sm app-btn-secondary" href="{{ url('/admin/bookings/' . $booking->id) }}">View</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                   
                </div>		
            </div>

        </div>
    </div>
    

</div>
@endsection
