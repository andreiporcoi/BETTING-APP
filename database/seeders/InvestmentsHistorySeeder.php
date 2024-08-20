<?php

namespace Database\Seeders;

use App\Models\InvestmentsHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvestmentsHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InvestmentsHistory::truncate();
        $csvData = fopen(base_path('public/db/investments_history.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {

                Investmentshistory::create( [
                    'id'=> $data['0'],
                    'reference'=> $data['1'],
                    'email'=>$data['2'],
                    'interest'=>$data['3'],
                    'amount'=>$data['4'],
                    'roi'=>$data['5'],
                    'startDate'=>$data['6'] == '0' ? $data['6'] : date("Y-m-d", substr($data['6'], 0, 10)),
                    'nextDate'=> $data['7'] == '0' ? $data['7'] : date("Y-m-d", substr($data['7'], 0, 10)),
                    'endDate'=> $data['8'] == '0' ? $data['8'] : date("Y-m-d", substr($data['8'], 0, 10)),
                    ] );
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
