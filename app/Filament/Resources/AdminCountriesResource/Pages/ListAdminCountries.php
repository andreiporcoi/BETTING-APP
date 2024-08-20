<?php

namespace App\Filament\Resources\AdminCountriesResource\Pages;

use App\Filament\Resources\AdminCountriesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdminCountries extends ListRecords
{
    protected static string $resource = AdminCountriesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
