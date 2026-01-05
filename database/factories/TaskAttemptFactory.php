<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Task;
use App\Models\TaskAttempt;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskAttempt>
 */
class TaskAttemptFactory extends Factory
{
    protected $model = TaskAttempt::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,  // безопасный существующий пользователь
            'task_id' => Task::inRandomOrder()->first()->id,  // безопасный существующий task
            'user_sql' => $this->faker->sentence(),          // текст вместо случайного числа
        ];
    }
}
