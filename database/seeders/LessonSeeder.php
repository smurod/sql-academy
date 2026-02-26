<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // ==========================================
        // 1. Создаем Курс
        // (Тут slug, level и extra_info нужны, судя по прошлым ошибкам)
        // ==========================================
        $courseId = 1;
        DB::table('courses')->upsert([
            [
                'id' => $courseId,
                'title' => 'SQL Academy Course',
                'slug' => 'sql-academy-course',
                'level' => 'beginner',
                'extra_info' => 'SQL Academy Course Description',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ], ['id'], ['title', 'slug', 'level', 'extra_info', 'updated_at']);

        // ==========================================
        // 2. Создаем Модуль
        // (❌ УБРАЛ slug, так как его нет в таблице modules)
        // ==========================================
        $moduleId = 1;
        DB::table('modules')->upsert([
            [
                'id' => $moduleId,
                'course_id' => $courseId,
                'title' => 'Основной модуль',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ], ['id'], ['title', 'course_id', 'updated_at']);

        // ==========================================
        // 3. Создаем Уроки
        // (Оставил slug, так как обычно у уроков он есть.
        // Если будет ошибка "Unknown column slug" для уроков — уберите его и здесь)
        // ==========================================
        $lessonsData = [
            ['title' => 'Основы SELECT',                    'slug' => 'osnovy-select'],
            ['title' => 'COUNT, JOIN, GROUP BY',             'slug' => 'count-join-group-by'],
            ['title' => 'ORDER BY, HAVING, LIMIT',          'slug' => 'order-by-having-limit'],
            ['title' => 'Работа с семейной базой',          'slug' => 'family-db-work'],
            ['title' => 'LEFT JOIN, подзапросы',            'slug' => 'left-join-subqueries'],
            ['title' => 'Агрегатные функции',               'slug' => 'aggregate-functions'],
            ['title' => 'Школьная база: основы',            'slug' => 'school-db-basics'],
            ['title' => 'Школьная база: JOIN',              'slug' => 'school-db-join'],
            ['title' => 'Школьная база: продвинутые',       'slug' => 'school-db-advanced'],
            ['title' => 'DML: INSERT, UPDATE, DELETE',      'slug' => 'dml-insert-update-delete'],
            ['title' => 'Бронирование и строковые функции', 'slug' => 'booking-string-functions'],
            ['title' => 'Продвинутые запросы',              'slug' => 'advanced-queries'],
        ];

        $lessonsToInsert = [];
        foreach ($lessonsData as $index => $lesson) {
            $lessonsToInsert[] = [
                'id' => $index + 1,
                'course_id' => $courseId,
                'module_id' => $moduleId,
                'lesson_order' => $index + 1,
                'title' => $lesson['title'],
                'slug' => $lesson['slug'], // Если таблица lessons тоже без slug, удалите эту строку
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('lessons')->upsert(
            $lessonsToInsert,
            ['id'],
            ['course_id', 'module_id', 'lesson_order', 'title', 'slug', 'updated_at']
        );
    }
}
