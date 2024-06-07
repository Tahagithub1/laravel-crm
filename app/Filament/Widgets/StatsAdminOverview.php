<?php

namespace App\Filament\Widgets;

use App\Models\Client;
use App\Models\User;
use Filament\Forms\Components\Builder;
use Filament\Support\View\Components\Modal;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;

class StatsAdminOverview extends BaseWidget
{
//    protected int | string | array $columnSpan = [ 'lg' => 4];


    protected function getStats(): array
    {
//        $data = Trend::model(Client::class)
//            ->between(
//                now()->subMonth(6),
//                now()
//            )
//            ->perMonth()
//            ->count();
        $Client = Client::all();
        return [
            Stat::make('User', User::query()->count())
                ->description('All user from the database')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
//                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Client',  $Client->count())
                ->description('All client from the database')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
            ->color('info'),
            Stat::make('Client Active' , $Client->where('active',1)->count() )
                ->description('All client from the database Active')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary'),
        ];
    }
}
