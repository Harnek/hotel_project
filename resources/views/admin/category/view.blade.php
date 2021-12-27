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

            <h1 class="app-page-title">Room Category</h1>
            <hr class="mb-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Room Type</h3>
                    <div class="section-intro">Details for the room Type.</div>
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
                                    <h4 class="app-card-title">Room Category Details</h4>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="app-card-body px-4 w-100">    
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Category Name</strong></div>
                                        <div class="item-data">{{ $category->name }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label mb-2"><strong>Category Image</strong></div>
                                        <div class="item-data"><img class="profile-image" src="{{ asset('images/' . $category->image) }}" alt="Category Image"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Description</strong></div>
                                        <div class="item-data">{{ $category->description }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Base Price</strong></div>
                                        <div class="item-data">{{ $category->price1 }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Price 2</strong></div>
                                        <div class="item-data">{{ $category->price2 }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Price 3</strong></div>
                                        <div class="item-data">{{ $category->price3 }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Price 4</strong></div>
                                        <div class="item-data">{{ $category->price4 }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Adults</strong></div>
                                        <div class="item-data">{{ $category->adults ?? "" }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Children</strong></div>
                                        <div class="item-data">{{ $category->children ?? "" }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Enabled</strong></div>
                                        <div class="form-check form-switch">
                                            <label for="setting-input-4" class="form-label">Enabled</label>
                                            <input type="checkbox" name="enabled" class="form-check-input" id="setting-input-4" {{ $category->enabled ? 'checked': '' }} disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="app-card-footer p-4 mt-auto">
                            <a class="btn app-btn-secondary" href="{{ url(route('admin.categories') . '/' . $category->id . '/edit') }}">Edit Room</a>
                            <a class="btn app-btn-secondary" href="{{ route('admin.categories') }}">Go Back</a>
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
                                    <th class="cell">Status</th>
                                    <th class="cell">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)                                    
                                    <tr>
                                        <td class="cell">{{ $loop->index + 1 }}</td>
                                        <td class="cell">{{ $room->room_number ?? "Not Set" }}</td>
                                        <td class="cell">{{ $room->floor ?? "Not Set" }}</td>
                                        @if ($room->enabled)
                                            <td class="cell"><span class="badge bg-success">Enabled</span></td>
                                        @else
                                            <td class="cell"><span class="badge bg-danger">Disabled</span></td>
                                        @endif
                                        <td class="cell"><a class="btn-sm app-btn-secondary" href="{{ url('/admin/rooms/' . $room->id) }}">view</a></td>
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