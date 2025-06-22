<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center justify-center" style="border-bottom: 4px solid #e5e7eb;">
            <img src="{{ asset('images/calendar.png') }}" alt="Calendar Image" class="w-20 h-auto">
            <div class="text-lg">Booking Summary</div>
        </div>
        <div class="grid mt-2" style="grid-template-columns: 1fr 1fr; grid-gap: 1.5rem;">
            <div class="p-4 rounded-lg border-2">{{ $booking_summary['today'] }} Today</div>
            <div class="p-4 rounded-lg border-2">{{ $booking_summary['canceled'] }} Canceled</div>
            <div class="p-4 rounded-lg border-2">{{ $booking_summary['ongoing'] }} Ongoing</div>
            <div class="p-4 rounded-lg border-2">{{ $booking_summary['completed'] }} Completed</div>
            <div class="p-4 rounded-lg border-2 col-span-2 text-center">{{ $booking_summary['count'] }} Bookings</div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
