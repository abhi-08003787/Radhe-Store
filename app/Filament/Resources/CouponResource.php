<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Filament\Resources\CouponResource\RelationManagers;
use App\Models\Coupon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('code')
                ->label('Coupon Code')
                ->placeholder('Coupon Code')
                ->required()
                ->unique(ignoreRecord: true),

            Select::make('type')
                ->label('Coupon Type')
                ->options([
                    'fixed' => 'Fixed Amount',
                    'percent' => 'Percentage (%)',
                ])
                ->default('fixed'),

            TextInput::make('value')
                ->label('Value')
                ->placeholder('Coupon Value')
                ->numeric()
                ->required(),

            TextInput::make('cart_value')
                ->label('Cart Value')
                ->placeholder('Cart Value')
                ->numeric()
                ->required(),

            DatePicker::make('expiry_date')
                ->label('Expiry Date')
                ->placeholder('dd / mm / yyyy')
                ->native(false) 
                ->required(),
        ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }
}
