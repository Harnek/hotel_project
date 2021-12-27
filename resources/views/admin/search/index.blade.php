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
                    <h1 class="app-page-title mb-0">Create Booking</h1>
                </div>
                <div class="col-auto">
                     <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <form class="docs-search-form row gx-1 align-items-center">
                                    <div class="col-auto mb-2">
                                        <input type="date" name="check_in" id="check_in" class="form-control" placeholder="Check In" value="{{ $check_in }}" required>
                                    </div>
                                    
                                    <div class="col-auto mb-2">
                                        <input type="date" name="check_out" id="check_out" class="form-control" placeholder="Check Out" value="{{ $check_out }}" required>
                                    </div>
                                    
                                    <div class="col-auto mb-2">
                                        <select name="category_id" class="form-select w-auto">    
                                            @if (!$category_id)
                                                <option selected="">All Room Types</option>
                                            @endif
    
                                            @foreach ($categories as $category)
                                                @if ($category_id && $category_id == $category->id)
                                                    <option selected="" value="{{ $category->id }}">{{ $category->name }}</option>                                            
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>                                            
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-auto mb-2">
                                        <button type="submit" class="btn app-btn-secondary">Search</button>
                                    </div>
                                </form>                                
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->

            @if (count($rooms))
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Available Rooms</h1>
                    </div>
                </div>
                
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">Index</th>
                                        <th class="cell">Room Number</th>
                                        <th class="cell">Floor</th>
                                        <th class="cell">Category</th>
                                        <th class="cell">Select</th>
                                        <th class="cell"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rooms as $room)                                    
                                        <tr>
                                            <td class="cell">{{ $loop->index + 1 }}</td>
                                            <td class="cell">{{ $room->room_number ?? "Not Set" }}</td>
                                            <td class="cell">{{ $room->floor ?? "Not Set" }}</td>
                                            <td class="cell">{{ $room->category_name }}</td>
                                            <td class="cell"><input class="form-check-input room_checkbox" type="checkbox" value="{{ $room->id }}" id="flexCheckDefault"></td>
                                            <td class="cell"><a class="btn-sm app-btn-secondary" href="{{ url(route('admin.orders.create') . '?check_in=' . $check_in . '&check_out=' . $check_out . '&room_id[0]=' . $room->id) }}">Book</a></td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto"></div>
                    <div class="col-auto">
                        <a class="btn app-btn-primary" id="btn_book">Book Selected</a>	
                    </div>
                </div>

                <form id="form_rooms" action="{{ route('admin.orders.create') }}"></form>
            @endif
                
        </div>
    </div>
</div>
@endsection

@section('footer_extras')
    <script>function updateForm(){let form=document.getElementById('form_rooms');while(form.firstChild){form.firstChild.remove()}let check_in=document.createElement('input');check_in.type='hidden';check_in.name='check_in';check_in.value=document.getElementById('check_in').value;form.appendChild(check_in);let check_out=document.createElement('input');check_out.type='hidden';check_out.name='check_out';check_out.value=document.getElementById('check_out').value;form.appendChild(check_out);let rooms=document.querySelectorAll('.room_checkbox');rooms.forEach(room=>{if(room.checked){let el=document.createElement('input');el.type='hidden';el.name='room_id[]';el.value=room.value;form.appendChild(el)}});form.submit()}document.getElementById('btn_book').onclick=updateForm;</script>
@endsection