@extends('components.layouts.user.layouts.app')

@section('title', 'Booking History')

@section('styles')
    <style>
        body {
            background-color: #f4f6f8;
            font-family: 'Segoe UI', sans-serif;
        }

        /* Navbar */
        .main-header {
            background-color: #0c1b33;
            padding: 1rem 0;
        }

        .main-header .logo {
            color: #fff;
            font-weight: bold;
            font-size: 1.6rem;
            text-decoration: none;
        }

        .navbar-links a {
            color: #fff;
            font-size: 1rem;
            margin-left: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-links a:hover {
            color: #f4d03f;
        }

        .header-section {
            background-color: #fff;
            padding: 40px 0 20px;
            border-bottom: 1px solid #ddd;
        }

        .header-section h2 {
            font-weight: 700;
            font-size: 2rem;
            color: #0c1b33;
        }

        .card {
            border: 1px solid #dee2e6;
            border-radius: 15px;
            margin-bottom: 20px;
            padding: 25px;
            background-color: #fff;
        }

        .card h5 {
            color: #0c1b33;
            font-size: 1.25rem;
            margin-bottom: 15px;
        }

        .card p {
            margin: 4px 0;
            font-size: 0.95rem;
            color: #444;
        }

        .card p strong {
            color: #0c1b33;
        }

        .alert {
            font-size: 1rem;
        }

        @media (max-width: 576px) {
            .navbar-links {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Header Section -->
    <section class="header-section text-center">
        <div class="container">
            <h2>Booking History</h2>
            <p class="text-muted">Here's a summary of your recent bookings.</p>
        </div>
    </section>

    <!-- Booking Content -->
    <div class="container mt-4 mb-5">
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                    <th>Booking ID</th>
                    <th>Car</th>
                    <th>Period (Days)</th>
                    <th>Payment Method</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                    <tr>
                        <th scope="row">#BK-{{ $booking->booking_id }}</th>
                        <td>{{ $booking->name }}</td>
                        <td>{{ $booking->period }}</td>
                        <td>{{ $booking->bank_name ?? '-' }}</td>
                        <td>Rp.{{ number_format($booking->amount) }}</td>
                        <td>
                            <span
                                class="badge {{ [
                                    'canceled' => 'bg-danger',
                                    'not confirmed' => 'bg-secondary',
                                    'confirmed' => 'bg-info',
                                    'ongoing' => 'bg-warning text-dark',
                                    'completed' => 'bg-success',
                                ][$booking->status] }} rounded-pill d-inline">
                                {{ $booking->status }}</span>
                        </td>
                        <td>
                            @if ($booking->status == 'confirmed')
                                <a href="{{ route('cars.confirm', ['id' => $booking->id]) }}"
                                    class="btn btn-link btn-rounded btn-sm fw-bold" data-mdb-ripple-color="dark">
                                    Pay
                                </a>
                            @endif
                            <a href="{{ route('user.history.detail', ['id' => $booking->id]) }}" class="btn btn-link btn-rounded btn-sm fw-bold" data-mdb-ripple-color="dark">
                                View More
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="alert alert-info text-center" colspan="7">No bookings yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
