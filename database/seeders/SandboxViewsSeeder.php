<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SandboxViewsSeeder extends Seeder
{
    public function run(): void
    {
        $connection = 'sandbox_template';

        $views = [
            // ✈️ Airlines
            'PassengerView'        => 'passengers',
            'CompanyView'          => 'companies',
            'TripView'             => 'trips',

            // 👨‍👩‍👧 Family
            'FamilyMembersView'    => 'family_members',
            'GoodsView'            => 'goods',
            'GoodTypesView'        => 'good_types',
            'PaymentsView'         => 'payments',

            // 🏫 School
            'ClassView'            => 'classes',
            'StudentView'          => 'students',
            'Student_in_classView' => 'student_in_class',
            'ScheduleView'         => 'schedules',
            'SubjectView'          => 'subjects',
            'TeacherView'          => 'teachers',

            // 🏠 Booking
            'RoomsView'            => 'housing_rooms',
            'UsersView'            => 'housing_users',
            'ReservationsView'     => 'reservations',
            'ReviewsView'          => 'reviews',
        ];

        foreach ($views as $viewName => $tableName) {
            DB::connection($connection)->statement(
                "CREATE OR REPLACE VIEW `{$viewName}` AS SELECT * FROM `{$tableName}`"
            );

            echo "✅ VIEW {$viewName} → {$tableName}\n";
        }

        // 🕐 Timepair — проверяем, есть ли таблица
        $this->createTimepairIfNeeded($connection);
    }

    private function createTimepairIfNeeded(string $connection): void
    {
        // Проверяем существует ли таблица timepair/timepairs
        $tables = collect(DB::connection($connection)->select('SHOW TABLES'))
            ->map(fn($t) => array_values((array)$t)[0])
            ->toArray();

        if (in_array('timepairs', $tables)) {
            DB::connection($connection)->statement(
                "CREATE OR REPLACE VIEW `Timepair` AS SELECT * FROM `timepairs`"
            );

            echo "✅ VIEW Timepair → timepairs\n";
            return;
        }

        if (in_array('Timepair', $tables) || in_array('timepair', $tables)) {
            echo "✅ Timepair уже существует\n";
            return;
        }

        // ❌ Таблицы нет — создаём
        echo "⚠️ Таблица Timepair не найдена. Создаём...\n";

        DB::connection($connection)->statement("
            CREATE TABLE IF NOT EXISTS `Timepair` (
                `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                `start_pair` TIME NOT NULL,
                `end_pair` TIME NOT NULL
            )
        ");

        // Стандартное расписание уроков
        DB::connection($connection)->table('Timepair')->insert([
            ['id' => 1, 'start_pair' => '08:30:00', 'end_pair' => '09:15:00'],
            ['id' => 2, 'start_pair' => '09:25:00', 'end_pair' => '10:10:00'],
            ['id' => 3, 'start_pair' => '10:20:00', 'end_pair' => '11:05:00'],
            ['id' => 4, 'start_pair' => '11:15:00', 'end_pair' => '12:00:00'],
            ['id' => 5, 'start_pair' => '13:00:00', 'end_pair' => '13:45:00'],
            ['id' => 6, 'start_pair' => '13:55:00', 'end_pair' => '14:40:00'],
        ]);

        echo "✅ Таблица Timepair создана с данными\n";
    }
}
