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
