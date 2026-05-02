<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LessonTasksSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('lesson_tasks')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $rows = DB::table('tasks')
            ->whereNotNull('lesson_id')
            ->select('lesson_id', 'id as task_id')
            ->orderBy('lesson_id')
            ->orderBy('id')
            ->get()
            ->map(function ($item) use ($now) {
                return [
                    'lesson_id'  => $item->lesson_id,
                    'task_id'    => $item->task_id,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            })
            ->all();

        if (!empty($rows)) {
            DB::table('lesson_tasks')->insert($rows);
        }

        echo "✅ Вставлено " . count($rows) . " связей в lesson_tasks\n";
    }
}
