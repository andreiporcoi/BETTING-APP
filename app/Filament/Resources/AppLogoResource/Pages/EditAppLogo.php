<?php

namespace App\Filament\Resources\AppLogoResource\Pages;

use App\Filament\Resources\AppLogoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAppLogo extends EditRecord
{
    protected static string $resource = AppLogoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
