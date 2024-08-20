<?php

namespace Database\Seeders;

use App\Models\PurchasedTips;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchasedTipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PurchasedTips::truncate();
        $csvData = fopen(base_path('public/db/purchased_tips.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {

            PurchasedTips::create([
                'id'=>$data['0'],
                'sportId'=>$data['1'],
                'email'=>$data['2'],
                'amount'=>$data['3'],
                'sportDate'=>$data['4']
        ]);
        }
            $transRow = false;
        }
        fclose($csvData);
        }
}
