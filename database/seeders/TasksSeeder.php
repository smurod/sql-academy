<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TasksSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $this->ensureDependencies($now);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('tasks')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $tasks = $this->getTasks($now);

        foreach (array_chunk($tasks, 10) as $chunk) {
            DB::table('tasks')->insert($chunk);
        }

        echo "✅ Вставлено " . count($tasks) . " задач\n";
    }

    private function ensureDependencies(Carbon $now): void
    {
        if (!DB::table('users')->where('id', 1)->exists()) {
            DB::table('users')->insert([
                'id'         => 1,
                'name'       => 'Admin',
                'email'      => 'admin@sqlacademy.test',
                'password'   => bcrypt('password'),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            echo "👤 Создан пользователь Admin (id=1)\n";
        }
    }

    private function task(
        int     $id,
        int     $taskNumber,
        ?int    $lessonId,
        string  $title,
        string  $description,
        string  $taskText,
        string  $schema,
        string  $solutionSql,
        int     $difficultyPercent,
        bool    $isFree,
        string  $hint,
        int     $points,
        string  $sqlType,
        int     $taskOrder,
        Carbon  $now
    ): array {
        return [
            'id'                => $id,
            'task_number'       => $taskNumber,
            'lesson_id'         => $lessonId,
            'author_id'         => 1,
            'title'             => $title,
            'description'       => $description,
            'task_text'         => $taskText,
            'database_schema'   => $schema,
            'solution_sql'      => $solutionSql,
            'expected_results'  => json_encode([]),
            'difficulty_percent'=> $difficultyPercent,
            'is_free'           => $isFree,
            'hint'              => $hint,
            'points'            => $points,
            'sql_type'          => $sqlType,
            'task_order'        => $taskOrder,
            'created_at'        => $now,
            'updated_at'        => $now,
        ];
    }

    private function getTasks(Carbon $now): array
    {
        return [

            // ================================================================
            //  №1-4 — Простой SELECT, WHERE, LIKE
            //  Схема: aviation | Привязка: Оператор SELECT (lesson 6)
            // ================================================================

            $this->task(
                id: 1,
                taskNumber: 1,
                lessonId: 6,    // Оператор SELECT
                title: 'Имена пассажиров',
                description: 'Простой SELECT из одной таблицы',
                taskText: 'Вывести имена всех когда-либо обслуживаемых пассажиров авиакомпаний.',
                schema: 'aviation',
                solutionSql: 'SELECT name FROM Passenger;',
                difficultyPercent: 5,
                isFree: true,
                hint: 'Используйте SELECT name FROM имя_таблицы',
                points: 5,
                sqlType: 'select',
                taskOrder: 1,
                now: $now
            ),

            $this->task(
                id: 2,
                taskNumber: 2,
                lessonId: 6,    // Оператор SELECT
                title: 'Названия авиакомпаний',
                description: 'Простой SELECT из одной таблицы',
                taskText: 'Вывести названия всех авиакомпаний.',
                schema: 'aviation',
                solutionSql: 'SELECT name FROM Company;',
                difficultyPercent: 5,
                isFree: true,
                hint: 'Таблица Company содержит названия компаний',
                points: 5,
                sqlType: 'select',
                taskOrder: 2,
                now: $now
            ),

            $this->task(
                id: 3,
                taskNumber: 3,
                lessonId: 7,    // Оператор WHERE
                title: 'Рейсы из Москвы',
                description: 'SELECT с условием WHERE',
                taskText: 'Вывести все рейсы, совершенные из Москвы.',
                schema: 'aviation',
                solutionSql: "SELECT * FROM Trip WHERE town_from = 'Moscow';",
                difficultyPercent: 10,
                isFree: true,
                hint: "Используйте WHERE town_from = 'Moscow'",
                points: 5,
                sqlType: 'select',
                taskOrder: 3,
                now: $now
            ),

            $this->task(
                id: 4,
                taskNumber: 4,
                lessonId: 11,   // Оператор LIKE
                title: 'Имена на "man"',
                description: 'SELECT с оператором LIKE',
                taskText: 'Вывести имена людей, которые заканчиваются на "man".',
                schema: 'aviation',
                solutionSql: "SELECT name FROM Passenger WHERE name LIKE '%man';",
                difficultyPercent: 10,
                isFree: true,
                hint: "Используйте LIKE '%man'",
                points: 5,
                sqlType: 'select',
                taskOrder: 4,
                now: $now
            ),

            // ================================================================
            //  №5-7 — COUNT, DISTINCT, JOIN
            //  Схема: aviation
            // ================================================================

            $this->task(
                id: 5,
                taskNumber: 5,
                lessonId: 15,   // Агрегатные функции
                title: 'Количество рейсов на TU-134',
                description: 'Агрегатная функция COUNT с WHERE',
                taskText: 'Вывести количество рейсов, совершенных на TU-134.',
                schema: 'aviation',
                solutionSql: "SELECT COUNT(*) AS count FROM Trip WHERE plane = 'TU-134';",
                difficultyPercent: 15,
                isFree: true,
                hint: "COUNT(*) считает строки, WHERE plane = 'TU-134' фильтрует",
                points: 10,
                sqlType: 'select',
                taskOrder: 5,
                now: $now
            ),

            $this->task(
                id: 6,
                taskNumber: 6,
                lessonId: 20,   // INNER JOIN
                title: 'Компании на Boeing',
                description: 'JOIN двух таблиц с DISTINCT',
                taskText: 'Какие компании совершали перелеты на Boeing?',
                schema: 'aviation',
                solutionSql: "SELECT DISTINCT Company.name FROM Company JOIN Trip ON Company.id = Trip.company WHERE Trip.plane = 'Boeing';",
                difficultyPercent: 25,
                isFree: true,
                hint: 'Нужен JOIN между Trip и Company, фильтр по plane',
                points: 10,
                sqlType: 'select',
                taskOrder: 6,
                now: $now
            ),

            $this->task(
                id: 7,
                taskNumber: 7,
                lessonId: 18,   // DISTINCT
                title: 'Самолёты в Москву',
                description: 'SELECT DISTINCT с WHERE',
                taskText: 'Вывести все названия самолётов, на которых можно улететь в Москву (Moscow).',
                schema: 'aviation',
                solutionSql: "SELECT DISTINCT plane FROM Trip WHERE town_to = 'Moscow';",
                difficultyPercent: 15,
                isFree: true,
                hint: "WHERE town_to = 'Moscow' + DISTINCT",
                points: 10,
                sqlType: 'select',
                taskOrder: 7,
                now: $now
            ),

            // ================================================================
            //  №8-10 — Функции даты/времени, BETWEEN
            //  Схема: aviation
            // ================================================================

            $this->task(
                id: 8,
                taskNumber: 8,
                lessonId: 35,   // Функции даты и времени
                title: 'Перелёты из Парижа',
                description: 'Функция TIMEDIFF для вычисления разницы времени',
                taskText: 'В какие города можно улететь из Парижа (Paris) и сколько времени это займёт?',
                schema: 'aviation',
                solutionSql: "SELECT town_to, TIMEDIFF(time_in, time_out) AS flight_time FROM Trip WHERE town_from = 'Paris';",
                difficultyPercent: 20,
                isFree: true,
                hint: 'TIMEDIFF(time_in, time_out) вычисляет разницу во времени',
                points: 10,
                sqlType: 'select',
                taskOrder: 8,
                now: $now
            ),

            $this->task(
                id: 9,
                taskNumber: 9,
                lessonId: 20,   // INNER JOIN
                title: 'Компании из Владивостока',
                description: 'JOIN с условием WHERE',
                taskText: 'Какие компании организуют перелёты из Владивостока (Vladivostok)?',
                schema: 'aviation',
                solutionSql: "SELECT DISTINCT Company.name FROM Company JOIN Trip ON Company.id = Trip.company WHERE Trip.town_from = 'Vladivostok';",
                difficultyPercent: 20,
                isFree: true,
                hint: "JOIN Company и Trip, фильтр по town_from = 'Vladivostok'",
                points: 10,
                sqlType: 'select',
                taskOrder: 9,
                now: $now
            ),

            $this->task(
                id: 10,
                taskNumber: 10,
                lessonId: 9,    // Оператор BETWEEN
                title: 'Вылеты 1 января',
                description: 'Фильтрация по диапазону дат с BETWEEN',
                taskText: 'Вывести вылеты, совершенные с 10 ч. по 14 ч. 1 января 1900 г.',
                schema: 'aviation',
                solutionSql: "SELECT * FROM Trip WHERE time_out BETWEEN '1900-01-01T10:00:00.000Z' AND '1900-01-01T14:00:00.000Z';",
                difficultyPercent: 20,
                isFree: true,
                hint: 'Используйте BETWEEN для диапазона дат и времени',
                points: 10,
                sqlType: 'select',
                taskOrder: 10,
                now: $now
            // ⚠️ [ТРЕБУЕТ ПРОВЕРКИ] — формат даты может отличаться.
            // На оригинале может быть '1900-01-01 10:00:00'
            ),

            // ================================================================
            //  №11-16 — ORDER BY, GROUP BY, HAVING, JOIN
            //  Схема: aviation
            // ================================================================

            $this->task(
                id: 11,
                taskNumber: 11,
                lessonId: 13,   // ORDER BY
                title: 'Самое длинное имя',
                description: 'ORDER BY с функцией LENGTH и LIMIT',
                taskText: 'Вывести пассажиров с самым длинным именем. Имя, длину.',
                schema: 'aviation',
                solutionSql: 'SELECT name, LENGTH(name) AS length FROM Passenger ORDER BY length DESC LIMIT 1;',
                difficultyPercent: 20,
                isFree: true,
                hint: 'LENGTH(name) возвращает длину строки, ORDER BY DESC + LIMIT 1',
                points: 10,
                sqlType: 'select',
                taskOrder: 11,
                now: $now
            // ⚠️ [ТРЕБУЕТ ПРОВЕРКИ] — формулировка может быть
            // "Вывести имена пассажиров с самым длинным ФИО"
            // а выводимые поля — только name или name + length
            ),

            $this->task(
                id: 12,
                taskNumber: 12,
                lessonId: 16,   // GROUP BY
                title: 'Пассажиры на рейсах',
                description: 'GROUP BY с COUNT',
                taskText: 'Вывести id и количество пассажиров для всех прошедших полётов.',
                schema: 'aviation',
                solutionSql: 'SELECT trip, COUNT(passenger) AS count FROM Pass_in_trip GROUP BY trip;',
                difficultyPercent: 20,
                isFree: true,
                hint: 'GROUP BY trip + COUNT(passenger)',
                points: 10,
                sqlType: 'select',
                taskOrder: 12,
                now: $now
            ),

            $this->task(
                id: 13,
                taskNumber: 13,
                lessonId: 17,   // HAVING
                title: 'Полные тёзки',
                description: 'GROUP BY с HAVING COUNT > 1',
                taskText: 'Вывести имена людей, у которых есть полный тёзка среди пассажиров.',
                schema: 'aviation',
                solutionSql: 'SELECT name FROM Passenger GROUP BY name HAVING COUNT(*) > 1;',
                difficultyPercent: 25,
                isFree: true,
                hint: 'GROUP BY name + HAVING COUNT(*) > 1 находит дубликаты',
                points: 15,
                sqlType: 'select',
                taskOrder: 13,
                now: $now
            ),

            $this->task(
                id: 14,
                taskNumber: 14,
                lessonId: 20,   // INNER JOIN
                title: 'Города Брюса Уиллиса',
                description: 'Тройной JOIN трёх таблиц',
                taskText: 'В какие города летал Bruce Willis?',
                schema: 'aviation',
                solutionSql: "SELECT town_to FROM Trip JOIN Pass_in_trip ON Trip.id = Pass_in_trip.trip JOIN Passenger ON Passenger.id = Pass_in_trip.passenger WHERE Passenger.name = 'Bruce Willis';",
                difficultyPercent: 30,
                isFree: true,
                hint: 'JOIN трёх таблиц: Trip ↔ Pass_in_trip ↔ Passenger',
                points: 15,
                sqlType: 'select',
                taskOrder: 14,
                now: $now
            ),

            $this->task(
                id: 15,
                taskNumber: 15,
                lessonId: 20,   // INNER JOIN
                title: 'Стив Мартин в Лондоне',
                description: 'JOIN с двумя условиями WHERE',
                taskText: 'Выведите дату и время прилёта пассажира Стив Мартин (Steve Martin) в Лондон (London).',
                schema: 'aviation',
                solutionSql: "SELECT time_in FROM Trip JOIN Pass_in_trip ON Trip.id = Pass_in_trip.trip JOIN Passenger ON Passenger.id = Pass_in_trip.passenger WHERE Passenger.name = 'Steve Martin' AND Trip.town_to = 'London';",
                difficultyPercent: 30,
                isFree: true,
                hint: "Добавьте AND town_to = 'London' к запросу задачи 14",
                points: 15,
                sqlType: 'select',
                taskOrder: 15,
                now: $now
            ),

            $this->task(
                id: 16,
                taskNumber: 16,
                lessonId: 17,   // HAVING
                title: 'Рейтинг пассажиров',
                description: 'JOIN + GROUP BY + HAVING + ORDER BY',
                taskText: 'Вывести отсортированный по количеству перелетов (по убыванию) и имени (по возрастанию) список пассажиров, совершивших хотя бы 1 полет.',
                schema: 'aviation',
                solutionSql: "SELECT Passenger.name, COUNT(*) AS count FROM Pass_in_trip JOIN Passenger ON Passenger.id = Pass_in_trip.passenger GROUP BY Passenger.name HAVING count >= 1 ORDER BY count DESC, Passenger.name ASC;",
                difficultyPercent: 35,
                isFree: true,
                hint: 'GROUP BY + HAVING + ORDER BY вместе',
                points: 20,
                sqlType: 'select',
                taskOrder: 16,
                now: $now
            ),

            // ================================================================
            //  №17-24 — Семейная база данных
            //  Схема: family
            // ================================================================

            $this->task(
                id: 17,
                taskNumber: 17,
                lessonId: 15,   // Агрегатные функции
                title: 'Расходы за 2005 год',
                description: 'JOIN + SUM + GROUP BY + фильтр по дате',
                taskText: 'Определить, сколько потратил в 2005 году каждый из членов семьи. В результирующей выборке не выводите тех членов семьи, которые ничего не потратили.',
                schema: 'family',
                solutionSql: "SELECT member_name, status, SUM(unit_price * amount) AS costs FROM FamilyMembers JOIN Payments ON FamilyMembers.member_id = Payments.family_member WHERE YEAR(date) = 2005 GROUP BY member_id, member_name, status;",
                difficultyPercent: 30,
                isFree: true,
                hint: 'JOIN Payments и FamilyMembers, SUM для суммы, GROUP BY для группировки',
                points: 15,
                sqlType: 'select',
                taskOrder: 17,
                now: $now
            ),

            $this->task(
                id: 18,
                taskNumber: 18,
                lessonId: 15,   // Агрегатные функции
                title: 'Самый старший',
                description: 'Подзапрос с MIN',
                taskText: 'Выведите имя самого старшего человека. Вывести имя и дату рождения.',
                schema: 'family',
                solutionSql: 'SELECT member_name FROM FamilyMembers WHERE birthday = (SELECT MIN(birthday) FROM FamilyMembers);',
                difficultyPercent: 20,
                isFree: true,
                hint: 'MIN(birthday) — самая ранняя дата рождения = самый старший',
                points: 10,
                sqlType: 'select',
                taskOrder: 18,
                now: $now
            // ⚠️ [ТРЕБУЕТ ПРОВЕРКИ] — выводимые поля могут быть
            // только member_name, или member_name + birthday
            ),

            $this->task(
                id: 19,
                taskNumber: 19,
                lessonId: 20,   // INNER JOIN
                title: 'Кто покупал картошку',
                description: 'Тройной JOIN с DISTINCT',
                taskText: 'Определить, кто из членов семьи покупал картошку (potato).',
                schema: 'family',
                solutionSql: "SELECT DISTINCT status FROM FamilyMembers JOIN Payments ON FamilyMembers.member_id = Payments.family_member JOIN Goods ON Payments.good = Goods.good_id WHERE Goods.good_name = 'potato';",
                difficultyPercent: 30,
                isFree: true,
                hint: 'JOIN трёх таблиц + фильтр по good_name',
                points: 15,
                sqlType: 'select',
                taskOrder: 19,
                now: $now
            ),

            $this->task(
                id: 20,
                taskNumber: 20,
                lessonId: 20,   // INNER JOIN
                title: 'Расходы на развлечения',
                description: 'Четверной JOIN с SUM и GROUP BY',
                taskText: 'Сколько и кто из семьи потратил на развлечения (entertainment). Вывести статус в семье, имя, сумму.',
                schema: 'family',
                solutionSql: "SELECT status, member_name, SUM(unit_price * amount) AS costs FROM FamilyMembers JOIN Payments ON FamilyMembers.member_id = Payments.family_member JOIN Goods ON Payments.good = Goods.good_id JOIN GoodTypes ON Goods.type = GoodTypes.good_type_id WHERE GoodTypes.good_type_name = 'entertainment' GROUP BY member_id, status, member_name;",
                difficultyPercent: 35,
                isFree: true,
                hint: 'JOIN четырёх таблиц + WHERE good_type_name + SUM',
                points: 20,
                sqlType: 'select',
                taskOrder: 20,
                now: $now
            ),

            $this->task(
                id: 21,
                taskNumber: 21,
                lessonId: 17,   // HAVING
                title: 'Товары куплены > 1 раза',
                description: 'GROUP BY + HAVING COUNT > 1',
                taskText: 'Определить товары, которые покупали более 1 раза.',
                schema: 'family',
                solutionSql: 'SELECT good_name FROM Goods JOIN Payments ON Goods.good_id = Payments.good GROUP BY good_name HAVING COUNT(*) > 1;',
                difficultyPercent: 25,
                isFree: true,
                hint: 'GROUP BY + HAVING COUNT(*) > 1',
                points: 15,
                sqlType: 'select',
                taskOrder: 21,
                now: $now
            ),

            $this->task(
                id: 22,
                taskNumber: 22,
                lessonId: 7,    // WHERE
                title: 'Все матери',
                description: 'Простой WHERE по статусу',
                taskText: 'Найти имена всех матерей (mother).',
                schema: 'family',
                solutionSql: "SELECT member_name FROM FamilyMembers WHERE status = 'mother';",
                difficultyPercent: 5,
                isFree: true,
                hint: "WHERE status = 'mother'",
                points: 5,
                sqlType: 'select',
                taskOrder: 22,
                now: $now
            ),

            $this->task(
                id: 23,
                taskNumber: 23,
                lessonId: 20,   // INNER JOIN
                title: 'Самый дешёвый деликатес',
                description: 'JOIN + MIN или ORDER BY + LIMIT',
                taskText: 'Найдите самый дешёвый деликатес, стоимость и название товара. Под деликатесом мы подразумеваем тип товара "delicacies".',
                schema: 'family',
                solutionSql: "SELECT good_name, unit_price FROM Payments JOIN Goods ON Payments.good = Goods.good_id JOIN GoodTypes ON Goods.type = GoodTypes.good_type_id WHERE GoodTypes.good_type_name = 'delicacies' ORDER BY unit_price LIMIT 1;",
                difficultyPercent: 25,
                isFree: true,
                hint: "JOIN трёх таблиц + WHERE good_type_name = 'delicacies' + ORDER BY + LIMIT",
                points: 15,
                sqlType: 'select',
                taskOrder: 23,
                now: $now
            // ⚠️ [ТРЕБУЕТ ПРОВЕРКИ] — формулировка может быть
            // "Найти самый дешёвый деликатес" или "Найти первый купленный деликатес"
            ),

            $this->task(
                id: 24,
                taskNumber: 24,
                lessonId: 35,   // Функции даты и времени
                title: 'Расходы за июнь 2005',
                description: 'SUM + фильтр по году и месяцу',
                taskText: 'Определить, кто и сколько потратил в июне 2005.',
                schema: 'family',
                solutionSql: "SELECT member_name, SUM(unit_price * amount) AS costs FROM FamilyMembers JOIN Payments ON FamilyMembers.member_id = Payments.family_member WHERE YEAR(date) = 2005 AND MONTH(date) = 6 GROUP BY member_id, member_name;",
                difficultyPercent: 30,
                isFree: true,
                hint: 'YEAR(date) = 2005 AND MONTH(date) = 6',
                points: 15,
                sqlType: 'select',
                taskOrder: 24,
                now: $now
            ),

            $this->task(
                id: 25,
                taskNumber: 25,
                lessonId: 21,   // LEFT/RIGHT JOIN
                title: 'Непокупавшиеся товары 2005',
                description: 'LEFT JOIN + IS NULL',
                taskText: 'Определить, какие товары имеются в таблице Goods, но не покупались в течение 2005 года.',
                schema: 'family',
                solutionSql: "SELECT good_name FROM Goods LEFT JOIN Payments ON Goods.good_id = Payments.good AND YEAR(Payments.date) = 2005 WHERE Payments.good IS NULL;",
                difficultyPercent: 40,
                isFree: true,
                hint: 'LEFT JOIN + условие в ON + WHERE ... IS NULL',
                points: 20,
                sqlType: 'select',
                taskOrder: 25,
                now: $now
            ),

            // ================================================================
            //  №26-27 — Семейная база: подзапросы, группировка по типам
            //  Схема: family
            // ================================================================

            $this->task(
                id: 26,
                taskNumber: 26,
                lessonId: 24,   // Вложенные подзапросы
                title: 'Группы без покупок в 2005',
                description: 'NOT IN с подзапросом',
                taskText: 'Определить группы товаров, которые не приобретались в 2005 году.',
                schema: 'family',
                solutionSql: "SELECT good_type_name FROM GoodTypes WHERE good_type_id NOT IN (SELECT DISTINCT type FROM Goods JOIN Payments ON Goods.good_id = Payments.good WHERE YEAR(date) = 2005);",
                difficultyPercent: 45,
                isFree: true,
                hint: 'NOT IN + подзапрос, который находит типы купленные в 2005',
                points: 25,
                sqlType: 'select',
                taskOrder: 26,
                now: $now
            ),

            $this->task(
                id: 27,
                taskNumber: 27,
                lessonId: 16,   // GROUP BY
                title: 'Расходы по группам за 2005',
                description: 'Тройной JOIN + SUM + GROUP BY',
                taskText: 'Узнать, сколько потрачено на каждую из групп товаров в 2005 году. Вывести название группы и сумму.',
                schema: 'family',
                solutionSql: "SELECT good_type_name, SUM(amount * unit_price) AS costs FROM GoodTypes JOIN Goods ON GoodTypes.good_type_id = Goods.type JOIN Payments ON Goods.good_id = Payments.good WHERE YEAR(date) = 2005 GROUP BY good_type_name;",
                difficultyPercent: 35,
                isFree: true,
                hint: 'Тройной JOIN + SUM + GROUP BY good_type_name',
                points: 20,
                sqlType: 'select',
                taskOrder: 27,
                now: $now
            ),

            // ================================================================
            //  №28-30 — Авиа: COUNT, DISTINCT, ORDER BY
            //  Схема: aviation
            // ================================================================

            $this->task(
                id: 28,
                taskNumber: 28,
                lessonId: 15,   // Агрегатные функции
                title: 'Рейсы Ростов → Москва',
                description: 'COUNT с двумя условиями WHERE',
                taskText: 'Сколько рейсов совершили авиакомпании из Ростова (Rostov) в Москву (Moscow)?',
                schema: 'aviation',
                solutionSql: "SELECT COUNT(*) AS count FROM Trip WHERE town_from = 'Rostov' AND town_to = 'Moscow';",
                difficultyPercent: 15,
                isFree: true,
                hint: 'COUNT(*) + WHERE с двумя условиями через AND',
                points: 10,
                sqlType: 'select',
                taskOrder: 28,
                now: $now
            ),

            $this->task(
                id: 29,
                taskNumber: 29,
                lessonId: 20,   // INNER JOIN
                title: 'Пассажиры TU-134 в Москву',
                description: 'DISTINCT + тройной JOIN + два условия',
                taskText: 'Выведите имена пассажиров, улетевших в Москву (Moscow) на самолете TU-134.',
                schema: 'aviation',
                solutionSql: "SELECT DISTINCT Passenger.name FROM Passenger JOIN Pass_in_trip ON Passenger.id = Pass_in_trip.passenger JOIN Trip ON Pass_in_trip.trip = Trip.id WHERE Trip.plane = 'TU-134' AND Trip.town_to = 'Moscow';",
                difficultyPercent: 30,
                isFree: true,
                hint: 'JOIN трёх таблиц + DISTINCT + WHERE plane AND town_to',
                points: 15,
                sqlType: 'select',
                taskOrder: 29,
                now: $now
            ),

            $this->task(
                id: 30,
                taskNumber: 30,
                lessonId: 13,   // ORDER BY
                title: 'Нагруженность рейсов',
                description: 'GROUP BY + COUNT + ORDER BY DESC',
                taskText: 'Выведите нагруженность (число пассажиров) каждого рейса (trip). Результат вывести в отсортированном виде по убыванию нагруженности.',
                schema: 'aviation',
                solutionSql: 'SELECT trip, COUNT(passenger) AS count FROM Pass_in_trip GROUP BY trip ORDER BY count DESC;',
                difficultyPercent: 30,
                isFree: true,
                hint: 'GROUP BY trip + ORDER BY COUNT(*) DESC',
                points: 15,
                sqlType: 'select',
                taskOrder: 30,
                now: $now
            ),

            // ================================================================
            //  №31-33 — Семейная база: LIKE, AVG, TIMESTAMPDIFF
            //  Схема: family
            // ================================================================

            $this->task(
                id: 31,
                taskNumber: 31,
                lessonId: 11,   // LIKE
                title: 'Семья Quincey',
                description: 'LIKE для поиска по фамилии',
                taskText: 'Вывести всех членов семьи с фамилией Quincey.',
                schema: 'family',
                solutionSql: "SELECT * FROM FamilyMembers WHERE member_name LIKE '%Quincey';",
                difficultyPercent: 10,
                isFree: true,
                hint: "LIKE '%Quincey' — ищет строки заканчивающиеся на Quincey",
                points: 5,
                sqlType: 'select',
                taskOrder: 31,
                now: $now
            ),

            $this->task(
                id: 32,
                taskNumber: 32,
                lessonId: 15,   // Агрегатные функции
                title: 'Средний возраст',
                description: 'FLOOR + AVG + TIMESTAMPDIFF',
                taskText: 'Вывести средний возраст людей (в годах), хранящихся в базе данных. Результат округлите до целого в меньшую сторону.',
                schema: 'family',
                solutionSql: 'SELECT FLOOR(AVG(TIMESTAMPDIFF(YEAR, birthday, CURDATE()))) AS age FROM FamilyMembers;',
                difficultyPercent: 35,
                isFree: true,
                hint: 'TIMESTAMPDIFF(YEAR, birthday, CURDATE()) вычисляет возраст',
                points: 20,
                sqlType: 'select',
                taskOrder: 32,
                now: $now
            ),

            $this->task(
                id: 33,
                taskNumber: 33,
                lessonId: 15,   // Агрегатные функции
                title: 'Средняя стоимость икры',
                description: 'AVG + JOIN + IN',
                taskText: 'Найдите среднюю стоимость икры. В базе данных хранятся данные о покупках красной (red caviar) и черной икры (black caviar).',
                schema: 'family',
                solutionSql: "SELECT AVG(unit_price) AS cost FROM Payments JOIN Goods ON Payments.good = Goods.good_id WHERE good_name IN ('red caviar', 'black caviar');",
                difficultyPercent: 25,
                isFree: true,
                hint: "AVG + WHERE good_name IN ('red caviar', 'black caviar')",
                points: 15,
                sqlType: 'select',
                taskOrder: 33,
                now: $now
            ),

            // ================================================================
            //  №34-39 — Школьная база: основы
            //  Схема: schedule
            // ================================================================

            $this->task(
                id: 34,
                taskNumber: 34,
                lessonId: 15,   // Агрегатные функции
                title: 'Количество 10-х классов',
                description: 'COUNT + LIKE',
                taskText: 'Сколько всего 10-х классов?',
                schema: 'schedule',
                solutionSql: "SELECT COUNT(*) AS count FROM Class WHERE name LIKE '10%';",
                difficultyPercent: 10,
                isFree: true,
                hint: "COUNT(*) + WHERE name LIKE '10%'",
                points: 5,
                sqlType: 'select',
                taskOrder: 34,
                now: $now
            ),

            $this->task(
                id: 35,
                taskNumber: 35,
                lessonId: 18,   // DISTINCT
                title: 'Кабинеты 2 сентября',
                description: 'COUNT DISTINCT',
                taskText: 'Сколько различных кабинетов школы использовались 2 сентября 2019 в образовательных целях?',
                schema: 'schedule',
                solutionSql: "SELECT COUNT(DISTINCT classroom) AS count FROM Schedule WHERE date = '2019-09-02';",
                difficultyPercent: 15,
                isFree: true,
                hint: 'COUNT(DISTINCT classroom) — считает уникальные кабинеты',
                points: 10,
                sqlType: 'select',
                taskOrder: 35,
                now: $now
            ),

            $this->task(
                id: 36,
                taskNumber: 36,
                lessonId: 11,   // LIKE
                title: 'Улица Пушкина',
                description: 'LIKE для поиска по адресу',
                taskText: 'Выведите информацию об обучающихся живущих на улице Пушкина (ul. Pushkina).',
                schema: 'schedule',
                solutionSql: "SELECT * FROM Student WHERE address LIKE '%Pushkina%';",
                difficultyPercent: 10,
                isFree: true,
                hint: "LIKE '%Pushkina%' — ищет подстроку в адресе",
                points: 5,
                sqlType: 'select',
                taskOrder: 36,
                now: $now
            ),

            $this->task(
                id: 37,
                taskNumber: 37,
                lessonId: 15,   // Агрегатные функции
                title: 'Самый молодой ученик',
                description: 'MIN + TIMESTAMPDIFF',
                taskText: 'Сколько лет самому молодому обучающемуся?',
                schema: 'schedule',
                solutionSql: 'SELECT MIN(TIMESTAMPDIFF(YEAR, birthday, CURDATE())) AS year FROM Student;',
                difficultyPercent: 30,
                isFree: true,
                hint: 'MIN — находит минимальный возраст (= самый молодой)',
                points: 15,
                sqlType: 'select',
                taskOrder: 37,
                now: $now
            ),

            $this->task(
                id: 38,
                taskNumber: 38,
                lessonId: 15,   // Агрегатные функции
                title: 'Сколько Анн',
                description: 'COUNT с условием WHERE',
                taskText: 'Сколько обучающихся родилось в 2000 году?',
                schema: 'schedule',
                solutionSql: "SELECT COUNT(*) AS count FROM Student WHERE YEAR(birthday) = 2000;",
                difficultyPercent: 10,
                isFree: true,
                hint: "COUNT(*) + WHERE YEAR(birthday) = 2000",
                points: 5,
                sqlType: 'select',
                taskOrder: 38,
                now: $now
            // ⚠️ [ТРЕБУЕТ ПРОВЕРКИ] — на оригинале задача №38 может быть
            // "Сколько обучающихся с именем Anna?" или "Сколько обучающихся родилось в 2000?"
            // Обе формулировки встречаются в разных источниках для разных номеров
            ),

            $this->task(
                id: 39,
                taskNumber: 39,
                lessonId: 20,   // INNER JOIN
                title: 'Ученики 10 B',
                description: 'JOIN + COUNT',
                taskText: 'Сколько обучающихся в 10 B классе?',
                schema: 'schedule',
                solutionSql: "SELECT COUNT(*) AS count FROM Student_in_class JOIN Class ON Class.id = Student_in_class.class WHERE Class.name = '10 B';",
                difficultyPercent: 20,
                isFree: true,
                hint: 'JOIN Student_in_class и Class + WHERE name',
                points: 10,
                sqlType: 'select',
                taskOrder: 39,
                now: $now
            ),

            // ================================================================
            //  №40-44 — Школьная база: JOIN продвинутый
            //  Схема: schedule
            // ================================================================

            $this->task(
                id: 40,
                taskNumber: 40,
                lessonId: 20,   // INNER JOIN
                title: 'Предметы Ромашкина',
                description: 'Тройной JOIN + DISTINCT',
                taskText: 'Выведите названия предметов, которые преподает Ромашкин П.П. (Romashkin P.P.)',
                schema: 'schedule',
                solutionSql: "SELECT DISTINCT Subject.name AS subjects FROM Subject JOIN Schedule ON Subject.id = Schedule.subject JOIN Teacher ON Teacher.id = Schedule.teacher WHERE Teacher.last_name = 'Romashkin';",
                difficultyPercent: 30,
                isFree: true,
                hint: 'JOIN Subject ↔ Schedule ↔ Teacher + WHERE last_name',
                points: 15,
                sqlType: 'select',
                taskOrder: 40,
                now: $now
            ),

            $this->task(
                id: 41,
                taskNumber: 41,
                lessonId: 6,    // SELECT
                title: '4-й урок',
                description: 'Простой SELECT по id',
                taskText: 'Во сколько начинается 4-ый учебный предмет по расписанию?',
                schema: 'schedule',
                solutionSql: 'SELECT start_pair FROM Timepair WHERE id = 4;',
                difficultyPercent: 5,
                isFree: true,
                hint: 'WHERE id = 4',
                points: 5,
                sqlType: 'select',
                taskOrder: 41,
                now: $now
            ),

            $this->task(
                id: 42,
                taskNumber: 42,
                lessonId: 35,   // Функции даты и времени
                title: 'Время в школе',
                description: 'TIMEDIFF с подзапросами',
                taskText: 'Сколько времени обучающийся будет находиться в школе, учась со 2-го по 4-ый уч. предмет?',
                schema: 'schedule',
                solutionSql: 'SELECT TIMEDIFF((SELECT end_pair FROM Timepair WHERE id = 4), (SELECT start_pair FROM Timepair WHERE id = 2)) AS time;',
                difficultyPercent: 30,
                isFree: true,
                hint: 'TIMEDIFF(конец 4-го, начало 2-го)',
                points: 15,
                sqlType: 'select',
                taskOrder: 42,
                now: $now
            ),

            $this->task(
                id: 43,
                taskNumber: 43,
                lessonId: 20,   // INNER JOIN
                title: 'Преподаватели физкультуры',
                description: 'Тройной JOIN + ORDER BY',
                taskText: 'Выведите фамилии преподавателей, которые ведут физическую культуру (Physical Culture). Отсортируйте по фамилии в алфавитном порядке.',
                schema: 'schedule',
                solutionSql: "SELECT DISTINCT Teacher.last_name FROM Teacher JOIN Schedule ON Teacher.id = Schedule.teacher JOIN Subject ON Subject.id = Schedule.subject WHERE Subject.name = 'Physical Culture' ORDER BY Teacher.last_name;",
                difficultyPercent: 30,
                isFree: true,
                hint: 'JOIN Teacher ↔ Schedule ↔ Subject + ORDER BY last_name',
                points: 15,
                sqlType: 'select',
                taskOrder: 43,
                now: $now
            ),

            $this->task(
                id: 44,
                taskNumber: 44,
                lessonId: 15,   // Агрегатные функции
                title: 'Макс. возраст 10 классов',
                description: 'MAX + TIMESTAMPDIFF + тройной JOIN',
                taskText: 'Найдите максимальный возраст (количество лет) среди обучающихся 10 классов на сегодняшний день.',
                schema: 'schedule',
                solutionSql: "SELECT MAX(TIMESTAMPDIFF(YEAR, Student.birthday, CURDATE())) AS max_year FROM Student JOIN Student_in_class ON Student.id = Student_in_class.student JOIN Class ON Class.id = Student_in_class.class WHERE Class.name LIKE '10%';",
                difficultyPercent: 35,
                isFree: true,
                hint: 'MAX + TIMESTAMPDIFF + JOIN с фильтром по 10%',
                points: 20,
                sqlType: 'select',
                taskOrder: 44,
                now: $now
            ),

            // ================================================================
            //  №45-50 — Школьная база: продвинутые запросы
            //  Схема: schedule
            // ================================================================

            $this->task(
                id: 45,
                taskNumber: 45,
                lessonId: 24,   // Вложенные подзапросы
                title: 'Самые популярные кабинеты',
                description: 'GROUP BY + HAVING с подзапросом',
                taskText: 'Какой(ие) кабинет(ы) пользуются наибольшей популярностью?',
                schema: 'schedule',
                solutionSql: 'SELECT classroom FROM Schedule GROUP BY classroom HAVING COUNT(*) = (SELECT COUNT(*) AS cnt FROM Schedule GROUP BY classroom ORDER BY cnt DESC LIMIT 1);',
                difficultyPercent: 50,
                isFree: true,
                hint: 'Подзапрос для MAX количества использований + HAVING',
                points: 25,
                sqlType: 'select',
                taskOrder: 45,
                now: $now
            ),

            $this->task(
                id: 46,
                taskNumber: 46,
                lessonId: 20,   // INNER JOIN
                title: 'Классы Краузе',
                description: 'DISTINCT + тройной JOIN',
                taskText: 'В каких классах ведёт занятия преподаватель "Krauze"?',
                schema: 'schedule',
                solutionSql: "SELECT DISTINCT Class.name FROM Class JOIN Schedule ON Class.id = Schedule.class JOIN Teacher ON Teacher.id = Schedule.teacher WHERE Teacher.last_name = 'Krauze';",
                difficultyPercent: 25,
                isFree: true,
                hint: "JOIN Class ↔ Schedule ↔ Teacher + WHERE last_name = 'Krauze'",
                points: 15,
                sqlType: 'select',
                taskOrder: 46,
                now: $now
            ),

            $this->task(
                id: 47,
                taskNumber: 47,
                lessonId: 15,   // Агрегатные функции
                title: 'Занятия Краузе 30 августа',
                description: 'COUNT + JOIN + фильтр по дате',
                taskText: 'Сколько занятий провёл Krauze 30 августа 2019 г.?',
                schema: 'schedule',
                solutionSql: "SELECT COUNT(*) AS count FROM Schedule JOIN Teacher ON Teacher.id = Schedule.teacher WHERE Teacher.last_name = 'Krauze' AND Schedule.date = '2019-08-30';",
                difficultyPercent: 25,
                isFree: true,
                hint: "JOIN + WHERE last_name = 'Krauze' AND date = '2019-08-30'",
                points: 15,
                sqlType: 'select',
                taskOrder: 47,
                now: $now
            ),

            $this->task(
                id: 48,
                taskNumber: 48,
                lessonId: 16,   // GROUP BY
                title: 'Заполненность классов',
                description: 'JOIN + COUNT + ORDER BY DESC',
                taskText: 'Выведите заполненность классов в порядке убывания.',
                schema: 'schedule',
                solutionSql: 'SELECT Class.name, COUNT(Student_in_class.student) AS count FROM Class JOIN Student_in_class ON Class.id = Student_in_class.class GROUP BY Class.name ORDER BY count DESC;',
                difficultyPercent: 30,
                isFree: true,
                hint: 'GROUP BY name + ORDER BY COUNT(*) DESC',
                points: 15,
                sqlType: 'select',
                taskOrder: 48,
                now: $now
            ),

            $this->task(
                id: 49,
                taskNumber: 49,
                lessonId: 24,   // Вложенные подзапросы
                title: 'Процент в 10 A',
                description: 'Подзапрос для вычисления процента',
                taskText: 'Какой процент обучающихся учится в "10 A" классе?',
                schema: 'schedule',
                solutionSql: "SELECT COUNT(*) * 100.0 / (SELECT COUNT(*) FROM Student_in_class) AS percent FROM Student_in_class JOIN Class ON Class.id = Student_in_class.class WHERE Class.name = '10 A';",
                difficultyPercent: 50,
                isFree: true,
                hint: 'COUNT в классе * 100 / общий COUNT = процент',
                points: 25,
                sqlType: 'select',
                taskOrder: 49,
                now: $now
            ),

            $this->task(
                id: 50,
                taskNumber: 50,
                lessonId: 24,   // Вложенные подзапросы
                title: 'Процент рождённых в 2000',
                description: 'FLOOR + подзапрос + YEAR',
                taskText: 'Какой процент обучающихся родился в 2000 году? Результат округлить до целого в меньшую сторону.',
                schema: 'schedule',
                solutionSql: "SELECT FLOOR(COUNT(CASE WHEN YEAR(birthday) = 2000 THEN 1 END) * 100.0 / COUNT(*)) AS percent FROM Student;",
                difficultyPercent: 50,
                isFree: true,
                hint: 'FLOOR + CASE WHEN для условного подсчёта',
                points: 25,
                sqlType: 'select',
                taskOrder: 50,
                now: $now
            // ⚠️ [ТРЕБУЕТ ПРОВЕРКИ] — решение может быть через подзапрос:
            // SELECT FLOOR((SELECT COUNT(*) FROM Student WHERE YEAR(birthday) = 2000) * 100.0 / (SELECT COUNT(*) FROM Student)) AS percent
            ),

            // ================================================================
            //  №51-56 — DML: INSERT, UPDATE, DELETE
            //  Схемы: family, aviation
            // ================================================================

            $this->task(
                id: 51,
                taskNumber: 51,
                lessonId: 27,   // Оператор INSERT
                title: 'Добавить Cheese',
                description: 'INSERT INTO с указанием столбцов',
                taskText: 'Добавьте товар с именем "Cheese" и типом "food" в список товаров (Goods).',
                schema: 'family',
                solutionSql: "INSERT INTO Goods (good_id, good_name, type) SELECT COUNT(*) + 1, 'Cheese', (SELECT good_type_id FROM GoodTypes WHERE good_type_name = 'food') FROM Goods;",
                difficultyPercent: 15,
                isFree: true,
                hint: 'INSERT INTO таблица (столбцы) VALUES (значения)',
                points: 10,
                sqlType: 'insert',
                taskOrder: 51,
                now: $now
            // ⚠️ [ТРЕБУЕТ ПРОВЕРКИ] — на оригинале good_id может быть
            // захардкожен или вычисляться через подзапрос. Варианты:
            // INSERT INTO Goods VALUES (17, 'Cheese', 2)
            // INSERT INTO Goods (good_name, type) SELECT 'Cheese', good_type_id FROM GoodTypes WHERE good_type_name = 'food'
            ),

            $this->task(
                id: 52,
                taskNumber: 52,
                lessonId: 27,   // Оператор INSERT
                title: 'Добавить тип auto',
                description: 'INSERT INTO',
                taskText: 'Добавьте в список типов товаров (GoodTypes) новый тип "auto".',
                schema: 'family',
                solutionSql: "INSERT INTO GoodTypes (good_type_id, good_type_name) SELECT COUNT(*) + 1, 'auto' FROM GoodTypes;",
                difficultyPercent: 15,
                isFree: true,
                hint: 'INSERT INTO GoodTypes VALUES (...)',
                points: 10,
                sqlType: 'insert',
                taskOrder: 52,
                now: $now
            // ⚠️ [ТРЕБУЕТ ПРОВЕРКИ] — good_type_id может быть захардкожен
            ),

            $this->task(
                id: 53,
                taskNumber: 53,
                lessonId: 28,   // Оператор UPDATE
                title: 'Переименовать Andie',
                description: 'UPDATE SET WHERE',
                taskText: 'Измените имя "Andie Quincey" на "Andie Anthony".',
                schema: 'family',
                solutionSql: "UPDATE FamilyMembers SET member_name = 'Andie Anthony' WHERE member_name = 'Andie Quincey';",
                difficultyPercent: 15,
                isFree: true,
                hint: "UPDATE ... SET ... WHERE member_name = 'Andie Quincey'",
                points: 10,
                sqlType: 'update',
                taskOrder: 53,
                now: $now
            ),

            $this->task(
                id: 54,
                taskNumber: 54,
                lessonId: 29,   // Оператор DELETE
                title: 'Удалить Quincey',
                description: 'DELETE с LIKE',
                taskText: 'Удалить всех членов семьи с фамилией "Quincey".',
                schema: 'family',
                solutionSql: "DELETE FROM FamilyMembers WHERE member_name LIKE '%Quincey';",
                difficultyPercent: 15,
                isFree: true,
                hint: "DELETE FROM ... WHERE member_name LIKE '%Quincey'",
                points: 10,
                sqlType: 'delete',
                taskOrder: 54,
                now: $now
            ),

            $this->task(
                id: 55,
                taskNumber: 55,
                lessonId: 29,   // Оператор DELETE
                title: 'Удалить компании с мин. рейсами',
                description: 'DELETE с подзапросом',
                taskText: 'Удалить компании, совершившие наименьшее количество рейсов.',
                schema: 'aviation',
                solutionSql: "DELETE FROM Company WHERE id IN (SELECT company FROM (SELECT company, COUNT(*) AS cnt FROM Trip GROUP BY company HAVING cnt = (SELECT COUNT(*) AS c FROM Trip GROUP BY company ORDER BY c ASC LIMIT 1)) AS t);",
                difficultyPercent: 60,
                isFree: true,
                hint: 'DELETE + подзапрос для нахождения MIN количества рейсов',
                points: 30,
                sqlType: 'delete',
                taskOrder: 55,
                now: $now
            ),

            $this->task(
                id: 56,
                taskNumber: 56,
                lessonId: 29,   // Оператор DELETE
                title: 'Удалить рейсы из Москвы',
                description: 'DELETE с WHERE',
                taskText: 'Удалить все перелеты, совершенные из Москвы (Moscow).',
                schema: 'aviation',
                solutionSql: "DELETE FROM Trip WHERE town_from = 'Moscow';",
                difficultyPercent: 10,
                isFree: true,
                hint: "DELETE FROM Trip WHERE town_from = 'Moscow'",
                points: 10,
                sqlType: 'delete',
                taskOrder: 56,
                now: $now
            ),

            // ================================================================
            //  №57-58 — UPDATE, INSERT (расписание, бронирование)
            //  Схемы: schedule, booking
            // ================================================================

            $this->task(
                id: 57,
                taskNumber: 57,
                lessonId: 28,   // Оператор UPDATE
                title: 'Сдвинуть расписание +30 мин',
                description: 'UPDATE с DATE_ADD',
                taskText: 'Перенести расписание всех занятий на 30 мин. вперёд.',
                schema: 'schedule',
                solutionSql: 'UPDATE Timepair SET start_pair = DATE_ADD(start_pair, INTERVAL 30 MINUTE), end_pair = DATE_ADD(end_pair, INTERVAL 30 MINUTE);',
                difficultyPercent: 25,
                isFree: true,
                hint: 'DATE_ADD(поле, INTERVAL 30 MINUTE) — добавляет 30 минут',
                points: 15,
                sqlType: 'update',
                taskOrder: 57,
                now: $now
            // ⚠️ [ТРЕБУЕТ ПРОВЕРКИ] — на оригинале задача №57 может быть
            // CREATE VIEW, а не UPDATE. Нумерация DML-задач варьируется
            // в разных источниках
            ),

            $this->task(
                id: 58,
                taskNumber: 58,
                lessonId: 27,   // Оператор INSERT
                title: 'Добавить отзыв',
                description: 'INSERT с подзапросом',
                taskText: 'Добавить отзыв с рейтингом 5 на жилье, visoted by "George Clooney", по адресу "11218, Friel Place, New York", от имени "George Clooney".',
                schema: 'booking',
                solutionSql: "INSERT INTO Reviews (reservation_id, rating) VALUES ((SELECT Reservations.id FROM Reservations JOIN Rooms ON Rooms.id = Reservations.room_id JOIN Users ON Users.id = Reservations.user_id WHERE Users.name = 'George Clooney' AND Rooms.address = '11218, Friel Place, New York' LIMIT 1), 5);",
                difficultyPercent: 30,
                isFree: true,
                hint: 'Сначала найдите reservation_id через подзапрос с JOIN',
                points: 15,
                sqlType: 'insert',
                taskOrder: 58,
                now: $now
            // ⚠️ [ТРЕБУЕТ ПРОВЕРКИ] — точная формулировка задачи
            // и структура INSERT могут отличаться
            ),

            // ================================================================
            //  №59-62 — Booking + Schedule: LIKE, WEEK, строковые функции
            //  Схемы: booking, schedule
            // ================================================================

            $this->task(
                id: 59,
                taskNumber: 59,
                lessonId: 11,   // LIKE
                title: 'Белорусские номера',
                description: 'LIKE для телефонного кода',
                taskText: 'Вывести пользователей, указавших белорусский номер телефона. Телефонный код Белоруссии +375.',
                schema: 'booking',
                solutionSql: "SELECT * FROM Users WHERE phone_number LIKE '+375%';",
                difficultyPercent: 10,
                isFree: true,
                hint: "LIKE '+375%'",
                points: 5,
                sqlType: 'select',
                taskOrder: 59,
                now: $now
            ),

            $this->task(
                id: 60,
                taskNumber: 60,
                lessonId: 17,   // HAVING
                title: 'Преподаватели всех 11 классов',
                description: 'JOIN + GROUP BY + HAVING COUNT(DISTINCT)',
                taskText: 'Выведите идентификаторы преподавателей, которые хотя бы один раз за всё время преподавали в каждом из одиннадцатых классов.',
                schema: 'schedule',
                solutionSql: "SELECT teacher FROM Schedule JOIN Class ON Class.id = Schedule.class WHERE Class.name LIKE '11%' GROUP BY teacher HAVING COUNT(DISTINCT Class.id) = (SELECT COUNT(*) FROM Class WHERE name LIKE '11%');",
                difficultyPercent: 55,
                isFree: true,
                hint: 'GROUP BY teacher + HAVING COUNT(DISTINCT) = количество 11-х классов',
                points: 30,
                sqlType: 'select',
                taskOrder: 60,
                now: $now
            ),

            $this->task(
                id: 61,
                taskNumber: 61,
                lessonId: 35,   // Функции даты и времени
                title: 'Бронирования 12 недели',
                description: 'JOIN + функция WEEK()',
                taskText: 'Выведите список комнат, которые были зарезервированы хотя бы на одни сутки в 12-ую неделю 2020 года. В этой задаче считайте, что неделя начинается с понедельника.',
                schema: 'booking',
                solutionSql: "SELECT DISTINCT Rooms.* FROM Rooms JOIN Reservations ON Rooms.id = Reservations.room_id WHERE YEARWEEK(Reservations.start_date, 1) = YEARWEEK('2020-03-16', 1) OR YEARWEEK(Reservations.end_date, 1) = YEARWEEK('2020-03-16', 1);",
                difficultyPercent: 45,
                isFree: true,
                hint: 'YEARWEEK(date, 1) или WEEK(date, 1) для номера недели с понедельника',
                points: 25,
                sqlType: 'select',
                taskOrder: 61,
                now: $now
            // ⚠️ [ТРЕБУЕТ ПРОВЕРКИ] — способ вычисления 12-й недели
            // может быть через WEEK(date, 1) = 12 AND YEAR(date) = 2020
            ),

            $this->task(
                id: 62,
                taskNumber: 62,
                lessonId: 34,   // Строковые функции
                title: 'Популярные домены',
                description: 'SUBSTRING_INDEX + GROUP BY + ORDER BY',
                taskText: 'Вывести в порядке убывания популярности доменные имена 2-го уровня, используемые для электронной почты. Дополнительно отсортировать по возрастанию доменных имён.',
                schema: 'booking',
                solutionSql: "SELECT SUBSTRING_INDEX(email, '@', -1) AS domain, COUNT(*) AS count FROM Users GROUP BY domain ORDER BY count DESC, domain ASC;",
                difficultyPercent: 40,
                isFree: true,
                hint: "SUBSTRING_INDEX(email, '@', -1) извлекает домен",
                points: 20,
                sqlType: 'select',
                taskOrder: 62,
                now: $now
            ),

            // ================================================================
            //  №63-66 — CONCAT, Self JOIN, AVG, удобства
            //  Схемы: schedule, aviation, booking
            // ================================================================

            $this->task(
                id: 63,
                taskNumber: 63,
                lessonId: 34,   // Строковые функции
                title: 'Фамилия.И.О.',
                description: 'CONCAT + LEFT для форматирования',
                taskText: 'Выведите отсортированный список (по возрастанию) фамилий и имён студентов в виде Фамилия.И.О.',
                schema: 'schedule',
                solutionSql: "SELECT CONCAT(last_name, '.', LEFT(first_name, 1), '.', LEFT(middle_name, 1), '.') AS name FROM Student ORDER BY name;",
                difficultyPercent: 30,
                isFree: true,
                hint: "CONCAT объединяет строки, LEFT(str, 1) берёт первую букву",
                points: 15,
                sqlType: 'select',
                taskOrder: 63,
                now: $now
            ),

            $this->task(
                id: 64,
                taskNumber: 64,
                lessonId: 20,   // INNER JOIN
                title: 'Пары пассажиров',
                description: 'Self JOIN + GROUP BY + HAVING',
                taskText: 'Выведите имена всехересечённых (летевших вместе) пассажиров два или более раз и количество таких совместных рейсов. В первом столбце разместите имя пассажира с меньшим идентификатором.',
                schema: 'aviation',
                solutionSql: "SELECT p1.name AS name1, p2.name AS name2, COUNT(*) AS count FROM Pass_in_trip pit1 JOIN Pass_in_trip pit2 ON pit1.trip = pit2.trip AND pit1.passenger < pit2.passenger JOIN Passenger p1 ON p1.id = pit1.passenger JOIN Passenger p2 ON p2.id = pit2.passenger GROUP BY pit1.passenger, pit2.passenger HAVING COUNT(*) >= 2;",
                difficultyPercent: 70,
                isFree: true,
                hint: 'Self JOIN Pass_in_trip с условием passenger1 < passenger2',
                points: 35,
                sqlType: 'select',
                taskOrder: 64,
                now: $now
            // ⚠️ [ТРЕБУЕТ ПРОВЕРКИ] — точная формулировка и названия столбцов
            // могут быть passengerName1/passengerName2 или name1/name2
            ),

            $this->task(
                id: 65,
                taskNumber: 65,
                lessonId: 15,   // Агрегатные функции
                title: 'Рейтинг комнат',
                description: 'FLOOR + AVG + JOIN + GROUP BY',
                taskText: 'Вывести рейтинг для комнат, которые хоть раз арендовали, как среднее значение рейтинга отзывов, округлённое до целого вниз.',
                schema: 'booking',
                solutionSql: 'SELECT Reservations.room_id, FLOOR(AVG(Reviews.rating)) AS rating FROM Reservations JOIN Reviews ON Reviews.reservation_id = Reservations.id GROUP BY Reservations.room_id;',
                difficultyPercent: 35,
                isFree: true,
                hint: 'FLOOR(AVG(rating)) + GROUP BY room_id',
                points: 20,
                sqlType: 'select',
                taskOrder: 65,
                now: $now
            ),

            $this->task(
                id: 66,
                taskNumber: 66,
                lessonId: 21,   // LEFT/RIGHT JOIN
                title: 'Комнаты со всеми удобствами',
                description: 'LEFT JOIN + COALESCE + SUM + DATEDIFF',
                taskText: 'Вывести список комнат со всеми удобствами (наличие ТВ, интернета, кухни и кондиционера), а также общее количество дней и сумму за все дни аренды каждой из таких комнат.',
                schema: 'booking',
                solutionSql: "SELECT Rooms.home_type, Rooms.address, COALESCE(SUM(DATEDIFF(Reservations.end_date, Reservations.start_date)), 0) AS days, COALESCE(SUM(Reservations.total), 0) AS total_fee FROM Rooms LEFT JOIN Reservations ON Rooms.id = Reservations.room_id WHERE Rooms.has_tv = 1 AND Rooms.has_internet = 1 AND Rooms.has_kitchen = 1 AND Rooms.has_air_con = 1 GROUP BY Rooms.id, Rooms.home_type, Rooms.address;",
                difficultyPercent: 55,
                isFree: true,
                hint: 'LEFT JOIN + WHERE все удобства = 1 + COALESCE для NULL',
                points: 30,
                sqlType: 'select',
                taskOrder: 66,
                now: $now
            ),

            // ================================================================
            //  №67-70 — Booking: DATEDIFF, проценты, CASE
            //  Схема: booking
            // ================================================================

            $this->task(
                id: 67,
                taskNumber: 67,
                lessonId: 35,   // Функции даты и времени
                title: 'Среднее кол-во дней бронирования',
                description: 'AVG + DATEDIFF',
                taskText: 'Вывести среднее количество дней бронирования для каждого пользователя, который бронировал комнаты. Результат округлить до целого в большую сторону.',
                schema: 'booking',
                solutionSql: 'SELECT user_id, CEIL(AVG(DATEDIFF(end_date, start_date))) AS avg_days FROM Reservations GROUP BY user_id;',
                difficultyPercent: 35,
                isFree: true,
                hint: 'CEIL(AVG(DATEDIFF(end_date, start_date))) + GROUP BY user_id',
                points: 20,
                sqlType: 'select',
                taskOrder: 67,
                now: $now
            // ⚠️ [ТРЕБУЕТ ПРОВЕРКИ] — формулировка может отличаться
            ),

            $this->task(
                id: 68,
                taskNumber: 68,
                lessonId: 35,   // Функции даты и времени
                title: 'Первая и последняя бронь',
                description: 'MIN + MAX + GROUP BY',
                taskText: 'Для каждой комнаты, которую хоть раз бронировали, выведите дату первого и последнего бронирования.',
                schema: 'booking',
                solutionSql: 'SELECT room_id, MIN(start_date) AS first_reservation, MAX(end_date) AS last_reservation FROM Reservations GROUP BY room_id;',
                difficultyPercent: 25,
                isFree: true,
                hint: 'MIN(start_date) и MAX(end_date) + GROUP BY room_id',
                points: 15,
                sqlType: 'select',
                taskOrder: 68,
                now: $now
            // ⚠️ [ТРЕБУЕТ ПРОВЕРКИ] — формулировка может отличаться
            ),

            $this->task(
                id: 69,
                taskNumber: 69,
                lessonId: 15,   // Агрегатные функции
                title: 'Количество бронирований по месяцам',
                description: 'COUNT + MONTH + GROUP BY',
                taskText: 'Выведите количество бронирований по каждому месяцу каждого года, в котором было хотя бы 1 бронирование. Результат отсортируйте в порядке возрастания даты бронирования.',
                schema: 'booking',
                solutionSql: "SELECT YEAR(start_date) AS year, MONTH(start_date) AS month, COUNT(*) AS count FROM Reservations GROUP BY year, month ORDER BY year, month;",
                difficultyPercent: 30,
                isFree: true,
                hint: 'YEAR() + MONTH() + GROUP BY + ORDER BY',
                points: 15,
                sqlType: 'select',
                taskOrder: 69,
                now: $now
            // ⚠️ [ТРЕБУЕТ ПРОВЕРКИ] — формулировка может отличаться
            ),

            $this->task(
                id: 70,
                taskNumber: 70,
                lessonId: 36,   // CASE
                title: 'Категории жилья',
                description: 'CASE WHEN + COUNT + GROUP BY',
                taskText: 'Необходимо категоризовать жилье на economy, comfort, premium по цене соответственно <= 100, 100 < цена < 200, >= 200. В качестве результата вывести таблицу с названием категории и количеством жилья, попадающего в данную категорию.',
                schema: 'booking',
                solutionSql: "SELECT CASE WHEN price <= 100 THEN 'economy' WHEN price > 100 AND price < 200 THEN 'comfort' ELSE 'premium' END AS category, COUNT(*) AS count FROM Rooms GROUP BY category;",
                difficultyPercent: 40,
                isFree: true,
                hint: 'CASE WHEN ... THEN ... END + GROUP BY',
                points: 20,
                sqlType: 'select',
                taskOrder: 70,
                now: $now
            ),

            // ================================================================
            //  №71-73 — Booking: проценты, средняя цена, чётность
            //  Схема: booking
            // ================================================================

            $this->task(
                id: 71,
                taskNumber: 71,
                lessonId: 24,   // Вложенные подзапросы
                title: 'Процент активных пользователей',
                description: 'ROUND + подзапрос + UNION',
                taskText: 'Найдите какой процент пользователей, зарегистрированных на сервисе бронирования, хоть раз арендовали или сдавали в аренду жильё. Результат округлите до сотых.',
                schema: 'booking',
                solutionSql: "SELECT ROUND(COUNT(DISTINCT active_user) * 100.0 / (SELECT COUNT(*) FROM Users), 2) AS percent FROM (SELECT user_id AS active_user FROM Reservations UNION SELECT owner_id AS active_user FROM Rooms WHERE id IN (SELECT room_id FROM Reservations)) AS active_users;",
                difficultyPercent: 60,
                isFree: true,
                hint: 'UNION для объединения арендаторов и владельцев + ROUND',
                points: 30,
                sqlType: 'select',
                taskOrder: 71,
                now: $now
            // ⚠️ [ТРЕБУЕТ ПРОВЕРКИ] — точная формулировка и решение.
            // Альтернативное решение может использовать другой подход
            ),

            $this->task(
                id: 72,
                taskNumber: 72,
                lessonId: 15,   // Агрегатные функции
                title: 'Средняя цена бронирования',
                description: 'AVG + DATEDIFF + GROUP BY',
                taskText: 'Выведите среднюю цену бронирования за сутки для каждой из комнат, которую бронировали хотя бы один раз. Среднюю цену за сутки определите как общую сумму за все бронирования комнаты, делённую на общее количество забронированных суток.',
                schema: 'booking',
                solutionSql: 'SELECT room_id, ROUND(SUM(total) / SUM(DATEDIFF(end_date, start_date)), 2) AS avg_price FROM Reservations GROUP BY room_id;',
                difficultyPercent: 40,
                isFree: true,
                hint: 'SUM(total) / SUM(DATEDIFF) + GROUP BY room_id',
                points: 20,
                sqlType: 'select',
                taskOrder: 72,
                now: $now
            ),

            $this->task(
                id: 73,
                taskNumber: 73,
                lessonId: 17,   // HAVING
                title: 'Нечётное количество бронирований',
                description: 'COUNT + HAVING + MOD',
                taskText: 'Выведите id тех комнат, которые арендовали нечётное количество раз.',
                schema: 'booking',
                solutionSql: 'SELECT room_id FROM Reservations GROUP BY room_id HAVING COUNT(*) % 2 = 1;',
                difficultyPercent: 30,
                isFree: true,
                hint: 'COUNT(*) % 2 = 1 или MOD(COUNT(*), 2) = 1',
                points: 15,
                sqlType: 'select',
                taskOrder: 73,
                now: $now
            ),

            // ================================================================
            //  №74-76 — IF/CASE, признаки пользователей
            //  Схемы: booking, schedule
            // ================================================================

            $this->task(
                id: 74,
                taskNumber: 74,
                lessonId: 36,   // CASE
                title: 'Признак интернета',
                description: 'IF или CASE для boolean',
                taskText: 'Выведите идентификатор и признак наличия интернета в помещении. Если интернет в помещении присутствует, то выведите «YES», иначе «NO».',
                schema: 'booking',
                solutionSql: "SELECT id, IF(has_internet = 1, 'YES', 'NO') AS has_internet FROM Rooms;",
                difficultyPercent: 15,
                isFree: true,
                hint: "IF(условие, 'YES', 'NO') или CASE WHEN",
                points: 10,
                sqlType: 'select',
                taskOrder: 74,
                now: $now
            ),

            $this->task(
                id: 75,
                taskNumber: 75,
                lessonId: 35,   // Функции даты и времени
                title: 'Студенты рождённые в мае',
                description: 'WHERE MONTH() + ORDER BY',
                taskText: 'Выведите фамилию, имя и дату рождения студентов, кто был рождён в мае.',
                schema: 'schedule',
                solutionSql: "SELECT last_name, first_name, birthday FROM Student WHERE MONTH(birthday) = 5;",
                difficultyPercent: 10,
                isFree: true,
                hint: 'MONTH(birthday) = 5',
                points: 5,
                sqlType: 'select',
                taskOrder: 75,
                now: $now
            ),

            $this->task(
                id: 76,
                taskNumber: 76,
                lessonId: 36,   // CASE
                title: 'Признаки is_owner и is_tenant',
                description: 'CASE + EXISTS или IN',
                taskText: 'Вывести имена всех пользователей сервиса бронирования жилья, а также два признака — является лиригоз пользователь владельцем (is_owner) и является ли арендатором (is_tenant). В качестве значения используйте 1 и 0.',
                schema: 'booking',
                solutionSql: "SELECT Users.name, CASE WHEN Users.id IN (SELECT owner_id FROM Rooms) THEN 1 ELSE 0 END AS is_owner, CASE WHEN Users.id IN (SELECT user_id FROM Reservations) THEN 1 ELSE 0 END AS is_tenant FROM Users;",
                difficultyPercent: 40,
                isFree: true,
                hint: 'CASE WHEN id IN (подзапрос) THEN 1 ELSE 0 END',
                points: 20,
                sqlType: 'select',
                taskOrder: 76,
                now: $now
            // ⚠️ [ТРЕБУЕТ ПРОВЕРКИ] — формулировка содержит опечатку "ригоз"
            // на оригинале скорее "данный пользователь"
            ),

            // ================================================================
            //  №77 — CREATE VIEW
            //  Схема: schedule
            // ================================================================

            $this->task(
                id: 77,
                taskNumber: 77,
                lessonId: 33,   // Представления (VIEW)
                title: 'Представление People',
                description: 'CREATE VIEW с UNION',
                taskText: 'Создайте представление с именем "People", которое будет содержать список имён (first_name) и фамилий (last_name) всех студентов (Student) и преподавателей (Teacher).',
                schema: 'schedule',
                solutionSql: 'CREATE VIEW People AS SELECT first_name, last_name FROM Student UNION SELECT first_name, last_name FROM Teacher;',
                difficultyPercent: 25,
                isFree: true,
                hint: 'CREATE VIEW name AS SELECT ... UNION SELECT ...',
                points: 15,
                sqlType: 'create_view',
                taskOrder: 77,
                now: $now
            ),

            // ================================================================
            //  №78-79 — Booking: строковые функции, скидка
            //  Схема: booking
            // ================================================================

            $this->task(
                id: 78,
                taskNumber: 78,
                lessonId: 34,   // Строковые функции
                title: 'Пользователи hotmail.com',
                description: 'LIKE или SUBSTRING_INDEX для домена',
                taskText: 'Выведите всех пользователей с электронной почтой в домене «hotmail.com».',
                schema: 'booking',
                solutionSql: "SELECT * FROM Users WHERE email LIKE '%@hotmail.com';",
                difficultyPercent: 10,
                isFree: true,
                hint: "LIKE '%@hotmail.com'",
                points: 5,
                sqlType: 'select',
                taskOrder: 78,
                now: $now
            ),

            $this->task(
                id: 79,
                taskNumber: 79,
                lessonId: 36,   // CASE
                title: 'Скидка 10% за ТВ и интернет',
                description: 'CASE или IF для условной скидки',
                taskText: 'Выведите поля id, home_type, price у всех комнат из таблицы Rooms. Если комната имеет телевизор и интернет одновременно, то в поле price выведите цену со скидкой 10%.',
                schema: 'booking',
                solutionSql: "SELECT id, home_type, CASE WHEN has_tv = 1 AND has_internet = 1 THEN ROUND(price * 0.9, 2) ELSE price END AS price FROM Rooms;",
                difficultyPercent: 25,
                isFree: true,
                hint: 'CASE WHEN has_tv = 1 AND has_internet = 1 THEN price * 0.9',
                points: 15,
                sqlType: 'select',
                taskOrder: 79,
                now: $now
            ),

        ];
    }
}

