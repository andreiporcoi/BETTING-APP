<?php

namespace App\Filament\Resources\PurchasedTipsResource\Pages;

use App\Filament\Resources\PurchasedTipsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPurchasedTips extends EditRecord
{
    protected static string $resource = PurchasedTipsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
