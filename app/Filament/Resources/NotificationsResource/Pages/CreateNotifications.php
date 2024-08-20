<?php

namespace App\Filament\Resources\NotificationsResource\Pages;

use App\Filament\Resources\NotificationsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\NotificationsController;

class CreateNotifications extends CreateRecord
{
    protected static string $resource = NotificationsResource::class;

    protected function handleRecordCreation(array $data): Model
    {


        $newData = [
            "notificationId" => $data['notificationId'],
            "notificationTitle" => $data['notificationTitle'],
            "notificationBody" => $data['notificationBody'],
            'topic'=>$data['topic'],

        ];

        $request = new Request($newData);
        $notifications =new NotificationsController();
        return $notifications->sendNotification($request);
    }

}
