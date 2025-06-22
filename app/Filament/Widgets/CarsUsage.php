<?php

namespace App\Filament\Widgets;

use App\Models\Cars;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class CarsUsage extends ChartWidget
{
    protected static ?string $heading = 'Cars Usage';

    protected static ?string $maxHeight = '350px';

    protected function getData(): array
    {
        $cars_status = Cars::groupBy('status')->select('status', DB::raw('COUNT(status) as total'))->get();

        $total = [];
        $status = [];

        foreach($cars_status as $car) {
            array_push($total, $car->total);
            array_push($status, $car->status . ' ' . $car->total);
        }

        return [
            'datasets' => [
                [
                    'data' => $total,
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                    'hoverOffset' => 4,
                ],
            ],
            'labels' => $status,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                ],
            ],
            'scales' => [
                'x' => [
                    'display' => false,
                    'grid' => [
                        'display' => false,
                    ],
                    'ticks' => [
                        'display' => false,
                    ],
                ],
                'y' => [
                    'display' => false,
                    'grid' => [
                        'display' => false,
                    ],
                    'ticks' => [
                        'display' => false,
                    ],
                ],
            ],
        ];
    }
}
