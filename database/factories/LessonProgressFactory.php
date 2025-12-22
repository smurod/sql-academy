<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Lesson;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LessonProgressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'lesson_id' => Lesson::inRandomOrder()->first()->id,
            'completed' => $this->faker->boolean(),
        ];
    }
}
