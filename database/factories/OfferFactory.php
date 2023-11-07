<?php

namespace Database\Factories;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class OfferFactory extends Factory
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
                Offer::STATUS_ACTIVE,
                Offer::STATUS_INACTIVE
            ]),
            'price'          => $this->faker->randomFloat(2, 10, 1000),
            'sale_price'     => $this->faker->randomFloat(2, 10, 1000),
            'sale_starts_on' => $this->faker->dateTimeBetween('-1 day', 'now'),
            'sale_ends_on'   => $this->faker->dateTimeBetween('now', '+1 day'),
            'stock'          => $this->faker->numberBetween(0, 100),
        ];
    }
}
