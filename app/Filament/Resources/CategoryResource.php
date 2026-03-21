<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
           
            Forms\Components\TextInput::make('name')
                ->label('Category Name')
                ->required()
                ->live(onBlur: true) 
                ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => 
                    $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null)
                ->maxLength(255),

         
            Forms\Components\TextInput::make('slug')
                ->label('Slug')
                ->disabled() 
                ->dehydrated() 
                ->required(),

          
            Forms\Components\FileUpload::make('image')
                ->label('Category Image')
                ->image()
                ->disk('public')
                ->directory('categories')
                ->visibility('public')
                ->imageResizeMode('cover') 
                ->imageCropAspectRatio('1:1') 
                ->imageResizeTargetWidth('800') 
                ->loadingIndicatorPosition('left') 
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\ImageColumn::make('image')
                ->label('Image')
                ->circular()
                ->disk('public')
                ->url(fn ($record) => asset('storage/' . $record->image)),

            Tables\Columns\TextColumn::make('name')
                ->label('Category Name')
                ->searchable(),

            Tables\Columns\TextColumn::make('slug')
                ->label('Slug'),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
