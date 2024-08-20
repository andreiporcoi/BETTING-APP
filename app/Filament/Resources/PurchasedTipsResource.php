<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchasedTipsResource\Pages;
use App\Filament\Resources\PurchasedTipsResource\RelationManagers;
use App\Models\PurchasedTips;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PurchasedTipsResource extends Resource
{
    protected static ?string $model = PurchasedTips::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Tips';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('sportId')
                    ->required()->default(Str::random(8))
                    ->maxLength(191),
                Forms\Components\TextInput::make('amount')
                    ->required()->numeric()->minValue(0)
                    ->maxLength(191),
                    DatePicker::make('sportDate')->displayFormat('d-m-Y')->required(),
               
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('sportId'),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('sportDate'),
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
            'index' => Pages\ListPurchasedTips::route('/'),
            'create' => Pages\CreatePurchasedTips::route('/create'),
            'edit' => Pages\EditPurchasedTips::route('/{record}/edit'),
        ];
    }    
}
