<?php

namespace App\Filament\Resources\PaidTipsResource\Pages;

use App\Filament\Resources\PaidTipsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPaidTips extends ListRecords
{
    protected static string $resource = PaidTipsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
