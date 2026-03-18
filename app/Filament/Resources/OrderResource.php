<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('product_image')
                    ->label('Product')
                    ->getStateUsing(function (Order $record): string {
                       
                        $firstItem = $record->items->first();
                        if ($firstItem?->product && $firstItem->product->image) {
                            return asset('storage/' . $firstItem->product->image);
                        }
                    
                        return 'https://images.unsplash.com/photo-1610216705422-caa3fcb6d158?auto=format&fit=crop&q=80&w=100';
                    })
                    ->size(50)
                    ->circular()
                    ->defaultImageUrl(url('https://images.unsplash.com/photo-1610216705422-caa3fcb6d158?auto=format&fit=crop&q=80&w=100')),
                Tables\Columns\TextColumn::make('id')
                    ->label('Order ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Customer')
                    ->getStateUsing(function (Order $record): string {
                        return $record->user ? $record->user->name : 'Guest';
                    })
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy(
                            User::select('name')
                                ->whereColumn('users.id', 'orders.user_id')
                                ->limit(1),
                            $direction
                        );
                    })
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereHas('user', function (Builder $query) use ($search) {
                            $query->where('name', 'like', "%{$search}%");
                        })->orWhere('user_id', null);
                    }),
                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Total Amount')
                    ->money('INR')
                    ->sortable(),
                Tables\Columns\SelectColumn::make('status')
                    ->label('Update Status')
                    ->options([
                        'pending' => 'Pending',
                        'pending_verification' => 'Pending Verification',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ]),
                Tables\Columns\TextColumn::make('current_status')
                    ->label('Current Status')
                    ->getStateUsing(fn (Order $record): string => $record->status)
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'pending_verification' => 'secondary',
                        'processing' => 'info',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['user', 'items.product']);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
