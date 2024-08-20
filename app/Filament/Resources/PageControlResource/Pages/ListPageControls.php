<?php

namespace App\Filament\Resources\PageControlResource\Pages;

use App\Filament\Resources\PageControlResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPageControls extends ListRecords
{
    protected static string $resource = PageControlResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
