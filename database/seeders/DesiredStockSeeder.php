<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Carbon;

use App\Models\CuratechProduct;
use App\Models\DesiredStock;

class DesiredStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        foreach(CuratechProduct::all() as $cp) {
            $amount_initial = rand(0, 1000);
            $amount_made = rand(0, $amount_initial);
            $amount_to_make = $amount_initial - $amount_made;
            
            DesiredStock::create([
                'curatech_product_id' => $cp->id,
                'amount_initial' => $amount_initial,
                'amount_made' => $amount_made,
                'amount_to_make' => $amount_to_make,
                'start_date' => Carbon::now(),
                'expiration_date' => Carbon::now()->addDays(rand(1, 365)),
            ]);
        }
    }
}
