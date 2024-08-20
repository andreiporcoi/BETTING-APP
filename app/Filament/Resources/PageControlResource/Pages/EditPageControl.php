<?php

namespace App\Filament\Resources\PageControlResource\Pages;

use App\Filament\Resources\PageControlResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPageControl extends EditRecord
{
    protected static string $resource = PageControlResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
