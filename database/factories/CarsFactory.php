<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cars>
 */
class CarsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new \Faker\Provider\FakeCar($this->faker));

        return [
            'name' => $this->faker->vehicle(),
            'type' => $this->faker->vehicleType(),
            'plate_number' => $this->faker->vehicleRegistration('[A-Z]{2}-[0-9]{4}-[A-Z]{2}'),
            'rental_price' => ($this->faker->numberBetween(1, 10) * 10000000) + ($this->faker->randomElement([220, 350, 400, 600, 890]) * 1000),
            'insurance' => $this->faker->numberBetween(1, 8) * 100000,
            'service_fee' => $this->faker->numberBetween(1,8) * 100000,
        ];
    }
}
