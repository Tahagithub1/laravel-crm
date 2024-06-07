<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use Filament\Actions;
//use Filament\Actions\Action;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;


class EditClient extends EditRecord
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getSavedNotification(): ?Notification
    {
      return  Notification::make()
            ->title('Client Edit')
            ->body('A Client Edited')
            ->info()
            ->color('info')
            ->duration(4000)
            ->actions([
             Action::make('view')
                  ->button()
                  ->url(fn()=>ClientResource::getUrl('view' , ['record' => $this->getRecord()])),
//                 Action::make('undo')
//                    ->color('gray')
//                    ->dispatch('undoEditingPost')
           ]);



    }
}
