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
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 1,
            'title' => 'Введение',
            'slug' => 'intro',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Добро пожаловать в курс SQL'],
                    ['type' => 'paragraph', 'text' => 'Этот курс поможет тебе последовательно освоить SQL — от простейших запросов до сложных аналитических конструкций.'],
                    ['type' => 'paragraph', 'text' => 'Ты научишься понимать устройство реляционных баз данных, уверенно писать запросы и применять SQL в реальных задачах.'],
                    ['type' => 'list', 'items' => [
                        'Что такое базы данных и зачем нужен SQL',
                        'Как писать SELECT-запросы',
                        'Фильтрация, сортировка, группировка',
                        'JOIN, подзапросы и оконные функции',
                    ]],
                    ['type' => 'paragraph', 'text' => 'Каждый урок содержит теоретический блок с примерами SQL-кода. По мере прохождения курса задачи становятся сложнее.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 1,
            'title' => 'Структура курса',
            'slug' => 'course-structure',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Как устроен курс'],
                    ['type' => 'paragraph', 'text' => 'Курс состоит из модулей. Каждый модуль посвящён отдельной теме и содержит несколько уроков.'],
                    ['type' => 'list', 'items' => [
                        'Модуль 0 — Введение',
                        'Модуль 1 — Фундаментальные основы',
                        'Модуль 2 — Основы выборки I',
                        'Модуль 3 — Основы выборки II',
                        'Модуль 4 — Манипулирование данными',
                        'Модуль 5 — Продвинутый SQL',
                        'Модуль 6 — Базы данных и таблицы',
                    ]],
                    ['type' => 'paragraph', 'text' => 'Рекомендуется проходить уроки последовательно, так как каждая тема опирается на предыдущие.'],
                    ['type' => 'paragraph', 'text' => 'После теории по каждой теме можно решать практические задания для закрепления.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 1,
            'title' => 'Сообщество',
            'slug' => 'community',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Зачем нужно сообщество'],
                    ['type' => 'paragraph', 'text' => 'Обучение проходит значительно эффективнее, когда можно обсуждать задачи, разбирать ошибки и делиться различными подходами к решению.'],
                    ['type' => 'paragraph', 'text' => 'Одну и ту же задачу в SQL можно решить несколькими способами. Обсуждение альтернативных решений помогает глубже понять язык.'],
                    ['type' => 'paragraph', 'text' => 'Не бойся ошибаться — разбор ошибок является важной частью процесса обучения.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        // =============================================================
        //  МОДУЛЬ 1: Фундаментальные основы (module_id = 2)
        // =============================================================

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 2,
            'title' => 'Базы данных и СУБД',
            'slug' => 'databases-and-dbms',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Что такое база данных'],
                    ['type' => 'paragraph', 'text' => 'База данных — это организованное хранилище информации. Она позволяет структурированно хранить данные о пользователях, товарах, заказах и любых других сущностях.'],
                    ['type' => 'heading', 'text' => 'Что такое СУБД'],
                    ['type' => 'paragraph', 'text' => 'СУБД (система управления базами данных) — это программа, которая управляет базой данных: создаёт таблицы, хранит записи, обрабатывает запросы и обеспечивает безопасность данных.'],
                    ['type' => 'list', 'items' => [
                        'MySQL — одна из самых популярных СУБД с открытым кодом',
                        'PostgreSQL — мощная СУБД с поддержкой сложных типов данных',
                        'SQLite — лёгкая файловая СУБД для встраиваемых приложений',
                        'Microsoft SQL Server — коммерческая СУБД от Microsoft',
                    ]],
                    ['type' => 'paragraph', 'text' => 'СУБД принимает SQL-запросы от пользователя, выполняет их и возвращает результат.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 2,
            'title' => 'Типы баз данных',
            'slug' => 'database-types',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Основные типы баз данных'],
                    ['type' => 'paragraph', 'text' => 'Базы данных различаются по модели хранения данных. Выбор типа зависит от задач проекта.'],
                    ['type' => 'list', 'items' => [
                        'Реляционные — данные хранятся в таблицах со строками и столбцами',
                        'Key-value — данные представлены парами ключ-значение',
                        'Документоориентированные — данные хранятся в виде JSON-документо��',
                        'Графовые — данные описывают связи между объектами',
                    ]],
                    ['type' => 'paragraph', 'text' => 'Реляционные базы данных — самый распространённый тип. Именно для работы с ними используется язык SQL.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 2,
            'title' => 'Реляционные базы данных',
            'slug' => 'relational-databases',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Реляционная модель'],
                    ['type' => 'paragraph', 'text' => 'Реляционные базы данных хранят информацию в таблицах. Каждая таблица имеет фиксированный набор столбцов и произвольное количество строк.'],
                    ['type' => 'paragraph', 'text' => 'Каждая строка таблицы представляет одну запись, а каждый столбец — отдельное свойство (атрибут) этой записи.'],
                    ['type' => 'paragraph', 'text' => 'Таблицы могут быть связаны друг с другом через ключи. Это позволяет избежать дублирования данных и строить запросы, объединяющие информацию из нескольких таблиц.'],
                    ['type' => 'paragraph', 'text' => 'Реляционная модель была предложена Эдгаром Коддом в 1970 году и до сих пор остаётся основой большинства корпоративных систем.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 2,
            'title' => 'Key-value базы данных',
            'slug' => 'key-value-databases',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Key-value хранилища'],
                    ['type' => 'paragraph', 'text' => 'В key-value базах данные хранятся как пары: уникальный ключ и связанное с ним значение.'],
                    ['type' => 'code', 'language' => 'text', 'content' => "session_abc123 => {user_id: 42, role: 'admin'}\ncache:products_list => '[{id:1, name:\"Laptop\"}, ...]'"],
                    ['type' => 'paragraph', 'text' => 'Такой подход обеспечивает очень быстрый доступ к данным по ключу. Он широко используется для кэширования, хранения сессий и очередей сообщений.'],
                    ['type' => 'paragraph', 'text' => 'Примеры key-value СУБД: Redis, Memcached, Amazon DynamoDB.'],
                    ['type' => 'paragraph', 'text' => 'Главное ограничение — отсутствие возможности делать сложные выборки и объединения данных, как в SQL.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 4,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 2,
            'title' => 'Документоориентированные базы данных',
            'slug' => 'document-databases',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Документоориентированные базы данных'],
                    ['type' => 'paragraph', 'text' => 'В документоориентированных базах данных информация хранится в виде документов — чаще всего в формате JSON или BSON.'],
                    ['type' => 'code', 'language' => 'json', 'content' => "{\n  \"name\": \"Ali\",\n  \"email\": \"ali@example.com\",\n  \"age\": 25,\n  \"skills\": [\"SQL\", \"Laravel\", \"Vue.js\"]\n}"],
                    ['type' => 'paragraph', 'text' => 'Каждый документ может иметь свою собственную структуру, что делает эту модель гибкой для проектов с часто меняющимися требованиями.'],
                    ['type' => 'paragraph', 'text' => 'Примеры: MongoDB, CouchDB, Firebase Firestore.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 5,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 2,
            'title' => 'Структура реляционных баз данных',
            'slug' => 'relational-db-structure',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Из чего состоит реляционная база данных'],
                    ['type' => 'paragraph', 'text' => 'Реляционная база данных включает таблицы, столбцы, строки, первичные и внешние ключи, а также ограничения целостности.'],
                    ['type' => 'heading', 'text' => 'Первичный ключ (Primary Key)'],
                    ['type' => 'paragraph', 'text' => 'Первичный ключ — это столбец (или набор столбцов), который однозначно идентифицирует каждую строку таблицы. Чаще всего используется числовой столбец id с автоинкрементом.'],
                    ['type' => 'heading', 'text' => 'Внешний ключ (Foreign Key)'],
                    ['type' => 'paragraph', 'text' => 'Внешний ключ — это столбец, который ссылается на первичный ключ другой таблицы. Он создаёт связь между таблицами.'],
                    ['type' => 'code', 'language' => 'text', 'content' => "users: id, name, email\norders: id, user_id, product, amount\n\norders.user_id → users.id"],
                    ['type' => 'paragraph', 'text' => 'Правильная структура базы данных помогает избежать дублирования информации, упрощает поддержку и повышает производительность запросов.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 6,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 2,
            'title' => 'Вводная информация о SQL',
            'slug' => 'sql-introduction',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Что такое SQL'],
                    ['type' => 'paragraph', 'text' => 'SQL (Structured Query Language) — это стандартизированный язык для работы с реляционными базами данных. Он позволяет выполнять четыре основных типа операций с данными.'],
                    ['type' => 'list', 'items' => [
                        'Получение данных — SELECT',
                        'Добавление данных — INSERT',
                        'Изменение данных — UPDATE',
                        'Удаление данных — DELETE',
                    ]],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT * FROM users;"],
                    ['type' => 'paragraph', 'text' => 'SQL также включает команды для создания таблиц, изменения их структуры, управления правами доступа и другие.'],
                    ['type' => 'paragraph', 'text' => 'Несмотря на наличие стандарта SQL, каждая СУБД имеет свои расширения и особенности синтаксиса.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 7,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        // =============================================================
        //  МОДУЛЬ 2: Основы выборки I (module_id = 3)
        // =============================================================

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 3,
            'title' => 'Базовый синтаксис SQL запроса',
            'slug' => 'sql-query-syntax',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Структура SELECT-запроса'],
                    ['type' => 'paragraph', 'text' => 'Основной запрос в SQL строится из трёх ключевых частей: SELECT, FROM и WHERE.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT column1, column2\nFROM table_name\nWHERE condition;"],
                    ['type' => 'list', 'items' => [
                        'SELECT — определяет, какие столбцы будут в результате',
                        'FROM — указывает таблицу-источник данных',
                        'WHERE — задаёт условие фильтрации строк',
                    ]],
                    ['type' => 'paragraph', 'text' => 'Для выбора всех столбцов используется символ звёздочки:'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT * FROM users;"],
                    ['type' => 'paragraph', 'text' => 'Результатом SELECT-запроса всегда является таблица — набор строк и столбцов.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 3,
            'title' => 'Литералы',
            'slug' => 'literals',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Что такое литералы в SQL'],
                    ['type' => 'paragraph', 'text' => 'Литералы — это фиксированные значения, которые записываются прямо в SQL-запросе. Они не зависят от данных в таблице.'],
                    ['type' => 'list', 'items' => [
                        'Числовые литералы: 42, 3.14, -100',
                        "Строковые литералы: 'Hello', 'SQL курс'",
                        "Литералы даты: '2026-01-15'",
                        'NULL — специальное значение, означающее отсутствие данных',
                    ]],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT 'Hello' AS greeting, 42 AS answer;"],
                    ['type' => 'paragraph', 'text' => 'Литералы можно использовать не только в WHERE, но и в SELECT для создания вычисляемых столбцов.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 3,
            'title' => 'Применение функций',
            'slug' => 'using-functions',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Функции в SQL'],
                    ['type' => 'paragraph', 'text' => 'SQL предоставляет множество встроенных функций для обработки данных прямо внутри запроса.'],
                    ['type' => 'heading', 'text' => 'Строковые функции'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT UPPER(name) AS upper_name,\n       LENGTH(name) AS name_length\nFROM users;"],
                    ['type' => 'heading', 'text' => 'Числовые функции'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT ROUND(price, 2) AS rounded_price,\n       ABS(balance) AS abs_balance\nFROM products;"],
                    ['type' => 'heading', 'text' => 'Функции даты'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT NOW() AS current_time,\n       YEAR(created_at) AS reg_year\nFROM users;"],
                    ['type' => 'paragraph', 'text' => 'Функции можно применять в SELECT, WHERE, ORDER BY и других частях запроса.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 3,
            'title' => 'Исключение дубликатов, DISTINCT',
            'slug' => 'distinct',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Оператор DISTINCT'],
                    ['type' => 'paragraph', 'text' => 'DISTINCT убирает повторяющиеся строки из результата запроса, оставляя только уникальные значения.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT DISTINCT city\nFROM users;"],
                    ['type' => 'paragraph', 'text' => 'DISTINCT можно применять к нескольким столбцам — тогда уникальность определяется по комбинации значений:'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT DISTINCT city, country\nFROM users;"],
                    ['type' => 'paragraph', 'text' => 'DISTINCT ставится сразу после ключевого слова SELECT, перед списком столбцов.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 4,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 3,
            'title' => 'Условный оператор WHERE',
            'slug' => 'where',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Фильтрация с помощью WHERE'],
                    ['type' => 'paragraph', 'text' => 'WHERE используется для отбора строк, соответствующих заданному условию.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT *\nFROM employees\nWHERE salary > 50000;"],
                    ['type' => 'heading', 'text' => 'Логические операторы'],
                    ['type' => 'paragraph', 'text' => 'Условия можно комбинировать с помощью AND, OR и NOT:'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT *\nFROM employees\nWHERE salary > 50000\n  AND department = 'IT';"],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT *\nFROM products\nWHERE category = 'electronics'\n   OR category = 'books';"],
                    ['type' => 'paragraph', 'text' => 'WHERE выполняется до GROUP BY и ORDER BY — это важно для понимания порядка обработки запроса.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 5,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 3,
            'title' => 'Операторы IS NULL, BETWEEN, IN',
            'slug' => 'is-null-between-in',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Дополнительные операторы фильтрации'],
                    ['type' => 'heading', 'text' => 'IS NULL и IS NOT NULL'],
                    ['type' => 'paragraph', 'text' => 'NULL — это специальное значение, означающее отсутствие данных. Для проверки на NULL нельзя использовать знак равенства.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT * FROM users\nWHERE phone IS NULL;\n\nSELECT * FROM users\nWHERE phone IS NOT NULL;"],
                    ['type' => 'heading', 'text' => 'BETWEEN'],
                    ['type' => 'paragraph', 'text' => 'BETWEEN проверяет, попадает ли значение в указанный диапазон (включительно):'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT * FROM products\nWHERE price BETWEEN 100 AND 500;"],
                    ['type' => 'heading', 'text' => 'IN'],
                    ['type' => 'paragraph', 'text' => 'IN проверяет, входит ли значение в заданный список:'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT * FROM orders\nWHERE status IN ('new', 'processing', 'shipped');"],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 6,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 3,
            'title' => 'Оператор LIKE',
            'slug' => 'like',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Поиск по шаблону с LIKE'],
                    ['type' => 'paragraph', 'text' => 'LIKE позволяет искать строки по частичному совпадению с использованием подстановочных символов.'],
                    ['type' => 'list', 'items' => [
                        '% — заменяет любое количество символов (включая ноль)',
                        '_ — заменяет ровно один символ',
                    ]],
                    ['type' => 'code', 'language' => 'sql', 'content' => "-- Имена, начинающиеся на 'A'\nSELECT * FROM users WHERE name LIKE 'A%';\n\n-- Имена из ровно 4 символов\nSELECT * FROM users WHERE name LIKE '____';\n\n-- Email на домене gmail\nSELECT * FROM users WHERE email LIKE '%@gmail.com';"],
                    ['type' => 'paragraph', 'text' => 'Для поиска без учёта регистра в MySQL можно использовать LIKE напрямую, а в PostgreSQL — оператор ILIKE.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 7,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 3,
            'title' => 'Регулярные выражения',
            'slug' => 'regexp',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Регулярные выражения в SQL'],
                    ['type' => 'paragraph', 'text' => 'REGEXP (или RLIKE) позволяет выполнять поиск по более сложным шаблонам, чем LIKE.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "-- Имена, начинающиеся на A или B\nSELECT * FROM users\nWHERE name REGEXP '^[AB]';\n\n-- Email, содержащий только цифры перед @\nSELECT * FROM users\nWHERE email REGEXP '^[0-9]+@';"],
                    ['type' => 'list', 'items' => [
                        '^ — начало строки',
                        '$ — конец строки',
                        '[abc] — один из символов a, b, c',
                        '[0-9] — любая цифра',
                        '. — любой символ',
                        '+ — один или более раз',
                        '* — ноль или более раз',
                    ]],
                    ['type' => 'paragraph', 'text' => 'Регулярные выражения поддерживаются в MySQL и PostgreSQL, но синтаксис может немного различаться.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 8,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 3,
            'title' => 'Сортировка, оператор ORDER BY',
            'slug' => 'order-by',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Сортировка результатов'],
                    ['type' => 'paragraph', 'text' => 'ORDER BY упорядочивает строки результата по одному или нескольким столбцам.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT * FROM products\nORDER BY price ASC;"],
                    ['type' => 'paragraph', 'text' => 'ASC — сортировка по возрастанию (по умолчанию), DESC — по убыванию.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT * FROM employees\nORDER BY department ASC, salary DESC;"],
                    ['type' => 'paragraph', 'text' => 'В этом примере сотрудники сначала группируются по отделу в алфавитном порядке, а внутри каждого отдела — по убыванию зарплаты.'],
                    ['type' => 'paragraph', 'text' => 'ORDER BY выполняется после WHERE и GROUP BY — это одна из последних операций в обработке запроса.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 9,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 3,
            'title' => 'Группировка, оператор GROUP BY',
            'slug' => 'group-by',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Группировка строк'],
                    ['type' => 'paragraph', 'text' => 'GROUP BY объединяет строки с одинаковыми значениями в указанных столбцах в одну группу. Обычно используется совместно с агрегатными функциями.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT department, COUNT(*) AS employee_count\nFROM employees\nGROUP BY department;"],
                    ['type' => 'paragraph', 'text' => 'Все столбцы в SELECT, которые не являются агрегатными функциями, должны быть указаны в GROUP BY.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT city, AVG(salary) AS avg_salary\nFROM employees\nGROUP BY city;"],
                    ['type' => 'paragraph', 'text' => 'GROUP BY можно комбинировать с WHERE (фильтрация до группировки) и HAVING (фильтрация после группировки).'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 10,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 3,
            'title' => 'Агрегатные функции',
            'slug' => 'aggregate-functions',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Агрегатные функции SQL'],
                    ['type' => 'paragraph', 'text' => 'Агрегатные функции вычисляют одно итоговое значение по набору строк.'],
                    ['type' => 'list', 'items' => [
                        'COUNT(*) — количество строк',
                        'COUNT(column) — количество непустых значений',
                        'SUM(column) — сумма значений',
                        'AVG(column) — среднее арифметическое',
                        'MIN(column) — минимальное значение',
                        'MAX(column) — максимальное значение',
                    ]],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT\n  COUNT(*) AS total,\n  SUM(salary) AS total_salary,\n  AVG(salary) AS avg_salary,\n  MIN(salary) AS min_salary,\n  MAX(salary) AS max_salary\nFROM employees;"],
                    ['type' => 'paragraph', 'text' => 'Агрегатные функции особенно мощны в сочетании с GROUP BY — они позволяют получать итоги по каждой группе.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 11,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 3,
            'title' => 'Оператор HAVING',
            'slug' => 'having',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Фильтрация групп с HAVING'],
                    ['type' => 'paragraph', 'text' => 'HAVING фильтрует результаты уже после группировки. Если WHERE работает со строками до GROUP BY, то HAVING — с группами после.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT department, COUNT(*) AS cnt\nFROM employees\nGROUP BY department\nHAVING COUNT(*) > 5;"],
                    ['type' => 'heading', 'text' => 'Порядок выполнения'],
                    ['type' => 'list', 'items' => [
                        'FROM — определяется источник данных',
                        'WHERE — фильтруются строки',
                        'GROUP BY — строки группируются',
                        'HAVING — фильтруются группы',
                        'SELECT — формируется результат',
                        'ORDER BY — результат сортируется',
                    ]],
                    ['type' => 'paragraph', 'text' => 'Таким образом, WHERE и HAVING выполняют фильтрацию на разных этапах обработки запроса.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 12,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        // =============================================================
        //  МОДУЛЬ 3: Основы выборки II (module_id = 4)
        // =============================================================

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 4,
            'title' => 'Многотабличные запросы, оператор JOIN',
            'slug' => 'join',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Зачем нужен JOIN'],
                    ['type' => 'paragraph', 'text' => 'В реляционных базах данные распределены по нескольким таблицам. JOIN позволяет объединить строки из разных таблиц на основании связующего условия.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT users.name, orders.amount\nFROM users\nJOIN orders ON users.id = orders.user_id;"],
                    ['type' => 'paragraph', 'text' => 'Условие ON определяет, по какому принципу строки из двух таблиц соединяются друг с другом.'],
                    ['type' => 'list', 'items' => [
                        'INNER JOIN — только совпавшие строки',
                        'LEFT JOIN — все из левой таблицы + совпавшие из правой',
                        'RIGHT JOIN — все из правой таблицы + совпавшие из левой',
                        'FULL OUTER JOIN — все строки из обеих таблиц',
                        'CROSS JOIN — декартово произведение',
                    ]],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 4,
            'title' => 'INNER JOIN',
            'slug' => 'inner-join',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'INNER JOIN — внутреннее соединение'],
                    ['type' => 'paragraph', 'text' => 'INNER JOIN возвращает только те строки, которые имеют совпадение в обеих таблицах.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT e.name, d.department_name\nFROM employees e\nINNER JOIN departments d\n  ON e.department_id = d.id;"],
                    ['type' => 'paragraph', 'text' => 'Если у сотрудника нет отдела (department_id = NULL), он не попадёт в результат INNER JOIN.'],
                    ['type' => 'paragraph', 'text' => 'INNER JOIN — это тип соединения по умолчанию. Если написать просто JOIN без указания типа, SQL интерпретирует это как INNER JOIN.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 4,
            'title' => 'OUTER JOIN',
            'slug' => 'outer-join',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'LEFT JOIN и RIGHT JOIN'],
                    ['type' => 'paragraph', 'text' => 'LEFT JOIN возвращает все строки из левой таблицы. Если совпадения в правой таблице нет, вместо значений подставляется NULL.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT u.name, o.amount\nFROM users u\nLEFT JOIN orders o ON u.id = o.user_id;"],
                    ['type' => 'paragraph', 'text' => 'RIGHT JOIN работает аналогично, но приоритет отдаётся правой таблице.'],
                    ['type' => 'heading', 'text' => 'FULL OUTER JOIN'],
                    ['type' => 'paragraph', 'text' => 'FULL OUTER JOIN возвращает все строки из обеих таблиц. Там, где нет совпадения, подставляется NULL.'],
                    ['type' => 'paragraph', 'text' => 'MySQL не поддерживает FULL OUTER JOIN напрямую, но его можно имитировать через UNION LEFT JOIN и RIGHT JOIN.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 4,
            'title' => 'Ограничение выборки, оператор LIMIT',
            'slug' => 'limit',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Ограничение количества строк'],
                    ['type' => 'paragraph', 'text' => 'LIMIT позволяет ограничить количество строк в результате запроса. Это особенно полезно при работе с большими таблицами и при постраничной навигации.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT * FROM products\nORDER BY price DESC\nLIMIT 10;"],
                    ['type' => 'heading', 'text' => 'OFFSET'],
                    ['type' => 'paragraph', 'text' => 'OFFSET позволяет пропустить указанное количество строк перед выдачей результата:'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "-- Вторая страница по 10 записей\nSELECT * FROM products\nORDER BY id\nLIMIT 10 OFFSET 10;"],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 4,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 4,
            'title' => 'Подзапросы',
            'slug' => 'subqueries',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Что такое подзапрос'],
                    ['type' => 'paragraph', 'text' => 'Подзапрос — это SQL-запрос, вложенный внутрь другого запроса. Он заключается в круглые скобки и выполняется первым.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT *\nFROM employees\nWHERE salary > (\n  SELECT AVG(salary) FROM employees\n);"],
                    ['type' => 'paragraph', 'text' => 'Подзапросы могут использоваться в WHERE, SELECT, FROM и HAVING.'],
                    ['type' => 'list', 'items' => [
                        'Скалярные подзапросы — возвращают одно значение',
                        'Табличные подзапросы — возвращают набор строк',
                        'Коррелированные подзапросы — ссылаются на внешний запрос',
                    ]],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 5,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 4,
            'title' => 'Подзапросы с одной строкой с одним столбцом',
            'slug' => 'single-row-subqueries',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Скалярные подзапросы'],
                    ['type' => 'paragraph', 'text' => 'Скалярный подзапрос возвращает ровно одну строку и один столбец — одно значение. Его можно использовать везде, где ожидается единственное значение.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT name, salary\nFROM employees\nWHERE salary = (\n  SELECT MAX(salary) FROM employees\n);"],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT name,\n  salary - (SELECT AVG(salary) FROM employees) AS diff_from_avg\nFROM employees;"],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 6,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 4,
            'title' => 'Подзапросы с несколькими строками и одним столбцом',
            'slug' => 'multi-row-subqueries',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Подзапросы, возвращающие список значений'],
                    ['type' => 'paragraph', 'text' => 'Такие подзапросы возвращают несколько строк из одного столбца. Их используют с операторами IN, ANY и ALL.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT * FROM users\nWHERE id IN (\n  SELECT user_id FROM orders\n  WHERE amount > 1000\n);"],
                    ['type' => 'heading', 'text' => 'ANY и ALL'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "-- Зарплата больше хотя бы одного из отдела IT\nSELECT * FROM employees\nWHERE salary > ANY (\n  SELECT salary FROM employees WHERE department = 'IT'\n);"],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 7,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 4,
            'title' => 'Многостолбцовые подзапросы',
            'slug' => 'multi-column-subqueries',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Подзапросы с несколькими столбцами'],
                    ['type' => 'paragraph', 'text' => 'Многостолбцовые подзапросы позволяют сравнивать сразу несколько столбцов одновременно.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT *\nFROM employees\nWHERE (department_id, salary) IN (\n  SELECT department_id, MAX(salary)\n  FROM employees\n  GROUP BY department_id\n);"],
                    ['type' => 'paragraph', 'text' => 'Этот запрос находит сотрудников с максимальной зарплатой в каждом отделе.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 8,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 4,
            'title' => 'Коррелированные подзапросы',
            'slug' => 'correlated-subqueries',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Коррелированные подзапросы'],
                    ['type' => 'paragraph', 'text' => 'Коррелированный подзапрос ссылается на столбцы внешнего запроса. Он выполняется заново для каждой строки внешнего запроса.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT e.name, e.salary\nFROM employees e\nWHERE e.salary > (\n  SELECT AVG(e2.salary)\n  FROM employees e2\n  WHERE e2.department_id = e.department_id\n);"],
                    ['type' => 'paragraph', 'text' => 'Этот запрос находит сотрудников, чья зарплата выше средней по их собственному отделу.'],
                    ['type' => 'heading', 'text' => 'EXISTS'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT * FROM users u\nWHERE EXISTS (\n  SELECT 1 FROM orders o\n  WHERE o.user_id = u.id\n);"],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 9,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 4,
            'title' => 'Обобщенное табличное выражение, WITH',
            'slug' => 'cte-with',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'CTE — Common Table Expression'],
                    ['type' => 'paragraph', 'text' => 'WITH позволяет задать именованный подзапрос, который можно использовать в основном запросе. Это делает сложные запросы более читаемыми.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "WITH dept_stats AS (\n  SELECT department_id,\n         AVG(salary) AS avg_salary\n  FROM employees\n  GROUP BY department_id\n)\nSELECT e.name, e.salary, ds.avg_salary\nFROM employees e\nJOIN dept_stats ds ON e.department_id = ds.department_id\nWHERE e.salary > ds.avg_salary;"],
                    ['type' => 'paragraph', 'text' => 'CTE существует только в рамках одного запроса и не сохраняется в базе данных.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 10,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 4,
            'title' => 'Объединение запросов, оператор UNION',
            'slug' => 'union',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Оператор UNION'],
                    ['type' => 'paragraph', 'text' => 'UNION объединяет результаты двух или более SELECT-запросов в один набор строк.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT name, 'employee' AS type FROM employees\nUNION\nSELECT name, 'client' AS type FROM clients;"],
                    ['type' => 'list', 'items' => [
                        'UNION — убирает дубликаты',
                        'UNION ALL — оставляет все строки, включая дубликаты',
                    ]],
                    ['type' => 'paragraph', 'text' => 'Количество и типы столбцов во всех объединяемых запросах должны совпадать.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 11,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 4,
            'title' => 'Условная логика, оператор CASE',
            'slug' => 'case',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Оператор CASE'],
                    ['type' => 'paragraph', 'text' => 'CASE позволяет реализовать условную логику прямо внутри SQL-запроса, аналогично конструкции if-else в языках программирования.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT name, salary,\n  CASE\n    WHEN salary > 100000 THEN 'высокая'\n    WHEN salary > 50000 THEN 'средняя'\n    ELSE 'низкая'\n  END AS salary_level\nFROM employees;"],
                    ['type' => 'paragraph', 'text' => 'CASE можно использовать в SELECT, WHERE, ORDER BY и даже в агрегатных функциях.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 12,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 4,
            'title' => 'Условная функция IF',
            'slug' => 'if-function',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Функция IF'],
                    ['type' => 'paragraph', 'text' => 'В MySQL доступна функция IF, которая проверяет условие и возвращает одно из двух значений.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT name,\n  IF(salary > 50000, 'выше среднего', 'ниже среднего') AS level\nFROM employees;"],
                    ['type' => 'heading', 'text' => 'IFNULL и COALESCE'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "-- Заменяет NULL на значение по умолчанию\nSELECT IFNULL(phone, 'не указан') AS phone\nFROM users;\n\n-- COALESCE возвращает первое не NULL значение\nSELECT COALESCE(phone, email, 'нет контакта') AS contact\nFROM users;"],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 13,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        // =============================================================
        //  МОДУЛЬ 4: Манипулирование данными (module_id = 5)
        // =============================================================

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 5,
            'title' => 'Добавление данных, оператор INSERT',
            'slug' => 'insert',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Оператор INSERT'],
                    ['type' => 'paragraph', 'text' => 'INSERT добавляет новые строки в таблицу.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "INSERT INTO users (name, email, age)\nVALUES ('Ali', 'ali@example.com', 25);"],
                    ['type' => 'heading', 'text' => 'Вставка нескольких строк'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "INSERT INTO users (name, email, age)\nVALUES\n  ('Ali', 'ali@example.com', 25),\n  ('Sara', 'sara@example.com', 30),\n  ('Bob', 'bob@example.com', 22);"],
                    ['type' => 'heading', 'text' => 'INSERT из SELECT'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "INSERT INTO archive_orders (id, user_id, amount)\nSELECT id, user_id, amount\nFROM orders\nWHERE created_at < '2025-01-01';"],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 5,
            'title' => 'Обновление данных, оператор UPDATE',
            'slug' => 'update',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Оператор UPDATE'],
                    ['type' => 'paragraph', 'text' => 'UPDATE изменяет значения в существующих строках таблицы.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "UPDATE users\nSET email = 'new@example.com'\nWHERE id = 1;"],
                    ['type' => 'paragraph', 'text' => 'Без WHERE оператор UPDATE изменит все строки таблицы — будьте осторожны.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "-- Увеличить зарплату на 10% в отделе IT\nUPDATE employees\nSET salary = salary * 1.10\nWHERE department = 'IT';"],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 5,
            'title' => 'Удаление данных, оператор DELETE',
            'slug' => 'delete',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Оператор DELETE'],
                    ['type' => 'paragraph', 'text' => 'DELETE удаляет строки из таблицы, соответствующие заданному условию.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "DELETE FROM orders\nWHERE status = 'cancelled';"],
                    ['type' => 'paragraph', 'text' => 'Без WHERE будут удалены все строки из таблицы.'],
                    ['type' => 'heading', 'text' => 'TRUNCATE'],
                    ['type' => 'paragraph', 'text' => 'TRUNCATE удаляет все строки из таблицы значительно быстрее, чем DELETE без WHERE, но не вызывает триггеры и сбрасывает автоинкремент.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "TRUNCATE TABLE logs;"],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        // =============================================================
        //  МОДУЛЬ 5: Продвинутый SQL (module_id = 6)
        // =============================================================

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 6,
            'title' => 'Работа с типами данных',
            'slug' => 'working-with-data-types',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Типы данных в SQL'],
                    ['type' => 'paragraph', 'text' => 'Каждый столбец в таблице имеет определённый тип данных. Правильный выбор типа влияет на производительность, занимаемое место и корректность хранения.'],
                    ['type' => 'list', 'items' => [
                        'Числовые типы: INT, BIGINT, DECIMAL, FLOAT',
                        'Строковые типы: VARCHAR, CHAR, TEXT',
                        'Дата и время: DATE, TIME, DATETIME, TIMESTAMP',
                        'Логический тип: BOOLEAN (в MySQL хранится как TINYINT)',
                    ]],
                    ['type' => 'paragraph', 'text' => 'При работе с данными часто приходится преобразовывать один тип в другой с помощью CAST или CONVERT.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 6,
            'title' => 'Числовой тип данных',
            'slug' => 'numeric-data-type',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Числовые типы'],
                    ['type' => 'paragraph', 'text' => 'SQL предоставляет функции для работы с числами: округление, абсолютное значение, возведение в степень и другие.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT\n  ROUND(3.14159, 2) AS rounded,\n  CEIL(4.2) AS ceiling,\n  FLOOR(4.8) AS floored,\n  ABS(-42) AS absolute,\n  MOD(10, 3) AS remainder,\n  POWER(2, 10) AS power_result;"],
                    ['type' => 'paragraph', 'text' => 'Для финансовых расчётов рекомендуется использовать тип DECIMAL вместо FLOAT, чтобы избежать ошибок округления.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 6,
            'title' => 'Дата и время',
            'slug' => 'date-and-time',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Функции даты и времени'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT\n  NOW() AS current_datetime,\n  CURDATE() AS current_date,\n  CURTIME() AS current_time,\n  YEAR(NOW()) AS current_year,\n  MONTH(NOW()) AS current_month,\n  DAY(NOW()) AS current_day;"],
                    ['type' => 'heading', 'text' => 'Арифметика с датами'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT\n  DATE_ADD('2026-01-01', INTERVAL 30 DAY) AS plus_30_days,\n  DATEDIFF('2026-12-31', '2026-01-01') AS days_between,\n  TIMESTAMPDIFF(MONTH, '2025-01-01', '2026-06-15') AS months_diff;"],
                    ['type' => 'paragraph', 'text' => 'Функции для работы с датами могут различаться в разных СУБД.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 6,
            'title' => 'Функции преобразования типов, CAST',
            'slug' => 'cast',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Преобразование типов'],
                    ['type' => 'paragraph', 'text' => 'CAST и CONVERT позволяют явно преобразовать значение из одного типа данных в другой.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT\n  CAST('123' AS UNSIGNED) AS str_to_int,\n  CAST(42 AS CHAR) AS int_to_str,\n  CAST('2026-03-20' AS DATE) AS str_to_date;"],
                    ['type' => 'paragraph', 'text' => 'Преобразование типов часто нужно при сравнении данных разных типов или при форматировании вывода.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 4,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 6,
            'title' => 'Оконные функции',
            'slug' => 'window-functions',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Что такое оконные функции'],
                    ['type' => 'paragraph', 'text' => 'Оконные функции позволяют выполнять вычисления по набору строк, связанных с текущей строкой, не сворачивая результат в одну строку (в отличие от GROUP BY).'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT name, department, salary,\n  SUM(salary) OVER () AS total_salary\nFROM employees;"],
                    ['type' => 'paragraph', 'text' => 'OVER() определяет окно — набор строк, по которым выполняется вычисление. Пустые скобки означают «все строки».'],
                    ['type' => 'paragraph', 'text' => 'Оконные функции доступны начиная с MySQL 8.0 и во всех версиях PostgreSQL.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 5,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 6,
            'title' => 'Партиции в оконных функциях',
            'slug' => 'window-partitions',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'PARTITION BY'],
                    ['type' => 'paragraph', 'text' => 'PARTITION BY разбивает набор строк на группы (партиции), и оконная функция вычисляется отдельно для каждой группы.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT name, department, salary,\n  AVG(salary) OVER (PARTITION BY department) AS dept_avg\nFROM employees;"],
                    ['type' => 'paragraph', 'text' => 'В отличие от GROUP BY, PARTITION BY не сворачивает строки — каждая исходная строка остаётся в результате, но дополняется вычисленным значением.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 6,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 6,
            'title' => 'Сортировка внутри окна',
            'slug' => 'window-ordering',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'ORDER BY в оконных функциях'],
                    ['type' => 'paragraph', 'text' => 'ORDER BY внутри OVER() задаёт порядок строк в окне. Это необходимо для ранжирующих и накопительных функций.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT name, salary,\n  ROW_NUMBER() OVER (ORDER BY salary DESC) AS rank_num\nFROM employees;"],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT name, department, salary,\n  SUM(salary) OVER (\n    PARTITION BY department\n    ORDER BY salary\n  ) AS running_total\nFROM employees;"],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 7,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 6,
            'title' => 'Рамки окон в оконных функциях',
            'slug' => 'window-frames',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Рамки окон (Window Frames)'],
                    ['type' => 'paragraph', 'text' => 'Рамка окна позволяет уточнить, какие именно строки из партиции участвуют в вычислении оконной функции.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT date, amount,\n  AVG(amount) OVER (\n    ORDER BY date\n    ROWS BETWEEN 2 PRECEDING AND CURRENT ROW\n  ) AS moving_avg_3\nFROM sales;"],
                    ['type' => 'list', 'items' => [
                        'ROWS BETWEEN ... AND ... — рамка по количеству строк',
                        'RANGE BETWEEN ... AND ... — рамка по значениям',
                        'UNBOUNDED PRECEDING — от начала партиции',
                        'CURRENT ROW — текущая строка',
                        'UNBOUNDED FOLLOWING — до конца партиции',
                    ]],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 8,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 6,
            'title' => 'Типы оконных функций',
            'slug' => 'window-function-types',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Типы оконных функций'],
                    ['type' => 'heading', 'text' => 'Ранжирующие функции'],
                    ['type' => 'list', 'items' => [
                        'ROW_NUMBER() — уникальный номер строки',
                        'RANK() — ранг с пропуском позиций при совпадении',
                        'DENSE_RANK() — ранг без пропуска позиций',
                        'NTILE(n) — разбивает на n равных групп',
                    ]],
                    ['type' => 'heading', 'text' => 'Функции смещения'],
                    ['type' => 'list', 'items' => [
                        'LAG(col, n) — значение из предыдущей строки',
                        'LEAD(col, n) — значение из следующей строки',
                        'FIRST_VALUE(col) — первое значение в окне',
                        'LAST_VALUE(col) — последнее значение в окне',
                    ]],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT name, salary,\n  RANK() OVER (ORDER BY salary DESC) AS salary_rank,\n  LAG(salary) OVER (ORDER BY salary DESC) AS prev_salary\nFROM employees;"],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 9,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 6,
            'title' => 'Транзакции',
            'slug' => 'transactions',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Что такое транзакция'],
                    ['type' => 'paragraph', 'text' => 'Транзакция — это последовательность SQL-операций, которая выполняется как единое целое. Либо все операции завершаются успешно, либо ни одна из них не применяется.'],
                    ['type' => 'heading', 'text' => 'Свойства ACID'],
                    ['type' => 'list', 'items' => [
                        'Atomicity (Атомарность) — всё или ничего',
                        'Consistency (Согласованность) — данные остаются корректными',
                        'Isolation (Изолированность) — транзакции не мешают друг другу',
                        'Durability (Долговечность) — результат сохраняется даже при сбое',
                    ]],
                    ['type' => 'paragraph', 'text' => 'Транзакции необходимы при переводе средств, оформлении заказов и любых других операциях, где несколько действий должны быть выполнены вместе.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 10,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 6,
            'title' => 'Блокировки в СУБД',
            'slug' => 'locks',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Блокировки и конкурентный доступ'],
                    ['type' => 'paragraph', 'text' => 'Когда несколько пользователей или процессов одновременно работают с одними данными, СУБД использует блокировки для предотвращения конфликтов.'],
                    ['type' => 'list', 'items' => [
                        'Shared Lock (блокировка чтения) — несколько читателей одновременно',
                        'Exclusive Lock (блокировка записи) — только один процесс может изменять данные',
                        'Row-level Lock — блокировка на уровне строки',
                        'Table-level Lock — блокировка на уровне таблицы',
                    ]],
                    ['type' => 'paragraph', 'text' => 'Deadlock (взаимная блокировка) возникает, когда два процесса ждут освобождения ресурсов друг друга. СУБД автоматически обнаруживает deadlock и отменяет одну из транзакций.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 11,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 6,
            'title' => 'Создание транзакций',
            'slug' => 'creating-transactions',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Синтаксис транзакций'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "START TRANSACTION;\n\nUPDATE accounts SET balance = balance - 500 WHERE id = 1;\nUPDATE accounts SET balance = balance + 500 WHERE id = 2;\n\nCOMMIT;"],
                    ['type' => 'paragraph', 'text' => 'COMMIT фиксирует все изменения. Если что-то пошло не так, можно использовать ROLLBACK для отмены всех операций внутри транзакции.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "START TRANSACTION;\n\nUPDATE accounts SET balance = balance - 500 WHERE id = 1;\n-- Ошибка!\nROLLBACK;"],
                    ['type' => 'heading', 'text' => 'SAVEPOINT'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "START TRANSACTION;\nSAVEPOINT sp1;\n\nUPDATE ... ;\n\nROLLBACK TO sp1;\nCOMMIT;"],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 12,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 6,
            'title' => 'Хранимые процедуры и функции',
            'slug' => 'stored-procedures-and-functions',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Хранимые процедуры и функции'],
                    ['type' => 'paragraph', 'text' => 'Хранимые процедуры и функции — это именованные блоки SQL-кода, которые сохраняются в базе данных и могут быть вызваны многократно.'],
                    ['type' => 'list', 'items' => [
                        'Функция — возвращает одно значение, может использоваться в SELECT',
                        'Процедура — выполняет действия, может возвращать несколько результатов через параметры',
                    ]],
                    ['type' => 'paragraph', 'text' => 'Они помогают инкапсулировать бизнес-логику на стороне базы данных и уменьшить количество SQL-кода в приложении.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 13,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 6,
            'title' => 'Хранимые функции',
            'slug' => 'stored-functions',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Создание хранимой функции'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "DELIMITER //\n\nCREATE FUNCTION get_full_name(\n  first_name VARCHAR(50),\n  last_name VARCHAR(50)\n)\nRETURNS VARCHAR(101)\nDETERMINISTIC\nBEGIN\n  RETURN CONCAT(first_name, ' ', last_name);\nEND //\n\nDELIMITER ;"],
                    ['type' => 'heading', 'text' => 'Использование функции'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT get_full_name('Ali', 'Khan') AS name;\n\nSELECT get_full_name(first_name, last_name) AS name\nFROM employees;"],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 14,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 6,
            'title' => 'Хранимые процедуры',
            'slug' => 'stored-procedures',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Создание хранимой процедуры'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "DELIMITER //\n\nCREATE PROCEDURE raise_salary(\n  IN emp_id INT,\n  IN percentage DECIMAL(5,2)\n)\nBEGIN\n  UPDATE employees\n  SET salary = salary * (1 + percentage / 100)\n  WHERE id = emp_id;\nEND //\n\nDELIMITER ;"],
                    ['type' => 'heading', 'text' => 'Вызов процедуры'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "CALL raise_salary(1, 10);"],
                    ['type' => 'list', 'items' => [
                        'IN — входной параметр',
                        'OUT — выходной параметр',
                        'INOUT — входной и выходной одновременно',
                    ]],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 15,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 6,
            'title' => 'Операторы IF, CASE, WHILE в хранимых процедурах',
            'slug' => 'control-flow-in-procedures',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Управляющие конструкции'],
                    ['type' => 'heading', 'text' => 'IF ... THEN'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "IF salary > 100000 THEN\n  SET bonus = salary * 0.15;\nELSEIF salary > 50000 THEN\n  SET bonus = salary * 0.10;\nELSE\n  SET bonus = salary * 0.05;\nEND IF;"],
                    ['type' => 'heading', 'text' => 'CASE'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "CASE department\n  WHEN 'IT' THEN SET rate = 1.2;\n  WHEN 'HR' THEN SET rate = 1.1;\n  ELSE SET rate = 1.0;\nEND CASE;"],
                    ['type' => 'heading', 'text' => 'WHILE'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SET i = 1;\nWHILE i <= 10 DO\n  INSERT INTO numbers (val) VALUES (i);\n  SET i = i + 1;\nEND WHILE;"],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 16,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 6,
            'title' => 'Планировщик событий',
            'slug' => 'event-scheduler',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Event Scheduler в MySQL'],
                    ['type' => 'paragraph', 'text' => 'Планировщик событий позволяет автоматически выполнять SQL-операции по расписанию — аналог cron на уровне базы данных.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "-- Включение планировщика\nSET GLOBAL event_scheduler = ON;"],
                    ['type' => 'code', 'language' => 'sql', 'content' => "CREATE EVENT clean_old_logs\nON SCHEDULE EVERY 1 DAY\nDO\n  DELETE FROM logs\n  WHERE created_at < NOW() - INTERVAL 90 DAY;"],
                    ['type' => 'code', 'language' => 'sql', 'content' => "-- Одноразовое событие\nCREATE EVENT one_time_task\nON SCHEDULE AT '2026-12-31 23:59:00'\nDO\n  INSERT INTO notifications (message)\n  VALUES ('Happy New Year!');"],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 17,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        // =============================================================
        //  МОДУЛЬ 6: Базы данных и таблицы (module_id = 7)
        // =============================================================

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 7,
            'title' => 'Создание и удаление баз данных',
            'slug' => 'create-drop-database',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Управление базами данных'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "CREATE DATABASE shop\n  CHARACTER SET utf8mb4\n  COLLATE utf8mb4_unicode_ci;"],
                    ['type' => 'code', 'language' => 'sql', 'content' => "DROP DATABASE IF EXISTS shop;"],
                    ['type' => 'code', 'language' => 'sql', 'content' => "-- Показать все базы данных\nSHOW DATABASES;\n\n-- Выбрать базу данных для работы\nUSE shop;"],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 7,
            'title' => 'Создание и удаление таблиц',
            'slug' => 'create-drop-table',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'CREATE TABLE'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "CREATE TABLE users (\n  id INT AUTO_INCREMENT PRIMARY KEY,\n  name VARCHAR(100) NOT NULL,\n  email VARCHAR(255) UNIQUE NOT NULL,\n  age INT,\n  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP\n);"],
                    ['type' => 'heading', 'text' => 'ALTER TABLE'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "ALTER TABLE users\n  ADD COLUMN phone VARCHAR(20),\n  MODIFY COLUMN name VARCHAR(200);"],
                    ['type' => 'heading', 'text' => 'DROP TABLE'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "DROP TABLE IF EXISTS users;"],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 7,
            'title' => 'Типы данных для колонок таблиц',
            'slug' => 'column-data-types',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Обзор типов данных'],
                    ['type' => 'paragraph', 'text' => 'При создании таблицы для каждого столбца указывается тип данных. Правильный выбор типа влияет на объём хранимых данных, производительность и корректность.'],
                    ['type' => 'list', 'items' => [
                        'Числовые: TINYINT, SMALLINT, INT, BIGINT, DECIMAL, FLOAT, DOUBLE',
                        'Строковые: CHAR, VARCHAR, TEXT, MEDIUMTEXT, LONGTEXT',
                        'Дата/время: DATE, TIME, DATETIME, TIMESTAMP, YEAR',
                        'Бинарные: BLOB, BINARY, VARBINARY',
                        'Другие: ENUM, SET, JSON, BOOLEAN',
                    ]],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 7,
            'title' => 'Строковый тип данных',
            'slug' => 'string-data-type',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Строковые типы в SQL'],
                    ['type' => 'list', 'items' => [
                        'CHAR(n) — строка фиксированной длины, всегда занимает n байт',
                        'VARCHAR(n) — строка переменной длины, максимум n символов',
                        'TEXT — для длинных текстов (до 65 535 символов)',
                        'MEDIUMTEXT — до 16 млн символов',
                        'LONGTEXT — до 4 ГБ',
                    ]],
                    ['type' => 'heading', 'text' => 'Строковые функции'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "SELECT\n  CONCAT(first_name, ' ', last_name) AS full_name,\n  SUBSTRING(email, 1, 5) AS email_prefix,\n  REPLACE(phone, '-', '') AS clean_phone,\n  TRIM('  hello  ') AS trimmed\nFROM users;"],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 4,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 7,
            'title' => 'Числовой тип данных',
            'slug' => 'numeric-column-type',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Числовые типы для колонок'],
                    ['type' => 'list', 'items' => [
                        'TINYINT — от -128 до 127 (1 байт)',
                        'SMALLINT — от -32768 до 32767 (2 байта)',
                        'INT — от -2.1 млрд до 2.1 млрд (4 байта)',
                        'BIGINT — очень большие числа (8 байт)',
                        'DECIMAL(p, s) — точные дробные числа',
                        'FLOAT / DOUBLE — приблизительные дробные числа',
                    ]],
                    ['type' => 'code', 'language' => 'sql', 'content' => "CREATE TABLE products (\n  id INT AUTO_INCREMENT PRIMARY KEY,\n  price DECIMAL(10, 2) NOT NULL,\n  quantity INT UNSIGNED DEFAULT 0,\n  weight FLOAT\n);"],
                    ['type' => 'paragraph', 'text' => 'UNSIGNED убирает отрицательные значения и удваивает максимальное положительное значение.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 5,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 7,
            'title' => 'Дата и время',
            'slug' => 'datetime-column-type',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Типы даты и времени для колонок'],
                    ['type' => 'list', 'items' => [
                        "DATE — только дата: '2026-03-20'",
                        "TIME — только время: '14:30:00'",
                        "DATETIME — дата и время: '2026-03-20 14:30:00'",
                        'TIMESTAMP — как DATETIME, но хранится в UTC и автоконвертируется',
                        "YEAR — только год: 2026",
                    ]],
                    ['type' => 'code', 'language' => 'sql', 'content' => "CREATE TABLE events (\n  id INT AUTO_INCREMENT PRIMARY KEY,\n  title VARCHAR(200),\n  event_date DATE,\n  start_time TIME,\n  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,\n  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP\n    ON UPDATE CURRENT_TIMESTAMP\n);"],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 6,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 7,
            'title' => 'Представления, VIEW',
            'slug' => 'view',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Что такое VIEW'],
                    ['type' => 'paragraph', 'text' => 'VIEW — это виртуальная таблица, основанная на SELECT-запросе. Она не хранит данные, а каждый раз вычисляется при обращении.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "CREATE VIEW active_users AS\nSELECT id, name, email\nFROM users\nWHERE active = 1;"],
                    ['type' => 'code', 'language' => 'sql', 'content' => "-- Использование как обычной таблицы\nSELECT * FROM active_users\nWHERE name LIKE 'A%';"],
                    ['type' => 'code', 'language' => 'sql', 'content' => "DROP VIEW IF EXISTS active_users;"],
                    ['type' => 'paragraph', 'text' => 'VIEW удобен для упрощения часто используемых запросов и для ограничения доступа к определённым данным.'],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 7,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 7,
            'title' => 'Индексы в SQL',
            'slug' => 'indexes',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Индексы'],
                    ['type' => 'paragraph', 'text' => 'Индексы ускоряют поиск данных в таблице. Без индекса СУБД сканирует все строки (full table scan), с индексом — находит нужные записи значительно быстрее.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "CREATE INDEX idx_email ON users (email);\n\nCREATE UNIQUE INDEX idx_users_email ON users (email);\n\nCREATE INDEX idx_name_city ON users (name, city);"],
                    ['type' => 'heading', 'text' => 'Когда индексы полезны'],
                    ['type' => 'list', 'items' => [
                        'Столбцы, часто используемые в WHERE',
                        'Столбцы в JOIN-условиях',
                        'Столбцы в ORDER BY и GROUP BY',
                    ]],
                    ['type' => 'heading', 'text' => 'Когда индексы вредят'],
                    ['type' => 'paragraph', 'text' => 'Каждый индекс замедляет операции INSERT, UPDATE и DELETE, потому что СУБД должна обновлять индекс при каждом изменении данных.'],
                    ['type' => 'code', 'language' => 'sql', 'content' => "DROP INDEX idx_email ON users;"],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 8,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $lessons[] = [
            'id' => $id++,
            'course_id' => 1,
            'module_id' => 7,
            'title' => 'Ограничения столбцов (Constraints)',
            'slug' => 'constraints',
            'content' => json_encode([
                'lecture' => [
                    ['type' => 'heading', 'text' => 'Ограничения (Constraints)'],
                    ['type' => 'paragraph', 'text' => 'Ограничения задают правила для данных в столбцах таблицы. Они помогают поддерживать целостность и корректность данных.'],
                    ['type' => 'list', 'items' => [
                        'NOT NULL — столбец не может содержать NULL',
                        'UNIQUE — все значения в столбце должны быть уникальными',
                        'PRIMARY KEY — уникальный идентификатор строки (NOT NULL + UNIQUE)',
                        'FOREIGN KEY — ссылка на первичный ключ другой таблицы',
                        'DEFAULT — значение по умолчанию',
                        'CHECK — произвольное условие проверки',
                    ]],
                    ['type' => 'code', 'language' => 'sql', 'content' => "CREATE TABLE orders (\n  id INT AUTO_INCREMENT PRIMARY KEY,\n  user_id INT NOT NULL,\n  amount DECIMAL(10,2) NOT NULL CHECK (amount > 0),\n  status ENUM('new','paid','shipped','cancelled')\n    DEFAULT 'new',\n  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,\n\n  FOREIGN KEY (user_id) REFERENCES users(id)\n    ON DELETE CASCADE\n    ON UPDATE CASCADE\n);"],
                    ['type' => 'heading', 'text' => 'ON DELETE / ON UPDATE'],
                    ['type' => 'list', 'items' => [
                        'CASCADE — удалить/обновить связанные записи',
                        'SET NULL — установить NULL в связанных записях',
                        'RESTRICT — запретить удаление/обновление',
                        'NO ACTION — аналог RESTRICT в MySQL',
                    ]],
                ],
            ], JSON_UNESCAPED_UNICODE),
            'lesson_type' => 'theory',
            'lesson_order' => 9,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        // =============================================================
        //  Вставка
        // =============================================================

        DB::table('lessons')->insert($lessons);

        $this->command->info('✅ Уроки созданы (' . count($lessons) . ' записей)');
    }
}
