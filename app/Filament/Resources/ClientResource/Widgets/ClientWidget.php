<?php

namespace App\Filament\Resources\ClientResource\Widgets;

use App\Filament\Resources\ClientResource;
use App\Models\Client;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;

class ClientWidget extends ChartWidget
{
    protected static ?string $heading = 'Client Register Chart';

    protected function getData(): array
    {
        $data = Trend::model(Client::class)
            ->between(
                now()->subMonth(6),
                now()
            )
            ->perMonth()
            ->count();
        return [
//            'datasets' => [
//                [
//                    'label' => 'last register client',
//                    'data' => [37 , 22 , 50 , 41 ,28 , 60]
//                ]
//            ],
//            'labels' => ['May' , 'Jun' , 'Jul' , 'Aug' , 'Sep' , 'Dct']
            'datasets' => [
                [
                    'label' => 'last register client',
                    'data' => $data->map(fn($value) => $value->aggregate)
                ]
            ],
            'labels' => $data->map(fn($value) => $value->date)
        ];

    }

    protected function getType(): string
    {
        return 'line';
    }
}
