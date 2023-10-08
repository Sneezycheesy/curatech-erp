<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

use App\Models\Component;
use App\Models\DesiredStock;

class ComponentsDesiredStocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        foreach(DesiredStock::all() as $ds) {
            $components = array_count_values($ds->curatechProduct()->first()->components()->pluck('components.id')->toArray());
            foreach($components as $component_id=>$amount) {
                $ds->curatechComponents()->attach($component_id, [
                    'amount_initial' => $ds->amount_initial * $amount,
                    'amount_made' => $ds->amount_made * $amount,
                    'amount_to_make' => $ds->amount_to_make * $amount,
                ]);
            }
        }
    }
}
