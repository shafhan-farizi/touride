<?php

namespace App\Filament\Widgets;

use App\Models\Cars;
use Filament\Widgets\Widget;

class AddedCars extends Widget
{
    protected static string $view = 'filament.widgets.added-cars';

    public $cars;

    protected int | string | array $columnSpan = [
        'sm' => 12,
        'md' => 6,
    ];

    public function mount(): void
    {
        $cars = Cars::latest()->take(3)->get();

        $this->cars = $cars;
    }
}
