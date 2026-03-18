<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Filament\Resources\SliderResource\RelationManagers;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('title')
                ->required(),
            
            TextInput::make('line_1')
                ->required()
                ->label('Line 1'),

            TextInput::make('line_2')
                ->required()
                ->label('Line 2'),

            FileUpload::make('image')
                ->label('Upload images')
                ->image() 
                ->directory('sliders') 
                ->required(),

            FileUpload::make('inset_image')
                ->label('Upload Inset Image')
                ->image()
                ->directory('sliders')
                ->required(),

            Select::make('icon')
                ->label('Select category icon')
                ->options([
                    'icon-1' => 'Icon 1',
                    'icon-2' => 'Icon 2',
                    'icon-3' => 'Icon 3',
                ]),
        ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // ૧. આઈડી
            TextColumn::make('id')->label('ID')->sortable(),

            // ૨. ઈમેજ (જો સ્લાઈડરમાં ફોટો હોય તો)
            ImageColumn::make('image') // તમારી કોલમનું નામ ચેક કરી લેજો
                ->label('Image'),

            // ૩. ટાઈટલ
            TextColumn::make('title') // તમારી કોલમનું નામ 'title' કે 'name' હોઈ શકે
                ->label('Title')
                ->searchable(),

            // ૪. લિંક અથવા બીજો ડેટા
            TextColumn::make('link')
                ->label('Link'),
                
            // ૫. સ્ટેટસ (જો હોય તો)
            Tables\Columns\IconColumn::make('status')
                ->boolean()
                ->label('Status'),
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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}
