<?php

namespace App\Filament\Widgets;

use App\Models\Cars;
use Filament\Widgets\Widget;

class CarsOverview extends Widget
{
    protected static string $view = 'filament.widgets.cars-overview';

    public $cars_summary;

    protected int | string | array $columnSpan = [
        'sm' => 12,
        'md' => 4,
    ];

    public function mount(): void {
        $available = Cars::where('status', 'available')->count();
        $rented = Cars::where('status', 'rented')->count();
        $maintenance = Cars::where('status', 'maintenance')->count();
        $total = Cars::count();

        $this->cars_summary = [
            'available' => $available,
            'rented' => $rented,
            'maintenance' => $maintenance,
            'total' => $total,
        ];
    }
}
