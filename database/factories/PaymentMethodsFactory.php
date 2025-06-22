<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PaymentMethodsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_count = User::role('customer')->count();

        return [
            'user_id' => $this->faker->numberBetween(1, $user_count),
            'bank_name' => $this->faker->randomElement(['BCA', 'BRI', 'Mandiri', 'Jago']),
            'pin' => $this->faker->creditCardNumber(),
            'type' => $this->faker->randomElement(['atm', 'phone']),
            'selected' => $this->faker->numberBetween(0, 1),
        ];
    }
}
