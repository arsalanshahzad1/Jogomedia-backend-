<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlockchainUser>
 */
class BlockchainUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_address' => $this->faker->text(),
            'token_sale' => $this->faker->numberBetween(18, 65),
            'eth_amount' => $this->faker->numberBetween(18, 65),
            'usdt_amount' => $this->faker->numberBetween(18, 65),
            'created_at' => $this->faker->dateTimeBetween('-2 years', '+1 year')->format('Y-m-d'),
        ];
    }
}
