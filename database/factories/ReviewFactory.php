<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'content' => $this->faker->paragraph(),
            'count_like' => $this->faker->numberBetween(0, 50),
            'account_id' => $this->faker->numberBetween(1, 30),
            'category_review_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
