<?php

namespace App\Filament\Widgets;

use App\Models\Bookings;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class BookingTrends extends ChartWidget
{
    protected static ?string $heading = 'Booking Trends';

    protected static ?string $maxHeight = '350px';

    protected function getData(): array
    {
        $startOfMonth = Carbon::now()->startOfMonth();

        $endOfMonth = Carbon::now()->endOfMonth();

        $currentDate = $startOfMonth->copy();
        $weeks = [];

        $i = 0;

        while ($currentDate->lte($endOfMonth)) {
            $startOfWeek = $currentDate->copy()->startOfWeek(Carbon::MONDAY);

            $endOfWeek = $currentDate->copy()->endOfWeek(Carbon::SUNDAY);

            if (!isset($weeks[$startOfWeek->format('Y-m-d')])) {
                $weeks[$startOfWeek->format('Y-m-d')] = [
                    'start' => $startOfWeek->format('Y-m-d'),
                    'end' => $endOfWeek->format('Y-m-d'),
                ];
            }

            $currentDate->addDay();
        }

        $data = [];
        $label = [];
        $i = 1;
        foreach($weeks as $week) {
            array_push($data, Bookings::whereBetween(DB::raw('DATE(updated_at)'), [$week['start'], $week['end']])->count());
            array_push($label, 'Week ' . $i++);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Weekly Booking Trends',
                    'data' => $data,
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $label,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'indexAxis' => 'y',
        ];
    }
}
