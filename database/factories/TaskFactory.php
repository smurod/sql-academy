<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Lesson;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'lesson_id' => Lesson::inRandomOrder()->first()->id, // правильно: snake_case
            'title' => $this->faker->sentence(),
            'task_text' => $this->faker->paragraph(),
            'difficulty' => $this->faker->numberBetween(1, 5),
        ];
    }
}
