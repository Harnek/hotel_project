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
                    <h1 class="app-page-title mb-0">Orders</h1>
                </div>
            </div>
           
            
            <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
                <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">All</a>
                <a class="flex-sm-fill text-sm-center nav-link"  id="orders-paid-tab" data-bs-toggle="tab" href="#orders-paid" role="tab" aria-controls="orders-paid" aria-selected="false">Confirmed</a>
                <a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab" href="#orders-pending" role="tab" aria-controls="orders-pending" aria-selected="false">Pending</a>
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
                                            <th class="cell">Customer</th>
                                            <th class="cell">Date</th>
                                            <th class="cell">Payment</th>
                                            <th class="cell">Status</th>
                                            <th class="cell">Total</th>
                                            <th class="cell"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td class="cell">{{ 1 + $start + $loop->index }}</td>
                                                <td class="cell">{{ $order->customer }}</td>
                                                <td class="cell">{{ date('j M, Y', strtotime($order->order_created)) }}</td>

                                                @if ($order->payment_status == 'paid')
                                                    <td class="cell"><span class="badge bg-success">Paid</span></td>
                                                @elseif ($order->payment_status == 'refunded')
                                                    <td class="cell"><span class="badge bg-info">Refunded</span></td>
                                                @elseif ($order->payment_status == 'pending')
                                                    <td class="cell"><span class="badge bg-warning">Pending</span></td>
                                                @else
                                                    <td class="cell"><span class="badge bg-danger">Failed</span></td>
                                                @endif

                                                @if ($order->order_status == 'processed')
                                                    <td class="cell"><span class="badge bg-success">Processed</span></td>
                                                @elseif ($order->order_status == 'cancelled')
                                                    <td class="cell"><span class="badge bg-info">Cancelled</span></td>
                                                @elseif ($order->order_status == 'pending')
                                                    <td class="cell"><span class="badge bg-warning">Pending</span></td>
                                                @else
                                                    <td class="cell"><span class="badge bg-danger">Failed</span></td>
                                                @endif

                                                <td class="cell"><span>&#8377;</span>{{ $order->total }}</td>
                                                <td class="cell"><a class="btn-sm app-btn-secondary" href="{{ url('/admin/orders/' . $order->id) }}">View</a></td>
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
                                            <th class="cell">Customer</th>
                                            <th class="cell">Date</th>
                                            <th class="cell">Payment</th>
                                            <th class="cell">Status</th>
                                            <th class="cell">Total</th>
                                            <th class="cell"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            @if ($order->order_status == 'processed')
                                                <tr>
                                                    <td class="cell">{{ 1 + $start + $loop->index }}</td>
                                                        <td class="cell">{{ $order->customer }}</td>
                                                    <td class="cell">{{ date('j M, Y', strtotime($order->order_created)) }}</td>
                                                   
                                                    @if ($order->payment_status == 'paid')
                                                        <td class="cell"><span class="badge bg-success">Paid</span></td>                                            
                                                    @elseif ($order->payment_status == 'refunded')
                                                        <td class="cell"><span class="badge bg-info">Refunded</span></td>                                            
                                                    @elseif ($order->payment_status == 'pending')
                                                        <td class="cell"><span class="badge bg-warning">Pending</span></td>
                                                    @else
                                                        <td class="cell"><span class="badge bg-danger">Failed</span></td>
                                                    @endif            

                                                    <td class="cell"><span class="badge bg-success">Processed</span></td>                                            
                                                    <td class="cell"><span>&#8377;</span>{{ $order->total }}</td>
                                                    <td class="cell"><a class="btn-sm app-btn-secondary" href="{{ url('/admin/orders/' . $order->id) }}">View</a></td>
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
                                            <th class="cell">Customer</th>
                                            <th class="cell">Date</th>
                                            <th class="cell">Payment</th>
                                            <th class="cell">Status</th>
                                            <th class="cell">Total</th>
                                            <th class="cell"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            @if ($order->order_status == 'pending')
                                                <tr>
                                                    <td class="cell">{{ 1 + $start + $loop->index }}</td>
                                                        <td class="cell">{{ $order->customer }}</td>
                                                    <td class="cell">{{ date('j M, Y', strtotime($order->order_created)) }}</td>
                                                    
                                                    @if ($order->payment_status == 'paid')
                                                        <td class="cell"><span class="badge bg-success">Paid</span></td>                                            
                                                    @elseif ($order->payment_status == 'refunded')
                                                        <td class="cell"><span class="badge bg-info">Refunded</span></td>                                            
                                                    @elseif ($order->payment_status == 'pending')
                                                        <td class="cell"><span class="badge bg-warning">Pending</span></td>
                                                    @else
                                                        <td class="cell"><span class="badge bg-danger">Failed</span></td>
                                                    @endif         

                                                    <td class="cell"><span class="badge bg-warning">Pending</span></td>                                           
                                                    <td class="cell"><span>&#8377;</span>{{ $order->total }}</td>
                                                    <td class="cell"><a class="btn-sm app-btn-secondary" href="{{ url('/admin/orders/' . $order->id) }}">View</a></td>
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
                                            <th class="cell">Customer</th>
                                            <th class="cell">Date</th>
                                            <th class="cell">Payment</th>
                                            <th class="cell">Status</th>
                                            <th class="cell">Total</th>
                                            <th class="cell"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            @if ($order->order_status == 'cancelled' || $order->order_status == 'failed')
                                                <tr>
                                                    <td class="cell">{{ 1 + $start + $loop->index }}</td>
                                                        <td class="cell">{{ $order->customer }}</td>
                                                    <td class="cell">{{ date('j M, Y', strtotime($order->order_created)) }}</td>
                                                   
                                                    @if ($order->payment_status == 'paid')
                                                        <td class="cell"><span class="badge bg-success">Paid</span></td>                                            
                                                    @elseif ($order->payment_status == 'refunded')
                                                        <td class="cell"><span class="badge bg-info">Refunded</span></td>                                            
                                                    @elseif ($order->payment_status == 'pending')
                                                        <td class="cell"><span class="badge bg-warning">Pending</span></td>
                                                    @else
                                                        <td class="cell"><span class="badge bg-danger">Failed</span></td>
                                                    @endif

                                                    @if ($order->order_status == 'processed')
                                                        <td class="cell"><span class="badge bg-success">Processed</span></td>
                                                    @elseif($order->order_status == 'pending')
                                                        <td class="cell"><span class="badge bg-warning">Pending</span></td>
                                                    @elseif($order->order_status == 'cancelled')
                                                        <td class="cell"><span class="badge bg-info">Cancelled</span></td>
                                                    @else
                                                        <td class="cell"><span class="badge bg-danger">Failed</span></td>
                                                    @endif

                                                    <td class="cell"><span>&#8377;</span>{{ $order->total }}</td>
                                                    <td class="cell"><a class="btn-sm app-btn-secondary" href="{{ url('/admin/orders/' . $order->id) }}">View</a></td>
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

            {{ $orders->links() }}
            
        </div>
    </div>
    
</div>  
@endsection