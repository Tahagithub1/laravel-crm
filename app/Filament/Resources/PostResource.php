<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Category;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationGroup = "Blog";


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Edit')
                            ->schema([
                                Forms\Components\TextInput::make('title'),
                                Forms\Components\TextInput::make('slug'),

                                Forms\Components\Select::make('category_id')
                                    ->label('Category')
                                    ->options(Category::all()->pluck('name','id')),
                                Forms\Components\ColorPicker::make('color'),

                                Forms\Components\MarkdownEditor::make('content')->required()->columnSpanFull(),
                                Forms\Components\FileUpload::make('thumbnail')->label('Photo')->disk('public')->directory('thumbnail')->required(),

//                                Forms\Components\TagsInput::make('tage')->required(),
                                Forms\Components\Checkbox::make('publish')->required(),
                            ])
                    ])->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               Tables\Columns\TextColumn::make('title')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\ColorColumn::make('color'),
                Tables\Columns\ImageColumn::make('thumbnail')->label('photo')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tage')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\CheckboxColumn::make('publish')
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
