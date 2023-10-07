<?php

namespace Database\Factories;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CuratechProduct;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DesiredStock>
 */
class DesiredStockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amount_initial = rand(0, 1000);
        $amount_made = rand(0, $amount_initial);
        $amount_to_make = $amount_initial - $amount_made;
        return [
            //
            'curatech_product_id' => CuratechProduct::all()->random(),
            'amount_initial' => $amount_initial,
            'amount_made' => $amount_made,
            'amount_to_make' => $amount_to_make,
            'start_date' => Carbon::now(),
            'expiration_date' => Carbon::now()->addDays(rand(20, 365)),
        ];
    }
}
