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
                ->disk(env('APP_ENV') === 'production' ? 'cloudinary' : 'public')
                ->directory('categories')
                ->visibility('public')
                ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                ->maxSize(2048)
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
                ->defaultImageUrl('https://res.cloudinary.com/demo/image/upload/v1/default-placeholder.jpg')
                ->getStateUsing(function ($record) {
                    if (!$record->image) {
                        return 'https://res.cloudinary.com/demo/image/upload/v1/default-placeholder.jpg';
                    }
                    
                    // Check if image is a full URL (Cloudinary)
                    if (str_starts_with($record->image, 'http')) {
                        return $record->image;
                    }
                    
                    // Extract filename if path includes folder
                    $filename = $record->image;
                    if (str_contains($record->image, '/')) {
                        $parts = explode('/', $record->image);
                        $filename = end($parts);
                    }
                    
                    // Check multiple possible folder names
                    $possiblePaths = [
                        storage_path('app/public/categories/' . $filename),
                        storage_path('app/public/category/' . $filename),
                        storage_path('app/public/' . $record->image),
                    ];
                    
                    foreach ($possiblePaths as $path) {
                        if (file_exists($path)) {
                            // Return correct URL based on which folder exists
                            if (str_contains($path, '/categories/')) {
                                return asset('storage/categories/' . $filename);
                            } elseif (str_contains($path, '/category/')) {
                                return asset('storage/category/' . $filename);
                            } else {
                                return asset('storage/' . $record->image);
                            }
                        }
                    }
                    
                    // Fallback
                    return 'https://res.cloudinary.com/demo/image/upload/v1/default-placeholder.jpg';
                }),

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
