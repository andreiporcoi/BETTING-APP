<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaidTipsResource\Pages;
use App\Filament\Resources\PaidTipsResource\RelationManagers;
use App\Models\PaidTips;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\TextInput;

class PaidTipsResource extends Resource
{
    protected static ?string $model = PaidTips::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Tips';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sportId')
                ->default(Str::random(8))
                ->required()
                ->maxLength(191)->disabled(),
                Forms\Components\TextInput::make('sportType')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('league')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('teamOne')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('teamOneLogo')
                    ->maxLength(191),
                Forms\Components\TextInput::make('teamTwo')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('teamTwoLogo')
                    ->maxLength(191),
                Forms\Components\TextInput::make('statsUrl')
                    ->maxLength(191),
                Forms\Components\TextInput::make('tips')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('odds')->mask(fn (TextInput\Mask $mask) => $mask
        ->numeric()
        ->decimalPlaces(2)
        ->minValue(1)
        ->maxValue(100)
        )
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('amount')
                    ->required()->numeric()->minValue(0),
                    DatePicker::make('sportDate')->displayFormat('d-m-Y')->required(),
                    TimePicker::make('sportTime')->withoutSeconds()->minutesStep(5)->required(),
                Forms\Components\TextInput::make('probability')->mask(fn (TextInput\Mask $mask) => $mask
        ->numeric()
        ->decimalPlaces(2)
        ->minValue(1)
        ->maxValue(100)
        )
                    ->required()
                    ->maxLength(191),
                    Select::make('status')
                    ->options([
                        '0' => 'Lost',
                        '1' => 'Pending',
                        '2' => 'Won',
                    ])->default('1')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sportId'),
                Tables\Columns\TextColumn::make('sportType')->sortable(),
                Tables\Columns\TextColumn::make('league'),
                Tables\Columns\TextColumn::make('teamOne'),
                Tables\Columns\TextColumn::make('teamTwo'),
                Tables\Columns\TextColumn::make('tips'),
                Tables\Columns\TextColumn::make('odds'),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('sportDate'),
                Tables\Columns\TextColumn::make('sportTime'),
                Tables\Columns\TextColumn::make('probability'),
                Tables\Columns\BadgeColumn::make('status') ->colors([
                    // 'primary',
                    'warning' => 1,
                    'success' => 2,
                    'danger' => 0,
                ])->enum([
                     0 => 'Lost',
                    1 => 'Pending',
                    2=> 'Won'
                ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()->sortable(),
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
            'index' => Pages\ListPaidTips::route('/'),
            'create' => Pages\CreatePaidTips::route('/create'),
            'edit' => Pages\EditPaidTips::route('/{record}/edit'),
        ];
    }
}
