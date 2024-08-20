<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'User Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('uid')
                ->required()
                ->maxLength(191)->default(Str::random(8)),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                // Forms\Components\TextInput::make('password')
                //     // ->password()
                //     ->required()
                //     ->maxLength(255),
                // Forms\Components\TextInput::make('password')
                // ->password()
                // ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                // ->dehydrated(fn ($state) => filled($state)),
                Forms\Components\TextInput::make('country'),
                // Forms\Components\Textarea::make('two_factor_secret')
                //     ->maxLength(65535),
                // Forms\Components\Textarea::make('two_factor_recovery_codes')
                //     ->maxLength(65535),
                // Forms\Components\DateTimePicker::make('two_factor_confirmed_at'),
                Forms\Components\TextInput::make('refCode'),

                Forms\Components\TextInput::make('referredBy'),
                Forms\Components\TextInput::make('balance'),
                Forms\Components\TextInput::make('coins')->numeric()->minValue(0),
                Forms\Components\TextInput::make('refConfirmCount')->numeric()->minValue(0),
                Forms\Components\TextInput::make('refUnconfirmCount')->numeric()->minValue(0),
                // Forms\Components\TextInput::make('remember_token')
                // ->maxLength(191)->default(Str::random(8)),
                   Select::make('roles')->multiple()->relationship('roles', 'name'), Toggle::make('blocked')->default(0),
                   Toggle::make('admin')->default(0),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')->sortable()
                    ->dateTime(),
                    Tables\Columns\TextColumn::make('country')->searchable(),
                    Tables\Columns\TextColumn::make('refCode'),
                    Tables\Columns\TextColumn::make('balance')->sortable(),
                    Tables\Columns\TextColumn::make('coins')->sortable(),

                Tables\Columns\IconColumn::make('admin')->sortable()
                    ->options([
                        'heroicon-o-x-circle'=> 0,
                        'heroicon-o-check-circle' => 1,
                    ])->colors([
                        'danger' => 0,
                        'success' => 1,
                    ])->default(0),
                    Tables\Columns\IconColumn::make('blocked')->sortable()
                    ->options([
                        'heroicon-o-x-circle'=> 0,
                        'heroicon-o-check-circle' => 1,
                    ])->colors([
                        'danger' => 0,
                        'success' => 1,
                    ])->default(0),

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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}