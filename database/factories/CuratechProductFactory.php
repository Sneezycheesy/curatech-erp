<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CuratechProduct>
 */
class CuratechProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'curatech_product_id' => rand(10000, 20000) . '.' . rand(10, 99),
            'name' => Str::random(8),
            'description' => Str::random(40),
            'stock_desired' => rand(0, 1000),
        ];
    }
}
