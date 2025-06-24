@extends('components.layouts.user.layouts.app')

@section('title', 'Cars')

@section('styles')
    <style>
        <style>

        /* Navbar */
        .main-header {
            background-color: #0c1b33;
            padding: 1rem 0;
        }

        .main-header .logo {
            color: #fff;
            font-weight: bold;
            font-size: 1.6rem;
            font-family: 'Segoe UI', sans-serif;
            text-decoration: none;
        }

        .navbar-links a {
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
            font-size: 1rem;
            margin-left: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-links a:hover {
            color: #f4d03f;
        }

        /* Headings */
        h2 {
            font-weight: 700;
            color: #343a40;
        }

        /* Card layout */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease-in-out;
            background-color: #fff;
        }

        .card:hover {
            transform: scale(1.03);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .card-body {
            padding: 1rem 1.25rem;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: bold;
            color: #333;
        }

        .card-text {
            color: #555;
            font-size: 0.95rem;
        }

        .btn-outline-secondary {
            width: 100%;
            margin-bottom: 0.5rem;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-disabled {
            pointer-events: none;
            opacity: 0.6;
        }

        /* Search Bar */
        #searchInput {
            border-radius: 8px;
            padding: 0.6rem 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
            margin-bottom: 80px;
        }

        /* Responsive tweaks */
        @media (max-width: 768px) {
            .card-title {
                font-size: 1rem;
            }

            .card-text {
                font-size: 0.9rem;
            }

            .main-header nav a {
                margin-left: 10px;
            }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endsection

@section('content')
    <div class="container py-5">
        <h2 class="text-center mb-4">Explore Our Cars</h2>

        <div>
            <input type="text" id="search" class="form-control" placeholder="Search cars by name or type..." />
        </div>

        <div class="row mt-3" id="carContainer">
            @foreach ($cars as $car)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ $car->image }}" class="card-img-top" alt="{{ $car->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $car->name }}</h5>
                            <p class="card-text">Type: {{ $car->type }}</p>
                            <p class="card-text">Price: Rp.{{ number_format($car->rental_price) }}</p>
                            <a href="{{ route('cars.show', ['id' => $car->id]) }}" class="btn btn-outline-secondary">View
                                Detail</a>
                            @auth
                                @if (!$is_booking && $car->status == 'available')
                                    <a href="{{ route('cars.booking', ['id' => $car->id]) }}" class="btn btn-primary mt-2">Book
                                        Now</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

        $('#search').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ URL::to('search') }}',
                data: {
                    'search': $value
                },
                success: function(data) {
                    $('#carContainer').html(data);
                }
            });
        })
    </script>
@endsection
