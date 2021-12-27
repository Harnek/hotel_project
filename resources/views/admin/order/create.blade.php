@extends('layouts.admin')

@section('content')
<div class="app-wrapper">
	    
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">			    
            <h1 class="app-page-title">Create New Order</h1>
            <hr class="mb-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Add Order</h3>
                    <div class="section-intro">Fill following fields for the new order.</div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        
                        <div class="app-card-body">
                            <form class="settings-form" action="{{ route('admin.orders.store') }}" method="POST">
                                @csrf

                                @foreach ($rooms as $room)
                                    <input type="hidden" name="room_id[]" value="{{ $room->id }}">
                                @endforeach

                                <div class="mb-3">
                                    <label for="setting-input-1" class="form-label">Check In</label>
                                    <input type="text" name="check_in" class="form-control" id="setting-input-1" value="{{ $check_in }}" readonly>
                                    @error('check_in')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Check Out</label>
                                    <input type="text" name="check_out" class="form-control" id="setting-input-2" value="{{ $check_out }}" readonly>
                                    @error('check_out')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-3" class="form-label">Rooms</label>
                                    <input type="text" name="rooms" class="form-control" id="setting-input-3" value="{{ count($rooms) }}" disabled>
                                    @error('rooms')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-4" class="form-label">Firstname</label>
                                    <input type="text" name="firstname" class="form-control" id="setting-input-4" value="{{ old('firstname') }}" placeholder="Firstname" required>
                                    @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-5" class="form-label">Lastname</label>
                                    <input type="text" name="lastname" class="form-control" id="setting-input-5" value="{{ old('lastname') }}" placeholder="Lastname">
                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-6" class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" id="setting-input-6" value="{{ old('phone') }}" placeholder="Phone" required>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-7" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="setting-input-7" value="{{ old('email') }}" placeholder="Email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-7" class="form-label">Guests</label>
                                    <input type="number" name="guests" class="form-control" id="setting-input-7" value="{{ old('guests') }}" placeholder="Number of Guests">
                                    @error('guests')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-8" class="form-label">Meal Option</label>
                                    <select class="form-select" id="setting-input-8" name="price" required>
                                        <option disabled selected>-- Meal --</option>
                                        <option value="price1">Food not included</option>
                                        <option value="price2">Includes Breakfast</option>
                                        <option value="price3">Includes Breakfast with lunch or dinner</option>
                                        <option value="price4">Includes Full Meal Course</option>
                                    </select>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-9" class="form-label">Payment Method</label>
                                    <select class="form-select" id="setting-input-9" name="payment_method" required>
                                        <option disabled selected>-- Payment Method --</option>
                                        <option value="cash">Cash</option>
                                        <option value="other">Other</option>
                                    </select>
                                    @error('payment_method')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-10" class="form-label">Payment Status</label>
                                    <select class="form-select" id="setting-input-10" name="payment_status" required>
                                        <option disabled selected>-- Payment Status --</option>
                                        <option value="paid">Paid</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                    @error('payment_status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn app-btn-primary" >Create</button>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
            <hr class="my-4">

            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Rooms</h1>
                </div>
            </div>
           
            <div class="app-card app-card-orders-table shadow-sm mb-5">
                <div class="app-card-body">
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left">
                            <thead>
                                <tr>
                                    <th class="cell">Index</th>
                                    <th class="cell">Room</th>
                                    <th class="cell">Floor</th>
                                    <th class="cell">Category</th>
                                    <th class="cell">Status</th>
                                    <th class="cell">View</th>
                                    <th class="cell">Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)                                    
                                    <tr>
                                        <td class="cell">{{ $loop->index + 1 }}</td>
                                        <td class="cell">{{ $room->room_number ?? "Not Set" }}</td>
                                        <td class="cell">{{ $room->floor ?? "Not Set" }}</td>
                                        <td class="cell">{{ $room->category_name }}</td>
                                        @if ($room->enabled)
                                            <td class="cell"><span class="badge bg-success">Enabled</span></td>
                                        @else
                                            <td class="cell"><span class="badge bg-danger">Disabled</span></td>
                                        @endif
                                        <td class="cell"><a class="btn-sm app-btn-secondary" href="{{ url(route('admin.rooms') . '/' . $room->id) }}">view</a></td>
                                        <td class="cell"><a class="btn-sm app-btn-secondary" href="{{ url(route('admin.rooms') . '/' . $room->id . '/edit') }}">modify</a></td>
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