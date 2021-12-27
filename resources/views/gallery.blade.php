@extends('layouts.app')

@section('header_extras')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/baguetteBox.min.css') }}">
@endsection

@section('content')
    <div class="gallery_container">
        <div class="container gallery">
            <div class="row">
                <div class="col-12">
                    <h1>Gallery</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 p-0">
                    <a href="{{ asset('images/gallery_1.jpg') }}">
                        <img src="{{ asset('images/gallery_1.jpg') }}" alt="hotel image">
                    </a>
                </div>
                <div class="col-md-6 p-0">
                    <a href="{{ asset('images/gallery_2.jpg') }}">
                        <img src="{{ asset('images/gallery_2.jpg') }}" alt="hotel image">
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 p-0">
                    <a href="{{ asset('images/gallery_3.jpg') }}">
                        <img src="{{ asset('images/gallery_3.jpg') }}" alt="hotel image" />
                    </a>
                </div>
                <div class="col-md-3 p-0">
                    <a href="{{ asset('images/gallery_4.jpg') }}">
                        <img src="{{ asset('images/gallery_4.jpg') }}" alt="hotel image" />
                    </a>
                </div>
                <div class="col-md-3 p-0">
                    <a href="{{ asset('images/gallery_5.jpg') }}">
                        <img src="{{ asset('images/gallery_5.jpg') }}" alt="hotel image" />
                    </a>
                </div>
                <div class="col-md-3 p-0">
                    <a href="{{ asset('images/gallery_6.jpg') }}">
                        <img src="{{ asset('images/gallery_6.jpg') }}" alt="hotel image" />
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 p-0">
                    <a href="{{ asset('images/gallery_7.jpg') }}">
                        <img src="{{ asset('images/gallery_7.jpg') }}" alt="hotel image" />
                    </a>
                </div>
                <div class="col-md-3 p-0">
                    <a href="{{ asset('images/gallery_8.jpg') }}">
                        <img src="{{ asset('images/gallery_8.jpg') }}" alt="hotel image" />
                    </a>
                </div>
                <div class="col-md-3 p-0">
                    <a href="{{ asset('images/gallery_9.jpg') }}">
                        <img src="{{ asset('images/gallery_9.jpg') }}" alt="hotel image" />
                    </a>
                </div>
                <div class="col-md-3 p-0">
                    <a href="{{ asset('images/gallery_10.jpg') }}">
                        <img src="{{ asset('images/gallery_10.jpg') }}" alt="hotel image" />
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 p-0">
                    <a href="{{ asset('images/gallery_11.jpg') }}">
                        <img src="{{ asset('images/gallery_11.jpg') }}" alt="hotel image" />
                    </a>
                </div>
                <div class="col-md-3 p-0">
                    <a href="{{ asset('images/gallery_12.jpg') }}">
                        <img src="{{ asset('images/gallery_12.jpg') }}" alt="hotel image" />
                    </a>
                </div>
                <div class="col-md-3 p-0">
                    <a href="{{ asset('images/gallery_13.jpg') }}">
                        <img src="{{ asset('images/gallery_13.jpg') }}" alt="hotel image" />
                    </a>
                </div>
                <div class="col-md-3 p-0">
                    <a href="{{ asset('images/gallery_4.jpg') }}">
                        <img src="{{ asset('images/gallery_4.jpg') }}" alt="hotel image" />
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_extras')
    <script src="{{ asset('js/baguetteBox.min.js') }}"></script>
    <script>
        baguetteBox.run('.gallery');
    </script>
@endsection
