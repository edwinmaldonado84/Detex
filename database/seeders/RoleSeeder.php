<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::create([
            'name' => "SuperAdmin",
            'guard_name' => 'api',
        ]);

        Role::create([
            'name' => 'Admin',
            'guard_name' => 'api',
        ]);
    }
}
