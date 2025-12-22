<?php

namespace Database\Seeders;

use App\Models\TaskAttempt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskAttemptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskAttempt::factory()->count(50)->create();
    }
}
