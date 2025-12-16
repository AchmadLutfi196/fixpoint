<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\StockMovement;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class AdvancedAnalyticsChart extends ChartWidget
{
    protected static ?string $heading = 'Advanced Business Analytics';
    protected static ?int $sort = 4;
    protected static ?string $pollingInterval = '60s';
    
    protected function getData(): array
    {
        // Get last 12 months data
        $months = collect(range(11, 0))->map(function ($monthsBack) {
            return Carbon::now()->subMonths($monthsBack);
        });
        
        // Sales data
        $salesData = $months->map(function (Carbon $month) {
            return Order::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('total_amount');
        })->values();
        
        // Stock movements data
        $stockMovementsData = $months->map(function (Carbon $month) {
            return StockMovement::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->where('type', 'out')
                ->sum('quantity');
        })->values();
        
        $labels = $months->map(function (Carbon $month) {
            return $month->format('M Y');
        })->values();
        
        return [
            'datasets' => [
                [
                    'label' => 'Sales (Rp)',
                    'data' => $salesData->toArray(),
                    'borderColor' => 'rgb(59, 130, 246)',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'yAxisID' => 'y',
                ],
                [
                    'label' => 'Stock Out (Units)',
                    'data' => $stockMovementsData->toArray(),
                    'borderColor' => 'rgb(16, 185, 129)',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'yAxisID' => 'y1',
                ],
            ],
            'labels' => $labels->toArray(),
        ];

        

    }
    
    protected function getType(): string
    {
        return 'line';
    }
    
    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'interaction' => [
                'mode' => 'index',
                'intersect' => false,
            ],
            'scales' => [
                'y' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'left',
                    'title' => [
                        'display' => true,
                        'text' => 'Amount (Rp)',
                    ],
                ],
                'y1' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'right',
                    'title' => [
                        'display' => true,
                        'text' => 'Units',
                    ],
                    'grid' => [
                        'drawOnChartArea' => false,
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'position' => 'top',
                ],
                'title' => [
                    'display' => true,
                    'text' => '12-Month Business Trends',
                ],
            ],
        ];
    }
}
