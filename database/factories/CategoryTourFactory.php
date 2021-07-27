<?php

namespace Database\Factories;

use App\Models\CategoryTour;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryTourFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryTour::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cat_name' => $this->faker->randomElement(['Leiture Travel', 'Adventure Travel', 'Diving Tour']),
        ];
    }
}
