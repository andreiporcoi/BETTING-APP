<?php

namespace Database\Seeders;

use App\Models\Ads;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Ads::truncate();
        $csvData = fopen(base_path('public/db/ads.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                Ads::create( [
                    'id'=> $data['0'],
                    'adsId'=>$data['1'],
                    'adsImage'=> $data['2'],
                    'adsTitle'=>$data['3'],
                    'adsDescription'=> $data['4'],
                    'adsLink'=> $data['5'],
                    'adsType'=>$data['6']
                    ] );
            }
            $transRow = false;
        }
        fclose($csvData);

    }
}
