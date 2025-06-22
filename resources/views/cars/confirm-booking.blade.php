<!DOCTYPE html>
<html>

<head>
    <title>Touride - Booking Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .summary-card {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .summary-label {
            font-weight: 500;
            color: #6c757d;
        }

        .summary-value {
            font-size: 1.1rem;
        }

        .modal-content {
            border-radius: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <a href="javascript:history.back()" class="d-block mt-4 text-decoration-none text-secondary">&larr; Back</a>
        <form method="post" action="{{ route('cars.confirmed', ['id' => $booking->id]) }}">
            @csrf
            <div class="summary-card">
                <h2 class="mb-4">Booking Summary #BK-{{ $booking->booking_id }}</h2>
                <div class="row mb-4">
                    <div class="col">
                        <div class="fs-4">Car Info</div>
                        <div class="mb-2">
                            <div class="summary-label">Name</div>
                            <div class="summary-value">{{ $booking->car->name }}</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">Period</div>
                            <div class="summary-value">{{ $booking->period }} Day(s)</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">PickUp</div>
                            <div class="summary-value">{{ date('d M Y, H:i', strtotime($booking->pickup_date)) }} -
                                {{ $booking->pickup_location }}</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">Return</div>
                            <div class="summary-value">{{ date('d M Y, H:i', strtotime($booking->return_date)) }} -
                                {{ $booking->dropoff_location }}</div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="fs-4">Pricing Summary</div>

                        <div class="mb-2">
                            <div class="summary-label">Base Price</div>
                            <div class="summary-value">Rp.{{ number_format($booking->calculated_price) }}</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">Insurance</div>
                            <div class="summary-value">Rp.{{ number_format($booking->car->insurance) }}</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">Service Fee</div>
                            <div class="summary-value">Rp.{{ number_format($booking->car->service_fee) }}</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">Total</div>
                            <div class="summary-value">
                                Rp.{{ number_format($booking->calculated_price + $booking->car->insurance + $booking->car->service_fee) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="fs-4">Renter Info</div>

                        <div class="mb-2">
                            <div class="summary-label">Customer</div>
                            <div class="summary-value">{{ $user->name }}</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">Phone</div>
                            <div class="summary-value">{{ $user->phone }}</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">Email</div>
                            <div class="summary-value">{{ $user->email }}</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="fs-4">Payment Method</div>

                        <div class="mb-2">
                            <div class="summary-label">Select Payment Method</div>
                            <div class="summary-value">
                                <select name="payment_method_id" class="form-control" id="">
                                    <option selected disabled>Select Option</option>
                                    @foreach ($payment_methods as $pm)
                                        <option value="{{ $pm->id }}">{{ $pm->bank_name }} - {{ $pm->pin }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="summary-label">Return Location</div>
                    <div class="summary-value">{{ $booking->dropoff_location }}</div>
                </div>


                <div class="text-end mt-4">
                    <a href="{{ route('user.history') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Confirm Booking</button>
                </div>
        </form>
    </div>
    </div>

    <!-- Modal Booking Confirmed -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="rounded-circle bg-success d-inline-flex align-items-center justify-content-center"
                            style="width: 80px; height: 80px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white"
                                class="bi bi-check-lg" viewBox="0 0 16 16">
                                <path
                                    d="M13.485 1.929a.75.75 0 0 1 1.06 1.06l-8 8a.75.75 0 0 1-1.06 0l-4-4a.75.75 0 0 1 1.06-1.06L6 9.439l7.485-7.51z" />
                            </svg>
                        </div>
                    </div>
                    <h4 class="fw-bold">Booking Confirmed!</h4>
                    <p class="text-muted mb-3">Your booking has been successfully submitted.</p>
                    <a href="{{ route('user.history') }}" class="btn btn-primary px-4">Go to Booking History</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
