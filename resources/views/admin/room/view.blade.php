@extends('layouts.admin')

@section('content')
<div class="app-wrapper">
	    
    <div class="app-content pt-3 p-md-3 p-lg-4">
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

        <div class="container-xl">

            <h1 class="app-page-title">Room</h1>
            <hr class="mb-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Room</h3>
                    <div class="section-intro">Details for the room.</div>
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
                                    <!--//icon-holder-->

                                </div>
                                <div class="col-auto">
                                    <h4 class="app-card-title">Room Details</h4>
                                </div>
                            </div>
                            <!--//row-->
                        </div>
                        <!--//app-card-header-->
                        <div class="app-card-body px-4 w-100">
                            <!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Room Type</strong></div>
                                        <div class="item-data">{{ $room->category }}</div>
                                    </div>
                                    {{-- <div class="col text-end">
                                        <a class="btn-sm app-btn-secondary" href="#">Change</a>
                                    </div> --}}
                                </div>
                                <!--//row-->
                            </div>
                            <!--//item-->
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Room Number</strong></div>
                                        <div class="item-data">{{ $room->room_number ?? "Not set" }}</div>
                                    </div>
                                    {{-- <div class="col text-end">
                                        <a class="btn-sm app-btn-secondary" href="#">Change</a>
                                    </div> --}}
                                </div>
                                <!--//row-->
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Floor</strong></div>
                                        <div class="item-data">{{ $room->floor ?? "Not set" }}</div>
                                    </div>
                                    {{-- <div class="col text-end">
                                        <a class="btn-sm app-btn-secondary" href="#">Change</a>
                                    </div> --}}
                                </div>
                                <!--//row-->
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Room Enabled</strong></div>
                                        <div class="form-check form-switch">
                                            <label for="setting-input-4" class="form-label">Enabled</label>
                                            <input type="checkbox" name="enabled" class="form-check-input" id="setting-input-4" {{ $room->enabled ? 'checked': '' }} disabled>
                                        </div>
                                    </div>
                                    {{-- <div class="col text-end">
                                        <a class="btn-sm app-btn-secondary" href="#">Change</a>
                                    </div> --}}
                                </div>
                                <!--//row-->
                            </div>
                        </div>
                        <!--//app-card-body-->
                        <div class="app-card-footer p-4 mt-auto">
                            <a class="btn app-btn-secondary" href="{{ url('/admin/rooms/' . $room->id . '/edit') }}">Edit Room</a>
                            <a class="btn app-btn-secondary" href="{{ url('/admin/rooms') }}">Go Back</a>
                        </div>
                        <!--//app-card-footer-->

                    </div>
                    <!--//app-card-->
                </div>
            </div>
            <hr class="my-4">

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
                                        <td class="cell">{{ $booking->customer }}</td>
                                        <td class="cell"><span>{{ date('j M, Y', strtotime($booking->check_in)) }}</span></span></td>
                                        <td class="cell"><span>{{ date('j M, Y', strtotime($booking->check_out)) }}</span></span></td>
                                        @if ($booking->cancelled)
                                            <td class="cell"><span class="badge bg-danger">Cancelled</span></td>
                                        @elseif ($booking->failed)
                                            <td class="cell"><span class="badge bg-danger">Failed</span></td>
                                        @else
                                            <td class="cell"><span class="badge bg-success">Booked</span></td>                                            
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