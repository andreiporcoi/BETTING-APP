<?php

namespace Database\Seeders;

use App\Models\Subscriptions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscriptions::truncate();
        $csvData = fopen(base_path('public/db/subscriptions.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {

            Subscriptions::create( [
                'id'=> $data['0'],
                'email'=> $data['1'],
                'title'=> $data['2'],
                'amount'=> $data['3'],
                'duration'=> $data['4'],
                'roi'=> $data['5'],
                'startDate'=>date("Y-m-d", substr($data['6'], 0, 10)),
                'endDate'=> date("Y-m-d", substr($data['7'], 0, 10)),
                ] );
            }
            $transRow = false;
            }
            fclose($csvData);
            
    }
}
