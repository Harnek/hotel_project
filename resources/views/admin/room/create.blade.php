@extends('layouts.admin')

@section('content')
<div class="app-wrapper">
	    
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">			    
            <h1 class="app-page-title">Create New Room</h1>
            <hr class="mb-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Add Room</h3>
                    <div class="section-intro">Fill following fields for the new room.</div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        
                        <div class="app-card-body">
                            <form class="settings-form" action="{{ route('admin.rooms.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="setting-input-1" class="form-label">Category Name</label>
                                    <select class="form-select" id="setting-input-1" name="category_id" required>
                                        <option disabled selected>-- Select Room Type --</option>
                                        @foreach ($categories as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Room Number (optional)</label>
                                    <input type="number" name="room_number" class="form-control" id="setting-input-2" value="{{ old('room_number') }}">
                                    @error('room_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-3" class="form-label">Floor (optional)</label>
                                    <input type="number" name="floor" class="form-control" id="setting-input-3" value="{{ old('floor') }}">
                                    @error('floor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 form-check form-switch">
                                    <label for="setting-input-4" class="form-label">Enabled</label>
                                    <input type="checkbox" name="enabled" class="form-check-input" id="setting-input-4" checked>
                                    @error('enabled')
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
        </div>
    </div>
    
</div>   
@endsection