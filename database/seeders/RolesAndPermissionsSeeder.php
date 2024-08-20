<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Misc
        // $miscPermission = Permission::create(['name' => 'N/A']);

        // USER MODEL
        $userPermission1 = Permission::create(['name' => 'create: user']);
        $userPermission2 = Permission::create(['name' => 'read: user']);
        $userPermission3 = Permission::create(['name' => 'update: user']);
        $userPermission4 = Permission::create(['name' => 'delete: user']);

        // ROLE MODEL
        $rolePermission1 = Permission::create(['name' => 'create: role']);
        $rolePermission2 = Permission::create(['name' => 'read: role']);
        $rolePermission3 = Permission::create(['name' => 'update: role']);
        $rolePermission4 = Permission::create(['name' => 'delete: role']);

        // PERMISSION MODEL
        $permission1 = Permission::create(['name' => 'create: permission']);
        $permission2 = Permission::create(['name' => 'read: permission']);
        $permission3 = Permission::create(['name' => 'update: permission']);
        $permission4 = Permission::create(['name' => 'delete: permission']);

        // TIPS MODEL
        $tipsPermission1 = Permission::create(['name' => 'create: tips']);
        $tipsPermission2 = Permission::create(['name' => 'read: tips']);
        $tipsPermission3 = Permission::create(['name' => 'update: tips']);
        $tipsPermission4 = Permission::create(['name' => 'delete: tips']);


        // SUBSCRIPTIONS MODEL
        $subscriptionsPermission1 = Permission::create(['name' => 'create: subscriptions']);
        $subscriptionsPermission2 = Permission::create(['name' => 'read: subscriptions']);
        $subscriptionsPermission3 = Permission::create(['name' => 'update: subscriptions']);
        $subscriptionsPermission4 = Permission::create(['name' => 'delete: subscriptions']);

        // INVESTMENTS MODEL
        $investmentsPermission1 = Permission::create(['name' => 'create: investments']);
        $investmentsPermission2 = Permission::create(['name' => 'read: investments']);
        $investmentsPermission3 = Permission::create(['name' => 'update: investments']);
        $investmentsPermission4 = Permission::create(['name' => 'delete: investments']);


        // TRANSACTIONS MODEL
        $transactionsPermission1 = Permission::create(['name' => 'create: transactions']);
        $transactionsPermission2 = Permission::create(['name' => 'read: transactions']);
        $transactionsPermission3 = Permission::create(['name' => 'update: transactions']);
        $transactionsPermission4 = Permission::create(['name' => 'delete: transactions']);


        // NOTIFICATIONS MODEL
        $notificationsPermission1 = Permission::create(['name' => 'create: notifications']);
        $notificationsPermission2 = Permission::create(['name' => 'read: notifications']);
        $notificationsPermission3 = Permission::create(['name' => 'update: notifications']);
        $notificationsPermission4 = Permission::create(['name' => 'delete: notifications']);



        // ADMINS
        $adminPermission1 = Permission::create(['name' => 'read: admin']);
        $adminPermission2 = Permission::create(['name' => 'update: admin']);

        // CREATE ROLES
        // $userRole = Role::create(['name' => 'user'])->syncPermissions([
        //     $miscPermission,
        // ]);

        $superAdminRole = Role::create(['name' => 'super-admin'])->syncPermissions([
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,

            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,

            $permission1,
            $permission2,
            $permission3,
            $permission4,

            $adminPermission1,
            $adminPermission2,

            $tipsPermission1,
            $tipsPermission2,
            $tipsPermission3,
            $tipsPermission4,

            $subscriptionsPermission1,
            $subscriptionsPermission2,
            $subscriptionsPermission3,
            $subscriptionsPermission4,

            $investmentsPermission1,
            $investmentsPermission2,
            $investmentsPermission3,
            $investmentsPermission4,

            $transactionsPermission1,
            $transactionsPermission2,
            $transactionsPermission3,
            $transactionsPermission4,

            $notificationsPermission1,
            $notificationsPermission2,
            $notificationsPermission3,
            $notificationsPermission4,

        ]);

        $adminRole = Role::create(['name' => 'admin'])->syncPermissions([
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,

            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,

            $permission1,
            $permission2,
            $permission3,
            $permission4,

            $adminPermission1,
            $adminPermission2,

            $tipsPermission1,
            $tipsPermission2,
            $tipsPermission3,
            $tipsPermission4,

            $subscriptionsPermission1,
            $subscriptionsPermission2,
            $subscriptionsPermission3,
            $subscriptionsPermission4,

            $investmentsPermission1,
            $investmentsPermission2,
            $investmentsPermission3,
            $investmentsPermission4,

            $transactionsPermission1,
            $transactionsPermission2,
            $transactionsPermission3,
            $transactionsPermission4,


            $notificationsPermission1,
            $notificationsPermission2,
            $notificationsPermission3,
            $notificationsPermission4,

        ]);

        $tipsRole = Role::create(['name' => 'tips'])->syncPermissions([
            $tipsPermission1,
            $tipsPermission2,
            $tipsPermission3,
            $tipsPermission4,
        ]);


        $subscriptionsRole = Role::create(['name' => 'subscriptions'])->syncPermissions([
            $subscriptionsPermission1,
            $subscriptionsPermission2,
            $subscriptionsPermission3,
            $subscriptionsPermission4,
        ]);


        $investmentsRole = Role::create(['name' => 'investments'])->syncPermissions([
            $investmentsPermission1,
            $investmentsPermission2,
            $investmentsPermission3,
            $investmentsPermission4,
        ]);


        $transactionsRole = Role::create(['name' => 'transactions'])->syncPermissions([
            $transactionsPermission1,
            $transactionsPermission2,
            $transactionsPermission3,
            $transactionsPermission4,
        ]);



        $notificationsRole = Role::create(['name' => 'notifications'])->syncPermissions([
            $notificationsPermission1,
            $notificationsPermission2,
            $notificationsPermission3,
            $notificationsPermission4,
        ]);


        $moderatorRole = Role::create(['name' => 'moderator'])->syncPermissions([
            $userPermission2,
            $rolePermission2,
            $permission2,
            $tipsPermission2,
            $subscriptionsPermission2,
            $investmentsPermission2,
            $transactionsPermission2,
            $notificationsPermission2,
        ]);

        $developerRole = Role::create(['name' => 'developer'])->syncPermissions([
            $adminPermission1,
        ]);

    //     User::truncate();
    //     $csvData = fopen(base_path('public/db/users.csv'), 'r');
    //     $transRow = true;
    //     while (($data = fgetcsv($csvData, 555, ',')) !== false) {
    //         if (!$transRow) {

    //     User::create([
    //         'id'=>$data['0'],
    //         'uid'=>$data['1'],
    //         'name'=>$data['2'],
    //         'email'=>$data['3'],
    //         'email_verified_at' =>$data['14'] == 1? now() : NULL,
    //         'password'=>$data['4'],
    //         'country'=>$data['5'],
    //         'dateCreated'=>$data['6'],
    //         'blocked'=>$data['7'],
    //         'admin'=>$data['8'],
    //         'remember_token' => Str::random(10),
    //         'avatar'=>$data['9'],
    //         'refCode'=>$data['10'],
    //         'referredBy'=>$data['11'],
    //         'balance'=>$data['12'],
    //         'coins'=>$data['13'],
    //         'verified'=>$data['14'],
    //         'refConfirmCount'=>$data['15'],
    //         'refUnconfirmCount'=>$data['16'],
    //     ])->assignRole($userRole);
    // }
    //     $transRow = false;
    // }
    // fclose($csvData);

        // CREATE ADMINS & USERS
        User::create([
            'name' => 'super admin',
            'admin' => 1,
            'email' => 'super@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'country' => 'Belgie',
            'refCode' => Str::random(6),
            'uid' => Str::random(12),

        ])->assignRole($superAdminRole);

        User::create([
            'name' => 'admin',
            'admin' => 1,
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'country' => 'Belgie',
            'refCode' => Str::random(6),
            'uid' => Str::random(12),

        ])->assignRole($adminRole);

        User::create([
            'name' => 'tips',
            'admin' => 1,
            'email' => 'tips@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'country' => 'Belgie',
            'refCode' => Str::random(6),
            'uid' => Str::random(12),

        ])->assignRole($tipsRole);

        User::create([
            'name' => 'subscriptions',
            'admin' => 1,
            'email' => 'subscriptions@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'country' => 'Belgie',
            'refCode' => Str::random(6),
            'uid' => Str::random(12),

        ])->assignRole($subscriptionsRole);


        User::create([
            'name' => 'investments',
            'admin' => 1,
            'email' => 'investments@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'country' => 'Belgie',
            'refCode' => Str::random(6),
            'uid' => Str::random(12),

        ])->assignRole($investmentsRole);

        User::create([
            'name' => 'transactions',
            'admin' => 1,
            'email' => 'transactions@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'country' => 'Belgie',
            'refCode' => Str::random(6),
            'uid' => Str::random(12),

        ])->assignRole($transactionsRole);

        User::create([
            'name' => 'notifications',
            'admin' => 1,
            'email' => 'notifications@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'country' => 'Belgie',
            'refCode' => Str::random(6),
            'uid' => Str::random(12),

        ])->assignRole($notificationsRole);

        User::create([
            'name' => 'moderator',
            'admin' => 1,
            'email' => 'moderator@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'country' => 'Belgie',
            'refCode' => Str::random(6),
            'uid' => Str::random(12),

        ])->assignRole($moderatorRole);

        User::create([
            'name' => 'developer',
            'admin' => 1,
            'email' => 'developer@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'country' => 'Belgie',
            'refCode' => Str::random(6),
            'uid' => Str::random(12),

        ])->assignRole($developerRole);





        // for ($i=1; $i < 50; $i++) {
        //     User::create([
        //         'name' => 'Test '.$i,
        //         'admin' => 0,
        //         'email' => 'test'.$i.'@ezeematrix.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('password'), // password
        //         'remember_token' => Str::random(10),
        //     'country' => 'Belgie',
        //     'refCode' => Str::random(6),
        //     'uid' => Str::random(12),

        //     ])->assignRole($userRole);
        // }
    }
}
