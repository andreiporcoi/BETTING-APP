<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppLogoResource\Pages;
use App\Filament\Resources\AppLogoResource\RelationManagers;
use App\Models\AppLogo;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AppLogoResource extends Resource
{
    protected static ?string $model = AppLogo::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Admin Config';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                        // Forms\Components\TextInput::make('title')
                //     ->required()
                //     ->maxLength(191),
                Forms\Components\TextInput::make('title')->disabled(),
                    FileUpload::make('value')->image(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                ImageColumn::make('value'),

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
            'index' => Pages\ListAppLogos::route('/'),
            'create' => Pages\CreateAppLogo::route('/create'),
            'edit' => Pages\EditAppLogo::route('/{record}/edit'),
        ];
    }    
}
