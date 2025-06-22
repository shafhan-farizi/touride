<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payments>
 */
class PaymentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $counter = 0;

    public function definition(): array
    {
        return [
            'payment_id' => str_pad($this->counter++, 4, '0', STR_PAD_LEFT),
            'payment_method_id' => $this->faker->numberBetween(1, 50),
            'amount' => $this->faker->randomFloat(0, 1000000, 5000000),
            'status' => $this->faker->randomElement(['paid', 'pending']),
        ];
    }
}
