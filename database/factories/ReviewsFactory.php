<?php

namespace Database\Factories;

use App\Models\Bookings;
use App\Models\Cars;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReviewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $count_user = User::role('customer')->count();
        $count_car = Cars::all()->count();
        $count_booking = Bookings::all()->count();

        return [
            'user_id' => fake()->randomElement([1, $count_user]),
            'car_id' => fake()->randomElement([1, $count_car]),
            'booking_id' => fake()->randomElement([1, $count_booking]),
            'rating' => fake()->randomElement([1, 5]),
            'description' => fake()->sentence()
        ];
    }
}
