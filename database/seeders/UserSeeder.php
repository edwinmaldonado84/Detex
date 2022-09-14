<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $role = Role::create([
            'name' => "SuperAdmin",
            'guard_name' => 'api',
        ]);

        $edwin = User::create([
            'name' => 'Edwin Maldonado',
            'email' => 'edwin.maldonado84@gmail.com',
            'password' => Hash::make('apple123'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $edwin->assignRole($role);

        $daniel = User::create([
            'name' => 'Daniel Heil',
            'email' => 'dh@detext.com',
            'password' => Hash::make('apple123'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $daniel->assignRole($role);

        $elias = User::create([
            'name' => 'Elias Dominguez',
            'email' => 'ed84@detext.com',
            'password' => Hash::make('apple123'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $elias->assignRole($role);
    }
}
