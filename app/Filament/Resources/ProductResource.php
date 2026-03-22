<?php

namespace App\Filament\Resources;

use App\Models\Category;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Grid::make(2) 
                ->schema([
                    Section::make()
                        ->schema([
                            TextInput::make('name')
                                ->label('Product name')
                                ->required()
                                ->placeholder('Enter product name')
                                ->helperText('Do not exceed 100 characters when entering the product name.'),

                                TextInput::make('slug')
                                ->required()
                                ->unique(ignoreRecord: true),

                            Grid::make(2)->schema([
                                Select::make('category_id')
                                ->label('Category')
                                ->relationship('categoryRel','name')
                                ->searchable()
                                ->preload()
                                ->required()
                            ]),

                            Textarea::make('short_description')
                                ->label('Short Description')
                                ->required()
                                ->rows(4),

                            Textarea::make('description')
                                ->label('Description')
                                ->required()
                                ->rows(6),
                        ])->columnSpan(1),

                    // જમણી બાજુનો ભાગ (Images & Pricing)
                    Section::make()
                        ->schema([
                            FileUpload::make('image')
                                ->label('Upload images')
                                ->image()
                                ->disk('public')
                                ->directory('products')
                                ->visibility('public')
                                ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png'])
                                ->maxSize(2048) // 2MB max
                                ->required(),

                            Grid::make(2)->schema([
                                TextInput::make('regular_price')
                                    ->numeric()
                                    ->required(),

                                TextInput::make('sale_price')
                                    ->numeric(),
                            ]),

                            Grid::make(2)->schema([
                                TextInput::make('SKU')
                                    ->label('SKU')
                                    ->required()
                                    ->unique(ignoreRecord: true),

                                TextInput::make('quantity')
                                    ->numeric()
                                    ->required(),
                            ]),

                            Grid::make(2)->schema([
                                Select::make('stock_status')
                                    ->label('Stock')
                                    ->options([
                                        'instock' => 'InStock',
                                        'outofstock' => 'Out of Stock',
                                    ])->default('instock'),

                                Select::make('featured')
                                    ->options([
                                        '0' => 'No',
                                        '1' => 'Yes',
                                    ])->default('0'),
                            ]),
                        ])->columnSpan(1),
                ]),

            // Technical Details Section
            Section::make('Technical Details')
                ->schema([
                    Grid::make(3)->schema([
                        TextInput::make('style_id')
                            ->label('Style ID')
                            ->placeholder('Enter style ID'),

                        TextInput::make('sla_days')
                            ->label('Dispatch Time (SLA Days)')
                            ->numeric()
                            ->placeholder('Enter dispatch days'),

                        TextInput::make('weight')
                            ->label('Weight (grams)')
                            ->numeric()
                            ->step(0.01)
                            ->placeholder('Enter weight in grams'),
                    ]),

                    Grid::make(3)->schema([
                        TextInput::make('hsn_code')
                            ->label('HSN Code')
                            ->placeholder('Enter HSN code'),

                        TextInput::make('gst_percentage')
                            ->label('GST Percentage')
                            ->numeric()
                            ->step(0.01)
                            ->default(3.00)
                            ->placeholder('Enter GST percentage'),

                        TextInput::make('supplier_cost')
                            ->label('Supplier Cost')
                            ->numeric()
                            ->step(0.01)
                            ->placeholder('Enter supplier cost'),
                    ]),
                ]),
        ]);
    }
    

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            // 1. ફોટો
            ImageColumn::make('image')
                ->label('image')
                ->circular()
                ->disk('public')
                ->defaultImageUrl(url('/images/default-product.jpg'))
                ->getStateUsing(function ($record) {
                    if ($record->image && file_exists(storage_path('app/public/products/' . $record->image))) {
                        return asset('storage/products/' . $record->image);
                    }
                    return asset('images/default-product.jpg');
                }),

            // 2. નામ
            TextColumn::make('name')
                ->label('name')
                ->searchable(),

            // 3. કિંમત (Price)
            TextColumn::make('regular_price')
                ->label('price')
                ->money('INR'),

            // 4. સેલ પ્રાઈસ (Sale Price)
            TextColumn::make('sale_price')
                ->label('sale price')
                ->money('INR'),

            // 5. કેટેગરી (અહીં નંબરની જગ્યાએ નામ આવશે)
            Tables\Columns\TextColumn::make('categoryRel.name')
            ->label('Category')
            ->searchable(),
            // 7. SKU
            TextColumn::make('SKU')
                ->label('SKU'),

            // 8. સ્ટોક સ્ટેટસ (Icon સાથે)
            TextColumn::make('stock_status')
                ->label('stock_status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'instock' => 'success',
                    'outofstock' => 'danger',
                    default => 'gray',
                }),

            // 9. ક્વોન્ટિટી
            TextColumn::make('quantity')
                ->label('quantity'),
                
            // 10. ફિચર (Featured)
            IconColumn::make('featured')
                ->label('featured')
                ->boolean(),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
