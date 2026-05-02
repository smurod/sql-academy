<?php

namespace Database\Seeders;

use App\Models\UsersRating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UsersRating::factory()->count(500)->create();
    }
}
