<?php

namespace Database\Seeders;

use App\Models\Ads;
use App\Models\FreeTips;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FreeTipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        FreeTips::truncate();
        $csvData = fopen(base_path('public/db/freeTips.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {

        FreeTips::create([
            'id'=> $data['0'],
            'sportId'=> $data['1'],
            'sportType'=>$data['2'],
            'league'=>$data['3'],
            'teamOne'=>$data['4'],
            'teamTwo'=>$data['5'],
            'tips'=>$data['6'],
            'odds'=>$data['7'],
            'amount'=>$data['8'],
            'sportDate'=>$data['9'],
            'sportTime'=>$data['10'],
            'probability'=>$data['11'],
            'status'=>$data['12']
        ]);
    }
        $transRow = false;
    }
    fclose($csvData);


    }
}
