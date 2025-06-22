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
        <form>
            @csrf
            <div class="summary-card">
                <h2 class="mb-4">Booking Summary #BK-{{ $booking['booking_id'] }}</h2>
                <div class="row mb-4">
                    <div class="col">
                        <div class="fs-4">Car Info</div>
                        <div class="mb-2">
                            <div class="summary-label">Name</div>
                            {{-- <div class="summary-value">{{ $booking['car']->name }}</div> --}}
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">Period</div>
                            <div class="summary-value">{{ $booking['period'] }} Day(s)</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">PickUp</div>
                            <div class="summary-value">{{ date('d M Y, H:i', strtotime($booking['pickup_date'])) }} -
                                {{ $booking['pickup_location'] }}</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">Return</div>
                            <div class="summary-value">{{ date('d M Y, H:i', strtotime($booking['return_date'])) }} -
                                {{ $booking['dropoff_location'] }}</div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="fs-4">Pricing Summary</div>

                        <div class="mb-2">
                            <div class="summary-label">Base Price</div>
                            <div class="summary-value">Rp.{{ number_format($booking['calculated_price']) }}</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">Insurance</div>
                            <div class="summary-value">Rp.{{ number_format($booking['car']['insurance']) }}</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">Service Fee</div>
                            <div class="summary-value">Rp.{{ number_format($booking['car']['service_fee']) }}</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">Total</div>
                            <div class="summary-value">
                                Rp.{{ number_format($booking['calculated_price'] + $booking['car']['insurance'] + $booking['car']['service_fee']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="fs-4">Renter Info</div>

                        <div class="mb-2">
                            <div class="summary-label">Customer</div>
                            <div class="summary-value">{{ $user['name'] }}</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">Phone</div>
                            <div class="summary-value">{{ $user['phone'] }}</div>
                        </div>
                        <div class="mb-2">
                            <div class="summary-label">Email</div>
                            <div class="summary-value">{{ $user['email'] }}</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="fs-4">Payment Method</div>

                        <div class="mb-2">
                            <div class="summary-label">Select Payment Method</div>
                            <div class="summary-value">{{ $booking['payment']['payment_method']['bank_name'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="summary-label">Return Location</div>
                    <div class="summary-value">{{ $booking['dropoff_location'] }}</div>
                </div>
        </form>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>