<?php

namespace App\Filament\Resources\InvestmentsHistoryResource\Pages;

use App\Filament\Resources\InvestmentsHistoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInvestmentsHistory extends EditRecord
{
    protected static string $resource = InvestmentsHistoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
