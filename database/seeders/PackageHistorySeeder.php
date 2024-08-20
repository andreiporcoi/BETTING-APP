<?php

namespace Database\Seeders;

use App\Models\PackageHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PackageHistory::truncate();
        $csvData = fopen(base_path('public/db/package_history.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {

                PackageHistory::create( [
                    'id'=>$data['0'],
                    'email'=>$data['1'],
                    'reference'=>$data['2'],
                    'title'=>$data['3'],
                    'amount'=>$data['4'],
                    'quantity'=>$data['5'],
                    'duration'=>$data['6'],
                    'roi'=>$data['7'],
                    'startDate'=>$data['8'] == '0' ? $data['8'] : date("Y-m-d", substr($data['8'], 0, 10)),
                    'endDate'=>$data['9'] == '0' ? $data['9'] :  date("Y-m-d", substr($data['9'], 0, 10)),
                    'type'=>$data['10'],
                    'status'=>$data['11'],
                    'payMethod'=>$data['12'],
                    'hash'=>$data['13']
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
