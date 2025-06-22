<!DOCTYPE html>
<html>

<head>
    <title>Touride - Book Now</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-card {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: 500;
        }
    </style>
</head>

<body>

    <div class="container">
        <a href="javascript:history.back()" class="d-block mt-4 text-decoration-none text-secondary">&larr; Back</a>

        <div class="form-card">
            <h3 class="mb-4">Book: {{ $car->name }}</h3>

            <form action="{{ route('cars.booking.create') }}" method="post">
                @csrf
                <input type="hidden" name="car_id" value="{{ $car->id }}">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Pickup Date & Time</label>
                        <input type="datetime-local" class="form-control @error('pickup_date')  @enderror" name="pickup_date" value="{{ old('pickup_date') }}" >
                        @error('pickup_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label>Return Date & Time</label>
                        <input type="datetime-local" class="form-control @error('return_date')  @enderror" name="return_date" value="{{ old('return_date') }}" >
                        @error('return_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Pickup Location</label>
                        <input type="text" class="form-control @error('pickup_location')  @enderror" name="pickup_location" value="{{ old('pickup_location') }}" >
                        @error('pickup_location')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label>Drop-off Location</label>
                        <input type="text" class="form-control @error('dropoff_location')  @enderror" name="dropoff_location" value="{{ old('dropoff_location') }}" >
                        @error('dropoff_location')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary mt-2">Book Now</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
