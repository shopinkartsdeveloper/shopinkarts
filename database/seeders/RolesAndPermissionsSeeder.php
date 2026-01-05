<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Carbon\Carbon;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // Clear permission cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        /*
        |--------------------------------------------------------------------------
        | 1. ROLES (FIXED IDS)
        |--------------------------------------------------------------------------
        */
        $roles = [
            1 => 'admin',
            2 => 'seller',
            3 => 'manufacturer',
            4 => 'customer',
        ];

        foreach ($roles as $id => $name) {
            DB::table('roles')->updateOrInsert(
                ['id' => $id],
                [
                    'name' => $name,
                    'guard_name' => 'web',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | 2. USERS (FIXED IDS + YOUR DATA)
        |--------------------------------------------------------------------------
        */
        $users = [
            [
                'id' => 1,
                'name' => 'ShopInKarts Admin',
                'email' => 'admin@shopinkarts.com',
                'mobile' => '6367848341',
                'type' => 'admin',
                'password' => 'Admin@123',
                'role_id' => 1,
            ],
            [
                'id' => 2,
                'name' => 'AP Collection Seller',
                'email' => 'seller@shopinkarts.com',
                'mobile' => '8503848341',
                'type' => 'seller',
                'password' => 'Seller@123',
                'role_id' => 2,
            ],
            [
                'id' => 3,
                'name' => 'AP Creation Manufacturers',
                'email' => 'manufacturer@shopinkarts.com',
                'mobile' => '9876543212',
                'type' => 'manufacturer',
                'password' => 'Manufacturer@123',
                'role_id' => 3,
            ],
            [
                'id' => 4,
                'name' => 'Abhishek Yadav',
                'email' => 'customer@shopinkarts.com',
                'mobile' => '9876543213',
                'type' => 'customer',
                'password' => 'Customer@123',
                'role_id' => 4,
            ],
        ];

        foreach ($users as $data) {
            $user = User::updateOrCreate(
                ['id' => $data['id']],
                [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'mobile' => $data['mobile'],
                    'type' => $data['type'],
                    'email_verified_at' => $now,
                    'mobile_verified_at' => $now,
                    'password' => Hash::make($data['password']),
                    'updated_at' => $now,
                ]
            );

            // Assign role safely
            DB::table('model_has_roles')->updateOrInsert(
                [
                    'role_id' => $data['role_id'],
                    'model_type' => User::class,
                    'model_id' => $user->id,
                ],
                []
            );
        }

        $this->command->info('✅ Roles & Users seeded successfully (NO DUPLICATES)');
    }
}
