<?php

namespace Database\Seeders;

use App\Models\Payouts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PayoutsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payouts::truncate();
        $csvData = fopen(base_path('public/db/payouts.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {

                Payouts::create([
                    'id'=>$data['0'],
                    'email'=>$data['1'],
                    'paymentMethod'=>$data['2'],
                    'fullName'=>$data['3'],
                    'createdDate'=>$data['4'],
                    'updatedDate'=>$data['5'],
                    'amount'=>$data['6'],
                    'address'=>$data['7'],
                    'reference'=>$data['8'],
                    'status'=>$data['9'],
                    'payType'=>$data['10'],
                    'bankName'=>$data['11'],
                    'accName'=>$data['12'],
                    'accNum'=>$data['13'],
                    'benCountry'=>$data['14'],
                    'benAddress'=>$data['15'],
                    'bankBranch'=>$data['16'],
                    'bankAddress'=>$data['17'],
                    'currency'=>$data['18'],
                    'swiftCode'=>$data['19']
        ]);
    }
        $transRow = false;
    }
    fclose($csvData);
    }
}
