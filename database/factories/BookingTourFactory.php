<?php

namespace Database\Factories;

use App\Models\BookingTour;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingTourFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookingTour::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'total_price' => rand(50, 500),
            'booking_start_date' => $this->faker->date(),
            'quantity' => $this->faker->numberBetween(1, 30),
            'status' => false,
            'duration' => rand(2, 7),
            'tour_id' => $this->faker->numberBetween(1, 30),
            'account_id' => $this->faker->numberBetween(1, 30),
        ];
    }
}
