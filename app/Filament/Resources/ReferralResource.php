<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReferralResource\Pages;
use App\Filament\Resources\ReferralResource\RelationManagers;
use App\Models\Referral;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReferralResource extends Resource
{
    protected static ?string $model = Referral::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'User Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('refereeCode')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('refereeUid')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('referredUid')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('referredEmail')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('referredName')
                    ->required()
                    ->maxLength(191),
                    DatePicker::make('joinedDate')->displayFormat('d-m-Y')->required(),
                    Select::make('confirmed')
                    ->options([
                        '0' => 'No',
                        '1' => 'Yes',
                    ])
                    ->required(),
                    DatePicker::make('confirmDate')->displayFormat('d-m-Y')->required(),
             
                Forms\Components\TextInput::make('amount')
                    ->required()->numeric()->minValue(0)
                    ->maxLength(191),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('refereeCode'),
                Tables\Columns\TextColumn::make('refereeUid'),
                Tables\Columns\TextColumn::make('referredUid'),
                Tables\Columns\TextColumn::make('referredEmail'),
                Tables\Columns\TextColumn::make('referredName'),
                Tables\Columns\TextColumn::make('joinedDate'),
                Tables\Columns\BadgeColumn::make('confirmed') ->colors([
                    // 'primary',
                    'success' => '1',
                    'danger' => '0',
                ])->enum([
                     0 => 'No',
                    1 => 'Yes',
                ]),
                Tables\Columns\TextColumn::make('confirmDate'),
                Tables\Columns\TextColumn::make('amount'),
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
            'index' => Pages\ListReferrals::route('/'),
            'create' => Pages\CreateReferral::route('/create'),
            'edit' => Pages\EditReferral::route('/{record}/edit'),
        ];
    }    
}
