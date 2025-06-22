<?php

namespace Database\Factories;

use App\Models\Cars;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $counter = 0;

    
    public function definition(): array
    {
        // $count_user = User::role('customer')->count();
        $count_user = 1;
        $count_car = Cars::all()->count();

        return [
            'booking_id' => str_pad($this->counter++, 4, '0', STR_PAD_LEFT),
            'user_id' => $this->faker->numberBetween(1, $count_user),
            'payment_id' => $this->faker->numberBetween(1, 5),
            'car_id' => $this->faker->numberBetween(1, $count_car),
            'period' => $this->faker->numberBetween(1, 30),
            'pickup_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'return_date' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'pickup_location' => $this->faker->city(),
            'dropoff_location' => $this->faker->city(),
            'status' => 'confirmed',
        ];
    }
}
