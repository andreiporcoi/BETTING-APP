<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageControlResource\Pages;
use App\Filament\Resources\PageControlResource\RelationManagers;
use App\Models\PageControl;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Camya\Filament\Forms\Components\TitleWithSlugInput;

class PageControlResource extends Resource
{
    protected static ?string $model = PageControl::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Admin Config';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
              
                    TitleWithSlugInput::make(
                        fieldTitle: 'title',
                        fieldSlug: 'slug',
                        urlPath: '/page/',
                        // urlVisitLinkLabel: 'Visit Page',
                        urlVisitLinkVisible: false,
                        titleLabel: 'Title',
                        titlePlaceholder: 'Insert the title...',
                        slugLabel: 'Link:',
                        urlHostVisible: false,
                        slugRules: [
                            'required',
                            'string',
                        ],

                    ),
                    TinyEditor::make('body')->height(300)->required(),
                    Forms\Components\Toggle::make('top_level'),
                    
               
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
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
            'index' => Pages\ListPageControls::route('/'),
            'create' => Pages\CreatePageControl::route('/create'),
            'edit' => Pages\EditPageControl::route('/{record}/edit'),
        ];
    }    
}
