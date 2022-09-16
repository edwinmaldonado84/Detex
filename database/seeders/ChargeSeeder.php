<?php

namespace Database\Seeders;

use App\Models\Charge;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $charges = ['Gerente general', 'Encargado de compras', 'Encargado de almacen'];

        foreach ($charges as $key => $chargeValue) {
            Charge::create([
                'name' => $chargeValue,
            ]);
        }
    }
}
