<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center justify-center" style="border-bottom: 4px solid #e5e7eb;">
            <img src="{{ asset('images/income.png') }}" alt="Income Image" class="w-20 h-auto">
            <div class="text-lg">Income Summary</div>
        </div>
        <div id="chart"></div>
        <x-filament::link icon="heroicon-m-cursor-arrow-rays" size="sm">
            See Full Report
        </x-filament::link>
        @script
            <script>
                setTimeout(() => {
                    options = {
                        chart: {
                            type: 'bar'
                        },
                        plotOptions: {
                            bar: {
                                horizontal: true
                            }
                        },
                        series: [{
                            name: 'Total pendapatan',
                            data: @php
                                $chartData = [];
                                $weekCounter = 1;
                                foreach ($income_summary as $income) {
                                    $chartData[] = [
                                        'x' => 'Week ' . $weekCounter++,
                                        'y' => round($income['data'] / 1000000, 1), 
                                    ];
                                }

                                echo json_encode($chartData);
                            @endphp


                        }],
                        xaxis: {
                            labels: {
                                formatter: function(val) {
                                    return val.toLocaleString() + 'M';
                                }
                            }
                        },
                    }

                    var chart = new ApexCharts(document.querySelector("#chart"), options);

                    chart.render();
                }, 0);
            </script>
        @endscript
    </x-filament::section>
</x-filament-widgets::widget>
