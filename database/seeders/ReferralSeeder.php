<?php

namespace Database\Seeders;

use App\Models\Referral;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReferralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Referral::truncate();
        $csvData = fopen(base_path('public/db/referrals.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {

                Referral::create( [
                    'id'=>$data['0'],
                    'refereeCode'=>$data['1'],
                    'refereeUid'=> $data['2'],
                    'referredUid'=> $data['3'],
                    'referredEmail'=> $data['4'],
                    'referredName'=>$data['5'],
                    'joinedDate'=>date("Y-m-d", substr($data['6'], 0, 10)),
                    'confirmed'=>$data['7'],
                    'confirmDate'=>$data['8'] == '0' ? $data['8'] : date("Y-m-d", substr($data['8'], 0, 10)),
                    'amount'=>$data['9']
                    ] );
    }
    $transRow = false;
    }
    fclose($csvData);
    }
}
