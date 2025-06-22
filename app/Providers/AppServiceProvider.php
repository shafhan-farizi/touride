<?php

namespace App\Providers;

use App\Filament\Widgets\BookingTrends;
use App\Filament\Widgets\CarsUsage;
use App\Filament\Widgets\StatsOverview;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('stats-overview', StatsOverview::class);
        Livewire::component('cars-usage', CarsUsage::class);
        Livewire::component('booking-trends', BookingTrends::class);
    }
}
