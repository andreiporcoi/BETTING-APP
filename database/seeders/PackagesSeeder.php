<?php

namespace Database\Seeders;

use App\Models\Packages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Packages::truncate();
        $csvData = fopen(base_path('public/db/packages.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {

                Packages::create( [
                    'id'=>$data['0'],
                    'packageId'=>$data['1'],
                    'type'=>$data['2'],
                    'title'=>$data['3'],
                    'amount'=>$data['4'],
                    'duration'=>$data['5'],
                    'quantity'=>$data['6'],
                    'roi'=>$data['7']
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);

    }
}
