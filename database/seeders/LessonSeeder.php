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

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('lessons')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $lessons = [];
        $id = 1;

        // =============================================================
        //  МОДУЛЬ 0: Введение (module_id = 1)
        // =============================================================

        $lessons[] = [
            'id'           => $id++,  // 1
            'course_id'    => 1,
            'module_id'    => 1,
            'title'        => 'Введение',
            'slug'         => 'intro',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 1,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 2
            'course_id'    => 1,
            'module_id'    => 1,
            'title'        => 'Структура курса',
            'slug'         => 'course-structure',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 2,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 3
            'course_id'    => 1,
            'module_id'    => 1,
            'title'        => 'Сообщество',
            'slug'         => 'community',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 3,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        // =============================================================
        //  МОДУЛЬ 1: Фундаментальные основы (module_id = 2)
        // =============================================================

        $lessons[] = [
            'id'           => $id++,  // 4
            'course_id'    => 1,
            'module_id'    => 2,
            'title'        => 'Базы данных и СУБД',
            'slug'         => 'databases-and-dbms',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 1,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 5
            'course_id'    => 1,
            'module_id'    => 2,
            'title'        => 'Типы баз данных',
            'slug'         => 'database-types',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 2,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 6
            'course_id'    => 1,
            'module_id'    => 2,
            'title'        => 'Реляционные базы данных',
            'slug'         => 'relational-databases',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 3,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 7
            'course_id'    => 1,
            'module_id'    => 2,
            'title'        => 'Key-value базы данных',
            'slug'         => 'key-value-databases',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 4,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 8
            'course_id'    => 1,
            'module_id'    => 2,
            'title'        => 'Документоориентированные базы данных',
            'slug'         => 'document-databases',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 5,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 9
            'course_id'    => 1,
            'module_id'    => 2,
            'title'        => 'Структура реляционных баз данных',
            'slug'         => 'relational-db-structure',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 6,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 10
            'course_id'    => 1,
            'module_id'    => 2,
            'title'        => 'Вводная информация о SQL',
            'slug'         => 'sql-introduction',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 7,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        // =============================================================
        //  МОДУЛЬ 2: Основы выборки I (module_id = 3)
        // =============================================================

        $lessons[] = [
            'id'           => $id++,  // 11
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Базовый синтаксис SQL запроса',
            'slug'         => 'sql-query-syntax',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 1,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 12
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Литералы',
            'slug'         => 'literals',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 2,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 13
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Применение функций',
            'slug'         => 'using-functions',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 3,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 14
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Исключение дубликатов, DISTINCT',
            'slug'         => 'distinct',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 4,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 15
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Условный оператор WHERE',
            'slug'         => 'where',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 5,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 16
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Операторы IS NULL, BETWEEN, IN',
            'slug'         => 'is-null-between-in',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 6,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 17
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Оператор LIKE',
            'slug'         => 'like',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 7,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 18
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Регулярные выражения',
            'slug'         => 'regexp',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 8,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 19
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Сортировка, оператор ORDER BY',
            'slug'         => 'order-by',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 9,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 20
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Группировка, оператор GROUP BY',
            'slug'         => 'group-by',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 10,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 21
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Агрегатные функции',
            'slug'         => 'aggregate-functions',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 11,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 22
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Оператор HAVING',
            'slug'         => 'having',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 12,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        // =============================================================
        //  МОДУЛЬ 3: Основы выборки II (module_id = 4)
        // =============================================================

        $lessons[] = [
            'id'           => $id++,  // 23
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'Многотабличные запросы, оператор JOIN',
            'slug'         => 'join',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 1,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 24
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'INNER JOIN',
            'slug'         => 'inner-join',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 2,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 25
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'OUTER JOIN',
            'slug'         => 'outer-join',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 3,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 26
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'Ограничение выборки, оператор LIMIT',
            'slug'         => 'limit',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 4,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 27
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'Подзапросы',
            'slug'         => 'subqueries',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 5,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 28
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'Подзапросы с одной строкой с одним столбцом',
            'slug'         => 'single-row-subqueries',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 6,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 29
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'Подзапросы с несколькими строками и одним столбцом',
            'slug'         => 'multi-row-subqueries',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 7,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 30
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'Многостолбцовые подзапросы',
            'slug'         => 'multi-column-subqueries',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 8,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 31
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'Коррелированные подзапросы',
            'slug'         => 'correlated-subqueries',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 9,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 32
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'Обобщенное табличное выражение, WITH',
            'slug'         => 'cte-with',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 10,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 33
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'Объединение запросов, оператор UNION',
            'slug'         => 'union',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 11,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 34
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'Условная логика, оператор CASE',
            'slug'         => 'case',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 12,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 35
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'Условная функция IF',
            'slug'         => 'if-function',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 13,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        // =============================================================
        //  МОДУЛЬ 4: Манипулирование данными (module_id = 5)
        // =============================================================

        $lessons[] = [
            'id'           => $id++,  // 36
            'course_id'    => 1,
            'module_id'    => 5,
            'title'        => 'Добавление данных, оператор INSERT',
            'slug'         => 'insert',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 1,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 37
            'course_id'    => 1,
            'module_id'    => 5,
            'title'        => 'Обновление данных, оператор UPDATE',
            'slug'         => 'update',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 2,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 38
            'course_id'    => 1,
            'module_id'    => 5,
            'title'        => 'Удаление данных, оператор DELETE',
            'slug'         => 'delete',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 3,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        // =============================================================
        //  МОДУЛЬ 5: Продвинутый SQL (module_id = 6)
        // =============================================================

        $lessons[] = [
            'id'           => $id++,  // 39
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Работа с типами данных',
            'slug'         => 'working-with-data-types',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 1,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 40
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Числовой тип данных',
            'slug'         => 'numeric-data-type',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 2,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 41
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Дата и время',
            'slug'         => 'date-and-time',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 3,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 42
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Функции преобразования типов, CAST',
            'slug'         => 'cast',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 4,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 43
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Оконные функции',
            'slug'         => 'window-functions',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 5,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 44
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Партиции в оконных функциях',
            'slug'         => 'window-partitions',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 6,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 45
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Сортировка внутри окна',
            'slug'         => 'window-ordering',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 7,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 46
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Рамки окон в оконных функциях',
            'slug'         => 'window-frames',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 8,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 47
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Типы оконных функций',
            'slug'         => 'window-function-types',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 9,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 48
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Транзакции',
            'slug'         => 'transactions',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 10,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 49
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Блокировки в СУБД',
            'slug'         => 'locks',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 11,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 50
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Создание транзакций',
            'slug'         => 'creating-transactions',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 12,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 51
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Хранимые процедуры и функции',
            'slug'         => 'stored-procedures-and-functions',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 13,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 52
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Хранимые функции',
            'slug'         => 'stored-functions',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 14,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 53
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Хранимые процедуры',
            'slug'         => 'stored-procedures',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 15,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 54
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Операторы IF, CASE, WHILE в хранимых процедурах',
            'slug'         => 'control-flow-in-procedures',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 16,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 55
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Планировщик событий',
            'slug'         => 'event-scheduler',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 17,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        // =============================================================
        //  МОДУЛЬ 6: Базы данных и таблицы (module_id = 7)
        // =============================================================

        $lessons[] = [
            'id'           => $id++,  // 56
            'course_id'    => 1,
            'module_id'    => 7,
            'title'        => 'Создание и удаление баз данных',
            'slug'         => 'create-drop-database',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 1,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 57
            'course_id'    => 1,
            'module_id'    => 7,
            'title'        => 'Создание и удаление таблиц',
            'slug'         => 'create-drop-table',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 2,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 58
            'course_id'    => 1,
            'module_id'    => 7,
            'title'        => 'Типы данных для колонок таблиц',
            'slug'         => 'column-data-types',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 3,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 59
            'course_id'    => 1,
            'module_id'    => 7,
            'title'        => 'Строковый тип данных',
            'slug'         => 'string-data-type',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 4,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 60
            'course_id'    => 1,
            'module_id'    => 7,
            'title'        => 'Числовой тип данных',
            'slug'         => 'numeric-column-type',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 5,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 61
            'course_id'    => 1,
            'module_id'    => 7,
            'title'        => 'Дата и время',
            'slug'         => 'datetime-column-type',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 6,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 62
            'course_id'    => 1,
            'module_id'    => 7,
            'title'        => 'Представления, VIEW',
            'slug'         => 'view',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 7,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 63
            'course_id'    => 1,
            'module_id'    => 7,
            'title'        => 'Индексы в SQL',
            'slug'         => 'indexes',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 8,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,  // 64
            'course_id'    => 1,
            'module_id'    => 7,
            'title'        => 'Ограничения столбцов (Constraints)',
            'slug'         => 'constraints',
            'content'      => null,
            'lesson_type'  => 'theory',
            'lesson_order' => 9,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        // =============================================================
        //  Вставка
        // =============================================================

        DB::table('lessons')->insert($lessons);

        echo "✅ Уроки созданы (" . count($lessons) . " записей)\n";
    }
}
