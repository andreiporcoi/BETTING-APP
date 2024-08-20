<?php

namespace Database\Seeders;

use App\Models\AdminCountries;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminCountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminCountries::truncate();
        $csvData = fopen(base_path('public/db/admin_countries.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {

            AdminCountries::create([
            'id' => $data['0'],
            'country' => $data['1'],
            'count' => $data['2'],

        ]);
    }
    $transRow = false;
    }
    fclose($csvData);
    }
}
