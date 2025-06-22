<?php

namespace App\Filament\Pages;

use App\Models\Bookings;
use App\Models\Payments;
use Carbon\Carbon;
use Filament\Pages\Page;

class Reports extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static string $view = 'filament.pages.reports';

    protected static ?int $navigationSort = 4;

    public function getWidgetData(): array
    {
        $month_before = Carbon::now()->startOfMonth()->subMonth();
        $month_now = Carbon::now()->startOfMonth();

        $now = Carbon::now();

        $revenue = Payments::where('status', 'paid')->whereBetween('updated_at', [$month_now, $now])->sum('amount');
        $last_month_revenue = Payments::where('status', 'paid')->whereBetween('updated_at', [$month_before, $month_now])->sum('amount');

        $comparison = $revenue - $last_month_revenue;

        $total_booking = Bookings::whereIn('status', ['ongoing', 'not confirmed', 'confirmed'])->count();

        $most_booked_car = Bookings::withCount('car')->orderByDesc('car_count')->first();
        
        $top_customer = Bookings::withCount('user')->orderByDesc('user_count')->first();

        return [
            'revenue' => $revenue,
            'comparison' => $comparison,
            'total_booking' => $total_booking,
            'most_booked_car' => $most_booked_car,
            'top_customer' => $top_customer,
        ];
    }
}
