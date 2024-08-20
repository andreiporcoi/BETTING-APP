<?php

namespace Database\Seeders;

use App\Models\SubscriptionHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubscriptionHistory::truncate();
        $csvData = fopen(base_path('public/db/sub.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 2000, ',')) !== false) {
            if (!$transRow) {

                SubscriptionHistory::create( [
                // 'id'=> $data['0'],
                // 'email'=> $data['1'],
                // 'title'=> $data['2'],
                // 'amount'=> $data['3'],
                // 'duration'=> $data['4'],
                // 'roi'=> $data['5'],
                // 'startDate'=> $data['6'],
                // 'endDate'=> $data['7']
                ] );
    
            $transRow = false;
            }
            fclose($csvData);
            }
    }
}
