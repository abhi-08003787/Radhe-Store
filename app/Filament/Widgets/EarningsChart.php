<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class EarningsChart extends ChartWidget
{
    
    protected static ?string $heading = 'Earnings revenue';

    protected int | string | array $columnSpan = 1; 
    protected static ?int $sort = 2;

    protected function getData(): array
    {
       

        return [
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => [/* ડેટાબેઝમાંથી આવતા આંકડા */], 
                    'backgroundColor' => '#3b82f6',
                ],
                [
                    'label' => 'Order',
                    'data' => [/* ડેટાબેઝમાંથી આવતા આંકડા */],
                    'backgroundColor' => '#f59e0b',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}