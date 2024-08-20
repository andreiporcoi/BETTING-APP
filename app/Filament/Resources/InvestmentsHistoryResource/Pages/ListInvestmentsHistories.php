<?php

namespace App\Filament\Resources\InvestmentsHistoryResource\Pages;

use App\Filament\Resources\InvestmentsHistoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInvestmentsHistories extends ListRecords
{
    protected static string $resource = InvestmentsHistoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
