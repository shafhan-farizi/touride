<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center justify-center">
            <div class="text-lg">Recently Status Cars</div>
        </div>


        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Car
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Plate Number
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price/day
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cars as $car)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $car->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $car->plate_number }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $car->status }}
                        </td>
                        <td class="px-6 py-4">
                            Rp.{{ number_format($car->rental_price) }}
                        </td>
                    </tr>
                    @empty
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            No Data.
                        </th>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <x-filament::button icon="heroicon-m-arrow-top-right-on-square" tag="button" size="sm" class="mt-4">
            View Details
        </x-filament::button>

    </x-filament::section>
</x-filament-widgets::widget>
