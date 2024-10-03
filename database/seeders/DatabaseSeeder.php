<?php

namespace Database\Seeders;

use App\AdminPermission;
use App\AppRoles;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\ResPermission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $superAdmin = User::create([
            'username' => 'super admin',
            'email' => 'superadmin@gmail.com',
            'password' => '123123@Aa'
        ]);
        $superAdmin->assignRole(AppRoles::SUPER_ADMIN);
        $res = User::create([
            'username' => 'ala keafk',
            'email' => 'keafk@gmail.com',
            'password' => '123123@Aa'
        ]);
        $res->assignRole(AppRoles::RESTAURANT);
    }
}
