<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Tabs;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Tabs::make('label')
            ->Tabs([
                Tabs\Tab::make('peroenal info')
                ->schema([
                    ImageEntry::make('photo'),
//                    TextEntry::make('first_name'),
//                    TextEntry::make('last_name'),
                    TextEntry::make('first_name')
                        ->label('Name')
                        ->formatStateUsing(fn($state , $record) => $record->first_name . " " . $record->last_name),
                    TextEntry::make('phone'),
                    TextEntry::make('mobile'),
                    TextEntry::make('email')->copyable(),
                    TextEntry::make('linkedin')
                    ->suffixAction(
                        \Filament\Infolists\Components\Actions\Action::make('open linkedin')
                        ->icon('heroicon-o-link')
                        ->url(fn($record) => $record->linkedin)
                    ),
                    TextEntry::make('active')
                    ->badge()
                    ->color(fn(bool $state) => match ($state){
                        false => 'info',
                        true => 'success',
                    }),

                ]),


                  Tabs\Tab::make('business info')
                      ->schema([
                          TextEntry::make('company'),
                          TextEntry::make('title'),
                          TextEntry::make('role'),
                          TextEntry::make('company_website'),
                          TextEntry::make('business_details'),
                          TextEntry::make('business_type'),
                          TextEntry::make('company_size'),
                          TextEntry::make('temperature'),
                          ]),


                Tabs\Tab::make('Notes')
                    ->schema([
                        TextEntry::make('notes'),
                        TextEntry::make('referrals'),
                    ]),


                  ])

        ]);

    }


    public static function form(Form $form): Form
    {

        return $form
            ->schema([

                Forms\Components\Grid::make([
                    'md' => 3
                ])
                    ->schema([
                        Forms\Components\Section::make()->schema([
                            // peroenal info
                            Forms\Components\Section::make('peroenal info')->schema([
                                TextInput::make('first_name')
                                    ->maxLength(255)
                                    ->minLength(2)
                                    ->required(),
                                TextInput::make('last_name')
                                    ->maxLength(255)
                                    ->minLength(2)
                                    ->required(),
                                TextInput::make('email')
                                    ->email()
                                    ->maxLength(255)

                                    ->required(),
                                TextInput::make('phone')
                                    ->tel()
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('mobile')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\FileUpload::make('photo')
                                    ->required(),

                            ]),
                            // business info
                            Forms\Components\Section::make('business info')->schema([
                                Forms\Components\Toggle::make('action')
                                    ->required()
                                ->visibleOn('edit'),
//                                    ->visible(fn($operation) => $operation === 'edit'),

                                TextInput::make('title')
                                    ->maxLength(255)
                                    ->string(),
                                TextInput::make('company')
                                    ->maxLength(255)
                                    ->string(),
                                TextInput::make('role')
                                    ->maxLength(255)
                                    ->string(),
                                TextInput::make('linkedin')
                                    ->maxLength(255)
                                    ->string(),
                                TextInput::make('company_website')
                                    ->maxLength(255)
                                    ->string(),
                                TextInput::make('business_details')
                                    ->maxLength(255)
                                    ->string(),
                                TextInput::make('business_type')
                                    ->maxLength(255)
                                    ->string(),
                                Forms\Components\Select::make('company_size')->options([
                                    'small', 'medium', 'big'
                                ]),
                                Select::make('temperature')
                                    ->options([
                                        'cold',
                                        'medium',
                                        'hot',
                                    ]),


                            ])
                            ->disabledOn('edit'),

                        ])
                        ->columnSpan('2'),
                        Forms\Components\Section::make('Notes')->schema([
                            Forms\Components\Textarea::make('notes')
                            ->maxLength(255)
                            ->columnSpanFull(),
                            Forms\Components\Textarea::make('referrals')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        ])->columnSpan('1')


                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                  ->searchable(),
                Tables\Columns\TextColumn::make('email')
                ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mobile')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->searchable(),
                Tables\Columns\TextColumn::make('linkedin')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company_website')
                    ->searchable(),
                Tables\Columns\TextColumn::make('business_details')
                    ->searchable(),
                Tables\Columns\TextColumn::make('business_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company_size')
                   ->searchable(),
                Tables\Columns\TextColumn::make('temperature')
                  ->searchable(),
                Tables\Columns\TextColumn::make('referrals')
                    ->searchable(),
                Tables\Columns\TextColumn::make('notes')
                    ->searchable(),
          Tables\Columns\IconColumn::make('active')->boolean(),



                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
            'view' => Pages\ViewClient::route('/{record}'),

        ];
    }
}
