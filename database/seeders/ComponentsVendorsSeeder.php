<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Component;
use App\Models\Vendor;

class ComponentsVendorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        foreach(Component::all() as $comp) {
            for($i =0; $i < rand(0, 5); $i++) {
                $comp->vendors()->attach(Vendor::whereNotIn('id', $comp->vendors()->pluck('vendor_id')->toArray())->get()->random(),
                [ 'vendor_product_nr' => Str::random(5),
                  'component_unit_price' => rand(0, 3000) / 1000
                ]);
            }
        }
    }
}
