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
                    <h1 class="app-page-title mb-0">Categories</h1>
                </div>
            </div>
           
            <div class="app-card app-card-orders-table shadow-sm mb-5">
                <div class="app-card-body">
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left">
                            <thead>
                                <tr>
                                    <th class="cell">Index</th>
                                    <th class="cell">Name</th>
                                    <th class="cell">Image</th>
                                    <th class="cell">Status</th>
                                    <th class="cell">View</th>
                                    <th class="cell">Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)                                    
                                    <tr>
                                        <td class="cell">{{ $loop->index + 1 }}</td>
                                        <td class="cell">{{ $category->name }}</td>
                                        <td class="cell"> <img src="{{ asset('images/'. $category->image) }}" alt="{{ $category->name }}"  style="width: auto; max-height: 6rem;"></td>
                                        @if ($category->enabled)
                                            <td class="cell"><span class="badge bg-success">Enabled</span></td>
                                        @else
                                            <td class="cell"><span class="badge bg-danger">Disabled</span></td>
                                        @endif
                                        <td class="cell"><a class="btn-sm app-btn-secondary" href="{{ url('/admin/categories/' . $category->id) }}">view</a></td>
                                        <td class="cell"><a class="btn-sm app-btn-secondary" href="{{ url('/admin/categories/' . $category->id . '/edit') }}">Modify</a></td>
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