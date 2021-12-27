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

            <h1 class="app-page-title">Settings</h1>
            <div class="row gy-4">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">General</h3>
                    <div class="section-intro">Details for the hotel.</div>
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
                                    <h4 class="app-card-title">Hotel Details</h4>
                                </div>
                            </div>    
                        </div>
                        
                        <div class="app-card-body px-4 w-100">                   
                            
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Hotel Name</strong></div>
                                        <div class="item-data">{{ $data['name'] }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Owner Name</strong></div>
                                        <div class="item-data">{{ $data['owner'] }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Business Email Address</strong></div>
                                        <div class="item-data">{{ $data['contact_email'] }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Tax percentage</strong></div>
                                        <div class="item-data">{{ $data['tax_percentage'] }}%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Discount percentage</strong></div>
                                        <div class="item-data">{{ $data['discount_percentage'] }}%</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="app-card-footer p-4 mt-auto">
                            <a class="btn app-btn-secondary" href="{{ route('admin.settings.edit') }}">Edit Settings</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
</div>
@endsection