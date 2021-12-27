@extends('layouts.admin')

@section('content')
<div class="app-wrapper">
	    
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">			    
            <h1 class="app-page-title">Create New Room Category</h1>
            <hr class="mb-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Add Room Category</h3>
                    <div class="section-intro">Fill following fields for the new category.</div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        
                        <div class="app-card-body">
                            <form class="settings-form" action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="setting-input-1" class="form-label">Category Name</label>
                                    <input type="text" name="name" class="form-control" id="setting-input-1" placeholder="Name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" id="setting-input-2" rows="4" style="height: auto;" placeholder="Description" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-3" class="form-label">Base Price</label>
                                    <input type="number" name="price1" class="form-control" id="setting-input-3" value="{{ old('price1') ?? '3000' }}" required>
                                    @error('price1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-4" class="form-label">Price 2</label>
                                    <input type="number" name="price2" class="form-control" id="setting-input-4" value="{{ old('price2') ?? '3000' }}" required>
                                    @error('price2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-5" class="form-label">Price 3</label>
                                    <input type="number" name="price3" class="form-control" id="setting-input-5" value="{{ old('price3') ?? '3000' }}" required>
                                    @error('price3')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-6" class="form-label">Price 4</label>
                                    <input type="number" name="price4" class="form-control" id="setting-input-6" value="{{ old('price4') ?? '3000' }}" required>
                                    @error('price4')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-7" class="form-label">Adults</label>
                                    <input type="number" name="adults" class="form-control" id="setting-input-7" value="{{ old('adults') ?? '2' }}" required>
                                    @error('adults')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-8" class="form-label">Children</label>
                                    <input type="number" name="children" class="form-control" id="setting-input-8" value="{{ old('children') ?? '2' }}" required>
                                    @error('children')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-9" class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control " id="setting-input-9" accept="image/png, image/jpeg, image/jpg" style="padding:.375rem .75rem; height: initial;">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 form-check form-switch">
                                    <label for="setting-input-10" class="form-label">Enabled</label>
                                    <input type="checkbox" name="enabled" class="form-check-input" id="setting-input-10" checked>
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