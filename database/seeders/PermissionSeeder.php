<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = ['group', 'company', 'contact', 'charge', 'user'];
        $types = ['read', 'create', 'edit', 'delete'];

        foreach ($modules as $key => $moduleValue) {
            foreach ($types as $key => $typeValue) {
                Permission::create([
                    'name' => $moduleValue . '_' . $typeValue,
                    'guard_name' => 'api',
                ]);
            }
        }
    }
}
