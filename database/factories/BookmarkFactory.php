<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookmarkFactory extends Factory
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
            'article_id' => $this->faker->numberBetween($min = 135, $max = 234),
            'created_at' => $this->faker->dateTime($max = 'now', $timezone = null),
        ];
    }
}
