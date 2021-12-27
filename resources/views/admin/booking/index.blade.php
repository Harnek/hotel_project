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

            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Bookings</h1>
                </div>
            </div>
           
            
            <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
                <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">All</a>
                <a class="flex-sm-fill text-sm-center nav-link"  id="orders-paid-tab" data-bs-toggle="tab" href="#orders-paid" role="tab" aria-controls="orders-paid" aria-selected="false">Current</a>
                <a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab" href="#orders-pending" role="tab" aria-controls="orders-pending" aria-selected="false">Upcoming</a>
                <a class="flex-sm-fill text-sm-center nav-link" id="orders-cancelled-tab" data-bs-toggle="tab" href="#orders-cancelled" role="tab" aria-controls="orders-cancelled" aria-selected="false">Cancelled</a>
            </nav>
            
            
            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left">
                                    <thead>
                                        <tr>
                                            <th class="cell">Index</th>
                                            <th class="cell">Booking Details</th>
                                            <th class="cell">Room</th>
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
                                                <td class="cell">{{ 1 + $start + $loop->index }}</td>
                                                <td class="cell"><span class="truncate">{{ $booking->category }}</span></td>
                                                <td class="cell">{{ $booking->room_number ?? "Not Set" }}</td>
                                                <td class="cell">{{ $booking->customer }}</td>
                                                <td class="cell">{{ date('j M, Y', strtotime($booking->check_in)) }}</td>
                                                <td class="cell">{{ date('j M, Y', strtotime($booking->check_out)) }}</td>
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
                
                <div class="tab-pane fade" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
                    <div class="app-card app-card-orders-table mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                
                                <table class="table mb-0 text-left">
                                    <thead>
                                        <tr>
                                            <th class="cell">Index</th>
                                            <th class="cell">Booking Details</th>
                                            <th class="cell">Room</th>
                                            <th class="cell">Customer</th>
                                            <th class="cell">Check In</th>
                                            <th class="cell">Check Out</th>
                                            <th class="cell">Status</th>
                                            <th class="cell">Total</th>
                                            <th class="cell"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookings as $booking)
                                            @if (
                                                    !$booking->cancelled
                                                    && strtotime($booking->check_in) <= strtotime(date('Y-m-d'))
                                                    && strtotime($booking->check_out) >= strtotime(date('Y-m-d'))
                                                )
                                                <tr>
                                                    <td class="cell">{{ 1 + $start + $loop->index }}</td>
                                                    <td class="cell"><span class="truncate">{{ $booking->category }}</span></td>
                                                    <td class="cell">{{ $booking->room_number ?? "Not Set" }}</td>
                                                    <td class="cell">{{ $booking->customer }}</td>
                                                    <td class="cell">{{ date('j M, Y', strtotime($booking->check_in)) }}</td>
                                                    <td class="cell">{{ date('j M, Y', strtotime($booking->check_out)) }}</td>
                                                    <td class="cell"><span class="badge bg-success">Confirmed</span></td>                                            
                                                    <td class="cell"><a class="btn-sm app-btn-secondary" href="{{ url('/admin/bookings/' . $booking->id) }}">View</a></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>		
                    </div>
                </div>
                
                <div class="tab-pane fade" id="orders-pending" role="tabpanel" aria-labelledby="orders-pending-tab">
                    <div class="app-card app-card-orders-table mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table mb-0 text-left">
                                    <thead>
                                        <tr>
                                            <th class="cell">Index</th>
                                            <th class="cell">Booking Details</th>
                                            <th class="cell">Room</th>
                                            <th class="cell">Customer</th>
                                            <th class="cell">Check In</th>
                                            <th class="cell">Check Out</th>
                                            <th class="cell">Status</th>
                                            <th class="cell">Total</th>
                                            <th class="cell"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookings as $booking)
                                            @if (
                                                !$booking->cancelled
                                                && strtotime($booking->check_in) > strtotime(date('Y-m-d'))
                                            )
                                                <tr>
                                                    <td class="cell">{{ 1 + $start + $loop->index }}</td>
                                                    <td class="cell"><span class="truncate">{{ $booking->category }}</span></td>
                                                    <td class="cell">{{ $booking->room_number ?? "Not Set" }}</td>
                                                    <td class="cell">{{ $booking->customer }}</td>
                                                    <td class="cell">{{ date('j M, Y', strtotime($booking->check_in)) }}</td>
                                                    <td class="cell">{{ date('j M, Y', strtotime($booking->check_out)) }}</td>
                                                    <td class="cell"><span class="badge bg-success">Confirmed</span></td>                                            
                                                    <td class="cell"><a class="btn-sm app-btn-secondary" href="{{ url('/admin/bookings/' . $booking->id) }}">View</a></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>		
                    </div>
                </div>
                <div class="tab-pane fade" id="orders-cancelled" role="tabpanel" aria-labelledby="orders-cancelled-tab">
                    <div class="app-card app-card-orders-table mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table mb-0 text-left">
                                    <thead>
                                        <tr>
                                            <th class="cell">Index</th>
                                            <th class="cell">Booking Details</th>
                                            <th class="cell">Room</th>
                                            <th class="cell">Customer</th>
                                            <th class="cell">Check In</th>
                                            <th class="cell">Check Out</th>
                                            <th class="cell">Status</th>
                                            <th class="cell">Total</th>
                                            <th class="cell"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookings as $booking)
                                            @if ($booking->cancelled)
                                                <tr>
                                                    <td class="cell">{{ 1 + $start + $loop->index }}</td>
                                                    <td class="cell"><span class="truncate">{{ $booking->category }}</span></td>
                                                    <td class="cell">{{ $booking->room_number ?? "Not Set" }}</td>
                                                    <td class="cell">{{ $booking->customer }}</td>
                                                    <td class="cell">{{ date('j M, Y', strtotime($booking->check_in)) }}</td>
                                                    <td class="cell">{{ date('j M, Y', strtotime($booking->check_out)) }}</td>
                                                    <td class="cell"><span class="badge bg-info">Cancelled</span></td>
                                                    <td class="cell"><a class="btn-sm app-btn-secondary" href="{{ url('/admin/bookings/' . $booking->id) }}">View</a></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>		
                    </div>
                </div>
            </div>
            
            {{ $bookings->links() }}
            
        </div>
    </div>
    
</div>  
@endsection