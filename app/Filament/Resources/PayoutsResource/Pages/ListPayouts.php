<?php

namespace App\Filament\Resources\PayoutsResource\Pages;

use App\Filament\Resources\PayoutsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPayouts extends ListRecords
{
    protected static string $resource = PayoutsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
