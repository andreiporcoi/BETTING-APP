<?php

namespace Database\Seeders;

use App\Models\AdminConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    //     AdminConfig::truncate();
    //     $csvData = fopen(base_path('public/db/app_configs.csv'), 'r');
    //     $transRow = true;
    //     while (($data = fgetcsv($csvData, 555, ',')) !== false) {
    //         if (!$transRow) {

    //     AdminConfig::create([
    //         'id' => $data['0'],
    //         'title' => $data['1'],
    //         'value' => $data['2'],
    //     ]);
    // }
    //     $transRow = false;
    // }
    // fclose($csvData);

    AdminConfig::create([
        'title' => 'appName',
        'value' => 'EZBET X',
    ]);
    AdminConfig::create([
        'title' => 'refPercent',
        'value' => '5',
    ]);
    AdminConfig::create([
        'title' => 'serverKey',
        'value' => '',
    ]);

    AdminConfig::create([
        'title' => 'chatLink',
        'value' => '',
    ]);

    AdminConfig::create([
        'title' => 'btcDeposit',
        'value' => '',
    ]);

    AdminConfig::create([
        'title' => 'ethDeposit',
        'value' => '',
    ]);

    AdminConfig::create([
        'title' => 'usdtDeposit',
        'value' => '',
    ]);

    AdminConfig::create([
        'title' => 'bankName',
        'value' => '',
    ]);

    AdminConfig::create([
        'title' => 'accName',
        'value' => '',
    ]);

    AdminConfig::create([
        'title' => 'accNum',
        'value' => '',
    ]);

    AdminConfig::create([
        'title' => 'iban',
        'value' => '',
    ]);

    AdminConfig::create([
        'title' => 'swiftCode',
        'value' => '',
    ]);
    }
}