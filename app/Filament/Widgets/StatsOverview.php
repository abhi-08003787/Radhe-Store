<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected int | string | array $columnSpan = 1;
    protected static ?int $sort = 1;
   
    protected static ?string $pollingInterval = '5s';
    protected function getStats(): array
    {
        
        return [
          
            Stat::make('Total Orders', Order::count())
                ->description('Total orders in store')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

          
            Stat::make('Total Amount', '₹' . number_format(Order::sum('total_amount') ?? 0, 2))
                ->description('Overall revenue')
                ->color('primary'),

          
            Stat::make('Pending Orders', Order::where('status', 'ordered')->count())
                ->description('Waiting for confirmation')
                ->color('warning'),

        
            Stat::make('Delivered Orders', Order::where('status', 'delivered')->count())
                ->color('success'),

            Stat::make('Delivered Amount', '₹' . number_format(Order::where('status', 'delivered')->sum('total_amount') ?? 0, 2))
                ->color('secondary'),

          
            Stat::make('Canceled Orders', Order::where('status', 'canceled')->count())
                ->color('danger'),

           
            Stat::make('Canceled Amount', '₹' . number_format(Order::where('status', 'canceled')->sum('total_amount') ?? 0, 2))
                ->color('danger'),
  
                
            Stat::make('Pending Amount', '₹' . number_format(Order::where('status', 'ordered')->sum('total_amount') ?? 0, 2))
                ->color('warning'),
        ];
    }
    
}