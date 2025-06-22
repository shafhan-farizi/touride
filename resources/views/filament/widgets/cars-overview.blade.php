<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center justify-center" style="border-bottom: 4px solid #e5e7eb;">
            <img src="{{ asset('images/car.png') }}" alt="Car Image" class="w-20 h-auto">
            <div class="text-lg">Fleet Overview</div>
        </div>
        <div class="grid mt-2" style="grid-template-columns: 1fr 1fr; grid-gap: 1.5rem;">
            <div class="p-4 rounded-lg border-2 col-span-2">{{ $cars_summary['available'] }} Available</div>
            <div class="p-4 rounded-lg border-2">{{ $cars_summary['rented'] }} Rented</div>
            <div class="p-4 rounded-lg border-2">{{ $cars_summary['maintenance'] }} Maintenance</div>
            <div class="p-4 rounded-lg border-2 col-span-2 text-center">{{ $cars_summary['total'] }} Cars</div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
