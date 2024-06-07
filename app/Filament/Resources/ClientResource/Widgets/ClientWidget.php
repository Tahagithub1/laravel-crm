<?php

namespace App\Filament\Resources\ClientResource\Widgets;

use App\Filament\Resources\ClientResource;
use Filament\Widgets\ChartWidget;

class ClientWidget extends ChartWidget
{
    protected static ?string $heading = 'Client Chart';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'last register client',
                    'data' => [37 , 22 , 50 , 41 ,28 , 60]
                ]
            ],
            'labels' => ['May' , 'Jun' , 'Jul' , 'Aug' , 'Sep' , 'Dct']
        ];

    }

    protected function getType(): string
    {
        return 'line';
    }
}
