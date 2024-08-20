<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotificationTokensResource\Pages;
use App\Filament\Resources\NotificationTokensResource\RelationManagers;
use App\Models\NotificationTokens;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NotificationTokensResource extends Resource
{
    protected static ?string $model = NotificationTokens::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Notifications Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('uid')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('token')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('uid'),
                Tables\Columns\TextColumn::make('token'),
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
            'index' => Pages\ListNotificationTokens::route('/'),
            'create' => Pages\CreateNotificationTokens::route('/create'),
            'edit' => Pages\EditNotificationTokens::route('/{record}/edit'),
        ];
    }
}
