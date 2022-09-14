<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = ['Grupo general', 'Xcaret', 'Uvc'];

        foreach ($groups as $key => $groupValue) {
            Group::create([
                'name' => $groupValue,
            ]);
        }
    }
}
