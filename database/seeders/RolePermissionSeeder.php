<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'superadmin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'employee']);
        Permission::create(['name' => 'Personal']);
        Permission::create(['name' => 'PDCA']);
        Permission::create(['name' => 'Physician']);
        Permission::create(['name' => 'Strengthen']);
        Permission::create(['name' => 'Nutrition']);
        Permission::create(['name' => 'Psychology']);
        Permission::create(['name' => 'Physical']);
        Permission::create(['name' => 'Report']);
    }
}
