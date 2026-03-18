<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
           
            Section::make('Profile Information')
                ->schema([
                    TextInput::make('full_name')
                        ->label('Name')
                        ->placeholder('Full Name')
                        ->required(),
                    TextInput::make('mobile_number')
                        ->label('Mobile Number')
                        ->placeholder('Mobile Number')
                        ->tel()
                        ->required(),
                    TextInput::make('email_address')
                        ->label('Email Address')
                        ->placeholder('Email Address')
                        ->email()
                        ->required(),
                ])->columns(1),

           
            Section::make('PASSWORD CHANGE')
                ->schema([
                    TextInput::make('old_password')
                        ->label('Old password')
                        ->password()
                        ->placeholder('Old password'),
                    TextInput::make('new_password')
                        ->label('New password')
                        ->password()
                        ->placeholder('New password'),
                    TextInput::make('confirm_password')
                        ->label('Confirm new password')
                        ->password()
                        ->placeholder('Confirm new password'),
                ])->columns(1),
        ]);
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
