<?php

namespace Database\Seeders;

use App\Models\NotificationTokens;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationTokensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NotificationTokens::truncate();
        $csvData = fopen(base_path('public/db/notification_tokens.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {

            NotificationTokens::create([
            'id' => $data['0'],
            'uid' => $data['1'],
            'token' => $data['2'],

        ]);
    }
    $transRow = false;
    }
    fclose($csvData);
    }
}
