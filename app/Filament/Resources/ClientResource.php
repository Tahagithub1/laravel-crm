<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Tabs;
use Filament\Forms\Form;
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


    public static function form(Form $form): Form
    {

        return $form
            ->schema([

                Forms\Components\Grid::make([
                    'md' => 3
                ])
                    ->schema([
                        Forms\Components\Section::make()->schema([
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
                            Forms\Components\Section::make('business info')->schema([
                                Forms\Components\Toggle::make('action')
                                    ->required(),

                                TextInput::make('title')
                                    ->maxLength(255)
                                    ->string(),
                                TextInput::make('company')
                                    ->maxLength(255)
                                    ->string(),
                                TextInput::make('role')
                                    ->maxLength(255)
                                    ->string(),
                                TextInput::make('linkdin')
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
                                Select::make('company_size')
                                    ->options([
                                       'small' ,
                                       'medium',
                                       'large',
                                    ]),
                                Select::make('temperature')
                                    ->options([
                                        'cold',
                                        'medium',
                                        'hot',
                                    ]),


                            ]),
                            // peroenal info

                            // business info


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
                Tables\Columns\TextColumn::make('active')
                    ->searchable(),


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
        ];
    }
}
