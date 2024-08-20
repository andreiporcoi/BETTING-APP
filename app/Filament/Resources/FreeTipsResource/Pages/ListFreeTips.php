<?php

namespace App\Filament\Resources\FreeTipsResource\Pages;

use App\Filament\Resources\FreeTipsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFreeTips extends ListRecords
{
    protected static string $resource = FreeTipsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
