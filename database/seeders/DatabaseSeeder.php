<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Passport\ClientRepository;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $client = new ClientRepository();

        //Check Before PROD: REDIRECT
        $client->createPasswordGrantClient(null, 'Default password grant client', 'http://detext.test');
        $client->createPersonalAccessClient(null, 'Default Personal Access Client', 'http://detext.test');
        $this->call([
            UserSeeder::class,
            GroupSeeder::class,
            // CompanySeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            ChargeSeeder::class,
        ]);
    }
}
