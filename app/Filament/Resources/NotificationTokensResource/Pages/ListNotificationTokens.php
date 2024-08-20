<?php

namespace App\Filament\Resources\NotificationTokensResource\Pages;

use App\Filament\Resources\NotificationTokensResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNotificationTokens extends ListRecords
{
    protected static string $resource = NotificationTokensResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
