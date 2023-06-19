<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'like_count' => $this->faker->randomNumber(2),
            'description' => $this->faker->sentence(),
            'location' => $this->faker->city(),
            'user' => 2
        ];
    }
}
