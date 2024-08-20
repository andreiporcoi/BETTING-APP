<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageHistoryResource\Pages;
use App\Filament\Resources\PackageHistoryResource\RelationManagers;
use App\Models\PackageHistory;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PackageHistoryResource extends Resource
{
    protected static ?string $model = PackageHistory::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Packages';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('reference')
                    ->required() ->default(Str::random(8))
                    ->maxLength(191),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('amount')
                    ->required()->numeric()->minValue(0)
                    ->maxLength(191),
                Forms\Components\TextInput::make('quantity')->numeric()->minValue(0) ->required(),
                Forms\Components\TextInput::make('duration')->numeric()->minValue(0) ->required(),
                Forms\Components\TextInput::make('roi')->numeric()->minValue(0) ->required()
                    ->maxLength(191),

                    DatePicker::make('startDate')->displayFormat('d-m-Y'),
                    DatePicker::make('endDate')->displayFormat('d-m-Y'),
                    Select::make('type')
                    ->options([
                       0 => 'Coin',
                       1 => 'Subscription',
                        2 => 'Investment',
                    ])
                    ->required(),
                    Select::make('status')
                    ->options([
                        0 => 'Failed',
                        1 => 'Pending',
                        2 => 'Completed',
                    ])->default('1')
                    ->required(),
                Forms\Components\TextInput::make('payMethod')
                    ->maxLength(191),
                Forms\Components\TextInput::make('hash')
                    ->maxLength(191),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('reference'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('duration'),
                Tables\Columns\TextColumn::make('roi'),
                Tables\Columns\TextColumn::make('startDate'),
                Tables\Columns\TextColumn::make('endDate'),
                Tables\Columns\BadgeColumn::make('type') ->colors([
                    // 'primary',

                    'warning' => 0,
                    'primary' => 1,
                    'success' => 2,
                ])->enum([
                     0 => 'Coin',
                    1 => 'Subscription',
                    2=> 'Investment'
                ]),
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
                Tables\Columns\TextColumn::make('payMethod'),
                Tables\Columns\TextColumn::make('hash'),
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
            'index' => Pages\ListPackageHistories::route('/'),
            'create' => Pages\CreatePackageHistory::route('/create'),
            'edit' => Pages\EditPackageHistory::route('/{record}/edit'),
        ];
    }
}