<?php

namespace App\Filament\Widgets;

use App\Models\Bookings;
use App\Models\Payments;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $month_before = Carbon::now()->startOfMonth()->subMonth();
        $month_now = Carbon::now()->startOfMonth();

        $now = Carbon::now();

        $revenue = Payments::where('status', 'paid')->whereBetween('updated_at', [$month_now, $now])->sum('amount');
        $last_month_revenue = Payments::where('status', 'paid')->whereBetween('updated_at', [$month_before, $month_now])->sum('amount');

        $comparison = $revenue - $last_month_revenue;

        $total_booking = Bookings::whereIn('status', ['ongoing', 'not confirmed', 'confirmed'])->count();

        $most_booked_car = Bookings::withCount('car')->orderByDesc('car_count')->first()->car->name;
        
        $top_customer = Bookings::withCount('user')->orderByDesc('user_count')->first()->user->name;

        $decrease = [17, 4, 15, 3, 10, 2, 7];
        $increase = [7, 2, 10, 3, 15, 4, 17];

        $is_negative = $comparison < 0;

        return [
            Stat::make('Revenue', 'Rp.' . number_format($revenue))
                ->description('Rp.' . number_format($comparison) . ' ' . ($is_negative ? 'decrease' : 'increase'))
                ->chart($is_negative ? $decrease : $increase)
                ->color($is_negative ? 'danger' : 'success')
                ->descriptionIcon($is_negative ? 'heroicon-m-arrow-trending-down' : 'heroicon-m-arrow-trending-up'),
            Stat::make('Total Booking', $total_booking),
            Stat::make('Most Booked Cars', $most_booked_car),
            Stat::make('Top Customer', $top_customer)
        ];
    }
}
