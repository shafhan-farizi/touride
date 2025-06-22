<?php

namespace App\Filament\Widgets;

use App\Models\Bookings;
use Filament\Widgets\Widget;

class StatusCars extends Widget
{
    protected static string $view = 'filament.widgets.status-cars';

    public $bookings;

    protected int | string | array $columnSpan = [
        'sm' => 12,
        'md' => 6,
    ];

    public function mount(): void
    {
        // $bookings = Bookings::with(['user', 'car'])->latest()->take(3)->get();
        $bookings = Bookings::query()
            ->join('payments', 'bookings.payment_id', '=', 'payments.id')
            ->leftjoin('payment_methods', 'payments.payment_method_id', '=', 'payment_methods.id')
            ->join('cars', 'bookings.car_id', '=', 'cars.id')
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->select('bookings.id', 'users.name as customer', 'bookings.booking_id', 'cars.name', 'bookings.period', 'payment_methods.bank_name', 'payments.amount', 'bookings.status')
            ->orderBy('bookings.updated_at', 'desc')
            ->take(3)
            ->get();
            
        $this->bookings = $bookings;
    }
}
