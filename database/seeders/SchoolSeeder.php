<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        // Отключить проверку foreign keys
        DB::connection('sandbox_template')->statement('SET FOREIGN_KEY_CHECKS=0;');

        // Очистить таблицы
        DB::connection('sandbox_template')->table('schedules')->truncate();
        DB::connection('sandbox_template')->table('marks')->truncate();
        DB::connection('sandbox_template')->table('student_in_class')->truncate();
        DB::connection('sandbox_template')->table('students')->truncate();
        DB::connection('sandbox_template')->table('teachers')->truncate();
        DB::connection('sandbox_template')->table('subjects')->truncate();
        DB::connection('sandbox_template')->table('classes')->truncate();

        // Включить обратно проверку foreign keys
        DB::connection('sandbox_template')->statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. КЛАССЫ
        $classes = [
            ['id' => 1, 'name' => '1a'],
            ['id' => 2, 'name' => '1b'],
            ['id' => 3, 'name' => '2a'],
            ['id' => 4, 'name' => '2b'],
            ['id' => 5, 'name' => '3a'],
            ['id' => 6, 'name' => '3b'],
            ['id' => 7, 'name' => '4a'],
            ['id' => 8, 'name' => '4b'],
            ['id' => 9, 'name' => '5a'],
            ['id' => 10, 'name' => '5b'],
            ['id' => 11, 'name' => '6a'],
            ['id' => 12, 'name' => '6b'],
            ['id' => 13, 'name' => '7a'],
            ['id' => 14, 'name' => '7b'],
            ['id' => 15, 'name' => '8a'],
            ['id' => 16, 'name' => '8b'],
            ['id' => 17, 'name' => '9a'],
            ['id' => 18, 'name' => '9b'],
            ['id' => 19, 'name' => '10a'],
            ['id' => 20, 'name' => '10b'],
            ['id' => 21, 'name' => '11a'],
            ['id' => 22, 'name' => '11b'],
        ];

        DB::connection('sandbox_template')->table('classes')->insert($classes);

        // 2. ПРЕДМЕТЫ
        $subjects = [
            ['id' => 1, 'name' => 'Mathematics'],
            ['id' => 2, 'name' => 'Physics'],
            ['id' => 3, 'name' => 'Chemistry'],
            ['id' => 4, 'name' => 'Biology'],
            ['id' => 5, 'name' => 'Geography'],
            ['id' => 6, 'name' => 'History'],
            ['id' => 7, 'name' => 'English'],
            ['id' => 8, 'name' => 'Literature'],
            ['id' => 9, 'name' => 'Physical Education'],
            ['id' => 10, 'name' => 'Music'],
            ['id' => 11, 'name' => 'Art'],
            ['id' => 12, 'name' => 'Computer Science'],
        ];

        DB::connection('sandbox_template')->table('subjects')->insert($subjects);

        // 3. УЧИТЕЛЯ
        $teachers = [
            ['id' => 1, 'first_name' => 'Anna', 'last_name' => 'Smith'],
            ['id' => 2, 'first_name' => 'John', 'last_name' => 'Johnson'],
            ['id' => 3, 'first_name' => 'Mary', 'last_name' => 'Williams'],
            ['id' => 4, 'first_name' => 'Robert', 'last_name' => 'Brown'],
            ['id' => 5, 'first_name' => 'Patricia', 'last_name' => 'Jones'],
            ['id' => 6, 'first_name' => 'Michael', 'last_name' => 'Garcia'],
            ['id' => 7, 'first_name' => 'Linda', 'last_name' => 'Miller'],
            ['id' => 8, 'first_name' => 'David', 'last_name' => 'Davis'],
            ['id' => 9, 'first_name' => 'Barbara', 'last_name' => 'Rodriguez'],
            ['id' => 10, 'first_name' => 'William', 'last_name' => 'Martinez'],
            ['id' => 11, 'first_name' => 'Elizabeth', 'last_name' => 'Hernandez'],
            ['id' => 12, 'first_name' => 'Richard', 'last_name' => 'Lopez'],
            ['id' => 13, 'first_name' => 'Susan', 'last_name' => 'Gonzalez'],
            ['id' => 14, 'first_name' => 'Joseph', 'last_name' => 'Wilson'],
            ['id' => 15, 'first_name' => 'Jessica', 'last_name' => 'Anderson'],
        ];

        DB::connection('sandbox_template')->table('teachers')->insert($teachers);

        // 4. УЧЕНИКИ
        $students = [
            ['id' => 1, 'first_name' => 'Emma', 'last_name' => 'Thomas', 'birthday' => '2010-05-15', 'address' => '123 Oak Street'],
            ['id' => 2, 'first_name' => 'Liam', 'last_name' => 'Taylor', 'birthday' => '2010-08-22', 'address' => '456 Pine Avenue'],
            ['id' => 3, 'first_name' => 'Olivia', 'last_name' => 'Moore', 'birthday' => '2011-03-10', 'address' => '789 Elm Road'],
            ['id' => 4, 'first_name' => 'Noah', 'last_name' => 'Jackson', 'birthday' => '2010-12-05', 'address' => '321 Maple Drive'],
            ['id' => 5, 'first_name' => 'Ava', 'last_name' => 'Martin', 'birthday' => '2011-07-18', 'address' => '654 Cedar Lane'],
            ['id' => 6, 'first_name' => 'Ethan', 'last_name' => 'Lee', 'birthday' => '2009-04-25', 'address' => '987 Birch Court'],
            ['id' => 7, 'first_name' => 'Sophia', 'last_name' => 'Perez', 'birthday' => '2009-11-30', 'address' => '147 Willow Street'],
            ['id' => 8, 'first_name' => 'Mason', 'last_name' => 'White', 'birthday' => '2010-06-14', 'address' => '258 Spruce Avenue'],
            ['id' => 9, 'first_name' => 'Isabella', 'last_name' => 'Harris', 'birthday' => '2011-01-20', 'address' => '369 Ash Road'],
            ['id' => 10, 'first_name' => 'Lucas', 'last_name' => 'Clark', 'birthday' => '2009-09-08', 'address' => '741 Poplar Drive'],
            ['id' => 11, 'first_name' => 'Mia', 'last_name' => 'Lewis', 'birthday' => '2010-02-28', 'address' => '852 Beech Lane'],
            ['id' => 12, 'first_name' => 'Oliver', 'last_name' => 'Walker', 'birthday' => '2011-10-12', 'address' => '963 Fir Court'],
            ['id' => 13, 'first_name' => 'Charlotte', 'last_name' => 'Hall', 'birthday' => '2009-07-05', 'address' => '159 Palm Street'],
            ['id' => 14, 'first_name' => 'James', 'last_name' => 'Allen', 'birthday' => '2010-11-19', 'address' => '357 Hickory Avenue'],
            ['id' => 15, 'first_name' => 'Amelia', 'last_name' => 'Young', 'birthday' => '2011-04-03', 'address' => '753 Walnut Road'],
            ['id' => 16, 'first_name' => 'Benjamin', 'last_name' => 'King', 'birthday' => '2009-12-16', 'address' => '951 Cherry Drive'],
            ['id' => 17, 'first_name' => 'Harper', 'last_name' => 'Wright', 'birthday' => '2010-09-27', 'address' => '246 Magnolia Lane'],
            ['id' => 18, 'first_name' => 'Elijah', 'last_name' => 'Scott', 'birthday' => '2011-06-11', 'address' => '468 Sycamore Court'],
            ['id' => 19, 'first_name' => 'Evelyn', 'last_name' => 'Green', 'birthday' => '2009-03-22', 'address' => '579 Cypress Street'],
            ['id' => 20, 'first_name' => 'Alexander', 'last_name' => 'Baker', 'birthday' => '2010-01-09', 'address' => '135 Redwood Avenue'],
        ];

        DB::connection('sandbox_template')->table('students')->insert($students);

        // 5. РАСПРЕДЕЛЕНИЕ УЧЕНИКОВ ПО КЛАССАМ
        $studentInClass = [
            // 9a класс
            ['student_id' => 1, 'class_id' => 17],
            ['student_id' => 2, 'class_id' => 17],
            ['student_id' => 3, 'class_id' => 17],
            ['student_id' => 4, 'class_id' => 17],
            ['student_id' => 5, 'class_id' => 17],

            // 9b класс
            ['student_id' => 6, 'class_id' => 18],
            ['student_id' => 7, 'class_id' => 18],
            ['student_id' => 8, 'class_id' => 18],
            ['student_id' => 9, 'class_id' => 18],
            ['student_id' => 10, 'class_id' => 18],

            // 10a класс
            ['student_id' => 11, 'class_id' => 19],
            ['student_id' => 12, 'class_id' => 19],
            ['student_id' => 13, 'class_id' => 19],
            ['student_id' => 14, 'class_id' => 19],

            // 10b класс
            ['student_id' => 15, 'class_id' => 20],
            ['student_id' => 16, 'class_id' => 20],
            ['student_id' => 17, 'class_id' => 20],

            // 11a класс
            ['student_id' => 18, 'class_id' => 21],
            ['student_id' => 19, 'class_id' => 21],
            ['student_id' => 20, 'class_id' => 21],
        ];

        DB::connection('sandbox_template')->table('student_in_class')->insert($studentInClass);

        // 6. РАСПИСАНИЕ (schedules) - уроки на неделю
        $schedules = [
            // Понедельник 2024-09-02
            ['class_id' => 17, 'teacher_id' => 1, 'subject_id' => 1, 'lesson_date' => '2024-09-02 08:00:00'],
            ['class_id' => 17, 'teacher_id' => 2, 'subject_id' => 2, 'lesson_date' => '2024-09-02 09:00:00'],
            ['class_id' => 17, 'teacher_id' => 7, 'subject_id' => 7, 'lesson_date' => '2024-09-02 10:00:00'],
            ['class_id' => 18, 'teacher_id' => 1, 'subject_id' => 1, 'lesson_date' => '2024-09-02 08:00:00'],
            ['class_id' => 18, 'teacher_id' => 3, 'subject_id' => 3, 'lesson_date' => '2024-09-02 09:00:00'],
            ['class_id' => 19, 'teacher_id' => 4, 'subject_id' => 2, 'lesson_date' => '2024-09-02 08:00:00'],
            ['class_id' => 19, 'teacher_id' => 12, 'subject_id' => 12, 'lesson_date' => '2024-09-02 09:00:00'],

            // Вторник 2024-09-03
            ['class_id' => 17, 'teacher_id' => 3, 'subject_id' => 3, 'lesson_date' => '2024-09-03 08:00:00'],
            ['class_id' => 17, 'teacher_id' => 4, 'subject_id' => 4, 'lesson_date' => '2024-09-03 09:00:00'],
            ['class_id' => 17, 'teacher_id' => 8, 'subject_id' => 8, 'lesson_date' => '2024-09-03 10:00:00'],
            ['class_id' => 18, 'teacher_id' => 5, 'subject_id' => 5, 'lesson_date' => '2024-09-03 08:00:00'],
            ['class_id' => 18, 'teacher_id' => 6, 'subject_id' => 6, 'lesson_date' => '2024-09-03 09:00:00'],
            ['class_id' => 19, 'teacher_id' => 1, 'subject_id' => 1, 'lesson_date' => '2024-09-03 08:00:00'],
            ['class_id' => 19, 'teacher_id' => 7, 'subject_id' => 7, 'lesson_date' => '2024-09-03 09:00:00'],

            // Среда 2024-09-04
            ['class_id' => 17, 'teacher_id' => 9, 'subject_id' => 9, 'lesson_date' => '2024-09-04 08:00:00'],
            ['class_id' => 17, 'teacher_id' => 5, 'subject_id' => 5, 'lesson_date' => '2024-09-04 09:00:00'],
            ['class_id' => 17, 'teacher_id' => 6, 'subject_id' => 6, 'lesson_date' => '2024-09-04 10:00:00'],
            ['class_id' => 18, 'teacher_id' => 2, 'subject_id' => 2, 'lesson_date' => '2024-09-04 08:00:00'],
            ['class_id' => 18, 'teacher_id' => 8, 'subject_id' => 8, 'lesson_date' => '2024-09-04 09:00:00'],
            ['class_id' => 19, 'teacher_id' => 3, 'subject_id' => 3, 'lesson_date' => '2024-09-04 08:00:00'],
            ['class_id' => 19, 'teacher_id' => 4, 'subject_id' => 4, 'lesson_date' => '2024-09-04 09:00:00'],

            // Четверг 2024-09-05
            ['class_id' => 17, 'teacher_id' => 12, 'subject_id' => 12, 'lesson_date' => '2024-09-05 08:00:00'],
            ['class_id' => 17, 'teacher_id' => 1, 'subject_id' => 1, 'lesson_date' => '2024-09-05 09:00:00'],
            ['class_id' => 18, 'teacher_id' => 4, 'subject_id' => 4, 'lesson_date' => '2024-09-05 08:00:00'],
            ['class_id' => 18, 'teacher_id' => 9, 'subject_id' => 9, 'lesson_date' => '2024-09-05 09:00:00'],
            ['class_id' => 19, 'teacher_id' => 5, 'subject_id' => 5, 'lesson_date' => '2024-09-05 08:00:00'],
            ['class_id' => 19, 'teacher_id' => 6, 'subject_id' => 6, 'lesson_date' => '2024-09-05 09:00:00'],

            // Пятница 2024-09-06
            ['class_id' => 17, 'teacher_id' => 10, 'subject_id' => 10, 'lesson_date' => '2024-09-06 08:00:00'],
            ['class_id' => 17, 'teacher_id' => 11, 'subject_id' => 11, 'lesson_date' => '2024-09-06 09:00:00'],
            ['class_id' => 18, 'teacher_id' => 7, 'subject_id' => 7, 'lesson_date' => '2024-09-06 08:00:00'],
            ['class_id' => 18, 'teacher_id' => 12, 'subject_id' => 12, 'lesson_date' => '2024-09-06 09:00:00'],
            ['class_id' => 19, 'teacher_id' => 8, 'subject_id' => 8, 'lesson_date' => '2024-09-06 08:00:00'],
            ['class_id' => 19, 'teacher_id' => 9, 'subject_id' => 9, 'lesson_date' => '2024-09-06 09:00:00'],
        ];

        DB::connection('sandbox_template')->table('schedules')->insert($schedules);

        // 7. ОЦЕНКИ (marks)
        $marks = [
            // Математика
            ['student_id' => 1, 'subject_id' => 1, 'mark' => 5, 'mark_date' => '2024-09-02'],
            ['student_id' => 2, 'subject_id' => 1, 'mark' => 4, 'mark_date' => '2024-09-02'],
            ['student_id' => 3, 'subject_id' => 1, 'mark' => 5, 'mark_date' => '2024-09-02'],
            ['student_id' => 4, 'subject_id' => 1, 'mark' => 3, 'mark_date' => '2024-09-02'],
            ['student_id' => 5, 'subject_id' => 1, 'mark' => 4, 'mark_date' => '2024-09-02'],

            // Физика
            ['student_id' => 1, 'subject_id' => 2, 'mark' => 4, 'mark_date' => '2024-09-03'],
            ['student_id' => 2, 'subject_id' => 2, 'mark' => 5, 'mark_date' => '2024-09-03'],
            ['student_id' => 6, 'subject_id' => 2, 'mark' => 4, 'mark_date' => '2024-09-04'],
            ['student_id' => 7, 'subject_id' => 2, 'mark' => 3, 'mark_date' => '2024-09-04'],

            // Химия
            ['student_id' => 3, 'subject_id' => 3, 'mark' => 5, 'mark_date' => '2024-09-03'],
            ['student_id' => 8, 'subject_id' => 3, 'mark' => 4, 'mark_date' => '2024-09-04'],
            ['student_id' => 11, 'subject_id' => 3, 'mark' => 5, 'mark_date' => '2024-09-04'],

            // Биология
            ['student_id' => 4, 'subject_id' => 4, 'mark' => 4, 'mark_date' => '2024-09-03'],
            ['student_id' => 9, 'subject_id' => 4, 'mark' => 5, 'mark_date' => '2024-09-05'],
            ['student_id' => 12, 'subject_id' => 4, 'mark' => 4, 'mark_date' => '2024-09-04'],

            // Английский
            ['student_id' => 1, 'subject_id' => 7, 'mark' => 5, 'mark_date' => '2024-09-02'],
            ['student_id' => 2, 'subject_id' => 7, 'mark' => 5, 'mark_date' => '2024-09-02'],
            ['student_id' => 3, 'subject_id' => 7, 'mark' => 4, 'mark_date' => '2024-09-02'],
            ['student_id' => 14, 'subject_id' => 7, 'mark' => 5, 'mark_date' => '2024-09-03'],

            // Computer Science
            ['student_id' => 5, 'subject_id' => 12, 'mark' => 5, 'mark_date' => '2024-09-05'],
            ['student_id' => 11, 'subject_id' => 12, 'mark' => 4, 'mark_date' => '2024-09-02'],
            ['student_id' => 12, 'subject_id' => 12, 'mark' => 5, 'mark_date' => '2024-09-05'],
        ];

        DB::connection('sandbox_template')->table('marks')->insert($marks);

        $this->command->info('✅ School data seeded successfully!');
    }
}
