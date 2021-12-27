@extends('layouts.admin')

@section('content')
<div class="app-wrapper">
	    
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">			    
            <h1 class="app-page-title">Modify Order Settings</h1>
            <hr class="mb-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Modify Order</h3>
                    <div class="section-intro">You can customise following fields for the order.</div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        
                        <div class="app-card-body">

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
                                            <div class="item-data">Unknown</div>
                                        @endif                                            
                                    </div>
                                </div>
                            </div>

                            <form class="settings-form py-3" action="{{ url(route('admin.orders') . '/' . $order->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="id" value="{{ $order->id }}">
                                @error('id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="mb-3">
                                    <label for="setting-input-8" class="form-label">Payment</label>
                                    <select class="form-select" id="setting-input-8" name="payment_status" required>
                                        @if ($order->payment_status == 'paid')
                                            <option value="paid" selected>Paid</option>
                                        @else
                                            <option value="paid">Paid</option>
                                        @endif
                                        @if ($order->payment_status == 'pending')
                                            <option value="pending" selected>Pending</option>
                                        @else
                                            <option value="pending">Pending</option>
                                        @endif
                                    </select>
                                    @error('payment_status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn app-btn-primary" >Update</button>
                                <input type="button" class="btn app-btn-secondary" value="Cancel" onclick="window.location.href='{{ url('/admin/orders/' . $order->id) }}'" >
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
            <hr class="my-4">
        </div>
    </div>
    
</div>   
@endsection