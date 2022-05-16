<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween($min = 44, $max = 53),
            'title' => $this->faker->realTextBetween($minNbChars = 5, $maxNbChars = 30, $indexSize = 5),
            'body' =>  $this->faker->realTextBetween($minNbChars = 30, $maxNbChars = 1000, $indexSize = 5),
            'public_status' => $this->faker->numberBetween($min = 0, $max = 1),
            'category_id' => $this->faker->numberBetween($min = 1, $max = 5),
            'views' => $this->faker->numberBetween($min = 1, $max = 10000),
            'created_at' => $this->faker->dateTime($max = 'now', $timezone = null),
            'updated_at' => $this->faker->dateTime($max = 'now', $timezone = null),
        ];
    }
}
