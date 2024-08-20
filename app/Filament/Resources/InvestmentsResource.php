<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvestmentsResource\Pages;
use App\Filament\Resources\InvestmentsResource\RelationManagers;
use App\Models\Investments;
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

class InvestmentsResource extends Resource
{
    protected static ?string $model = Investments::class;

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
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('amount')
                    ->required()->numeric()->minValue(0)
                    ->maxLength(191),
                Forms\Components\TextInput::make('duration')->numeric()->minValue(1)
                    ->required(),
                Forms\Components\TextInput::make('roi')
                    ->required()->numeric()->minValue(0)
                    ->maxLength(191),
                    DatePicker::make('startDate')->displayFormat('d-m-Y')->required(),
                    DatePicker::make('nextDate')->displayFormat('d-m-Y')->required(),
                    DatePicker::make('endDate')->displayFormat('d-m-Y')->required(),
          
                    Select::make('status')
                    ->options([
                        '0' => 'Failed',
                        '1' => 'Active',
                        '2' => 'Completed',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('duration'),
                Tables\Columns\TextColumn::make('roi'),
                Tables\Columns\TextColumn::make('startDate'),
                Tables\Columns\TextColumn::make('nextDate'),
                Tables\Columns\TextColumn::make('endDate'),
                Tables\Columns\BadgeColumn::make('status') ->colors([
                    // 'primary',
                    'warning' => 1,
                    'success' => 2,
                    'danger' => 0,
                ])->enum([
                     0 => 'Failed',
                    1 => 'Active',
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
            'index' => Pages\ListInvestments::route('/'),
            'create' => Pages\CreateInvestments::route('/create'),
            'edit' => Pages\EditInvestments::route('/{record}/edit'),
        ];
    }    
}
