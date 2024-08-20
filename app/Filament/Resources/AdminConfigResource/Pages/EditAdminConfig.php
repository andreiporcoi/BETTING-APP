<?php

namespace App\Filament\Resources\AdminConfigResource\Pages;

use App\Filament\Resources\AdminConfigResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdminConfig extends EditRecord
{
    protected static string $resource = AdminConfigResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
