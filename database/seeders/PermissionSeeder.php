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

        Permission::create([
            'name' => "superuser",
            'guard_name' => 'api',
        ]);


        //SALES

        /* Permission::create([
            'name' => 'sale_read',
            'guard_name' => 'api',
        ]);

        Permission::create([
            'name' => 'sale_create',
            'guard_name' => 'api',
        ]);

        Permission::create([
            'name' => 'sale_edit',
            'guard_name' => 'api',
        ]);

        Permission::create([
            'name' => 'sale_delete',
            'guard_name' => 'api',
        ]);

        Permission::create([
            'name' => 'sale_report',
            'guard_name' => 'api',
        ]); */
    }
}
