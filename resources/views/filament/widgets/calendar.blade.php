<x-filament-widgets::widget>
    <x-filament::section>
        <div id="calendar" class="flex justify-center"></div>

        @script
            <script>
                setTimeout(() => {
                    jsCalendar.new('#calendar')
                }, 0);
            </script>
        @endscript
    </x-filament::section>
</x-filament-widgets::widget>
