<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackagesResource\Pages;
use App\Filament\Resources\PackagesResource\RelationManagers;
use App\Models\Packages;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PackagesResource extends Resource
{
    protected static ?string $model = Packages::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Packages';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('packageId')
                    ->required()
                    ->maxLength(191)->default(Str::random(8)),
                // Forms\Components\TextInput::make('type')
                //     ->required(),
                    Select::make('type')
                    ->options([
                        0 => 'Coin',
                        1 => 'Subscription',
                        2 => 'Investment',
                    ])->default('1')
                    ->required(),

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('amount')
                    ->required()->numeric()->minValue(0)
                    ->maxLength(191),
                Forms\Components\TextInput::make('duration')->numeric()->minValue(0),
                Forms\Components\TextInput::make('quantity')->numeric()->minValue(0)
                    ->maxLength(191),
                Forms\Components\TextInput::make('roi')->numeric()->minValue(0)
                    ->maxLength(191),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('packageId'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('duration'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('roi'),
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
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackages::route('/create'),
            'edit' => Pages\EditPackages::route('/{record}/edit'),
        ];
    }
}