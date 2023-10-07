<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Component>
 */
class ComponentFactory extends Factory
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
            'component_id' => Str::random(10),
            'description' => Str::random(100),
            'courant' => rand(0,1),
            'time_to_delivery' => rand(1, 50),
            'stock' => rand(0, 10000),
            'stock_machines' => rand(0, 1000),
            'smd' => rand(0, 1),
            'package_size' => rand(1, 1000),
        ];
    }
}
