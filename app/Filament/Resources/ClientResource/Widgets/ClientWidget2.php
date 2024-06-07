<?php

namespace App\Filament\Resources\ClientResource\Widgets;

use App\Models\Client;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;

class ClientWidget2 extends ChartWidget
{
    protected static ?string $heading = 'Client Register Chart bar';
    protected int | string | array $columnSpan = ['md' => 2 , 'lg' => 1];


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
            'datasets' => [
                [
                    'label' => 'last register client',
                    'data' => $data->map(fn($value) => $value->aggregate)
                ]
            ],
            'labels' => $data->map(fn($date) => $date->date)
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
