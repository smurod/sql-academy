<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('courses')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('courses')->insert([
            'id'          => 1,
            'title'       => 'Интерактивный курс по SQL',
            'slug'        => 'interactive-sql-course',
            'description' => 'Познакомьтесь с SQL — мощным языком для работы с базами данных. '
                . 'Курс охватывает все основные темы: от простых SELECT-запросов до '
                . 'сложных подзапросов, соединений таблиц и модификации данных.',
            'level'       => 'beginner',
            'extra_info'  => 'Более 60 тем и более 70 задач для практики',
            'created_at'  => $now,
            'updated_at'  => $now,
        ]);

        echo "✅ Курс создан (1 запись)\n";
    }
}
