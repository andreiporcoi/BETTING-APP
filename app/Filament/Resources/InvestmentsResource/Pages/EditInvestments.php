<?php

namespace App\Filament\Resources\InvestmentsResource\Pages;

use App\Filament\Resources\InvestmentsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInvestments extends EditRecord
{
    protected static string $resource = InvestmentsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
