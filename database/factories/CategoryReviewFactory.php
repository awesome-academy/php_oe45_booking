<?php

namespace Database\Factories;

use App\Models\CategoryReview;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryReview::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_rv_cat' => $this->faker->randomElement(['national', 'domestic']),
        ];
    }
}
