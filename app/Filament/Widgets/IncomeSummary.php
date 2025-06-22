<?php

namespace App\Filament\Widgets;

use App\Models\Payments;
use Carbon\Carbon;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;

class IncomeSummary extends Widget
{
    protected static string $view = 'filament.widgets.income-summary';

    public $income_summary;

    protected int | string | array $columnSpan = [
        'sm' => 12,
        'md' => 4,
    ];

    public function weekly_summary()
    {
        $startOfMonth = Carbon::now()->startOfMonth();

        $endOfMonth = Carbon::now()->endOfMonth();

        $currentDate = $startOfMonth->copy();
        $weeks = [];

        $i = 0;

        while ($currentDate->lte($endOfMonth)) {
            $startOfWeek = $currentDate->copy()->startOfWeek(Carbon::MONDAY);

            $endOfWeek = $currentDate->copy()->endOfWeek(Carbon::SUNDAY);

            if (!isset($weeks[$startOfWeek->format('Y-m-d')])) {
                $weeks[$startOfWeek->format('Y-m-d')] = [
                    'start' => $startOfWeek->format('Y-m-d'),
                    'end' => $endOfWeek->format('Y-m-d'),
                ];
            }

            $currentDate->addDay();
        }

        $income_summary = [];

        foreach($weeks as $week) {
            $income_summary[] = [
                'date' => [
                    'start' => $week['start'],
                    'end' => $week['end']
                ],
                'data' => Payments::whereBetween(DB::raw('DATE(updated_at)'), [$week['start'], $week['end']])->sum('amount')
            ];
        }

        return $income_summary;

    }

    public function mount(): void {
        $this->income_summary = $this->weekly_summary();
    }
}
