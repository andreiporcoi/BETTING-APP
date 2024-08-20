<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvestmentsHistoryResource\Pages;
use App\Filament\Resources\InvestmentsHistoryResource\RelationManagers;
use App\Models\InvestmentsHistory;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput;

class InvestmentsHistoryResource extends Resource
{
    protected static ?string $model = InvestmentsHistory::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Investments';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('reference')
                ->required()
                ->maxLength(191)->default(Str::random(8))->disabled(),
            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(191),

                  Forms\Components\TextInput::make('interest')->mask(fn (TextInput\Mask $mask) => $mask
        ->numeric()
        ->decimalPlaces(2))
                    ->required(),
                      Forms\Components\TextInput::make('amount')->mask(fn (TextInput\Mask $mask) => $mask
        ->numeric()
        ->decimalPlaces(2))
                    ->required(),
                      Forms\Components\TextInput::make('roi')->mask(fn (TextInput\Mask $mask) => $mask
        ->numeric()
        ->decimalPlaces(2))
                    ->required(),
                //       Forms\Components\TextInput::make('interest')
                // ->required()->numeric()->minValue(0)
                // ->maxLength(191),
            // Forms\Components\TextInput::make('amount')
            //     ->required()->numeric()->minValue(0)
            //     ->maxLength(191),

            // Forms\Components\TextInput::make('roi')
            //     ->required()->numeric()->minValue(0)
            //     ->maxLength(191),
                DatePicker::make('startDate')->displayFormat('d-m-Y')->required(),
                DatePicker::make('nextDate')->displayFormat('d-m-Y')->required(),
                DatePicker::make('endDate')->displayFormat('d-m-Y')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('interest'),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('roi'),
                Tables\Columns\TextColumn::make('startDate'),
                Tables\Columns\TextColumn::make('nextDate'),
                Tables\Columns\TextColumn::make('endDate'),
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
            'index' => Pages\ListInvestmentsHistories::route('/'),
            'create' => Pages\CreateInvestmentsHistory::route('/create'),
            'edit' => Pages\EditInvestmentsHistory::route('/{record}/edit'),
        ];
    }
}