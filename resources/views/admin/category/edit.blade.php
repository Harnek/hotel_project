@extends('layouts.admin')

@section('content')
<div class="app-wrapper">
	    
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">			    
            <h1 class="app-page-title">Modify Room Category Settings</h1>
            <hr class="mb-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Modify Room Category</h3>
                    <div class="section-intro">You can customise following fields for the room category.</div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        
                        <div class="app-card-body">
                            <form class="settings-form" action="{{ url(route('admin.categories') . '/' . $category->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="id" value="{{ $category->id }}">
                                @error('id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="mb-3">
                                    <label for="setting-input-1" class="form-label">Category Name</label>
                                    <input type="text" name="name" class="form-control" id="setting-input-1" placeholder="Name" value="{{ old('name') ?? $category->name }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" id="setting-input-2" rows="4" style="height: auto;" placeholder="Description" required>{{ old('description') ?? $category->description }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-3" class="form-label">Base Price</label>
                                    <input type="number" name="price1" class="form-control" id="setting-input-3" value="{{ old('price1') ?? $category->price1 }}" required>
                                    @error('price1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-4" class="form-label">Price 2</label>
                                    <input type="number" name="price2" class="form-control" id="setting-input-4" value="{{ old('price2') ?? $category->price2 }}" required>
                                    @error('price2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-5" class="form-label">Price 3</label>
                                    <input type="number" name="price3" class="form-control" id="setting-input-5" value="{{ old('price3') ?? $category->price3 }}" required>
                                    @error('price3')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-6" class="form-label">Price 4</label>
                                    <input type="number" name="price4" class="form-control" id="setting-input-6" value="{{ old('price4') ?? $category->price4 }}" required>
                                    @error('price4')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-7" class="form-label">Adults</label>
                                    <input type="number" name="adults" class="form-control" id="setting-input-7" value="{{ old('adults') ?? $category->adults }}" required>
                                    @error('adults')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-8" class="form-label">Children</label>
                                    <input type="number" name="children" class="form-control" id="setting-input-8" value="{{ old('children') ?? $category->children }}" required>
                                    @error('children')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-9" class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control" id="setting-input-9" accept="image/png, image/jpeg, image/jpg" style="padding:.375rem .75rem; height: initial;">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 form-check form-switch">
                                    <label for="setting-input-10" class="form-label">Enabled</label>
                                    <input type="checkbox" name="enabled" class="form-check-input" id="setting-input-10" {{ $category->enabled ? 'checked': '' }}>
                                    @error('enabled')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn app-btn-primary" >Update</button>
                                <input type="button" class="btn app-btn-secondary" value="Cancel" onclick="window.location.href='{{ url('/admin/categories/' . $category->id) }}'" >
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