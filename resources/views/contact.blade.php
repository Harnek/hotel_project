@extends('layouts.app')

@section('header_extras')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <!-- contact us form -->
    <div class="contactus_page py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center">Contact Us</h1>
                </div>
            </div>

            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible" role="alert" id="liveAlert">
                    {{ session()->get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mapArea mb-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 p-0">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3504.020787792555!2d77.18352381469624!3d28.56913848244289!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1d837cbc445f%3A0x3b12f7855cfd686c!2sHyatt%20Regency%20Delhi!5e0!3m2!1sen!2sin!4v1639671930900!5m2!1sen!2sin"
                                height="450" style="width: 100%" style="border: 0" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                        <div class="col-md-5 mapArea_second align-items-stretch">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>Contact Information</h2>
                                </div>
                                <div class="col-md-12">
                                    <p>Address</p>
                                    <a  
                                        href="https://goo.gl/maps/lorem"
                                        style="line-height: 1.5rem;"
                                        >
                                        3, Vaigai Street, Besant Nagar, Chennai, 600090, Tamil Nadu, India
                                    </a>
                                </div>
                                <div class="col-md-12">
                                    <p>Phone</p>
                                    <a href="tel:+91 61998 64461">+91 61998 64461</a>
                                    <a href="tel:+91 79313 03871">+91 79313 03871</a>
                                </div>
                                <div class="col-md-12">
                                    <p>Email</p>
                                    <a href="#contact"
                                        class="text-truncate">contact@sunshinehotel.com</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="row" id="contact">
                <div class="col-md-8">
                    <form action="{{ route('contact')}}" method="POST">
                        @csrf

                        <div class="row py-2">
                            <div class="col-12">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" value="{{ old('name') }}" required/>
                            </div>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row py-2">
                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Your Email" value="{{ old('email') }}" required/>
                            </div>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row py-2">
                            <div class="col-12">
                                <label for="phone" class="form-label">Phone (optional)</label>
                                <input type="text" name="phone" id="Phone" class="form-control"
                                    placeholder="Your Phone" value="{{ old('phone') }}" />
                            </div>
                            @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row py-2">
                            <div class="col-12">
                                <label for="message" class="form-label">Message</label>
                                <textarea name="message" id="message" cols="30" rows="8" class="form-control"
                                    placeholder="Your Message" value="{{ old('message') }}" required></textarea>
                            </div>
                            @error('message')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn">SEND</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('images/contactUs_image.svg') }}" alt="contact us image" class="img-fluid" />
                    <div class="row address_section">
                        <div class="col-md-12 contact_email">
                            <p class="address_section_heading">Email</p>
                            <a href="mailto:contact@sunshinehotel.com">contact@sunshinehotel.com</a>
                        </div>
                    </div>
                    <div class="row address_section">
                        <div class="col-md-12">
                            <p class="address_section_heading">Contact Number</p>
                            <a href="tel:+91 61998 64461">+91 61998 64461</a>
                            <a href="tel:+91 79313 03871">+91 79313 03871</a>
                        </div>
                    </div>
                    <div class="row address_section">
                        <div class="col-md-12">
                            <p class="address_section_heading">Contact Address</p>
                            <p class="address_section-address">
                            3, Vaigai Street, Besant Nagar, Chennai, 600090, Tamil Nadu, India
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="contact">
                <div class="col-md-8">
                    <form action="{{ route('review') }}" method="POST">
                        @csrf
                        
                        <div class="review">
                            <h2>Leave a Review</h2>
                        </div>

                        <div class="row py-2">
                            <div class="col-12">
                                <label for="name2" class="form-label">Name</label>
                                <input type="text" name="name2" id="name2" class="form-control" placeholder="Your Name" value="{{ old('name2') }}" required/>
                                @error('name2')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row py-2">
                            <div class="col-12">
                                <label for="Reviews" class="form-label">Reviews</label>
                                <textarea name="review" id="Reviews" cols="30" rows="8" class="form-control"
                                    placeholder="Your Reviews" value="{{ old('review') }}" required></textarea>
                                @error('review')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row py-2">
                            <div class="col-12">
                                <label for="Rating" class="form-label">Rating</label>
                                <input type="number" name="rating" id="rating" class="form-control" value="5" min="1" max="5" required/>
                                @error('rating')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn">Leave Review</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        
            <section id="testimonial" class="mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2>Reviews</h2>
                        </div>
                    </div>
                    <div class="col-12">
                        <div id="testimonialCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">

                                @foreach($reviews as $review)
                                    @if ($loop->first)
                                        <div class="carousel-item active">
                                            <div class="carousel-content">
                                                @if ($review->image)
                                                    <div class="client-img"><img src="images/{{ $review->image }}" alt="Testimonial Slider" /></div>
                                                @else
                                                    <div class="client-img"><img src="images/user-placeholder.jpg" alt="Testimonial Slider" /></div>
                                                @endif
                                                <p><i>{{ $review->review }}</i></p>
                                                <h3><span>-</span> {{ $review->name }} <span>-</span></h3>
                                            </div>
                                        </div>
                                    @else
                                        <div class="carousel-item">
                                            <div class="carousel-content">
                                                @if ($review->image)
                                                    <div class="client-img"><img src="images/{{ $review->image }}" alt="Testimonial Slider" /></div>
                                                @else
                                                    <div class="client-img"><img src="images/user-placeholder.jpg" alt="Testimonial Slider" /></div>
                                                @endif
                                                <p><i>{{ $review->review }}</i></p>
                                                <h3><span>-</span> {{ $review->name }} <span>-</span></h3>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                <a class="carousel-control-prev text-white" href="#testimonialCarousel" role="button" data-slide="prev">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <a class="carousel-control-next text-white" href="#testimonialCarousel" role="button" data-slide="next">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('footer_extras')

@endsection
