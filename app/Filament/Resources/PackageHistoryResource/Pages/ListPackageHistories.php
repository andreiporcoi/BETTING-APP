<?php

namespace App\Filament\Resources\PackageHistoryResource\Pages;

use App\Filament\Resources\PackageHistoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPackageHistories extends ListRecords
{
    protected static string $resource = PackageHistoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
