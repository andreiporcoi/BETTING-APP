<?php

namespace App\Filament\Resources\AdminConfigResource\Pages;

use App\Filament\Resources\AdminConfigResource;
use Filament\Forms\Components\Builder;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdminConfigs extends ListRecords
{
    protected static string $resource = AdminConfigResource::class;

    public static function getEloquentQuery(): Builder
{
    return static::getModel()::query()->where('title', 'image');
    
}

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
