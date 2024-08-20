<?php

namespace Database\Seeders;

use App\Models\Notifications;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notifications::truncate();
        $csvData = fopen(base_path('public/db/notifications.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {

        Notifications::create([
            'id' => $data['0'],
            'notificationId' => $data['1'],
            'notificationTitle' => $data['2'],
            'notificationBody' => $data['3'],

        ]);
    }
    $transRow = false;
    }
    fclose($csvData);
    }
}
