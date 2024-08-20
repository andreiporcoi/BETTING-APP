<?php

namespace Database\Seeders;

use App\Models\AppLogo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppLogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppLogo::create([
            'title' => 'logo',
        ]);
        }
}
