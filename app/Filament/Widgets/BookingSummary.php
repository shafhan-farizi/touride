<?php

namespace App\Filament\Widgets;

use App\Models\Bookings;
use Carbon\Carbon;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;

class BookingSummary extends Widget
{
    protected static string $view = 'filament.widgets.booking-summary';

    public $booking_summary;

    protected int | string | array $columnSpan = [
        'sm' => 12,
        'md' => 12,
        'xl' => 4
    ];

    public function mount(): void
    {
        $booking_canceled = Bookings::where('status', 'canceled')->count();
        $booking_ongoing = Bookings::where('status', 'ongoing')->count();
        $booking_completed = Bookings::where('status', 'completed')->count();
        $booking_today = Bookings::whereDate('created_at', Carbon::today())->count();
        $booking_count = Bookings::count();

        $this->booking_summary = [
            'canceled' => $booking_canceled,
            'ongoing' => $booking_ongoing,
            'completed' => $booking_completed,
            'today' => $booking_today,
            'count' => $booking_count
        ];
    }
}
