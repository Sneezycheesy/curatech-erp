<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

use App\Models\Component;
use App\Models\CuratechProduct;

class CuratechProductsComponentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        foreach(CuratechProduct::all() as $cp) {
            for($i =0; $i < rand(0, 100); $i++) {
                $cp->components()->attach(
                    Component::all()->random(),
                    [
                        'curatech_product_component_position' => Str::random(4),
                    ]
                );
            }
        }
    }
}
