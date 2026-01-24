<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'level' => $this->faker->randomElement(['beginner', 'middle', 'advanced']),
            'start_date' => $this->faker->date(),
            'duration' => $this->faker->randomElement(['3', '6', '12']),
            'image' => $this->faker->imageUrl(),
            'extra_info' => $this->faker->paragraph(),
        ];
    }
}
