<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task; // <-- правильно импортируем модель
use App\Models\TaskAnswer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskAnswer>
 */
class TaskAnswerFactory extends Factory
{
    protected $model = TaskAnswer::class;

    public function definition(): array
    {
        return [
            'task_id' => Task::inRandomOrder()->first()->id, // берём существующий Task
            'correct_sql' => $this->faker->sentence(),
        ];
    }
}
