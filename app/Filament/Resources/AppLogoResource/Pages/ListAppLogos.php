<?php

namespace App\Filament\Resources\AppLogoResource\Pages;

use App\Filament\Resources\AppLogoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAppLogos extends ListRecords
{
    protected static string $resource = AppLogoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
