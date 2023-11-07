<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reference' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'title'     => $this->faker->sentence(3),
            'status'    => $this->faker->randomElement([
                Product::STATUS_ACTIVE,
                Product::STATUS_INACTIVE
            ]),
            'price'               => $this->faker->randomFloat(2, 10, 1000),
            'promotional_price'   => $this->faker->randomFloat(2, 10, 1000),
            'promotion_starts_on' => $this->faker->dateTimeBetween('-1 day', 'now'),
            'promotion_ends_on'   => $this->faker->dateTimeBetween('now', '+1 day'),
            'quantity'            => $this->faker->numberBetween(0, 100),
        ];
    }
}
