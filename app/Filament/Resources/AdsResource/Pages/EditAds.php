<?php

namespace App\Filament\Resources\AdsResource\Pages;

use App\Filament\Resources\AdsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAds extends EditRecord
{
    protected static string $resource = AdsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
