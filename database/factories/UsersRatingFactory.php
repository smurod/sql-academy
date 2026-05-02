<?php

namespace Database\Factories;

use App\Models\UsersRating;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsersRatingFactory extends Factory
{
    protected $model = UsersRating::class;

    public function definition(): array
    {
        return [
            'user_id'   => \App\Models\User::inRandomOrder()->first()?->id ?? 1,
            'type'      => $this->faker->randomElement(['task', 'lesson', 'bonus']),
            'source_id' => $this->faker->numberBetween(1, 200),
            'xp'        => $this->faker->numberBetween(1, 100),
        ];
    }
}
