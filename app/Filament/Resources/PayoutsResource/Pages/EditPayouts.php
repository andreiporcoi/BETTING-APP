<?php

namespace App\Filament\Resources\PayoutsResource\Pages;

use App\Filament\Resources\PayoutsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPayouts extends EditRecord
{
    protected static string $resource = PayoutsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
