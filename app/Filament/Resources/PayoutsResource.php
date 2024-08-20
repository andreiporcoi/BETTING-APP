<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PayoutsResource\Pages;
use App\Filament\Resources\PayoutsResource\RelationManagers;
use App\Models\Payouts;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput;

class PayoutsResource extends Resource
{
    protected static ?string $model = Payouts::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('reference')
                    ->required() ->default(Str::random(8))
                    ->maxLength(191),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('fullName')
                    ->required()
                    ->maxLength(191),
                // Forms\Components\TextInput::make('amount')
                //     ->required()->numeric()->minValue(0)
                //     ->maxLength(191),
               Forms\Components\TextInput::make('amount')->mask(fn (TextInput\Mask $mask) => $mask
                 ->numeric()
                 ->decimalPlaces(2))
                 ->required(),
                Forms\Components\TextInput::make('walletAddress')
                    ->required()
                    ->maxLength(191),
                    Forms\Components\TextInput::make('bankName')
                    ->required()
                    ->maxLength(191),
                    Forms\Components\TextInput::make('accName')
                    ->required()
                    ->maxLength(191),
                    Forms\Components\TextInput::make('accNum')
                    ->required()
                    ->maxLength(191),
                    Forms\Components\TextInput::make('bankCountry')
                    ->required()
                    ->maxLength(191),
                    Forms\Components\TextInput::make('swiftCode')
                    ->required()
                    ->maxLength(191),
                    Select::make('status')
                    ->options([
                        0 => 'Failed',
                        1 => 'Pending',
                        2 => 'Completed',
                    ]),
                    Select::make('payType')
                    ->options([
                        0 => 'Crypto',
                        1 => 'Bank',
                    ]),
                    Select::make('paymentMethod')
                    ->options([
                        0 => 'BTC',
                        1 => 'ETH',
                        2 => 'USDT',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('paymentMethod'),
                Tables\Columns\TextColumn::make('fullName'),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\BadgeColumn::make('status') ->colors([
                    // 'primary',
                    'warning' => 1,
                    'success' => 2,
                    'danger' => 0,
                ])->enum([
                     0 => 'Failed',
                    1 => 'Pending',
                    2=> 'Completed'
                ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPayouts::route('/'),
            'create' => Pages\CreatePayouts::route('/create'),
            'edit' => Pages\EditPayouts::route('/{record}/edit'),
        ];
    }
}