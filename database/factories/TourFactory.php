<?php

namespace Database\Factories;

use App\Models\CategoryTour;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Type\Integer;

class TourFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tour::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->paragraph(),
            'duration' => rand(2, 7),
            'num_of_participants' => random_int(20, 50),
            'cat_tour_id' => $this->faker->numberBetween(1, 3),
            'avgRate' => 0,
            'price' => rand(50, 500),
        ];
    }
}
