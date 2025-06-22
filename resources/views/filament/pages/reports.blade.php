<x-filament-panels::page>
    <livewire:stats-overview />
    <div class="flex gap-4">
        <div class="w-1/2">
            @livewire(\App\Filament\Widgets\CarsUsage::class)
        </div>
        <div class="w-1/2">
            @livewire(\App\Filament\Widgets\BookingTrends::class)
        </div>
    </div>
</x-filament-panels::page>
