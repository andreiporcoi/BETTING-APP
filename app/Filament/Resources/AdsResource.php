<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdsResource\Pages;
use App\Filament\Resources\AdsResource\RelationManagers;
use App\Models\Ads;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ViewField;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ViewColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class AdsResource extends Resource
{
    protected static ?string $model = Ads::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('adsId')->default(Str::random(8))
                    ->required()
                    ->maxLength(191)->disabled(),
                // Forms\Components\TextInput::make('adsImage')
                //     ->required()
                //     ->maxLength(191),

                    FileUpload::make('adsImage')->image(),
                Forms\Components\TextInput::make('adsTitle')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('adsDescription')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('adsLink')
                    ->required()
                    ->maxLength(191),
                Select::make('adsType')
                ->options([
                    '0' => 'Pop Up',
                    '1' => 'Carousel',
                ]) ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('adsId'),
                ImageColumn::make('adsImage'),
                // ViewColumn::make('adsImage')->view('tables.columns.web-image'),

                // Tables\Columns\TextColumn::make('adsImage'),
                Tables\Columns\TextColumn::make('adsTitle'),
                Tables\Columns\TextColumn::make('adsDescription'),
                Tables\Columns\TextColumn::make('adsLink'),
                Tables\Columns\TextColumn::make('adsType')->enum([
                    '0' => 'Pop Up',
                    '1' => 'Carousel',
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
            'index' => Pages\ListAds::route('/'),
            'create' => Pages\CreateAds::route('/create'),
            'edit' => Pages\EditAds::route('/{record}/edit'),
        ];
    }    
}
