<?php

namespace App\Filament\Resources\PaidTipsResource\Pages;

use App\Filament\Resources\PaidTipsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPaidTips extends EditRecord
{
    protected static string $resource = PaidTipsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
