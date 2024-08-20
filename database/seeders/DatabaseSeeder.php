<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(PageControlSeeder::class);
        $this->call(AppLogoSeeder::class);

        // $this->call(NotificationsSeeder::class);
        $this->call(AdminConfigSeeder::class);
        // $this->call(AdminCountriesSeeder::class);
        // $this->call(AdsSeeder::class);
        // $this->call(FreeTipsSeeder::class);
        // $this->call(InvestmentsHistorySeeder::class);
        // $this->call(InvestmentsSeeder::class);
        // $this->call(NotificationsSeeder::class);
        // $this->call(NotificationTokensSeeder::class);
        // $this->call(PackageHistorySeeder::class);
        // $this->call(PackagesSeeder::class);
        // $this->call(PaidTipsSeeder::class);
        // $this->call(PayoutsSeeder::class);
        // $this->call(PurchasedTipsSeeder::class);
        // $this->call(ReferralSeeder::class);
        // $this->call(SubscriptionsSeeder::class);

        // $path = 'public/db/cs_db.sql';
        // DB::unprepared(file_get_contents($path));


    //     $csv_path = 'public/db/cs_db.csv';
    // $filename = str_replace("\\", "/", storage_path($csv_path));

    // $query = "LOAD DATA LOCAL INFILE '".$filename."' INTO TABLE yourtable
    //     FIELDS TERMINATED BY '\t'
    //     ENCLOSED BY ''
    //     LINES TERMINATED BY '\n'
    //     IGNORE 0 LINES
    //     (col1,col2,...);";

    // DB::unprepared($query);




        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}