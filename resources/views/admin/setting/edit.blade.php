@extends('layouts.admin')

@section('content')
<div class="app-wrapper">
	    
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">			    
            <h1 class="app-page-title">Modify General Settings</h1>
            <hr class="mb-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Modify Settings</h3>
                    <div class="section-intro">You can customise following fields for the hotel settings.</div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        
                        <div class="app-card-body">
                            <form class="settings-form" action="{{ route('admin.settings.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-3">
                                    <label for="setting-input-1" class="form-label">Hotel Name</label>
                                    <input type="text" name="name" class="form-control" id="setting-input-1" value="{{ old('name') ?? $data['name'] }}">                                    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Owner Name</label>
                                    <input type="text" name="owner" class="form-control" id="setting-input-2" value="{{ old('owner') ?? $data['owner'] }}">
                                    @error('owner')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-3" class="form-label">Contact Email</label>
                                    <input type="email" name="contact_email" class="form-control" id="setting-input-3" value="{{ old('contact_email') ?? $data['contact_email'] }}">
                                    @error('contact_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-4" class="form-label">Tax Percentage</label>
                                    <input type="text" name="tax_percentage" class="form-control" id="setting-input-4" value="{{ old('tax_percentage') ?? $data['tax_percentage'] }}">
                                    @error('tax_percentage')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-5" class="form-label">Discount Percentage</label>
                                    <input type="text" name="discount_percentage" class="form-control" id="setting-input-5" value="{{ old('discount_percentage') ?? $data['discount_percentage'] }}">
                                    @error('discount_percentage')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn app-btn-primary" >Update</button>
                                <input type="button" class="btn app-btn-secondary" value="Cancel" onclick="window.location.href='{{ route('admin.settings') }}'" >
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