<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
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
            'name' => Str::random(5, 20),
            'address' => Str::random(25) . ' ' . rand(1, 100),
            'zipcode' => rand(1000, 9999) . ' ' . Str::random(2),
            'city' => Str::random(5, 30),
            'country' => Str::random(5, 30),
        ];
    }
}
