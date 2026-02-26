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

        // =============================================
        // Убедимся что зависимости существуют
        // =============================================
        $this->ensureDependencies($now);

        // =============================================
        // Очистим старые задачи
        // =============================================
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('tasks')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // =============================================
        // Все 66 задач
        // =============================================
        $tasks = $this->getTasks($now);

        // Вставляем порциями по 10
        foreach (array_chunk($tasks, 10) as $chunk) {
            DB::table('tasks')->insert($chunk);
        }

        echo "✅ Вставлено " . count($tasks) . " задач\n";
    }

    /**
     * Создаём зависимости если их нет
     */
    private function ensureDependencies(Carbon $now): void
    {
        // Пользователь-автор
        if (!DB::table('users')->where('id', 1)->exists()) {
            DB::table('users')->insert([
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@sqlacademy.test',
                'password' => bcrypt('password'),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            echo "👤 Создан пользователь Admin (id=1)\n";
        }

        // Уроки (проверяем есть ли хотя бы 12)
        $lessonCount = DB::table('lessons')->count();
        if ($lessonCount < 12) {
            echo "⚠️  В таблице lessons только {$lessonCount} записей. Запустите сначала: php artisan db:seed --class=LessonSeeder\n";
        }
    }

    /**
     * Базовый шаблон задачи
     */
    private function task(
        int $id,
        int $lessonId,
        string $title,
        string $description,
        string $taskText,
        string $schema,
        string $solutionSql,
        int $difficultyPercent,
        bool $isFree,
        string $hint,
        int $points,
        string $sqlType,
        Carbon $now
    ): array {
        return [
            'id' => $id,
            'lesson_id' => $lessonId,
            'author_id' => 1,
            'title' => $title,
            'description' => $description,
            'task_text' => $taskText,
            'database_schema' => $schema,
            'solution_sql' => $solutionSql,
            'expected_results' => json_encode([]),
            'difficulty_percent' => $difficultyPercent,
            'is_free' => $isFree,
            'hint' => $hint,
            'points' => $points,
            'sql_type' => $sqlType,
            'created_at' => $now,
            'updated_at' => $now,
        ];
    }

    /**
     * Все 66 задач с исправленными SQL-запросами
     */
    private function getTasks(Carbon $now): array
    {
        return [

            // ============================================================
            //  УРОК 1: Основы SELECT (задачи 1-4)
            // ============================================================

            $this->task(
                id: 1,
                lessonId: 1,
                title: 'Имена пассажиров',
                description: 'Простой SELECT из одной таблицы',
                taskText: 'Вывести имена всех когда-либо обслуживаемых пассажиров авиакомпаний',
                schema: 'airlines',
                solutionSql: 'SELECT name FROM Passenger',
                difficultyPercent: 5,
                isFree: true,
                hint: 'Используйте SELECT name FROM имя_таблицы',
                points: 5,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 2,
                lessonId: 1,
                title: 'Названия авиакомпаний',
                description: 'Простой SELECT из одной таблицы',
                taskText: 'Вывести названия всех авиакомпаний',
                schema: 'airlines',
                solutionSql: 'SELECT name FROM Company',
                difficultyPercent: 5,
                isFree: true,
                hint: 'Таблица Company содержит названия компаний',
                points: 5,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 3,
                lessonId: 1,
                title: 'Рейсы из Москвы',
                description: 'SELECT с условием WHERE',
                taskText: 'Вывести все рейсы, совершенные из Москвы',
                schema: 'airlines',
                solutionSql: "SELECT * FROM Trip WHERE town_from = 'Moscow'",
                difficultyPercent: 10,
                isFree: true,
                hint: "Используйте WHERE town_from = 'Moscow'",
                points: 5,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 4,
                lessonId: 1,
                title: 'Имена на "man"',
                description: 'SELECT с оператором LIKE',
                taskText: 'Вывести имена людей, которые заканчиваются на "man"',
                schema: 'airlines',
                solutionSql: "SELECT name FROM Passenger WHERE name LIKE '%man'",
                difficultyPercent: 10,
                isFree: true,
                hint: "Используйте LIKE '%man'",
                points: 5,
                sqlType: 'select',
                now: $now
            ),

            // ============================================================
            //  УРОК 2: COUNT, JOIN, GROUP BY (задачи 5-10)
            // ============================================================

            $this->task(
                id: 5,
                lessonId: 2,
                title: 'Количество рейсов на TU-134',
                description: 'Агрегатная функция COUNT с WHERE',
                taskText: 'Вывести количество рейсов, совершенных на TU-134',
                schema: 'airlines',
                // ✅ ИСПРАВЛЕНО: было COUNT('plane'), стало COUNT(*)
                solutionSql: "SELECT COUNT(*) AS count FROM Trip WHERE plane = 'TU-134'",
                difficultyPercent: 15,
                isFree: true,
                hint: "COUNT(*) считает строки, WHERE plane = 'TU-134' фильтрует",
                points: 10,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 6,
                lessonId: 2,
                title: 'Компании на Boeing',
                description: 'JOIN двух таблиц с GROUP BY',
                taskText: 'Какие компании совершали перелеты на Boeing',
                schema: 'airlines',
                // ✅ ИСПРАВЛЕНО: GROUP BY Company.name вместо company
                solutionSql: "SELECT DISTINCT Company.name FROM Trip JOIN Company ON Company.id = Trip.company WHERE plane = 'Boeing'",
                difficultyPercent: 25,
                isFree: true,
                hint: 'Нужен JOIN между Trip и Company, фильтр по plane',
                points: 10,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 7,
                lessonId: 2,
                title: 'Самолёты в Москву',
                description: 'SELECT DISTINCT или GROUP BY',
                taskText: 'Вывести все названия самолётов, на которых можно улететь в Москву (Moscow)',
                schema: 'airlines',
                solutionSql: "SELECT DISTINCT plane FROM Trip WHERE town_to = 'Moscow'",
                difficultyPercent: 15,
                isFree: true,
                hint: "WHERE town_to = 'Moscow' + DISTINCT или GROUP BY",
                points: 10,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 8,
                lessonId: 2,
                title: 'Рейсы из Парижа',
                description: 'Функция TIMEDIFF для вычисления разницы времени',
                taskText: 'В какие города можно улететь из Парижа (Paris) и сколько времени это займёт?',
                schema: 'airlines',
                solutionSql: "SELECT town_to, TIMEDIFF(time_in, time_out) AS flight_time FROM Trip WHERE town_from = 'Paris'",
                difficultyPercent: 20,
                isFree: true,
                hint: 'TIMEDIFF(time_in, time_out) вычисляет разницу во времени',
                points: 10,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 9,
                lessonId: 2,
                title: 'Компании из Владивостока',
                description: 'JOIN с условием WHERE',
                // ✅ ИСПРАВЛЕНО: добавлено описание задачи
                taskText: 'Какие компании организуют перелёты из Владивостока (Vladivostok)?',
                schema: 'airlines',
                solutionSql: "SELECT name FROM Company AS c JOIN Trip AS t ON c.id = t.company WHERE t.town_from = 'Vladivostok'",
                difficultyPercent: 20,
                isFree: true,
                hint: "JOIN Company и Trip, фильтр по town_from = 'Vladivostok'",
                points: 10,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 10,
                lessonId: 2,
                title: 'Вылеты 1 января',
                description: 'Фильтрация по диапазону дат с BETWEEN',
                taskText: 'Вывести вылеты, совершенные с 10 ч. по 14 ч. 1 января 1900 г.',
                schema: 'airlines',
                // ✅ ИСПРАВЛЕНО: формат даты для MySQL
                solutionSql: "SELECT * FROM Trip WHERE time_out BETWEEN '1900-01-01 10:00:00' AND '1900-01-01 14:00:00'",
                difficultyPercent: 20,
                isFree: true,
                hint: 'Используйте BETWEEN для диапазона дат и времени',
                points: 10,
                sqlType: 'select',
                now: $now
            ),

            // ============================================================
            //  УРОК 3: ORDER BY, HAVING, LIMIT (задачи 11-16)
            // ============================================================

            $this->task(
                id: 11,
                lessonId: 3,
                title: 'Самое длинное имя',
                description: 'ORDER BY с функцией LENGTH и LIMIT',
                taskText: 'Вывести пассажиров с самым длинным именем',
                schema: 'airlines',
                solutionSql: 'SELECT name FROM Passenger ORDER BY LENGTH(name) DESC LIMIT 1',
                difficultyPercent: 20,
                isFree: true,
                hint: 'LENGTH(name) возвращает длину строки, ORDER BY DESC + LIMIT 1',
                points: 10,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 12,
                lessonId: 3,
                title: 'Пассажиры на рейсах',
                description: 'GROUP BY с COUNT',
                taskText: 'Вывести id и количество пассажиров для всех прошедших полётов',
                schema: 'airlines',
                solutionSql: 'SELECT trip, COUNT(passenger) AS count FROM Pass_in_trip GROUP BY trip',
                difficultyPercent: 20,
                isFree: true,
                hint: 'GROUP BY trip + COUNT(passenger)',
                points: 10,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 13,
                lessonId: 3,
                title: 'Полные тёзки',
                description: 'GROUP BY с HAVING COUNT > 1',
                taskText: 'Вывести имена людей, у которых есть полный тёзка среди пассажиров',
                schema: 'airlines',
                solutionSql: 'SELECT name FROM Passenger GROUP BY name HAVING COUNT(*) > 1',
                difficultyPercent: 25,
                isFree: true,
                hint: 'GROUP BY name + HAVING COUNT(*) > 1 находит дубликаты',
                points: 15,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 14,
                lessonId: 3,
                title: 'Города Брюса Уиллиса',
                description: 'Тройной JOIN трёх таблиц',
                taskText: 'В какие города летал Bruce Willis',
                schema: 'airlines',
                // ✅ ИСПРАВЛЕНО: явные алиасы в JOIN
                solutionSql: "SELECT t.town_to FROM Trip AS t JOIN Pass_in_trip AS pit ON t.id = pit.trip JOIN Passenger AS p ON p.id = pit.passenger WHERE p.name = 'Bruce Willis'",
                difficultyPercent: 30,
                isFree: true,
                hint: 'JOIN трёх таблиц: Trip ↔ Pass_in_trip ↔ Passenger',
                points: 15,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 15,
                lessonId: 3,
                title: 'Стив Мартин в Лондоне',
                description: 'JOIN с двумя условиями WHERE',
                taskText: 'Во сколько Стив Мартин (Steve Martin) прилетел в Лондон (London)',
                schema: 'airlines',
                // ✅ ИСПРАВЛЕНО: явные алиасы
                solutionSql: "SELECT t.time_in FROM Trip AS t JOIN Pass_in_trip AS pit ON t.id = pit.trip JOIN Passenger AS p ON p.id = pit.passenger WHERE p.name = 'Steve Martin' AND t.town_to = 'London'",
                difficultyPercent: 30,
                isFree: true,
                hint: "Добавьте AND town_to = 'London' к запросу задачи 14",
                points: 15,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 16,
                lessonId: 3,
                title: 'Рейтинг пассажиров',
                description: 'JOIN + GROUP BY + HAVING + ORDER BY',
                taskText: 'Вывести отсортированный по количеству перелетов (по убыванию) и имени (по возрастанию) список пассажиров, совершивших хотя бы 1 полет.',
                schema: 'airlines',
                // ✅ ИСПРАВЛЕНО: явные алиасы
                solutionSql: "SELECT p.name, COUNT(pit.passenger) AS count FROM Trip AS t JOIN Pass_in_trip AS pit ON t.id = pit.trip JOIN Passenger AS p ON p.id = pit.passenger GROUP BY p.name HAVING count >= 1 ORDER BY count DESC, p.name ASC",
                difficultyPercent: 35,
                isFree: true,
                hint: 'GROUP BY + HAVING + ORDER BY вместе',
                points: 20,
                sqlType: 'select',
                now: $now
            ),

            // ============================================================
            //  УРОК 4: Семейная база данных (задачи 17-24)
            // ============================================================

            $this->task(
                id: 17,
                lessonId: 4,
                title: 'Расходы за 2005 год',
                description: 'JOIN + SUM + GROUP BY + фильтр по дате',
                taskText: 'Определить, сколько потратил в 2005 году каждый из членов семьи',
                schema: 'family',
                solutionSql: "SELECT member_name, status, SUM(unit_price * amount) AS costs FROM Payments AS p JOIN FamilyMembers AS fm ON p.family_member = fm.member_id WHERE YEAR(date) = 2005 GROUP BY fm.member_id, member_name, status",
                difficultyPercent: 30,
                isFree: true,
                hint: 'JOIN Payments и FamilyMembers, SUM для суммы, GROUP BY для группировки',
                points: 15,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 18,
                lessonId: 4,
                title: 'Самый старший',
                description: 'Подзапрос с MIN',
                taskText: 'Узнать, кто старше всех в семье',
                schema: 'family',
                solutionSql: 'SELECT member_name FROM FamilyMembers WHERE birthday = (SELECT MIN(birthday) FROM FamilyMembers)',
                difficultyPercent: 20,
                isFree: true,
                hint: 'MIN(birthday) — самая ранняя дата рождения = самый старший',
                points: 10,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 19,
                lessonId: 4,
                title: 'Кто покупал картошку',
                description: 'Тройной JOIN с GROUP BY',
                taskText: 'Определить, кто из членов семьи покупал картошку (potato)',
                schema: 'family',
                solutionSql: "SELECT DISTINCT status FROM FamilyMembers AS fm JOIN Payments AS p ON fm.member_id = p.family_member JOIN Goods AS g ON p.good = g.good_id WHERE g.good_name = 'potato'",
                difficultyPercent: 30,
                isFree: true,
                hint: 'JOIN трёх таблиц + фильтр по good_name',
                points: 15,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 20,
                lessonId: 4,
                title: 'Расходы на развлечения',
                description: 'Четверной JOIN с SUM и GROUP BY',
                taskText: 'Сколько и кто из семьи потратил на развлечения (entertainment). Вывести статус в семье, имя, сумму',
                schema: 'family',
                solutionSql: "SELECT status, member_name, SUM(unit_price * amount) AS costs FROM FamilyMembers AS fm JOIN Payments AS p ON fm.member_id = p.family_member JOIN Goods AS g ON p.good = g.good_id JOIN GoodTypes AS gp ON g.type = gp.good_type_id WHERE gp.good_type_name = 'entertainment' GROUP BY fm.member_id, status, member_name",
                difficultyPercent: 35,
                isFree: true,
                hint: 'JOIN четырёх таблиц + WHERE good_type_name + SUM',
                points: 20,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 21,
                lessonId: 4,
                title: 'Товары куплены > 1 раза',
                description: 'GROUP BY + HAVING COUNT > 1',
                taskText: 'Определить товары, которые покупали более 1 раза',
                schema: 'family',
                solutionSql: 'SELECT good_name FROM Payments AS p JOIN Goods AS g ON p.good = g.good_id GROUP BY g.good_id, good_name HAVING COUNT(*) > 1',
                difficultyPercent: 25,
                isFree: true,
                hint: 'GROUP BY + HAVING COUNT(*) > 1',
                points: 15,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 22,
                lessonId: 4,
                title: 'Все матери',
                description: 'Простой WHERE по статусу',
                taskText: 'Найти имена всех матерей (mother)',
                schema: 'family',
                solutionSql: "SELECT member_name FROM FamilyMembers WHERE status = 'mother'",
                difficultyPercent: 5,
                isFree: true,
                hint: "WHERE status = 'mother'",
                points: 5,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 23,
                lessonId: 4,
                title: 'Первый деликатес',
                description: 'Тройной JOIN с LIMIT',
                // ✅ ИСПРАВЛЕНО: добавлено описание задачи
                taskText: 'Найти название и цену первого купленного деликатеса',
                schema: 'family',
                solutionSql: "SELECT good_name, unit_price FROM Payments AS p JOIN Goods AS g ON p.good = g.good_id JOIN GoodTypes AS gp ON g.type = gp.good_type_id WHERE gp.good_type_name = 'delicacies' LIMIT 1",
                difficultyPercent: 25,
                isFree: true,
                hint: "JOIN трёх таблиц + WHERE good_type_name = 'delicacies' + LIMIT 1",
                points: 15,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 24,
                lessonId: 4,
                title: 'Расходы за июнь 2005',
                description: 'SUM + фильтр по году и месяцу',
                taskText: 'Определить кто и сколько потратил в июне 2005',
                schema: 'family',
                solutionSql: "SELECT member_name, SUM(unit_price * amount) AS costs FROM Payments AS p JOIN FamilyMembers AS fm ON p.family_member = fm.member_id WHERE YEAR(date) = 2005 AND MONTH(date) = 6 GROUP BY fm.member_id, member_name",
                difficultyPercent: 30,
                isFree: true,
                hint: 'YEAR(date) = 2005 AND MONTH(date) = 6',
                points: 15,
                sqlType: 'select',
                now: $now
            ),

            // ============================================================
            //  УРОК 5: LEFT JOIN, подзапросы (задачи 25-30)
            // ============================================================

            $this->task(
                id: 25,
                lessonId: 5,
                title: 'Непокупавшиеся товары 2005',
                description: 'LEFT JOIN + IS NULL',
                taskText: 'Определить, какие товары имеются в таблице Goods, но не покупались в течение 2005 года',
                schema: 'family',
                solutionSql: "SELECT good_name FROM Goods LEFT JOIN Payments ON Goods.good_id = Payments.good AND YEAR(Payments.date) = 2005 WHERE Payments.good IS NULL",
                difficultyPercent: 40,
                isFree: true,
                hint: 'LEFT JOIN + условие в ON + WHERE ... IS NULL',
                points: 20,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 26,
                lessonId: 5,
                title: 'Группы без покупок в 2005',
                description: 'NOT IN с подзапросом',
                taskText: 'Определить группы товаров, которые не приобретались в 2005 году',
                schema: 'family',
                solutionSql: "SELECT good_type_name FROM GoodTypes WHERE good_type_id NOT IN (SELECT DISTINCT g.type FROM Goods AS g JOIN Payments AS p ON g.good_id = p.good AND YEAR(p.date) = 2005)",
                difficultyPercent: 45,
                isFree: false,
                hint: 'NOT IN + подзапрос, который находит типы купленные в 2005',
                points: 25,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 27,
                lessonId: 5,
                title: 'Расходы по группам за 2005',
                description: 'Тройной JOIN + SUM + GROUP BY',
                taskText: 'Узнать, сколько потрачено на каждую из групп товаров в 2005 году. Вывести название группы и сумму',
                schema: 'family',
                solutionSql: "SELECT good_type_name, SUM(amount * unit_price) AS costs FROM GoodTypes JOIN Goods ON good_type_id = type JOIN Payments ON good = good_id AND YEAR(date) = 2005 GROUP BY good_type_name",
                difficultyPercent: 35,
                isFree: false,
                hint: 'Тройной JOIN + SUM + GROUP BY good_type_name',
                points: 20,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 28,
                lessonId: 5,
                title: 'Рейсы Ростов → Москва',
                description: 'COUNT с двумя условиями WHERE',
                taskText: 'Сколько рейсов совершили авиакомпании с Ростова (Rostov) в Москву (Moscow)?',
                schema: 'airlines',
                solutionSql: "SELECT COUNT(*) AS count FROM Trip WHERE town_from = 'Rostov' AND town_to = 'Moscow'",
                difficultyPercent: 15,
                isFree: true,
                hint: 'COUNT(*) + WHERE с двумя условиями через AND',
                points: 10,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 29,
                lessonId: 5,
                title: 'Пассажиры TU-134 в Москву',
                description: 'DISTINCT + тройной JOIN + два условия',
                taskText: 'Выведите имена пассажиров улетевших в Москву (Moscow) на самолете TU-134',
                schema: 'airlines',
                solutionSql: "SELECT DISTINCT p.name FROM Passenger AS p JOIN Pass_in_trip AS pit ON p.id = pit.passenger JOIN Trip AS t ON pit.trip = t.id WHERE t.plane = 'TU-134' AND t.town_to = 'Moscow'",
                difficultyPercent: 30,
                isFree: true,
                hint: 'JOIN трёх таблиц + DISTINCT + WHERE plane AND town_to',
                points: 15,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 30,
                lessonId: 5,
                title: 'Нагруженность рейсов (сорт.)',
                description: 'JOIN + COUNT + ORDER BY DESC',
                taskText: 'Выведите нагруженность (число пассажиров) каждого рейса (trip). Результат вывести в отсортированном виде по убыванию нагруженности.',
                schema: 'airlines',
                solutionSql: 'SELECT pit.trip, COUNT(pit.passenger) AS count FROM Pass_in_trip AS pit GROUP BY pit.trip ORDER BY count DESC',
                difficultyPercent: 30,
                isFree: true,
                hint: 'GROUP BY trip + ORDER BY count DESC',
                points: 15,
                sqlType: 'select',
                now: $now
            ),

            // ============================================================
            //  УРОК 6: Агрегатные функции (задачи 31-33)
            // ============================================================

            $this->task(
                id: 31,
                lessonId: 6,
                title: 'Семья Quincey',
                description: 'LIKE для поиска по фамилии',
                taskText: 'Вывести всех членов семьи с фамилией Quincey.',
                schema: 'family',
                solutionSql: "SELECT * FROM FamilyMembers WHERE member_name LIKE '%Quincey'",
                difficultyPercent: 10,
                isFree: true,
                hint: "LIKE '%Quincey' — ищет строки заканчивающиеся на Quincey",
                points: 5,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 32,
                lessonId: 6,
                title: 'Средний возраст',
                description: 'FLOOR + AVG + DATEDIFF',
                taskText: 'Вывести средний возраст людей (в годах), хранящихся в базе данных. Результат округлите до целого в меньшую сторону.',
                schema: 'family',
                solutionSql: 'SELECT FLOOR(AVG(TIMESTAMPDIFF(YEAR, birthday, NOW()))) AS age FROM FamilyMembers',
                difficultyPercent: 35,
                isFree: true,
                hint: 'TIMESTAMPDIFF(YEAR, birthday, NOW()) точнее чем DATEDIFF/365',
                points: 20,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 33,
                lessonId: 6,
                title: 'Средняя стоимость икры',
                description: 'AVG + JOIN + OR в WHERE',
                taskText: 'Найдите среднюю стоимость икры. В базе данных хранятся данные о покупках красной (red caviar) и черной икры (black caviar).',
                schema: 'family',
                solutionSql: "SELECT AVG(unit_price) AS cost FROM Payments JOIN Goods ON good = good_id WHERE good_name IN ('red caviar', 'black caviar')",
                difficultyPercent: 25,
                isFree: true,
                hint: "AVG + WHERE good_name IN ('red caviar', 'black caviar')",
                points: 15,
                sqlType: 'select',
                now: $now
            ),

            // ============================================================
            //  УРОК 7: Школьная база — основы (задачи 34-39)
            // ============================================================

            $this->task(
                id: 34,
                lessonId: 7,
                title: 'Количество 10-х классов',
                description: 'COUNT + LIKE',
                taskText: 'Сколько всего 10-ых классов?',
                schema: 'school',
                solutionSql: "SELECT COUNT(*) AS count FROM Class WHERE name LIKE '10%'",
                difficultyPercent: 10,
                isFree: true,
                hint: "COUNT(*) + WHERE name LIKE '10%'",
                points: 5,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 35,
                lessonId: 7,
                title: 'Кабинеты 2 сентября',
                description: 'COUNT DISTINCT',
                taskText: 'Сколько различных кабинетов школы использовались 2.09.2019 в образовательных целях?',
                schema: 'school',
                // ✅ ИСПРАВЛЕНО: COUNT(DISTINCT classroom) вместо DISTINCT COUNT
                solutionSql: "SELECT COUNT(DISTINCT classroom) AS count FROM Schedule WHERE date = '2019-09-02'",
                difficultyPercent: 15,
                isFree: true,
                hint: 'COUNT(DISTINCT classroom) — считает уникальные кабинеты',
                points: 10,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 36,
                lessonId: 7,
                title: 'Улица Пушкина',
                description: 'LIKE для поиска по адресу',
                taskText: 'Выведите информацию об обучающихся живущих на улице Пушкина (ul. Pushkina)',
                schema: 'school',
                solutionSql: "SELECT * FROM Student WHERE address LIKE '%Pushkina%'",
                difficultyPercent: 10,
                isFree: true,
                hint: "LIKE '%Pushkina%' — ищет подстроку в адресе",
                points: 5,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 37,
                lessonId: 7,
                title: 'Самый молодой ученик',
                description: 'TIMESTAMPDIFF + MIN',
                taskText: 'Сколько лет самому молодому обучающемуся?',
                schema: 'school',
                solutionSql: 'SELECT MIN(TIMESTAMPDIFF(YEAR, birthday, NOW())) AS year FROM Student',
                difficultyPercent: 30,
                isFree: true,
                hint: 'MIN — находит минимальный возраст (= самый молодой)',
                points: 15,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 38,
                lessonId: 7,
                title: 'Сколько Анн',
                description: 'COUNT с условием WHERE',
                // ✅ ИСПРАВЛЕНО: добавлено описание задачи
                taskText: 'Сколько обучающихся с именем Anna?',
                schema: 'school',
                solutionSql: "SELECT COUNT(*) AS count FROM Student WHERE first_name = 'Anna'",
                difficultyPercent: 10,
                isFree: true,
                hint: "COUNT(*) + WHERE first_name = 'Anna'",
                points: 5,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 39,
                lessonId: 7,
                title: 'Ученики 10 B',
                description: 'JOIN + COUNT',
                taskText: 'Сколько обучающихся в 10 B классе?',
                schema: 'school',
                solutionSql: "SELECT COUNT(*) AS count FROM Student_in_class JOIN Class ON Class.id = Student_in_class.class WHERE Class.name = '10 B'",
                difficultyPercent: 20,
                isFree: true,
                hint: 'JOIN Student_in_class и Class + WHERE name',
                points: 10,
                sqlType: 'select',
                now: $now
            ),

            // ============================================================
            //  УРОК 8: Школьная база — JOIN (задачи 40-44)
            // ============================================================

            $this->task(
                id: 40,
                lessonId: 8,
                title: 'Предметы Ромашкина',
                description: 'Тройной JOIN + DISTINCT',
                taskText: 'Выведите название предметов, которые преподает Ромашкин П.П. (Romashkin P.P.)',
                schema: 'school',
                solutionSql: "SELECT DISTINCT Subject.name AS subjects FROM Subject JOIN Schedule ON Subject.id = Schedule.subject JOIN Teacher ON Teacher.id = Schedule.teacher WHERE Teacher.last_name = 'Romashkin'",
                difficultyPercent: 30,
                isFree: true,
                hint: 'JOIN Subject ↔ Schedule ↔ Teacher + WHERE last_name',
                points: 15,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 41,
                lessonId: 8,
                title: '4-й урок',
                description: 'Простой SELECT по id',
                taskText: 'Во сколько начинается 4-ый учебный предмет по расписанию?',
                schema: 'school',
                solutionSql: 'SELECT start_pair FROM Timepair WHERE id = 4',
                difficultyPercent: 5,
                isFree: true,
                hint: 'WHERE id = 4',
                points: 5,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 42,
                lessonId: 8,
                title: 'Время в школе',
                description: 'TIMEDIFF с подзапросами',
                taskText: 'Сколько времени обучающийся будет находиться в школе, учась со 2-го по 4-ый уч. предмет?',
                schema: 'school',
                solutionSql: 'SELECT TIMEDIFF((SELECT end_pair FROM Timepair WHERE id = 4), (SELECT start_pair FROM Timepair WHERE id = 2)) AS time',
                difficultyPercent: 30,
                isFree: true,
                hint: 'TIMEDIFF(конец 4-го, начало 2-го)',
                points: 15,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 43,
                lessonId: 8,
                title: 'Преподаватели физкультуры',
                description: 'Тройной JOIN + ORDER BY',
                taskText: 'Выведите фамилии преподавателей, которые ведут физическую культуру (Physical Culture). Отсортируйте по фамилии.',
                schema: 'school',
                solutionSql: "SELECT last_name FROM Teacher JOIN Schedule ON Teacher.id = Schedule.teacher JOIN Subject ON Subject.id = Schedule.subject WHERE Subject.name = 'Physical Culture' ORDER BY last_name ASC",
                difficultyPercent: 30,
                isFree: true,
                hint: 'JOIN Teacher ↔ Schedule ↔ Subject + ORDER BY last_name',
                points: 15,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 44,
                lessonId: 8,
                title: 'Макс. возраст 10 классов',
                description: 'MAX + TIMESTAMPDIFF + тройной JOIN',
                taskText: 'Найдите максимальный возраст (количество лет) среди обучающихся 10 классов',
                schema: 'school',
                solutionSql: "SELECT MAX(TIMESTAMPDIFF(YEAR, Student.birthday, NOW())) AS max_year FROM Student JOIN Student_in_class ON Student.id = Student_in_class.student JOIN Class ON Class.id = Student_in_class.class WHERE Class.name LIKE '10%'",
                difficultyPercent: 35,
                isFree: true,
                hint: 'MAX + TIMESTAMPDIFF + JOIN с фильтром по 10%',
                points: 20,
                sqlType: 'select',
                now: $now
            ),

            // ============================================================
            //  УРОК 9: Школьная база — продвинутые (задачи 45-50)
            // ============================================================

            $this->task(
                id: 45,
                lessonId: 9,
                title: 'Самые популярные кабинеты',
                description: 'GROUP BY + HAVING с подзапросом',
                taskText: 'Какой(ие) кабинет(ы) пользуются самым большим спросом?',
                schema: 'school',
                // ✅ ИСПРАВЛЕНО: корректный подзапрос для MAX
                solutionSql: 'SELECT classroom FROM Schedule GROUP BY classroom HAVING COUNT(*) = (SELECT COUNT(*) AS cnt FROM Schedule GROUP BY classroom ORDER BY cnt DESC LIMIT 1)',
                difficultyPercent: 50,
                isFree: false,
                hint: 'Подзапрос для MAX количества использований + HAVING',
                points: 25,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 46,
                lessonId: 9,
                title: 'Классы Краузе',
                description: 'DISTINCT + тройной JOIN',
                taskText: 'В каких классах ведёт занятия преподаватель "Krauze"?',
                schema: 'school',
                solutionSql: "SELECT DISTINCT Class.name FROM Class JOIN Schedule ON Class.id = Schedule.class JOIN Teacher ON Teacher.id = Schedule.teacher WHERE Teacher.last_name = 'Krauze'",
                difficultyPercent: 25,
                isFree: true,
                hint: "JOIN Class ↔ Schedule ↔ Teacher + WHERE last_name = 'Krauze'",
                points: 15,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 47,
                lessonId: 9,
                title: 'Занятия Краузе 30 августа',
                description: 'COUNT + JOIN + фильтр по дате',
                taskText: 'Сколько занятий провел Krauze 30 августа 2019 г.?',
                schema: 'school',
                solutionSql: "SELECT COUNT(*) AS count FROM Schedule JOIN Teacher ON Teacher.id = Schedule.teacher WHERE Teacher.last_name = 'Krauze' AND Schedule.date = '2019-08-30'",
                difficultyPercent: 25,
                isFree: true,
                hint: "JOIN + WHERE last_name = 'Krauze' AND date = '2019-08-30'",
                points: 15,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 48,
                lessonId: 9,
                title: 'Заполненность классов',
                description: 'JOIN + COUNT + ORDER BY DESC',
                taskText: 'Выведите заполненность классов в порядке убывания',
                schema: 'school',
                solutionSql: 'SELECT Class.name, COUNT(*) AS count FROM Class JOIN Student_in_class ON Class.id = Student_in_class.class GROUP BY Class.name ORDER BY count DESC',
                difficultyPercent: 30,
                isFree: true,
                hint: 'GROUP BY name + ORDER BY COUNT(*) DESC',
                points: 15,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 49,
                lessonId: 9,
                title: 'Процент в 10 A',
                description: 'Подзапрос для вычисления процента',
                taskText: 'Какой процент обучающихся учится в 10 A классе?',
                schema: 'school',
                solutionSql: "SELECT COUNT(*) * 100 / (SELECT COUNT(*) FROM Student_in_class) AS percent FROM Student_in_class JOIN Class ON Class.id = Student_in_class.class WHERE Class.name = '10 A'",
                difficultyPercent: 50,
                isFree: false,
                hint: 'COUNT в классе * 100 / общий COUNT = процент',
                points: 25,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 50,
                lessonId: 9,
                title: 'Процент рождённых в 2000',
                description: 'FLOOR + подзапрос + YEAR',
                taskText: 'Какой процент обучающихся родился в 2000 году? Результат округлить до целого в меньшую сторону.',
                schema: 'school',
                solutionSql: "SELECT FLOOR(COUNT(*) * 100 / (SELECT COUNT(*) FROM Student_in_class)) AS percent FROM Student WHERE YEAR(birthday) = 2000",
                difficultyPercent: 50,
                isFree: false,
                hint: 'FLOOR + подзапрос для общего числа + YEAR(birthday) = 2000',
                points: 25,
                sqlType: 'select',
                now: $now
            ),

            // ============================================================
            //  УРОК 10: DML — INSERT, UPDATE, DELETE (задачи 51-58)
            // ============================================================

            $this->task(
                id: 51,
                lessonId: 10,
                title: 'Добавить Cheese',
                description: 'INSERT INTO с указанием столбцов',
                taskText: 'Добавьте товар с именем "Cheese" и типом "food" в список товаров (Goods).',
                schema: 'family',
                solutionSql: "INSERT INTO Goods (good_id, good_name, type) VALUES (17, 'Cheese', 2)",
                difficultyPercent: 15,
                isFree: true,
                hint: 'INSERT INTO таблица (столбцы) VALUES (значения)',
                points: 10,
                sqlType: 'insert',
                now: $now
            ),

            $this->task(
                id: 52,
                lessonId: 10,
                title: 'Добавить тип auto',
                description: 'INSERT INTO',
                taskText: 'Добавьте в список типов товаров (GoodTypes) новый тип "auto".',
                schema: 'family',
                solutionSql: "INSERT INTO GoodTypes (good_type_id, good_type_name) VALUES (9, 'auto')",
                difficultyPercent: 15,
                isFree: true,
                hint: 'INSERT INTO GoodTypes VALUES (...)',
                points: 10,
                sqlType: 'insert',
                now: $now
            ),

            $this->task(
                id: 53,
                lessonId: 10,
                title: 'Переименовать Andie',
                description: 'UPDATE SET WHERE',
                taskText: 'Измените имя "Andie Quincey" на новое "Andie Anthony".',
                schema: 'family',
                solutionSql: "UPDATE FamilyMembers SET member_name = 'Andie Anthony' WHERE member_id = 3",
                difficultyPercent: 15,
                isFree: true,
                hint: 'UPDATE ... SET ... WHERE member_id = 3',
                points: 10,
                sqlType: 'update',
                now: $now
            ),

            $this->task(
                id: 54,
                lessonId: 10,
                title: 'Удалить Quincey',
                description: 'DELETE с LIKE',
                taskText: 'Удалить всех членов семьи с фамилией "Quincey".',
                schema: 'family',
                solutionSql: "DELETE FROM FamilyMembers WHERE member_name LIKE '%Quincey'",
                difficultyPercent: 15,
                isFree: true,
                hint: "DELETE FROM ... WHERE member_name LIKE '%Quincey'",
                points: 10,
                sqlType: 'delete',
                now: $now
            ),

            $this->task(
                id: 55,
                lessonId: 10,
                title: 'Удалить компании с мин. рейсами',
                description: 'DELETE с подзапросом',
                taskText: 'Удалить компании, совершившие наименьшее количество рейсов.',
                schema: 'airlines',
                // ✅ ИСПРАВЛЕНО: один DELETE с подзапросом вместо трёх
                solutionSql: "DELETE FROM Company WHERE id IN (SELECT company FROM (SELECT company, COUNT(*) AS cnt FROM Trip GROUP BY company HAVING cnt = (SELECT COUNT(*) AS c FROM Trip GROUP BY company ORDER BY c ASC LIMIT 1)) AS sub)",
                difficultyPercent: 60,
                isFree: false,
                hint: 'DELETE + подзапрос для нахождения MIN количества рейсов',
                points: 30,
                sqlType: 'delete',
                now: $now
            ),

            $this->task(
                id: 56,
                lessonId: 10,
                title: 'Удалить рейсы из Москвы',
                description: 'DELETE с WHERE',
                taskText: 'Удалить все перелеты, совершенные из Москвы (Moscow).',
                schema: 'airlines',
                solutionSql: "DELETE FROM Trip WHERE town_from = 'Moscow'",
                difficultyPercent: 10,
                isFree: true,
                hint: "DELETE FROM Trip WHERE town_from = 'Moscow'",
                points: 10,
                sqlType: 'delete',
                now: $now
            ),

            $this->task(
                id: 57,
                lessonId: 10,
                title: 'Сдвинуть расписание +30 мин',
                description: 'UPDATE с DATE_ADD',
                taskText: 'Перенести расписание всех занятий на 30 мин. вперед.',
                schema: 'school',
                // ✅ ИСПРАВЛЕНО: один UPDATE с двумя SET
                solutionSql: 'UPDATE Timepair SET start_pair = DATE_ADD(start_pair, INTERVAL 30 MINUTE), end_pair = DATE_ADD(end_pair, INTERVAL 30 MINUTE)',
                difficultyPercent: 25,
                isFree: true,
                hint: 'DATE_ADD(поле, INTERVAL 30 MINUTE) — добавляет 30 минут',
                points: 15,
                sqlType: 'update',
                now: $now
            ),

            $this->task(
                id: 58,
                lessonId: 10,
                title: 'Добавить отзыв',
                description: 'INSERT с данными из связанных таблиц',
                taskText: 'Добавить отзыв с рейтингом 5 на жилье по адресу "11218, Friel Place, New York" от имени "George Clooney"',
                schema: 'booking',
                solutionSql: 'INSERT INTO Reviews (id, reservation_id, rating) VALUES (23, 2, 5)',
                difficultyPercent: 30,
                isFree: true,
                hint: 'Сначала найдите reservation_id, затем INSERT INTO Reviews',
                points: 15,
                sqlType: 'insert',
                now: $now
            ),

            // ============================================================
            //  УРОК 11: Бронирование и строковые функции (задачи 59-62)
            // ============================================================

            $this->task(
                id: 59,
                lessonId: 11,
                title: 'Белорусские номера',
                description: 'LIKE для телефонного кода',
                taskText: 'Вывести пользователей, указавших Белорусский номер телефона. Телефонный код Белоруссии +375.',
                schema: 'booking',
                solutionSql: "SELECT * FROM Users WHERE phone_number LIKE '+375%'",
                difficultyPercent: 10,
                isFree: true,
                hint: "LIKE '+375%'",
                points: 5,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 60,
                lessonId: 11,
                title: 'Преподаватели всех 11 классов',
                description: 'JOIN + GROUP BY + HAVING COUNT(DISTINCT)',
                taskText: 'Выведите идентификаторы преподавателей, которые хотя бы один раз за всё время преподавали в каждом из одиннадцатых классов.',
                schema: 'school',
                solutionSql: "SELECT Schedule.teacher FROM Schedule JOIN Class ON Class.id = Schedule.class WHERE Class.name IN ('11 A', '11 B') GROUP BY Schedule.teacher HAVING COUNT(DISTINCT Class.name) = 2 ORDER BY Schedule.teacher",
                difficultyPercent: 55,
                isFree: false,
                hint: 'GROUP BY teacher + HAVING COUNT(DISTINCT Class.name) = количество 11-х классов',
                points: 30,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 61,
                lessonId: 11,
                title: 'Бронирования 12 недели',
                description: 'JOIN + функция WEEK()',
                taskText: 'Выведите список комнат, которые были зарезервированы в течение 12 недели 2020 года.',
                schema: 'booking',
                solutionSql: "SELECT Rooms.* FROM Rooms JOIN Reservations ON Rooms.id = Reservations.room_id WHERE (WEEK(Reservations.start_date, 1) = 12 OR WEEK(Reservations.end_date, 1) = 12) AND YEAR(Reservations.start_date) = 2020",
                difficultyPercent: 45,
                isFree: false,
                hint: 'WEEK(date, 1) возвращает номер недели, 1 = понедельник-начало',
                points: 25,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 62,
                lessonId: 11,
                title: 'Популярные домены',
                description: 'SUBSTRING_INDEX + GROUP BY + двойная сортировка',
                taskText: 'Вывести в порядке убывания популярности доменные имена 2-го уровня, используемые для электронной почты. Дополнительно отсортировать по возрастанию названий.',
                schema: 'booking',
                solutionSql: "SELECT SUBSTRING_INDEX(email, '@', -1) AS domain, COUNT(*) AS count FROM Users GROUP BY domain ORDER BY count DESC, domain ASC",
                difficultyPercent: 40,
                isFree: false,
                hint: "SUBSTRING_INDEX(email, '@', -1) извлекает домен",
                points: 20,
                sqlType: 'select',
                now: $now
            ),

            // ============================================================
            //  УРОК 12: Продвинутые запросы (задачи 63-66)
            // ============================================================

            $this->task(
                id: 63,
                lessonId: 12,
                title: 'Фамилия.И.О.',
                description: 'CONCAT + LEFT для форматирования',
                taskText: 'Выведите отсортированный список (по возрастанию) имен студентов в виде Фамилия.И.О.',
                schema: 'school',
                solutionSql: "SELECT CONCAT(last_name, '.', LEFT(first_name, 1), '.', LEFT(middle_name, 1), '.') AS name FROM Student ORDER BY first_name ASC",
                difficultyPercent: 30,
                isFree: true,
                hint: "CONCAT объединяет строки, LEFT(str, 1) берёт первую букву",
                points: 15,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 64,
                lessonId: 12,
                title: 'Пары пассажиров',
                description: 'Self JOIN + GROUP BY + HAVING',
                taskText: 'Выведите имена всех пар пассажиров, летевших вместе на одном рейсе два или более раз, и количество таких совместных рейсов. В passengerName1 разместите имя пассажира с наименьшим идентификатором.',
                schema: 'airlines',
                solutionSql: "SELECT p1.name AS passengerName1, p2.name AS passengerName2, COUNT(*) AS count FROM Pass_in_trip AS pit1 JOIN Pass_in_trip AS pit2 ON pit1.trip = pit2.trip AND pit1.passenger < pit2.passenger JOIN Passenger AS p1 ON p1.id = pit1.passenger JOIN Passenger AS p2 ON p2.id = pit2.passenger GROUP BY pit1.passenger, pit2.passenger HAVING COUNT(*) >= 2",
                difficultyPercent: 70,
                isFree: false,
                hint: 'Self JOIN Pass_in_trip с условием passenger1 < passenger2',
                points: 35,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 65,
                lessonId: 12,
                title: 'Рейтинг комнат',
                description: 'FLOOR + AVG + JOIN + GROUP BY',
                taskText: 'Вывести рейтинг для комнат, которые хоть раз арендовали, как среднее значение рейтинга отзывов округленное до целого вниз.',
                schema: 'booking',
                solutionSql: 'SELECT Reservations.room_id, FLOOR(AVG(Reviews.rating)) AS rating FROM Reservations JOIN Reviews ON Reviews.reservation_id = Reservations.id GROUP BY Reservations.room_id',
                difficultyPercent: 35,
                isFree: false,
                hint: 'FLOOR(AVG(rating)) + GROUP BY room_id',
                points: 20,
                sqlType: 'select',
                now: $now
            ),

            $this->task(
                id: 66,
                lessonId: 12,
                title: 'Комнаты со всеми удобствами',
                description: 'RIGHT JOIN + COALESCE + SUM + DATEDIFF',
                taskText: 'Вывести список комнат со всеми удобствами (ТВ, интернет, кухня, кондиционер), общее количество дней и сумму за все дни аренды.',
                schema: 'booking',
                solutionSql: "SELECT Rooms.home_type, Rooms.address, COALESCE(SUM(DATEDIFF(Reservations.end_date, Reservations.start_date)), 0) AS days, COALESCE(SUM(Reservations.total), 0) AS total_fee FROM Rooms LEFT JOIN Reservations ON Rooms.id = Reservations.room_id WHERE Rooms.has_tv = 1 AND Rooms.has_internet = 1 AND Rooms.has_kitchen = 1 AND Rooms.has_air_con = 1 GROUP BY Rooms.address, Rooms.home_type",
                difficultyPercent: 55,
                isFree: false,
                hint: 'LEFT JOIN + WHERE все удобства = 1 + COALESCE для NULL значений',
                points: 30,
                sqlType: 'select',
                now: $now
            ),
        ];
    }
}
