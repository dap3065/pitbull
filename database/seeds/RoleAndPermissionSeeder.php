<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all()->pluck('name');
        if (!$roles->contains('Admin')) {
            Role::create(['name' => 'Admin']);
        }
        if (!$roles->contains('Customer')) {
            Role::create(['name' => 'Customer']);
        }
    }
}
