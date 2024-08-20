<?php

namespace Database\Seeders;

use App\Models\Investments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvestmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Investments::truncate();
        $csvData = fopen(base_path('public/db/investments.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {

            Investments::create( [
                'id'=> $data['0'],
                'reference'=>$data['1'],
                'email'=> $data['2'],
                'title'=> $data['3'],
                'amount'=> $data['4'],
                'duration'=>$data['5'],
                'roi'=> $data['6'],
                'startDate'=>$data['7'] == '0' ? $data['7'] : date("Y-m-d", substr($data['7'], 0, 10)),
                'nextDate'=> $data['8'] == '0' ? $data['8'] : date("Y-m-d", substr($data['8'], 0, 10)),
                'endDate'=> $data['9'] == '0' ? $data['9'] : date("Y-m-d", substr($data['9'], 0, 10)),
                'status'=> $data['10'],
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
