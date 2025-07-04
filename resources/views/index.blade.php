@extends('components.layouts.user.layouts.app')

@section('title', 'Luxury Car Rental')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .swiper-container {
            position: relative;
            padding: 3rem;
        }

        .star-rating {
            direction: rtl;
            display: inline-block;
            cursor: pointer;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            color: #ddd;
            font-size: 24px;
            padding: 0 2px;
            cursor: pointer;
        }

        .star-rating input:checked~label {
            color: #ffc107;
        }
    </style>
@endsection

@section('content')
    <section id="home" class="hero-section d-flex align-items-center justify-content-center text-center">
        <div class="hero-content">
            <h1>Drive With Comfort</h1>
            <p>Experience top-tier vehicles for every journey</p>
        </div>
    </section>

    <section id="about" class="about-us container my-5">
        <h2 class="section-title text-center mb-4">About Us</h2>
        <p class="lead text-justify">
            At <strong>Touride</strong>, we offer an exclusive selection of cars of several types including cars
            commonly used
            by families to cars with large capacity. We also provide world-class cars to attend prestigious events.
        </p>
        <p class="text-justify">
            Whether you're attending a special event, business meeting or simply want to experience the thrill of
            driving a
            high-performance car, we provide a seamless and luxurious rental experience.
            Our fleet includes all types of vehicles from sleek sports cars to elegant sedans and powerful SUVs, all
            maintained to the highest standards. With flexible rental packages and shuttle services, we ensure a
            hassle-free
            experience that puts you directly behind the wheel of a luxury car.
        </p>
        <p class="text-justify">
            We also offer spacious family vehicles such as the Toyota Avanza and Daihatsu Xenia, perfect for group
            travel and
            family trips, providing ample space and comfort. We are committed to providing exceptional customer service,
            with
            a focus on comfort and satisfaction.
            At <strong>Touride</strong>, your journey begins with us — a place where luxury meets convenience.
        </p>
    </section>


    <!-- Car Collection -->
    <section id="cars" class="car-collection container py-5">
        <h2 class="section-title text-center mb-5">Our Car Collection</h2>
        <div class="row">
            @forelse ($cars as $car)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $car->image }}" class="card-img-top" alt="Ferrari">
                        <div class="card-body">
                            <h5 class="card-title">{{ $car->name }}</h5>
                            <p class="card-text">{{ $car->type }} —
                                <span class="text-warning">
                                    @php
                                        $full_star = floor($car->review->avg('rating'));
                                        $has_half_star = $car->review->avg('rating') - $full_star >= 0.5;
                                    @endphp
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < $full_star)
                                            <i class="fa-solid fa-star"></i>
                                        @elseif($has_half_star && $i == $full_star)
                                            <i class="fa-regular fa-star-half-stroke"></i>
                                        @else
                                            <i class="fa-regular fa-star"></i>
                                        @endif
                                    @endfor
                                </span>
                                <br>{{ $car->description }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted mt-4">No Data.</div>
            @endforelse
        </div>
    </section>

    <!-- Our Services -->
    <section id="services" class="our-services py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">Our Services</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="service-card text-center">
                        <h4>📅 Seamless Booking</h4>
                        <p>Reserve your car in just a few clicks—our platform makes it easy.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card text-center">
                        <h4>🚗 Door-to-Door Delivery</h4>
                        <p>Get your rental delivered straight to your location hassle-free.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card text-center">
                        <h4>📦 Custom Rental Plans</h4>
                        <p>Flexible packages: daily, weekly, or monthly — all tailored to you.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Customer Testimonials -->
    <section id="testimonials" class="testimonials py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-5">What Our Customers Say</h2>
            <div class="container swiper-container">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @forelse($reviews as $review)
                            <div class="card swiper-slide">
                                <div class="card-body">
                                    <div class="d-flex mb-3 gap-3 align-items-center">
                                        <img src="https://i.pinimg.com/736x/1d/f1/1c/1df11cbf1369672cf98d2e57eca35781.jpg"
                                            alt="" style="width: 70px; height: 70px" class="rounded-circle">
                                        <div class="">
                                            <h5 class="card-title">{{ $review->user->name }}</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">
                                                {{ date('m d, Y', strtotime($review->update_at)) }}</h6>
                                        </div>
                                    </div>
                                    <p class="card-text">{{ $review->description }}</p>
                                    <div class="star-rating animated-stars">
                                        <input type="radio" value="5" {{ $review->rating == 5 ? 'checked' : '' }}
                                            disabled>
                                        <label class="fa-solid fa-star"></label>
                                        <input type="radio" value="4" {{ $review->rating == 4 ? 'checked' : '' }}
                                            disabled>
                                        <label class="fa-solid fa-star"></label>
                                        <input type="radio" value="3" {{ $review->rating == 3 ? 'checked' : '' }}
                                            disabled>
                                        <label class="fa-solid fa-star"></label>
                                        <input type="radio" value="2" {{ $review->rating == 2 ? 'checked' : '' }}
                                            disabled>
                                        <label class="fa-solid fa-star"></label>
                                        <input type="radio" value="1" {{ $review->rating == 1 ? 'checked' : '' }}
                                            disabled>
                                        <label class="fa-solid fa-star"></label>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card w-100 text-center">
                                <div class="card-body">
                                    <h5 class="card-title">No Comments.</h5>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper', {
            loop: true,
            watchOverflow: true,
            slidesPerView: 3,
            spaceBetween: 15,
            pagination: {
                el: '.swiper-pagination',
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            scrollbar: {
                el: '.swiper-scrollbar',
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    spaceBetween: 10
                },
                500: {
                    slidesPerView: 2,
                    spaceBetween: 15
                },
                1200: {
                    slidesPerView: 3,
                    spaceBetween: 15
                }
            }
        });
    </script>
@endsection
