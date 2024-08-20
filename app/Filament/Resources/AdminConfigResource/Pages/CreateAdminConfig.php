<?php

namespace App\Filament\Resources\AdminConfigResource\Pages;

use App\Filament\Resources\AdminConfigResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdminConfig extends CreateRecord
{
    protected static string $resource = AdminConfigResource::class;
}
