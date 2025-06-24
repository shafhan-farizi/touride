<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class WelcomeMessage extends Widget
{
    protected static string $view = 'filament.widgets.welcome-message';

    protected int | string | array $columnSpan = [
        'sm' => 12,
        'md' => 12,
        'xl' => 8
    ];
}
