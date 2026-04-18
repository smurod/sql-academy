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
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 1,
            'title'        => 'Введение',
            'slug'         => 'intro',
            'lesson_type'  => 'theory',
            'lesson_order' => 1,
            'content'      => <<<HTML
<h2>Добро пожаловать в курс SQL</h2>

<p>SQL — один из самых востребованных языков в мире разработки. Он используется везде: в веб-приложениях, мобильных сервисах, аналитике данных и бизнес-системах.</p>

<p>Этот курс построен так, чтобы ты мог освоить SQL с нуля — последовательно, без лишней воды, с практическими примерами на каждом шагу.</p>

<h3>Чему ты научишься</h3>

<ul>
    <li>Понимать устройство реляционных баз данных</li>
    <li>Писать запросы для получения, фильтрации и сортировки данных</li>
    <li>Группировать данные и использовать агрегатные функции</li>
    <li>Объединять таблицы через JOIN</li>
    <li>Применять подзапросы и оконные функции</li>
    <li>Управлять структурой таблиц и транзакциями</li>
</ul>

<p>Каждый урок содержит теорию и примеры SQL-запросов. Рекомендуем проходить уроки по порядку — каждая тема опирается на предыдущую.</p>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 1,
            'title'        => 'Структура курса',
            'slug'         => 'course-structure',
            'lesson_type'  => 'theory',
            'lesson_order' => 2,
            'content'      => <<<HTML
<h2>Как устроен курс</h2>

<p>Курс разбит на модули. Каждый модуль охватывает отдельную тему и содержит несколько уроков с теорией и примерами.</p>

<h3>Модули курса</h3>

<ul>
    <li><strong>Модуль 0 — Введение:</strong> знакомство с курсом и сообществом</li>
    <li><strong>Модуль 1 — Фундаментальные основы:</strong> базы данных, СУБД, реляционная модель, SQL</li>
    <li><strong>Модуль 2 — Основы выборки I:</strong> SELECT, WHERE, функции, GROUP BY, HAVING</li>
    <li><strong>Модуль 3 — Основы выборки II:</strong> JOIN, подзапросы, UNION, CASE</li>
    <li><strong>Модуль 4 — Манипулирование данными:</strong> INSERT, UPDATE, DELETE</li>
    <li><strong>Модуль 5 — Продвинутый SQL:</strong> оконные функции, транзакции, процедуры</li>
    <li><strong>Модуль 6 — Базы данных и таблицы:</strong> CREATE, ALTER, индексы, ограничения</li>
</ul>

<p>Рекомендуем проходить модули последовательно. После теории закрепляй знания на практических заданиях.</p>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 1,
            'title'        => 'Сообщество',
            'slug'         => 'community',
            'lesson_type'  => 'theory',
            'lesson_order' => 3,
            'content'      => <<<HTML
<h2>Учись вместе с другими</h2>

<p>Обучение становится эффективнее, когда можно обсудить задачу, разобрать ошибку или увидеть альтернативное решение.</p>

<p>В SQL одну и ту же задачу часто можно решить несколькими способами. Обсуждение разных подходов помогает глубже понять язык и выработать профессиональное мышление.</p>

<h3>Почему это важно</h3>

<ul>
    <li>Разбор чужих решений расширяет кругозор</li>
    <li>Объяснение другим закрепляет собственные знания</li>
    <li>Ошибки — это нормально и полезно</li>
    <li>Совместный поиск решения учит работать в команде</li>
</ul>

<p>Не бойся задавать вопросы и делиться своими решениями — это часть обучения.</p>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        // =============================================================
        //  МОДУЛЬ 1: Фундаментальные основы (module_id = 2)
        // =============================================================

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 2,
            'title'        => 'Базы данных и СУБД',
            'slug'         => 'databases-and-dbms',
            'lesson_type'  => 'theory',
            'lesson_order' => 1,
            'content'      => <<<HTML
<h2>Что такое база данных</h2>

<p>База данных — это организованное хранилище информации. Представь таблицу в Excel: строки — это записи, столбцы — их свойства. База данных работает по похожему принципу, но гораздо мощнее.</p>

<p>Например, интернет-магазин хранит в базе данных:</p>

<ul>
    <li>Список товаров с ценами и остатками</li>
    <li>Данные покупателей</li>
    <li>Историю заказов</li>
    <li>Отзывы и рейтинги</li>
</ul>

<h2>Что такое СУБД</h2>

<p>СУБД (Система Управления Базами Данных) — это программа, которая управляет базой данных. Она принимает запросы, находит нужные данные, изменяет их и обеспечивает безопасность.</p>

<h3>Популярные СУБД</h3>

<ul>
    <li><strong>MySQL</strong> — самая популярная СУБД с открытым кодом, широко используется в веб-разработке</li>
    <li><strong>PostgreSQL</strong> — мощная СУБД с поддержкой сложных типов данных и расширений</li>
    <li><strong>SQLite</strong> — лёгкая файловая СУБД, встроена в Android, браузеры, Python</li>
    <li><strong>Microsoft SQL Server</strong> — корпоративная СУБД от Microsoft</li>
    <li><strong>Oracle Database</strong> — промышленная СУБД для крупных предприятий</li>
</ul>

<p>Все они понимают язык SQL, хотя и имеют свои особенности и расширения.</p>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 2,
            'title'        => 'Типы баз данных',
            'slug'         => 'database-types',
            'lesson_type'  => 'theory',
            'lesson_order' => 2,
            'content'      => <<<HTML
<h2>Виды баз данных</h2>

<p>Базы данных различаются по способу хранения и организации данных. Выбор типа зависит от задачи проекта.</p>

<h3>Реляционные базы данных</h3>
<p>Данные хранятся в таблицах со строками и столбцами. Таблицы связаны между собой через ключи. Для работы используется язык SQL.</p>
<p><strong>Примеры:</strong> MySQL, PostgreSQL, SQLite, Oracle</p>

<h3>Key-Value хранилища</h3>
<p>Данные хранятся как пары «ключ — значение». Очень быстрый доступ по ключу. Используются для кэша, сессий, очередей.</p>
<p><strong>Примеры:</strong> Redis, Memcached</p>

<h3>Документоориентированные базы данных</h3>
<p>Данные хранятся в виде JSON-документов. Гибкая структура — у каждого документа могут быть разные поля.</p>
<p><strong>Примеры:</strong> MongoDB, CouchDB, Firebase</p>

<h3>Графовые базы данных</h3>
<p>Данные представлены в виде узлов и связей между ними. Подходят для социальных сетей, рекомендательных систем.</p>
<p><strong>Примеры:</strong> Neo4j, Amazon Neptune</p>

<p>В этом курсе мы изучаем <strong>реляционные базы данных</strong> — самый распространённый и востребованный тип.</p>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 2,
            'title'        => 'Реляционные базы данных',
            'slug'         => 'relational-databases',
            'lesson_type'  => 'theory',
            'lesson_order' => 3,
            'content'      => <<<HTML
<h2>Реляционная модель</h2>

<p>Реляционные базы данных хранят данные в виде таблиц. Каждая таблица имеет фиксированный набор столбцов и произвольное количество строк.</p>

<p>Например, таблица <code>users</code>:</p>

<table>
    <thead>
        <tr><th>id</th><th>name</th><th>email</th><th>age</th></tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Ali</td><td>ali@example.com</td><td>25</td></tr>
        <tr><td>2</td><td>Sara</td><td>sara@example.com</td><td>30</td></tr>
        <tr><td>3</td><td>Bob</td><td>bob@example.com</td><td>22</td></tr>
    </tbody>
</table>

<h3>Основные понятия</h3>

<ul>
    <li><strong>Таблица (Table)</strong> — основная единица хранения данных</li>
    <li><strong>Строка (Row / Record)</strong> — одна запись в таблице</li>
    <li><strong>Столбец (Column / Field)</strong> — свойство записи с определённым типом данных</li>
    <li><strong>Первичный ключ (Primary Key)</strong> — уникальный идентификатор строки</li>
    <li><strong>Внешний ключ (Foreign Key)</strong> — ссылка на запись в другой таблице</li>
</ul>

<h3>Связи между таблицами</h3>

<p>Таблицы связаны через ключи. Например, таблица <code>orders</code> содержит поле <code>user_id</code>, которое ссылается на <code>id</code> в таблице <code>users</code>. Это позволяет хранить данные без дублирования.</p>

<p>Реляционная модель была предложена Эдгаром Коддом в 1970 году и по сей день остаётся основой большинства информационных систем.</p>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 2,
            'title'        => 'Key-value базы данных',
            'slug'         => 'key-value-databases',
            'lesson_type'  => 'theory',
            'lesson_order' => 4,
            'content'      => <<<HTML
<h2>Key-Value хранилища</h2>

<p>В key-value базах данных каждая запись — это пара из уникального ключа и связанного с ним значения. Структура очень простая, зато скорость доступа — максимальная.</p>

<pre><code class="language-none">ключ                      значение
─────────────────────────────────────────────────
session:abc123      →     {"user_id": 42, "role": "admin"}
cache:products      →     "[{id:1, name:'Laptop'}, ...]"
counter:visits      →     "15923"</code></pre>

<h3>Где применяется</h3>

<ul>
    <li>Кэширование результатов запросов</li>
    <li>Хранение пользовательских сессий</li>
    <li>Очереди сообщений</li>
    <li>Счётчики и рейтинги в реальном времени</li>
</ul>

<h3>Ограничения</h3>

<p>Key-value хранилища не поддерживают сложные выборки, объединения таблиц и фильтрацию по нескольким полям — в отличие от SQL.</p>

<p><strong>Популярные решения:</strong> Redis, Memcached, Amazon DynamoDB.</p>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 2,
            'title'        => 'Документоориентированные базы данных',
            'slug'         => 'document-databases',
            'lesson_type'  => 'theory',
            'lesson_order' => 5,
            'content'      => <<<HTML
<h2>Документоориентированные базы данных</h2>

<p>В документоориентированных базах данных информация хранится в виде документов — чаще всего в формате JSON или BSON. Каждый документ может иметь свою уникальную структуру.</p>

<pre><code class="language-json">{
  "name": "Ali",
  "email": "ali@example.com",
  "age": 25,
  "address": {
    "city": "Tashkent",
    "country": "Uzbekistan"
  },
  "skills": ["SQL", "Laravel", "Vue.js"]
}</code></pre>

<h3>Преимущества</h3>

<ul>
    <li>Гибкая структура — поля могут отличаться от документа к документу</li>
    <li>Хорошо подходит для иерархических данных</li>
    <li>Легко масштабируется горизонтально</li>
</ul>

<h3>Ограничения</h3>

<ul>
    <li>Сложнее поддерживать целостность данных</li>
    <li>Нет стандартного языка запросов как SQL</li>
    <li>Объединение коллекций сложнее, чем JOIN в SQL</li>
</ul>

<p><strong>Популярные решения:</strong> MongoDB, CouchDB, Firebase Firestore.</p>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 2,
            'title'        => 'Структура реляционных баз данных',
            'slug'         => 'relational-db-structure',
            'lesson_type'  => 'theory',
            'lesson_order' => 6,
            'content'      => <<<HTML
<h2>Из чего состоит реляционная база данных</h2>

<h3>Первичный ключ (Primary Key)</h3>

<p>Первичный ключ — это столбец (или набор столбцов), который однозначно идентифицирует каждую строку таблицы. Обычно это числовой столбец <code>id</code> с автоинкрементом.</p>

<pre><code class="language-sql">CREATE TABLE users (
  id   INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL
);</code></pre>

<h3>Внешний ключ (Foreign Key)</h3>

<p>Внешний ключ — столбец, который ссылается на первичный ключ другой таблицы. Он создаёт связь между таблицами и обеспечивает целостность данных.</p>

<pre><code class="language-sql">-- Таблица заказов ссылается на таблицу пользователей
CREATE TABLE orders (
  id      INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  amount  DECIMAL(10,2),
  FOREIGN KEY (user_id) REFERENCES users(id)
);</code></pre>

<h3>Типы связей</h3>

<ul>
    <li><strong>Один к одному (1:1)</strong> — одна запись в таблице A соответствует одной записи в таблице B</li>
    <li><strong>Один ко многим (1:N)</strong> — один пользователь может иметь много заказов</li>
    <li><strong>Многие ко многим (M:N)</strong> — студент может посещать много курсов, курс могут посещать много студентов</li>
</ul>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 2,
            'title'        => 'Вводная информация о SQL',
            'slug'         => 'sql-introduction',
            'lesson_type'  => 'theory',
            'lesson_order' => 7,
            'content'      => <<<HTML
<h2>Что такое SQL</h2>

<p>SQL (Structured Query Language — язык структурированных запросов) — это стандартный язык для работы с реляционными базами данных. С его помощью можно получать, добавлять, изменять и удалять данные.</p>

<h3>Основные операции</h3>

<ul>
    <li><strong>SELECT</strong> — получение данных</li>
    <li><strong>INSERT</strong> — добавление новых записей</li>
    <li><strong>UPDATE</strong> — изменение существующих записей</li>
    <li><strong>DELETE</strong> — удаление записей</li>
</ul>

<h3>Пример запроса</h3>

<pre><code class="language-sql">-- Получить всех пользователей из таблицы users
SELECT * FROM users;</code></pre>

<pre><code class="language-sql">-- Получить только имена и email пользователей старше 18 лет
SELECT name, email
FROM users
WHERE age > 18;</code></pre>

<h3>Подмножества SQL</h3>

<ul>
    <li><strong>DQL</strong> (Data Query Language) — запросы: SELECT</li>
    <li><strong>DML</strong> (Data Manipulation Language) — манипуляции: INSERT, UPDATE, DELETE</li>
    <li><strong>DDL</strong> (Data Definition Language) — структура: CREATE, ALTER, DROP</li>
    <li><strong>DCL</strong> (Data Control Language) — права доступа: GRANT, REVOKE</li>
    <li><strong>TCL</strong> (Transaction Control Language) — транзакции: COMMIT, ROLLBACK</li>
</ul>

<p>SQL является стандартом ISO, однако каждая СУБД добавляет свои расширения и особенности синтаксиса.</p>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];
        // =============================================================
        //  МОДУЛЬ 2: Основы выборки I (module_id = 3)
        // =============================================================

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Базовый синтаксис SQL запроса',
            'slug'         => 'sql-query-syntax',
            'lesson_type'  => 'theory',
            'lesson_order' => 1,
            'content'      => <<<HTML
<h2>Структура SELECT-запроса</h2>

<p>SELECT — основной оператор SQL для получения данных. Минимальный запрос состоит из двух частей: что выбрать и откуда.</p>

<pre><code class="language-sql">SELECT column1, column2
FROM table_name;</code></pre>

<h3>Полная структура запроса</h3>

<pre><code class="language-sql">SELECT column1, column2
FROM table_name
WHERE condition
GROUP BY column1
HAVING group_condition
ORDER BY column1
LIMIT 10;</code></pre>

<h3>Что означает каждая часть</h3>

<ul>
    <li><strong>SELECT</strong> — список столбцов, которые нужно вернуть</li>
    <li><strong>FROM</strong> — таблица-источник данных</li>
    <li><strong>WHERE</strong> — условие фильтрации строк</li>
    <li><strong>GROUP BY</strong> — группировка строк</li>
    <li><strong>HAVING</strong> — фильтрация групп</li>
    <li><strong>ORDER BY</strong> — сортировка результата</li>
    <li><strong>LIMIT</strong> — ограничение количества строк</li>
</ul>

<h3>Выбор всех столбцов</h3>

<p>Символ <code>*</code> означает «все столбцы»:</p>

<pre><code class="language-sql">SELECT * FROM users;</code></pre>

<h3>Псевдонимы столбцов</h3>

<p>С помощью <code>AS</code> можно задать столбцу другое имя в результате:</p>

<pre><code class="language-sql">SELECT name AS full_name, age AS years
FROM users;</code></pre>

<p>Результатом любого SELECT-запроса является таблица — набор строк и столбцов.</p>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Литералы',
            'slug'         => 'literals',
            'lesson_type'  => 'theory',
            'lesson_order' => 2,
            'content'      => <<<HTML
<h2>Литералы в SQL</h2>

<p>Литерал — это фиксированное значение, которое записывается прямо в запросе. Оно не зависит от данных в таблице.</p>

<h3>Типы литералов</h3>

<ul>
    <li><strong>Числовые:</strong> <code>42</code>, <code>3.14</code>, <code>-100</code></li>
    <li><strong>Строковые:</strong> <code>'Hello'</code>, <code>'SQL'</code></li>
    <li><strong>Дата:</strong> <code>'2026-01-15'</code></li>
    <li><strong>NULL</strong> — специальное значение, означающее отсутствие данных</li>
    <li><strong>Логические:</strong> <code>TRUE</code>, <code>FALSE</code></li>
</ul>

<h3>Использование литералов в SELECT</h3>

<p>Литералы можно использовать прямо в SELECT — они добавляют фиксированный столбец к каждой строке результата:</p>

<pre><code class="language-sql">SELECT
    name,
    'активен' AS status,
    0          AS bonus
FROM users;</code></pre>

<h3>Вычисления с литералами</h3>

<pre><code class="language-sql">SELECT
    price,
    price * 1.2 AS price_with_tax
FROM products;</code></pre>

<h3>NULL — особое значение</h3>

<p>NULL означает отсутствие значения. Важно помнить:</p>

<ul>
    <li><code>NULL = NULL</code> возвращает <code>NULL</code>, а не <code>TRUE</code></li>
    <li>Для проверки на NULL используют <code>IS NULL</code> и <code>IS NOT NULL</code></li>
    <li>Любая арифметика с NULL даёт NULL</li>
</ul>

<pre><code class="language-sql">SELECT * FROM users WHERE phone IS NULL;</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Применение функций',
            'slug'         => 'using-functions',
            'lesson_type'  => 'theory',
            'lesson_order' => 3,
            'content'      => <<<HTML
<h2>Встроенные функции SQL</h2>

<p>SQL предоставляет множество встроенных функций для обработки данных прямо внутри запроса. Функции принимают аргументы и возвращают результат.</p>

<h3>Строковые функции</h3>

<pre><code class="language-sql">SELECT
    UPPER(name)            AS upper_name,
    LOWER(email)           AS lower_email,
    LENGTH(name)           AS name_length,
    CONCAT(first_name, ' ', last_name) AS full_name,
    SUBSTRING(email, 1, 5) AS email_start,
    TRIM('  hello  ')      AS trimmed
FROM users;</code></pre>

<h3>Числовые функции</h3>

<pre><code class="language-sql">SELECT
    ROUND(price, 2)   AS rounded_price,
    CEIL(rating)      AS ceiling,
    FLOOR(rating)     AS floored,
    ABS(balance)      AS absolute,
    MOD(quantity, 3)  AS remainder,
    POWER(2, 8)       AS result
FROM products;</code></pre>

<h3>Функции даты и времени</h3>

<pre><code class="language-sql">SELECT
    NOW()                    AS current_datetime,
    CURDATE()                AS today,
    YEAR(created_at)         AS reg_year,
    MONTH(created_at)        AS reg_month,
    DATEDIFF(NOW(), created_at) AS days_registered
FROM users;</code></pre>

<h3>Где можно использовать функции</h3>

<p>Функции можно применять в <code>SELECT</code>, <code>WHERE</code>, <code>ORDER BY</code>, <code>GROUP BY</code> и <code>HAVING</code>.</p>

<pre><code class="language-sql">-- Найти пользователей, зарегистрированных в текущем году
SELECT name, created_at
FROM users
WHERE YEAR(created_at) = YEAR(NOW())
ORDER BY LENGTH(name);</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Исключение дубликатов, DISTINCT',
            'slug'         => 'distinct',
            'lesson_type'  => 'theory',
            'lesson_order' => 4,
            'content'      => <<<HTML
<h2>Оператор DISTINCT</h2>

<p>DISTINCT убирает повторяющиеся строки из результата запроса, оставляя только уникальные значения.</p>

<h3>Синтаксис</h3>

<pre><code class="language-sql">SELECT DISTINCT column_name
FROM table_name;</code></pre>

<h3>Пример — уникальные города</h3>

<pre><code class="language-sql">-- Без DISTINCT — все города включая повторы
SELECT city FROM users;

-- С DISTINCT — только уникальные города
SELECT DISTINCT city FROM users;</code></pre>

<h3>DISTINCT по нескольким столбцам</h3>

<p>Когда указано несколько столбцов, DISTINCT работает по комбинации значений:</p>

<pre><code class="language-sql">-- Уникальные комбинации город + страна
SELECT DISTINCT city, country
FROM users;</code></pre>

<h3>DISTINCT с COUNT</h3>

<pre><code class="language-sql">-- Количество уникальных городов
SELECT COUNT(DISTINCT city) AS unique_cities
FROM users;</code></pre>

<h3>Важно знать</h3>

<ul>
    <li>DISTINCT ставится сразу после SELECT, перед списком столбцов</li>
    <li>DISTINCT применяется ко всей строке результата, а не к отдельному столбцу</li>
    <li>При большом количестве данных DISTINCT может замедлить запрос</li>
</ul>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Условный оператор WHERE',
            'slug'         => 'where',
            'lesson_type'  => 'theory',
            'lesson_order' => 5,
            'content'      => <<<HTML
<h2>Фильтрация данных с WHERE</h2>

<p>WHERE позволяет отбирать только те строки, которые соответствуют заданному условию.</p>

<h3>Операторы сравнения</h3>

<table>
    <thead>
        <tr><th>Оператор</th><th>Значение</th><th>Пример</th></tr>
    </thead>
    <tbody>
        <tr><td><code>=</code></td><td>Равно</td><td><code>age = 25</code></td></tr>
        <tr><td><code>!=</code> или <code>&lt;&gt;</code></td><td>Не равно</td><td><code>status != 'active'</code></td></tr>
        <tr><td><code>&gt;</code></td><td>Больше</td><td><code>salary &gt; 50000</code></td></tr>
        <tr><td><code>&lt;</code></td><td>Меньше</td><td><code>age &lt; 18</code></td></tr>
        <tr><td><code>&gt;=</code></td><td>Больше или равно</td><td><code>rating &gt;= 4</code></td></tr>
        <tr><td><code>&lt;=</code></td><td>Меньше или равно</td><td><code>price &lt;= 1000</code></td></tr>
    </tbody>
</table>

<h3>Логические операторы</h3>

<pre><code class="language-sql">-- AND: оба условия должны быть истинны
SELECT * FROM employees
WHERE salary > 50000
  AND department = 'IT';

-- OR: хотя бы одно условие истинно
SELECT * FROM products
WHERE category = 'electronics'
   OR category = 'books';

-- NOT: отрицание условия
SELECT * FROM users
WHERE NOT city = 'Moscow';</code></pre>

<h3>Приоритет операторов</h3>

<p>AND выполняется раньше OR. Для явного указания порядка используй скобки:</p>

<pre><code class="language-sql">-- Найти IT-специалистов с высокой зарплатой
-- ИЛИ любых менеджеров
SELECT * FROM employees
WHERE (department = 'IT' AND salary > 80000)
   OR department = 'Management';</code></pre>

<h3>WHERE и порядок выполнения</h3>

<p>WHERE выполняется <strong>до</strong> GROUP BY, HAVING и ORDER BY. То есть сначала фильтруются строки, затем уже группируются и сортируются.</p>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Операторы IS NULL, BETWEEN, IN',
            'slug'         => 'is-null-between-in',
            'lesson_type'  => 'theory',
            'lesson_order' => 6,
            'content'      => <<<HTML
<h2>Дополнительные операторы фильтрации</h2>

<h3>IS NULL / IS NOT NULL</h3>

<p>NULL — это отсутствие значения. Нельзя проверять на NULL через <code>=</code> — только через <code>IS NULL</code>:</p>

<pre><code class="language-sql">-- Пользователи без номера телефона
SELECT * FROM users
WHERE phone IS NULL;

-- Пользователи с указанным телефоном
SELECT * FROM users
WHERE phone IS NOT NULL;</code></pre>

<h3>BETWEEN</h3>

<p>Проверяет, попадает ли значение в диапазон. Границы включаются:</p>

<pre><code class="language-sql">-- Товары ценой от 100 до 500 включительно
SELECT * FROM products
WHERE price BETWEEN 100 AND 500;

-- Эквивалентно:
SELECT * FROM products
WHERE price >= 100 AND price <= 500;

-- Работает и с датами
SELECT * FROM orders
WHERE created_at BETWEEN '2026-01-01' AND '2026-12-31';</code></pre>

<h3>IN</h3>

<p>Проверяет, входит ли значение в список:</p>

<pre><code class="language-sql">-- Заказы в определённых статусах
SELECT * FROM orders
WHERE status IN ('new', 'processing', 'shipped');

-- NOT IN — значение не входит в список
SELECT * FROM users
WHERE city NOT IN ('Moscow', 'Saint Petersburg');</code></pre>

<h3>Комбинирование операторов</h3>

<pre><code class="language-sql">SELECT * FROM products
WHERE category IN ('electronics', 'gadgets')
  AND price BETWEEN 500 AND 5000
  AND description IS NOT NULL;</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Оператор LIKE',
            'slug'         => 'like',
            'lesson_type'  => 'theory',
            'lesson_order' => 7,
            'content'      => <<<HTML
<h2>Поиск по шаблону с LIKE</h2>

<p>LIKE позволяет искать строки по частичному совпадению. Используется с двумя подстановочными символами:</p>

<ul>
    <li><code>%</code> — любое количество любых символов (включая ноль)</li>
    <li><code>_</code> — ровно один любой символ</li>
</ul>

<h3>Примеры с %</h3>

<pre><code class="language-sql">-- Имена, начинающиеся на 'A'
SELECT * FROM users WHERE name LIKE 'A%';

-- Имена, заканчивающиеся на 'ов'
SELECT * FROM users WHERE name LIKE '%ов';

-- Имена, содержащие 'ali' в любом месте
SELECT * FROM users WHERE name LIKE '%ali%';

-- Email на домене gmail.com
SELECT * FROM users WHERE email LIKE '%@gmail.com';</code></pre>

<h3>Примеры с _</h3>

<pre><code class="language-sql">-- Имена ровно из 4 символов
SELECT * FROM users WHERE name LIKE '____';

-- Номера вида A-123 (буква, дефис, три цифры)
SELECT * FROM products WHERE code LIKE '_-___';</code></pre>

<h3>NOT LIKE</h3>

<pre><code class="language-sql">-- Пользователи НЕ с gmail
SELECT * FROM users WHERE email NOT LIKE '%@gmail.com';</code></pre>

<h3>Регистр символов</h3>

<ul>
    <li>В <strong>MySQL</strong> LIKE по умолчанию нечувствителен к регистру</li>
    <li>В <strong>PostgreSQL</strong> LIKE чувствителен к регистру, используй <code>ILIKE</code> для поиска без учёта регистра</li>
</ul>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Регулярные выражения',
            'slug'         => 'regexp',
            'lesson_type'  => 'theory',
            'lesson_order' => 8,
            'content'      => <<<HTML
<h2>Регулярные выражения в SQL</h2>

<p>Оператор <code>REGEXP</code> (или <code>RLIKE</code>) позволяет искать строки по сложным шаблонам — более гибко, чем LIKE.</p>

<h3>Основные символы</h3>

<table>
    <thead>
        <tr><th>Символ</th><th>Значение</th></tr>
    </thead>
    <tbody>
        <tr><td><code>^</code></td><td>Начало строки</td></tr>
        <tr><td><code>$</code></td><td>Конец строки</td></tr>
        <tr><td><code>.</code></td><td>Любой одиночный символ</td></tr>
        <tr><td><code>[abc]</code></td><td>Один из символов a, b или c</td></tr>
        <tr><td><code>[a-z]</code></td><td>Любая буква от a до z</td></tr>
        <tr><td><code>[0-9]</code></td><td>Любая цифра</td></tr>
        <tr><td><code>+</code></td><td>Один или более раз</td></tr>
        <tr><td><code>*</code></td><td>Ноль или более раз</td></tr>
        <tr><td><code>|</code></td><td>Или (альтернатива)</td></tr>
    </tbody>
</table>

<h3>Примеры</h3>

<pre><code class="language-sql">-- Имена, начинающиеся на A или B
SELECT * FROM users
WHERE name REGEXP '^[AB]';

-- Email содержит только цифры перед @
SELECT * FROM users
WHERE email REGEXP '^[0-9]+@';

-- Номер телефона в формате +7XXXXXXXXXX
SELECT * FROM users
WHERE phone REGEXP '^\\+7[0-9]{10}$';

-- Имена из латинских букв длиной от 3 до 6 символов
SELECT * FROM users
WHERE name REGEXP '^[a-zA-Z]{3,6}$';</code></pre>

<h3>REGEXP vs LIKE</h3>

<ul>
    <li>LIKE проще и быстрее для простых шаблонов</li>
    <li>REGEXP мощнее, но сложнее и медленнее</li>
    <li>Используй REGEXP только когда LIKE не справляется</li>
</ul>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Сортировка, оператор ORDER BY',
            'slug'         => 'order-by',
            'lesson_type'  => 'theory',
            'lesson_order' => 9,
            'content'      => <<<HTML
<h2>Сортировка результатов с ORDER BY</h2>

<p>ORDER BY упорядочивает строки результата по одному или нескольким столбцам.</p>

<h3>Синтаксис</h3>

<pre><code class="language-sql">SELECT column1, column2
FROM table_name
ORDER BY column1 ASC,
         column2 DESC;</code></pre>

<ul>
    <li><code>ASC</code> — по возрастанию (от меньшего к большему), используется по умолчанию</li>
    <li><code>DESC</code> — по убыванию (от большего к меньшему)</li>
</ul>

<h3>Примеры</h3>

<pre><code class="language-sql">-- Товары от дешёвых к дорогим
SELECT name, price
FROM products
ORDER BY price ASC;

-- Самые новые заказы первыми
SELECT * FROM orders
ORDER BY created_at DESC;

-- Сначала по отделу (A→Z), внутри отдела — по зарплате (высокая→низкая)
SELECT name, department, salary
FROM employees
ORDER BY department ASC,
         salary DESC;</code></pre>

<h3>Сортировка по номеру столбца</h3>

<pre><code class="language-sql">-- Сортировка по второму столбцу в SELECT
SELECT name, age FROM users
ORDER BY 2 DESC;</code></pre>

<h3>Сортировка NULL-значений</h3>

<ul>
    <li>В <strong>MySQL</strong> NULL считается меньше любого значения при ASC (идут первыми)</li>
    <li>В <strong>PostgreSQL</strong> можно управлять: <code>ORDER BY col ASC NULLS LAST</code></li>
</ul>

<h3>Порядок выполнения</h3>

<p>ORDER BY выполняется одним из последних — после WHERE, GROUP BY и HAVING. Это важно понимать при написании сложных запросов.</p>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Группировка, оператор GROUP BY',
            'slug'         => 'group-by',
            'lesson_type'  => 'theory',
            'lesson_order' => 10,
            'content'      => <<<HTML
<h2>Группировка строк с GROUP BY</h2>

<p>GROUP BY объединяет строки с одинаковыми значениями в указанных столбцах в одну группу. Обычно используется вместе с агрегатными функциями.</p>

<h3>Синтаксис</h3>

<pre><code class="language-sql">SELECT column, aggregate_function(other_column)
FROM table_name
GROUP BY column;</code></pre>

<h3>Примеры</h3>

<pre><code class="language-sql">-- Количество сотрудников в каждом отделе
SELECT department, COUNT(*) AS employee_count
FROM employees
GROUP BY department;

-- Средняя зарплата по городам
SELECT city, AVG(salary) AS avg_salary
FROM employees
GROUP BY city;

-- Сумма заказов по каждому пользователю
SELECT user_id, SUM(amount) AS total_spent
FROM orders
GROUP BY user_id;</code></pre>

<h3>Правило GROUP BY</h3>

<p>Все столбцы в SELECT, которые не являются агрегатными функциями, <strong>обязательно</strong> должны быть указаны в GROUP BY:</p>

<pre><code class="language-sql">-- ✅ Правильно
SELECT department, city, COUNT(*)
FROM employees
GROUP BY department, city;

-- ❌ Ошибка — city не в GROUP BY и не агрегат
SELECT department, city, COUNT(*)
FROM employees
GROUP BY department;</code></pre>

<h3>GROUP BY + ORDER BY</h3>

<pre><code class="language-sql">-- Отделы по убыванию количества сотрудников
SELECT department, COUNT(*) AS cnt
FROM employees
GROUP BY department
ORDER BY cnt DESC;</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Агрегатные функции',
            'slug'         => 'aggregate-functions',
            'lesson_type'  => 'theory',
            'lesson_order' => 11,
            'content'      => <<<HTML
<h2>Агрегатные функции SQL</h2>

<p>Агрегатные функции вычисляют одно итоговое значение по набору строк. Они часто используются вместе с GROUP BY.</p>

<h3>Основные функции</h3>

<table>
    <thead>
        <tr><th>Функция</th><th>Что считает</th></tr>
    </thead>
    <tbody>
        <tr><td><code>COUNT(*)</code></td><td>Количество строк</td></tr>
        <tr><td><code>COUNT(column)</code></td><td>Количество непустых (не NULL) значений</td></tr>
        <tr><td><code>SUM(column)</code></td><td>Сумма всех значений</td></tr>
        <tr><td><code>AVG(column)</code></td><td>Среднее арифметическое</td></tr>
        <tr><td><code>MIN(column)</code></td><td>Минимальное значение</td></tr>
        <tr><td><code>MAX(column)</code></td><td>Максимальное значение</td></tr>
    </tbody>
</table>

<h3>Пример — статистика по всей таблице</h3>

<pre><code class="language-sql">SELECT
    COUNT(*)        AS total_employees,
    COUNT(phone)    AS with_phone,
    SUM(salary)     AS total_payroll,
    AVG(salary)     AS avg_salary,
    MIN(salary)     AS min_salary,
    MAX(salary)     AS max_salary
FROM employees;</code></pre>

<h3>Агрегаты с GROUP BY</h3>

<pre><code class="language-sql">-- Статистика по каждому отделу
SELECT
    department,
    COUNT(*)    AS headcount,
    AVG(salary) AS avg_salary,
    MAX(salary) AS top_salary
FROM employees
GROUP BY department
ORDER BY avg_salary DESC;</code></pre>

<h3>COUNT(*) vs COUNT(column)</h3>

<pre><code class="language-sql">SELECT
    COUNT(*)     AS total_rows,    -- считает все строки включая NULL
    COUNT(phone) AS rows_with_phone -- не считает NULL
FROM users;</code></pre>

<h3>DISTINCT внутри агрегата</h3>

<pre><code class="language-sql">-- Количество уникальных городов
SELECT COUNT(DISTINCT city) AS unique_cities
FROM users;</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 3,
            'title'        => 'Оператор HAVING',
            'slug'         => 'having',
            'lesson_type'  => 'theory',
            'lesson_order' => 12,
            'content'      => <<<HTML
<h2>Фильтрация групп с HAVING</h2>

<p>HAVING фильтрует результаты после группировки. Если WHERE работает со строками до GROUP BY, то HAVING — с группами после GROUP BY.</p>

<h3>Синтаксис</h3>

<pre><code class="language-sql">SELECT column, aggregate_function(other_column)
FROM table_name
GROUP BY column
HAVING aggregate_function(other_column) > value;</code></pre>

<h3>Примеры</h3>

<pre><code class="language-sql">-- Отделы, в которых более 5 сотрудников
SELECT department, COUNT(*) AS cnt
FROM employees
GROUP BY department
HAVING COUNT(*) > 5;

-- Пользователи, потратившие более 10000
SELECT user_id, SUM(amount) AS total
FROM orders
GROUP BY user_id
HAVING SUM(amount) > 10000;

-- Города со средней зарплатой выше 60000
SELECT city, AVG(salary) AS avg_sal
FROM employees
GROUP BY city
HAVING AVG(salary) > 60000
ORDER BY avg_sal DESC;</code></pre>

<h3>WHERE vs HAVING</h3>

<table>
    <thead>
        <tr><th></th><th>WHERE</th><th>HAVING</th></tr>
    </thead>
    <tbody>
        <tr><td>Когда выполняется</td><td>До GROUP BY</td><td>После GROUP BY</td></tr>
        <tr><td>Что фильтрует</td><td>Отдельные строки</td><td>Группы строк</td></tr>
        <tr><td>Можно агрегаты</td><td>❌ Нет</td><td>✅ Да</td></tr>
    </tbody>
</table>

<h3>Порядок выполнения запроса</h3>

<ol>
    <li><strong>FROM</strong> — определяем источник данных</li>
    <li><strong>WHERE</strong> — фильтруем строки</li>
    <li><strong>GROUP BY</strong> — группируем</li>
    <li><strong>HAVING</strong> — фильтруем группы</li>
    <li><strong>SELECT</strong> — формируем результат</li>
    <li><strong>ORDER BY</strong> — сортируем</li>
    <li><strong>LIMIT</strong> — ограничиваем</li>
</ol>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];
        // =============================================================
        //  МОДУЛЬ 3: Основы выборки II (module_id = 4)
        // =============================================================

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'Многотабличные запросы, оператор JOIN',
            'slug'         => 'join',
            'lesson_type'  => 'theory',
            'lesson_order' => 1,
            'content'      => <<<HTML
<h2>Зачем нужен JOIN</h2>

<p>В реляционных базах данные распределены по нескольким таблицам. JOIN позволяет объединить строки из разных таблиц на основании связующего условия.</p>

<h3>Пример без JOIN — проблема</h3>

<p>Представим две таблицы:</p>

<table>
    <thead><tr><th>users.id</th><th>users.name</th></tr></thead>
    <tbody>
        <tr><td>1</td><td>Ali</td></tr>
        <tr><td>2</td><td>Sara</td></tr>
    </tbody>
</table>

<table>
    <thead><tr><th>orders.id</th><th>orders.user_id</th><th>orders.amount</th></tr></thead>
    <tbody>
        <tr><td>1</td><td>1</td><td>500</td></tr>
        <tr><td>2</td><td>1</td><td>300</td></tr>
        <tr><td>3</td><td>2</td><td>800</td></tr>
    </tbody>
</table>

<p>Чтобы получить имя покупателя вместе с суммой заказа — нужен JOIN.</p>

<h3>Базовый синтаксис JOIN</h3>

<pre><code class="language-sql">SELECT users.name, orders.amount
FROM users
JOIN orders ON users.id = orders.user_id;</code></pre>

<h3>Типы JOIN</h3>

<ul>
    <li><strong>INNER JOIN</strong> — только строки с совпадением в обеих таблицах</li>
    <li><strong>LEFT JOIN</strong> — все строки из левой + совпавшие из правой</li>
    <li><strong>RIGHT JOIN</strong> — все строки из правой + совпавшие из левой</li>
    <li><strong>CROSS JOIN</strong> — декартово произведение всех строк</li>
</ul>

<h3>Псевдонимы таблиц</h3>

<p>Для удобства таблицам дают короткие псевдонимы:</p>

<pre><code class="language-sql">SELECT u.name, o.amount
FROM users u
JOIN orders o ON u.id = o.user_id;</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'INNER JOIN',
            'slug'         => 'inner-join',
            'lesson_type'  => 'theory',
            'lesson_order' => 2,
            'content'      => <<<HTML
<h2>INNER JOIN — внутреннее соединение</h2>

<p>INNER JOIN возвращает только те строки, для которых найдено совпадение в <strong>обеих</strong> таблицах. Строки без пары отбрасываются.</p>

<h3>Синтаксис</h3>

<pre><code class="language-sql">SELECT columns
FROM table_a
INNER JOIN table_b ON table_a.key = table_b.key;</code></pre>

<h3>Пример</h3>

<pre><code class="language-sql">-- Сотрудники с их отделами
-- Сотрудники без отдела в результат НЕ попадут
SELECT e.name, d.department_name
FROM employees e
INNER JOIN departments d ON e.department_id = d.id;</code></pre>

<h3>JOIN по нескольким условиям</h3>

<pre><code class="language-sql">SELECT o.id, p.name, o.quantity
FROM orders o
INNER JOIN products p
    ON o.product_id = p.id
    AND o.quantity > 0;</code></pre>

<h3>JOIN трёх и более таблиц</h3>

<pre><code class="language-sql">SELECT
    u.name       AS customer,
    p.name       AS product,
    o.amount     AS total
FROM orders o
INNER JOIN users    u ON o.user_id    = u.id
INNER JOIN products p ON o.product_id = p.id;</code></pre>

<h3>Важно знать</h3>

<ul>
    <li>Просто <code>JOIN</code> без указания типа — это INNER JOIN</li>
    <li>Если совпадений нет — строка не попадёт в результат</li>
    <li>INNER JOIN — самый часто используемый тип соединения</li>
</ul>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'OUTER JOIN',
            'slug'         => 'outer-join',
            'lesson_type'  => 'theory',
            'lesson_order' => 3,
            'content'      => <<<HTML
<h2>LEFT JOIN и RIGHT JOIN</h2>

<p>В отличие от INNER JOIN, внешние соединения сохраняют строки даже без совпадения в другой таблице. Там где совпадения нет — подставляется NULL.</p>

<h3>LEFT JOIN</h3>

<p>Возвращает <strong>все строки из левой таблицы</strong>. Если совпадения в правой таблице нет — поля правой таблицы будут NULL.</p>

<pre><code class="language-sql">-- Все пользователи и их заказы
-- Пользователи без заказов тоже попадут в результат
SELECT u.name, o.amount
FROM users u
LEFT JOIN orders o ON u.id = o.user_id;</code></pre>

<h3>Поиск строк без пары</h3>

<pre><code class="language-sql">-- Пользователи, которые ещё ничего не заказывали
SELECT u.name
FROM users u
LEFT JOIN orders o ON u.id = o.user_id
WHERE o.id IS NULL;</code></pre>

<h3>RIGHT JOIN</h3>

<p>Возвращает <strong>все строки из правой таблицы</strong>. На практике используется редко — обычно меняют порядок таблиц и используют LEFT JOIN.</p>

<pre><code class="language-sql">-- Эквивалентные запросы:
SELECT * FROM a RIGHT JOIN b ON a.id = b.a_id;
SELECT * FROM b LEFT JOIN a ON a.id = b.a_id;</code></pre>

<h3>FULL OUTER JOIN</h3>

<p>Возвращает все строки из обеих таблиц. MySQL не поддерживает FULL OUTER JOIN напрямую — его эмулируют через UNION:</p>

<pre><code class="language-sql">SELECT u.name, o.amount
FROM users u
LEFT JOIN orders o ON u.id = o.user_id

UNION

SELECT u.name, o.amount
FROM users u
RIGHT JOIN orders o ON u.id = o.user_id;</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'Ограничение выборки, оператор LIMIT',
            'slug'         => 'limit',
            'lesson_type'  => 'theory',
            'lesson_order' => 4,
            'content'      => <<<HTML
<h2>Ограничение количества строк с LIMIT</h2>

<p>LIMIT позволяет получить только первые N строк из результата запроса. Это особенно важно при работе с большими таблицами и при реализации постраничной навигации.</p>

<h3>Синтаксис</h3>

<pre><code class="language-sql">SELECT columns
FROM table_name
ORDER BY column
LIMIT количество;</code></pre>

<h3>Примеры</h3>

<pre><code class="language-sql">-- Топ-10 самых дорогих товаров
SELECT name, price
FROM products
ORDER BY price DESC
LIMIT 10;

-- Последние 5 зарегистрированных пользователей
SELECT name, created_at
FROM users
ORDER BY created_at DESC
LIMIT 5;</code></pre>

<h3>OFFSET — пропуск строк</h3>

<p>OFFSET указывает, сколько строк пропустить перед выдачей результата. Используется для постраничной навигации:</p>

<pre><code class="language-sql">-- Страница 1: строки 1-10
SELECT * FROM products ORDER BY id LIMIT 10 OFFSET 0;

-- Страница 2: строки 11-20
SELECT * FROM products ORDER BY id LIMIT 10 OFFSET 10;

-- Страница 3: строки 21-30
SELECT * FROM products ORDER BY id LIMIT 10 OFFSET 20;</code></pre>

<h3>Формула для пагинации</h3>

<pre><code class="language-none">OFFSET = (номер_страницы - 1) * размер_страницы</code></pre>

<h3>Важно</h3>

<ul>
    <li>Всегда используй ORDER BY вместе с LIMIT — без сортировки порядок строк не гарантирован</li>
    <li>При большом OFFSET запрос замедляется — СУБД всё равно читает все пропускаемые строки</li>
</ul>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'Подзапросы',
            'slug'         => 'subqueries',
            'lesson_type'  => 'theory',
            'lesson_order' => 5,
            'content'      => <<<HTML
<h2>Подзапросы в SQL</h2>

<p>Подзапрос — это SELECT-запрос, вложенный внутрь другого запроса. Он заключается в круглые скобки и выполняется первым.</p>

<h3>Подзапрос в WHERE</h3>

<pre><code class="language-sql">-- Сотрудники с зарплатой выше средней
SELECT name, salary
FROM employees
WHERE salary > (
    SELECT AVG(salary)
    FROM employees
);</code></pre>

<h3>Подзапрос в FROM</h3>

<pre><code class="language-sql">-- Используем подзапрос как временную таблицу
SELECT dept_name, avg_sal
FROM (
    SELECT department AS dept_name,
           AVG(salary) AS avg_sal
    FROM employees
    GROUP BY department
) AS dept_stats
WHERE avg_sal > 60000;</code></pre>

<h3>Подзапрос в SELECT</h3>

<pre><code class="language-sql">-- Добавляем среднюю зарплату к каждой строке
SELECT
    name,
    salary,
    (SELECT AVG(salary) FROM employees) AS company_avg
FROM employees;</code></pre>

<h3>Типы подзапросов</h3>

<ul>
    <li><strong>Скалярный</strong> — возвращает одно значение (одна строка, один столбец)</li>
    <li><strong>Строковый</strong> — возвращает одну строку с несколькими столбцами</li>
    <li><strong>Табличный</strong> — возвращает несколько строк и столбцов</li>
    <li><strong>Коррелированный</strong> — ссылается на внешний запрос</li>
</ul>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'Подзапросы с одной строкой и одним столбцом',
            'slug'         => 'single-row-subqueries',
            'lesson_type'  => 'theory',
            'lesson_order' => 6,
            'content'      => <<<HTML
<h2>Скалярные подзапросы</h2>

<p>Скалярный подзапрос возвращает ровно одну строку и один столбец — одно значение. Его можно использовать везде, где ожидается единственное значение.</p>

<h3>Примеры</h3>

<pre><code class="language-sql">-- Сотрудник с максимальной зарплатой
SELECT name, salary
FROM employees
WHERE salary = (
    SELECT MAX(salary)
    FROM employees
);</code></pre>

<pre><code class="language-sql">-- Разница зарплаты каждого от средней
SELECT
    name,
    salary,
    salary - (SELECT AVG(salary) FROM employees) AS diff
FROM employees
ORDER BY diff DESC;</code></pre>

<pre><code class="language-sql">-- Товары дороже среднего в своей категории
-- (скалярный подзапрос с фильтром)
SELECT name, price
FROM products
WHERE price > (
    SELECT AVG(price) FROM products
);</code></pre>

<h3>Операторы сравнения со скалярными подзапросами</h3>

<pre><code class="language-sql">-- Равно
WHERE salary = (SELECT MAX(salary) FROM employees)

-- Больше
WHERE salary > (SELECT AVG(salary) FROM employees)

-- Меньше
WHERE age < (SELECT AVG(age) FROM users)</code></pre>

<h3>Важно</h3>

<p>Если скалярный подзапрос вернёт более одной строки — SQL выдаст ошибку. Убедись, что подзапрос всегда возвращает ровно одно значение.</p>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'Подзапросы с несколькими строками и одним столбцом',
            'slug'         => 'multi-row-subqueries',
            'lesson_type'  => 'theory',
            'lesson_order' => 7,
            'content'      => <<<HTML
<h2>Подзапросы, возвращающие список значений</h2>

<p>Такие подзапросы возвращают несколько строк из одного столбца. С ними используют операторы <code>IN</code>, <code>ANY</code> и <code>ALL</code>.</p>

<h3>Оператор IN</h3>

<pre><code class="language-sql">-- Пользователи, сделавшие хотя бы один заказ
SELECT name
FROM users
WHERE id IN (
    SELECT DISTINCT user_id
    FROM orders
);

-- Пользователи без заказов
SELECT name
FROM users
WHERE id NOT IN (
    SELECT DISTINCT user_id
    FROM orders
);</code></pre>

<h3>Оператор ANY</h3>

<p>Условие истинно, если оно выполняется хотя бы для одного значения из подзапроса:</p>

<pre><code class="language-sql">-- Сотрудники с зарплатой выше хотя бы одного сотрудника IT
SELECT name, salary
FROM employees
WHERE salary > ANY (
    SELECT salary
    FROM employees
    WHERE department = 'IT'
);</code></pre>

<h3>Оператор ALL</h3>

<p>Условие истинно, если оно выполняется для всех значений из подзапроса:</p>

<pre><code class="language-sql">-- Сотрудники с зарплатой выше всех сотрудников IT
SELECT name, salary
FROM employees
WHERE salary > ALL (
    SELECT salary
    FROM employees
    WHERE department = 'IT'
);</code></pre>

<h3>ANY vs ALL vs IN</h3>

<ul>
    <li><code>= ANY(...)</code> эквивалентно <code>IN(...)</code></li>
    <li><code>&gt; ANY(...)</code> — больше минимального значения из списка</li>
    <li><code>&gt; ALL(...)</code> — больше максимального значения из списка</li>
</ul>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'Многостолбцовые подзапросы',
            'slug'         => 'multi-column-subqueries',
            'lesson_type'  => 'theory',
            'lesson_order' => 8,
            'content'      => <<<HTML
<h2>Подзапросы с несколькими столбцами</h2>

<p>Многостолбцовые подзапросы позволяют сравнивать сразу несколько столбцов одновременно. Это удобно когда нужно найти строки по комбинации значений.</p>

<h3>Синтаксис</h3>

<pre><code class="language-sql">SELECT *
FROM table_name
WHERE (column1, column2) IN (
    SELECT column1, column2
    FROM other_table
    WHERE condition
);</code></pre>

<h3>Пример — лидеры по зарплате в каждом отделе</h3>

<pre><code class="language-sql">-- Найти сотрудника с максимальной зарплатой в каждом отделе
SELECT name, department, salary
FROM employees
WHERE (department, salary) IN (
    SELECT department, MAX(salary)
    FROM employees
    GROUP BY department
);</code></pre>

<h3>Пример — последние заказы каждого пользователя</h3>

<pre><code class="language-sql">SELECT *
FROM orders
WHERE (user_id, created_at) IN (
    SELECT user_id, MAX(created_at)
    FROM orders
    GROUP BY user_id
);</code></pre>

<h3>Альтернатива через JOIN</h3>

<p>Многостолбцовые подзапросы можно заменить JOIN с подзапросом — иногда это работает быстрее:</p>

<pre><code class="language-sql">SELECT e.name, e.department, e.salary
FROM employees e
INNER JOIN (
    SELECT department, MAX(salary) AS max_sal
    FROM employees
    GROUP BY department
) m ON e.department = m.department
     AND e.salary   = m.max_sal;</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'Коррелированные подзапросы',
            'slug'         => 'correlated-subqueries',
            'lesson_type'  => 'theory',
            'lesson_order' => 9,
            'content'      => <<<HTML
<h2>Коррелированные подзапросы</h2>

<p>Коррелированный подзапрос ссылается на столбцы внешнего запроса. В отличие от обычного подзапроса, он выполняется заново для <strong>каждой строки</strong> внешнего запроса.</p>

<h3>Пример — зарплата выше средней по своему отделу</h3>

<pre><code class="language-sql">SELECT e.name, e.department, e.salary
FROM employees e
WHERE e.salary > (
    SELECT AVG(e2.salary)
    FROM employees e2
    WHERE e2.department = e.department  -- ← ссылка на внешний запрос
);</code></pre>

<h3>Оператор EXISTS</h3>

<p>EXISTS проверяет, вернул ли подзапрос хотя бы одну строку. Часто используется вместо IN для лучшей производительности:</p>

<pre><code class="language-sql">-- Пользователи, у которых есть хотя бы один заказ
SELECT u.name
FROM users u
WHERE EXISTS (
    SELECT 1
    FROM orders o
    WHERE o.user_id = u.id
);

-- Пользователи без заказов
SELECT u.name
FROM users u
WHERE NOT EXISTS (
    SELECT 1
    FROM orders o
    WHERE o.user_id = u.id
);</code></pre>

<h3>EXISTS vs IN</h3>

<table>
    <thead>
        <tr><th></th><th>IN</th><th>EXISTS</th></tr>
    </thead>
    <tbody>
        <tr><td>Что проверяет</td><td>Значение в списке</td><td>Факт наличия строк</td></tr>
        <tr><td>NULL в подзапросе</td><td>Может давать неожиданный результат</td><td>Безопасен</td></tr>
        <tr><td>Производительность</td><td>Хуже при большом списке</td><td>Лучше при большом наборе</td></tr>
    </tbody>
</table>

<h3>Производительность</h3>

<p>Коррелированные подзапросы могут быть медленными — они выполняются для каждой строки внешнего запроса. При возможности лучше заменить их на JOIN.</p>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'Обобщённое табличное выражение, WITH',
            'slug'         => 'cte-with',
            'lesson_type'  => 'theory',
            'lesson_order' => 10,
            'content'      => <<<HTML
<h2>CTE — Common Table Expression</h2>

<p>CTE (обобщённое табличное выражение) — это именованный подзапрос, объявленный с помощью <code>WITH</code>. Он делает сложные запросы более читаемыми и позволяет использовать один и тот же подзапрос несколько раз.</p>

<h3>Синтаксис</h3>

<pre><code class="language-sql">WITH cte_name AS (
    SELECT ...
    FROM ...
    WHERE ...
)
SELECT *
FROM cte_name
WHERE ...;</code></pre>

<h3>Пример — сотрудники выше среднего по отделу</h3>

<pre><code class="language-sql">WITH dept_avg AS (
    SELECT department,
           AVG(salary) AS avg_salary
    FROM employees
    GROUP BY department
)
SELECT e.name, e.department, e.salary, d.avg_salary
FROM employees e
JOIN dept_avg d ON e.department = d.department
WHERE e.salary > d.avg_salary;</code></pre>

<h3>Несколько CTE в одном запросе</h3>

<pre><code class="language-sql">WITH
top_customers AS (
    SELECT user_id, SUM(amount) AS total
    FROM orders
    GROUP BY user_id
    HAVING SUM(amount) > 10000
),
user_info AS (
    SELECT id, name, email
    FROM users
    WHERE active = 1
)
SELECT u.name, u.email, t.total
FROM user_info u
JOIN top_customers t ON u.id = t.user_id
ORDER BY t.total DESC;</code></pre>

<h3>CTE vs подзапрос в FROM</h3>

<ul>
    <li>CTE объявляется один раз и может использоваться несколько раз в запросе</li>
    <li>CTE улучшает читаемость сложных запросов</li>
    <li>CTE не сохраняется в базе данных — существует только в рамках одного запроса</li>
    <li>Подзапрос в FROM приходится дублировать если нужен в нескольких местах</li>
</ul>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'Объединение запросов, оператор UNION',
            'slug'         => 'union',
            'lesson_type'  => 'theory',
            'lesson_order' => 11,
            'content'      => <<<HTML
<h2>Оператор UNION</h2>

<p>UNION объединяет результаты двух или более SELECT-запросов в один набор строк.</p>

<h3>Синтаксис</h3>

<pre><code class="language-sql">SELECT column1, column2 FROM table_a
UNION
SELECT column1, column2 FROM table_b;</code></pre>

<h3>Правила UNION</h3>

<ul>
    <li>Количество столбцов во всех запросах должно совпадать</li>
    <li>Типы данных соответствующих столбцов должны быть совместимы</li>
    <li>Имена столбцов берутся из первого запроса</li>
</ul>

<h3>UNION vs UNION ALL</h3>

<pre><code class="language-sql">-- UNION — убирает дубликаты (медленнее)
SELECT name FROM employees
UNION
SELECT name FROM clients;

-- UNION ALL — оставляет все строки включая дубликаты (быстрее)
SELECT name FROM employees
UNION ALL
SELECT name FROM clients;</code></pre>

<h3>Практический пример</h3>

<pre><code class="language-sql">-- Объединить всех людей из разных таблиц с указанием их роли
SELECT name, email, 'employee' AS role FROM employees
UNION ALL
SELECT name, email, 'client'   AS role FROM clients
UNION ALL
SELECT name, email, 'partner'  AS role FROM partners
ORDER BY name;</code></pre>

<h3>UNION с условиями</h3>

<pre><code class="language-sql">-- ORDER BY применяется ко всему результату, а не к отдельным частям
SELECT name, salary FROM employees WHERE department = 'IT'
UNION
SELECT name, salary FROM contractors WHERE skill = 'SQL'
ORDER BY salary DESC
LIMIT 10;</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'Условная логика, оператор CASE',
            'slug'         => 'case',
            'lesson_type'  => 'theory',
            'lesson_order' => 12,
            'content'      => <<<HTML
<h2>Оператор CASE</h2>

<p>CASE реализует условную логику прямо внутри SQL-запроса — аналог конструкции if-else в языках программирования.</p>

<h3>Синтаксис — поисковый CASE</h3>

<pre><code class="language-sql">CASE
    WHEN условие1 THEN результат1
    WHEN условие2 THEN результат2
    ELSE результат_по_умолчанию
END</code></pre>

<h3>Синтаксис — простой CASE</h3>

<pre><code class="language-sql">CASE выражение
    WHEN значение1 THEN результат1
    WHEN значение2 THEN результат2
    ELSE результат_по_умолчанию
END</code></pre>

<h3>Примеры</h3>

<pre><code class="language-sql">-- Классификация зарплат
SELECT name, salary,
    CASE
        WHEN salary >= 100000 THEN 'Высокая'
        WHEN salary >= 50000  THEN 'Средняя'
        ELSE                       'Низкая'
    END AS salary_level
FROM employees;</code></pre>

<pre><code class="language-sql">-- Простой CASE — перевод статуса заказа
SELECT id,
    CASE status
        WHEN 'new'       THEN 'Новый'
        WHEN 'paid'      THEN 'Оплачен'
        WHEN 'shipped'   THEN 'Отправлен'
        WHEN 'cancelled' THEN 'Отменён'
        ELSE                  'Неизвестно'
    END AS status_ru
FROM orders;</code></pre>

<h3>CASE в ORDER BY</h3>

<pre><code class="language-sql">-- Сначала критические, потом остальные
SELECT * FROM tasks
ORDER BY
    CASE priority
        WHEN 'critical' THEN 1
        WHEN 'high'     THEN 2
        WHEN 'medium'   THEN 3
        ELSE                 4
    END;</code></pre>

<h3>CASE в агрегатных функциях</h3>

<pre><code class="language-sql">-- Подсчёт по условию
SELECT
    COUNT(*) AS total,
    COUNT(CASE WHEN salary > 80000 THEN 1 END) AS high_earners,
    COUNT(CASE WHEN salary <= 80000 THEN 1 END) AS others
FROM employees;</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 4,
            'title'        => 'Условная функция IF',
            'slug'         => 'if-function',
            'lesson_type'  => 'theory',
            'lesson_order' => 13,
            'content'      => <<<HTML
<h2>Функция IF и работа с NULL</h2>

<h3>Функция IF</h3>

<p>В MySQL доступна функция IF — упрощённый вариант CASE для одного условия:</p>

<pre><code class="language-sql">IF(условие, значение_если_true, значение_если_false)</code></pre>

<pre><code class="language-sql">SELECT name,
    IF(salary > 50000, 'Выше среднего', 'Ниже среднего') AS level
FROM employees;

SELECT name,
    IF(age >= 18, 'Взрослый', 'Несовершеннолетний') AS category
FROM users;</code></pre>

<h3>IFNULL</h3>

<p>Возвращает первый аргумент, если он не NULL, иначе — второй:</p>

<pre><code class="language-sql">-- Заменить NULL на текст по умолчанию
SELECT
    name,
    IFNULL(phone, 'Не указан') AS phone
FROM users;</code></pre>

<h3>NULLIF</h3>

<p>Возвращает NULL, если оба аргумента равны, иначе — первый аргумент. Удобно для предотвращения деления на ноль:</p>

<pre><code class="language-sql">-- Без NULLIF — ошибка при делении на 0
SELECT total / count FROM stats;

-- С NULLIF — вернёт NULL вместо ошибки
SELECT total / NULLIF(count, 0) AS avg
FROM stats;</code></pre>

<h3>COALESCE</h3>

<p>Возвращает первое значение, которое не является NULL. Работает с любым количеством аргументов:</p>

<pre><code class="language-sql">-- Первый доступный контакт
SELECT
    name,
    COALESCE(phone, mobile, email, 'Нет контакта') AS contact
FROM users;</code></pre>

<h3>Когда что использовать</h3>

<ul>
    <li><strong>IF</strong> — простое условие с двумя вариантами (только MySQL)</li>
    <li><strong>CASE</strong> — несколько условий, работает во всех СУБД</li>
    <li><strong>IFNULL</strong> — замена NULL значением по умолчанию</li>
    <li><strong>COALESCE</strong> — выбор первого не-NULL из нескольких вариантов</li>
</ul>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];
        // =============================================================
        //  МОДУЛЬ 4: Манипулирование данными (module_id = 5)
        // =============================================================

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 5,
            'title'        => 'Добавление данных, оператор INSERT',
            'slug'         => 'insert',
            'lesson_type'  => 'theory',
            'lesson_order' => 1,
            'content'      => <<<HTML
<h2>Оператор INSERT</h2>

<p>INSERT добавляет новые строки в таблицу. Это основной способ наполнения базы данных информацией.</p>

<h3>Базовый синтаксис</h3>

<pre><code class="language-sql">INSERT INTO table_name (column1, column2, column3)
VALUES (value1, value2, value3);</code></pre>

<h3>Пример</h3>

<pre><code class="language-sql">INSERT INTO users (name, email, age)
VALUES ('Ali', 'ali@example.com', 25);</code></pre>

<h3>Вставка нескольких строк за раз</h3>

<pre><code class="language-sql">INSERT INTO users (name, email, age)
VALUES
    ('Ali',  'ali@example.com',  25),
    ('Sara', 'sara@example.com', 30),
    ('Bob',  'bob@example.com',  22);</code></pre>

<h3>INSERT из SELECT</h3>

<p>Можно вставлять данные, полученные из другой таблицы:</p>

<pre><code class="language-sql">-- Скопировать старые заказы в архив
INSERT INTO archive_orders (id, user_id, amount, created_at)
SELECT id, user_id, amount, created_at
FROM orders
WHERE created_at < '2025-01-01';</code></pre>

<h3>INSERT IGNORE</h3>

<p>Игнорирует ошибки при вставке (например, дубликат уникального ключа):</p>

<pre><code class="language-sql">INSERT IGNORE INTO users (email, name)
VALUES ('ali@example.com', 'Ali');</code></pre>

<h3>ON DUPLICATE KEY UPDATE</h3>

<p>Если запись уже существует — обновляет её вместо ошибки:</p>

<pre><code class="language-sql">INSERT INTO products (id, name, price)
VALUES (1, 'Laptop', 999)
ON DUPLICATE KEY UPDATE
    price = VALUES(price);</code></pre>

<h3>Важные правила</h3>

<ul>
    <li>Порядок столбцов в INSERT должен совпадать с порядком VALUES</li>
    <li>Столбцы с DEFAULT или AUTO_INCREMENT можно не указывать</li>
    <li>NOT NULL столбцы без DEFAULT обязательно нужно указывать</li>
</ul>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 5,
            'title'        => 'Обновление данных, оператор UPDATE',
            'slug'         => 'update',
            'lesson_type'  => 'theory',
            'lesson_order' => 2,
            'content'      => <<<HTML
<h2>Оператор UPDATE</h2>

<p>UPDATE изменяет значения в существующих строках таблицы.</p>

<h3>Синтаксис</h3>

<pre><code class="language-sql">UPDATE table_name
SET column1 = value1,
    column2 = value2
WHERE condition;</code></pre>

<h3>Примеры</h3>

<pre><code class="language-sql">-- Обновить email одного пользователя
UPDATE users
SET email = 'new@example.com'
WHERE id = 1;

-- Обновить несколько столбцов сразу
UPDATE users
SET email = 'new@example.com',
    age   = 26
WHERE id = 1;</code></pre>

<h3>UPDATE с вычислениями</h3>

<pre><code class="language-sql">-- Повысить зарплату на 10% в отделе IT
UPDATE employees
SET salary = salary * 1.10
WHERE department = 'IT';

-- Увеличить цену всех товаров на 500
UPDATE products
SET price = price + 500
WHERE category = 'electronics';</code></pre>

<h3>UPDATE с подзапросом</h3>

<pre><code class="language-sql">-- Установить флаг VIP пользователям с суммой заказов > 50000
UPDATE users
SET is_vip = 1
WHERE id IN (
    SELECT user_id
    FROM orders
    GROUP BY user_id
    HAVING SUM(amount) > 50000
);</code></pre>

<h3>⚠️ Опасность UPDATE без WHERE</h3>

<pre><code class="language-sql">-- ❌ Обновит ВСЕ строки в таблице!
UPDATE users SET active = 0;

-- ✅ Правильно — с условием
UPDATE users SET active = 0 WHERE last_login < '2024-01-01';</code></pre>

<p>Всегда проверяй условие WHERE перед выполнением UPDATE. Рекомендуется сначала выполнить SELECT с тем же WHERE чтобы убедиться в правильности выборки.</p>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 5,
            'title'        => 'Удаление данных, оператор DELETE',
            'slug'         => 'delete',
            'lesson_type'  => 'theory',
            'lesson_order' => 3,
            'content'      => <<<HTML
<h2>Оператор DELETE</h2>

<p>DELETE удаляет строки из таблицы, соответствующие заданному условию.</p>

<h3>Синтаксис</h3>

<pre><code class="language-sql">DELETE FROM table_name
WHERE condition;</code></pre>

<h3>Примеры</h3>

<pre><code class="language-sql">-- Удалить одного пользователя
DELETE FROM users WHERE id = 5;

-- Удалить отменённые заказы
DELETE FROM orders WHERE status = 'cancelled';

-- Удалить старые записи логов
DELETE FROM logs
WHERE created_at < NOW() - INTERVAL 90 DAY;</code></pre>

<h3>DELETE с подзапросом</h3>

<pre><code class="language-sql">-- Удалить пользователей без заказов
DELETE FROM users
WHERE id NOT IN (
    SELECT DISTINCT user_id FROM orders
);</code></pre>

<h3>⚠️ DELETE без WHERE</h3>

<pre><code class="language-sql">-- ❌ Удалит ВСЕ строки из таблицы!
DELETE FROM logs;

-- ✅ Всегда указывай условие
DELETE FROM logs WHERE level = 'debug';</code></pre>

<h3>TRUNCATE — быстрая очистка таблицы</h3>

<p>TRUNCATE удаляет все строки быстрее, чем DELETE без WHERE:</p>

<pre><code class="language-sql">TRUNCATE TABLE logs;</code></pre>

<table>
    <thead>
        <tr><th></th><th>DELETE</th><th>TRUNCATE</th></tr>
    </thead>
    <tbody>
        <tr><td>Можно фильтровать (WHERE)</td><td>✅ Да</td><td>❌ Нет</td></tr>
        <tr><td>Вызывает триггеры</td><td>✅ Да</td><td>❌ Нет</td></tr>
        <tr><td>Сбрасывает AUTO_INCREMENT</td><td>❌ Нет</td><td>✅ Да</td></tr>
        <tr><td>Скорость</td><td>Медленнее</td><td>Быстрее</td></tr>
        <tr><td>Можно откатить (ROLLBACK)</td><td>✅ Да</td><td>⚠️ Зависит от СУБД</td></tr>
    </tbody>
</table>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        // =============================================================
        //  МОДУЛЬ 5: Продвинутый SQL (module_id = 6)
        // =============================================================

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Работа с типами данных',
            'slug'         => 'working-with-data-types',
            'lesson_type'  => 'theory',
            'lesson_order' => 1,
            'content'      => <<<HTML
<h2>Типы данных в SQL</h2>

<p>Каждый столбец таблицы имеет определённый тип данных. Правильный выбор типа влияет на:</p>

<ul>
    <li>Объём занимаемого места на диске</li>
    <li>Скорость выполнения запросов</li>
    <li>Корректность хранения и сравнения значений</li>
</ul>

<h3>Основные группы типов</h3>

<table>
    <thead>
        <tr><th>Группа</th><th>Типы</th></tr>
    </thead>
    <tbody>
        <tr><td>Числовые</td><td>INT, BIGINT, DECIMAL, FLOAT, DOUBLE</td></tr>
        <tr><td>Строковые</td><td>VARCHAR, CHAR, TEXT, LONGTEXT</td></tr>
        <tr><td>Дата и время</td><td>DATE, TIME, DATETIME, TIMESTAMP</td></tr>
        <tr><td>Логический</td><td>BOOLEAN (TINYINT в MySQL)</td></tr>
        <tr><td>Бинарные</td><td>BLOB, BINARY</td></tr>
        <tr><td>Прочие</td><td>ENUM, SET, JSON</td></tr>
    </tbody>
</table>

<h3>Преобразование типов — CAST</h3>

<pre><code class="language-sql">SELECT
    CAST('123'        AS UNSIGNED)  AS str_to_int,
    CAST(42           AS CHAR)      AS int_to_str,
    CAST('2026-03-20' AS DATE)      AS str_to_date,
    CAST(3.99         AS UNSIGNED)  AS float_to_int;</code></pre>

<h3>CONVERT</h3>

<pre><code class="language-sql">SELECT CONVERT('456', UNSIGNED INTEGER) AS result;</code></pre>

<h3>Неявное преобразование</h3>

<p>MySQL часто преобразует типы автоматически, но это может приводить к неожиданным результатам:</p>

<pre><code class="language-sql">-- '5' автоматически преобразуется в число
SELECT * FROM products WHERE price > '100';

-- Лучше явно указывать правильный тип
SELECT * FROM products WHERE price > 100;</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Числовой тип данных',
            'slug'         => 'numeric-data-type',
            'lesson_type'  => 'theory',
            'lesson_order' => 2,
            'content'      => <<<HTML
<h2>Числовые типы и функции</h2>

<h3>Основные числовые типы</h3>

<table>
    <thead>
        <tr><th>Тип</th><th>Диапазон</th><th>Байт</th></tr>
    </thead>
    <tbody>
        <tr><td>TINYINT</td><td>-128 до 127</td><td>1</td></tr>
        <tr><td>SMALLINT</td><td>-32 768 до 32 767</td><td>2</td></tr>
        <tr><td>INT</td><td>-2.1 млрд до 2.1 млрд</td><td>4</td></tr>
        <tr><td>BIGINT</td><td>очень большие числа</td><td>8</td></tr>
        <tr><td>DECIMAL(p,s)</td><td>точные дроби</td><td>зависит</td></tr>
        <tr><td>FLOAT</td><td>приближённые дроби</td><td>4</td></tr>
        <tr><td>DOUBLE</td><td>приближённые дроби</td><td>8</td></tr>
    </tbody>
</table>

<h3>DECIMAL vs FLOAT</h3>

<pre><code class="language-sql">-- FLOAT может давать погрешность
SELECT 0.1 + 0.2;  -- Результат: 0.30000000000000004

-- DECIMAL точен — используй для денег
CREATE TABLE payments (
    amount DECIMAL(10, 2)  -- до 10 цифр, 2 после запятой
);</code></pre>

<h3>Математические функции</h3>

<pre><code class="language-sql">SELECT
    ROUND(3.14159, 2)  AS rounded,   -- 3.14
    CEIL(4.1)          AS ceiling,   -- 5
    FLOOR(4.9)         AS floored,   -- 4
    ABS(-42)           AS absolute,  -- 42
    MOD(10, 3)         AS remainder, -- 1
    POWER(2, 10)       AS power,     -- 1024
    SQRT(144)          AS root;      -- 12</code></pre>

<h3>UNSIGNED</h3>

<pre><code class="language-sql">-- UNSIGNED убирает отрицательные числа
-- и удваивает максимальное положительное значение
CREATE TABLE counters (
    visits INT UNSIGNED DEFAULT 0  -- от 0 до ~4.3 млрд
);</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Дата и время',
            'slug'         => 'date-and-time',
            'lesson_type'  => 'theory',
            'lesson_order' => 3,
            'content'      => <<<HTML
<h2>Функции даты и времени</h2>

<h3>Текущая дата и время</h3>

<pre><code class="language-sql">SELECT
    NOW()      AS datetime_now,   -- 2026-03-20 14:30:00
    CURDATE()  AS date_today,     -- 2026-03-20
    CURTIME()  AS time_now;       -- 14:30:00</code></pre>

<h3>Извлечение частей даты</h3>

<pre><code class="language-sql">SELECT
    YEAR(created_at)    AS year,
    MONTH(created_at)   AS month,
    DAY(created_at)     AS day,
    HOUR(created_at)    AS hour,
    MINUTE(created_at)  AS minute,
    WEEKDAY(created_at) AS weekday  -- 0=Пн, 6=Вс
FROM orders;</code></pre>

<h3>Арифметика с датами</h3>

<pre><code class="language-sql">SELECT
    -- Прибавить интервал
    DATE_ADD('2026-01-01', INTERVAL 30 DAY)    AS plus_30_days,
    DATE_ADD('2026-01-01', INTERVAL 3 MONTH)   AS plus_3_months,

    -- Вычесть интервал
    DATE_SUB('2026-01-01', INTERVAL 1 YEAR)    AS minus_1_year,

    -- Разница в днях
    DATEDIFF('2026-12-31', '2026-01-01')        AS days_diff,

    -- Разница в месяцах
    TIMESTAMPDIFF(MONTH, '2025-01-01', '2026-06-15') AS months_diff;</code></pre>

<h3>Форматирование даты</h3>

<pre><code class="language-sql">SELECT DATE_FORMAT(NOW(), '%d.%m.%Y')       AS ru_date,
       DATE_FORMAT(NOW(), '%H:%i')           AS time_hm,
       DATE_FORMAT(created_at, '%M %Y')      AS month_year
FROM orders;</code></pre>

<h3>Фильтрация по дате</h3>

<pre><code class="language-sql">-- Заказы за последние 30 дней
SELECT * FROM orders
WHERE created_at >= NOW() - INTERVAL 30 DAY;

-- Заказы за текущий месяц
SELECT * FROM orders
WHERE YEAR(created_at)  = YEAR(NOW())
  AND MONTH(created_at) = MONTH(NOW());</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Функции преобразования типов, CAST',
            'slug'         => 'cast',
            'lesson_type'  => 'theory',
            'lesson_order' => 4,
            'content'      => <<<HTML
<h2>Преобразование типов данных</h2>

<p>Иногда данные хранятся в одном типе, но нужны в другом. CAST и CONVERT позволяют явно преобразовать значение.</p>

<h3>CAST</h3>

<pre><code class="language-sql">CAST(значение AS тип)</code></pre>

<pre><code class="language-sql">SELECT
    CAST('42'         AS UNSIGNED)  AS str_to_uint,
    CAST('3.14'       AS DECIMAL(10,2)) AS str_to_dec,
    CAST(100          AS CHAR)      AS int_to_str,
    CAST('2026-01-15' AS DATE)      AS str_to_date,
    CAST(NOW()        AS TIME)      AS dt_to_time;</code></pre>

<h3>CONVERT</h3>

<pre><code class="language-sql">-- CONVERT — альтернативный синтаксис
SELECT CONVERT('123', UNSIGNED INTEGER) AS result;

-- CONVERT для смены кодировки
SELECT CONVERT(name USING utf8mb4) FROM users;</code></pre>

<h3>Практические примеры</h3>

<pre><code class="language-sql">-- Сортировка числовых значений, хранящихся как VARCHAR
SELECT code
FROM products
ORDER BY CAST(code AS UNSIGNED);

-- Сравнение дат из строк
SELECT *
FROM events
WHERE CAST(event_date AS DATE) = CURDATE();

-- Безопасное деление с округлением
SELECT
    CAST(total_revenue AS DECIMAL(12,2)) /
    NULLIF(order_count, 0) AS avg_order_value
FROM stats;</code></pre>

<h3>Доступные типы в CAST</h3>

<ul>
    <li><code>UNSIGNED</code> / <code>SIGNED</code> — целое число</li>
    <li><code>DECIMAL(p,s)</code> — точное дробное число</li>
    <li><code>CHAR</code> — строка</li>
    <li><code>DATE</code>, <code>TIME</code>, <code>DATETIME</code> — дата и время</li>
    <li><code>JSON</code> — JSON тип (MySQL 8+)</li>
</ul>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Оконные функции',
            'slug'         => 'window-functions',
            'lesson_type'  => 'theory',
            'lesson_order' => 5,
            'content'      => <<<HTML
<h2>Оконные функции</h2>

<p>Оконные функции выполняют вычисления по набору строк, связанных с текущей строкой. В отличие от GROUP BY — строки не сворачиваются, каждая строка остаётся в результате.</p>

<h3>Синтаксис</h3>

<pre><code class="language-sql">функция() OVER (
    PARTITION BY столбец   -- разбивка на группы
    ORDER BY столбец       -- порядок внутри группы
)</code></pre>

<h3>Пример — сумма по всей таблице</h3>

<pre><code class="language-sql">SELECT
    name,
    department,
    salary,
    SUM(salary) OVER () AS total_payroll
FROM employees;</code></pre>

<h3>GROUP BY vs Оконные функции</h3>

<table>
    <thead>
        <tr><th></th><th>GROUP BY</th><th>Оконная функция</th></tr>
    </thead>
    <tbody>
        <tr><td>Строки в результате</td><td>По одной на группу</td><td>Все исходные строки</td></tr>
        <tr><td>Детализация</td><td>Теряется</td><td>Сохраняется</td></tr>
        <tr><td>Агрегат виден</td><td>Только итог</td><td>Рядом с каждой строкой</td></tr>
    </tbody>
</table>

<h3>Накопительная сумма</h3>

<pre><code class="language-sql">SELECT
    name,
    salary,
    SUM(salary) OVER (ORDER BY salary) AS running_total
FROM employees;</code></pre>

<h3>Доступность</h3>

<ul>
    <li>MySQL — начиная с версии <strong>8.0</strong></li>
    <li>PostgreSQL — поддерживается давно</li>
    <li>SQLite — с версии 3.25</li>
</ul>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Партиции в оконных функциях',
            'slug'         => 'window-partitions',
            'lesson_type'  => 'theory',
            'lesson_order' => 6,
            'content'      => <<<HTML
<h2>PARTITION BY в оконных функциях</h2>

<p>PARTITION BY разбивает строки на группы (партиции), и оконная функция вычисляется отдельно для каждой группы. При этом все строки остаются в результате.</p>

<h3>Пример — средняя зарплата по отделу</h3>

<pre><code class="language-sql">SELECT
    name,
    department,
    salary,
    AVG(salary) OVER (PARTITION BY department) AS dept_avg
FROM employees;</code></pre>

<p>Результат — каждый сотрудник остаётся в таблице, но рядом с ним появляется средняя зарплата по его отделу.</p>

<h3>Сравнение с GROUP BY</h3>

<pre><code class="language-sql">-- GROUP BY — теряем детали, только итог по отделу
SELECT department, AVG(salary) AS dept_avg
FROM employees
GROUP BY department;

-- PARTITION BY — сохраняем все строки + добавляем итог
SELECT name, department, salary,
       AVG(salary) OVER (PARTITION BY department) AS dept_avg
FROM employees;</code></pre>

<h3>Несколько разных партиций в одном запросе</h3>

<pre><code class="language-sql">SELECT
    name,
    department,
    city,
    salary,
    AVG(salary) OVER (PARTITION BY department) AS dept_avg,
    AVG(salary) OVER (PARTITION BY city)       AS city_avg,
    AVG(salary) OVER ()                        AS company_avg
FROM employees;</code></pre>

<h3>Процент от суммы по группе</h3>

<pre><code class="language-sql">SELECT
    name,
    department,
    salary,
    ROUND(
        salary * 100.0 / SUM(salary) OVER (PARTITION BY department),
        2
    ) AS pct_of_dept
FROM employees;</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Сортировка внутри окна',
            'slug'         => 'window-ordering',
            'lesson_type'  => 'theory',
            'lesson_order' => 7,
            'content'      => <<<HTML
<h2>ORDER BY в оконных функциях</h2>

<p>ORDER BY внутри OVER() задаёт порядок строк в окне. Это необходимо для ранжирующих и накопительных вычислений.</p>

<h3>Нарастающий итог</h3>

<pre><code class="language-sql">SELECT
    name,
    salary,
    SUM(salary) OVER (ORDER BY salary ASC) AS running_total
FROM employees;</code></pre>

<h3>Нарастающий итог внутри группы</h3>

<pre><code class="language-sql">SELECT
    name,
    department,
    salary,
    SUM(salary) OVER (
        PARTITION BY department
        ORDER BY salary ASC
    ) AS dept_running_total
FROM employees;</code></pre>

<h3>Ранжирование</h3>

<pre><code class="language-sql">SELECT
    name,
    salary,
    ROW_NUMBER() OVER (ORDER BY salary DESC) AS row_num,
    RANK()       OVER (ORDER BY salary DESC) AS rank_pos,
    DENSE_RANK() OVER (ORDER BY salary DESC) AS dense_pos
FROM employees;</code></pre>

<h3>Разница между ROW_NUMBER, RANK и DENSE_RANK</h3>

<table>
    <thead>
        <tr><th>Зарплата</th><th>ROW_NUMBER</th><th>RANK</th><th>DENSE_RANK</th></tr>
    </thead>
    <tbody>
        <tr><td>100 000</td><td>1</td><td>1</td><td>1</td></tr>
        <tr><td>90 000</td><td>2</td><td>2</td><td>2</td></tr>
        <tr><td>90 000</td><td>3</td><td>2</td><td>2</td></tr>
        <tr><td>80 000</td><td>4</td><td>4</td><td>3</td></tr>
    </tbody>
</table>

<ul>
    <li><strong>ROW_NUMBER</strong> — всегда уникальный номер</li>
    <li><strong>RANK</strong> — при совпадении одинаковый ранг, следующий пропускается</li>
    <li><strong>DENSE_RANK</strong> — при совпадении одинаковый ранг, без пропуска</li>
</ul>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Рамки окон в оконных функциях',
            'slug'         => 'window-frames',
            'lesson_type'  => 'theory',
            'lesson_order' => 8,
            'content'      => <<<HTML
<h2>Рамки окон (Window Frames)</h2>

<p>Рамка окна уточняет, какие именно строки из партиции участвуют в вычислении для текущей строки.</p>

<h3>Синтаксис</h3>

<pre><code class="language-sql">функция() OVER (
    ORDER BY column
    ROWS BETWEEN начало AND конец
)</code></pre>

<h3>Ключевые слова рамки</h3>

<ul>
    <li><code>UNBOUNDED PRECEDING</code> — от начала партиции</li>
    <li><code>N PRECEDING</code> — N строк назад от текущей</li>
    <li><code>CURRENT ROW</code> — текущая строка</li>
    <li><code>N FOLLOWING</code> — N строк вперёд от текущей</li>
    <li><code>UNBOUNDED FOLLOWING</code> — до конца партиции</li>
</ul>

<h3>Скользящее среднее за 3 дня</h3>

<pre><code class="language-sql">SELECT
    sale_date,
    amount,
    AVG(amount) OVER (
        ORDER BY sale_date
        ROWS BETWEEN 2 PRECEDING AND CURRENT ROW
    ) AS moving_avg_3days
FROM sales;</code></pre>

<h3>Накопительный итог от начала</h3>

<pre><code class="language-sql">SELECT
    sale_date,
    amount,
    SUM(amount) OVER (
        ORDER BY sale_date
        ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW
    ) AS cumulative_sum
FROM sales;</code></pre>

<h3>ROWS vs RANGE</h3>

<ul>
    <li><strong>ROWS</strong> — рамка по физическому количеству строк</li>
    <li><strong>RANGE</strong> — рамка по диапазону значений ORDER BY столбца</li>
</ul>

<pre><code class="language-sql">-- RANGE включает все строки с одинаковым значением ORDER BY
SUM(amount) OVER (
    ORDER BY sale_date
    RANGE BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW
)</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Типы оконных функций',
            'slug'         => 'window-function-types',
            'lesson_type'  => 'theory',
            'lesson_order' => 9,
            'content'      => <<<HTML
<h2>Типы оконных функций</h2>

<h3>Агрегатные оконные функции</h3>

<pre><code class="language-sql">SELECT name, salary,
    SUM(salary)  OVER (PARTITION BY department) AS dept_total,
    AVG(salary)  OVER (PARTITION BY department) AS dept_avg,
    MIN(salary)  OVER (PARTITION BY department) AS dept_min,
    MAX(salary)  OVER (PARTITION BY department) AS dept_max,
    COUNT(*)     OVER (PARTITION BY department) AS dept_count
FROM employees;</code></pre>

<h3>Ранжирующие функции</h3>

<pre><code class="language-sql">SELECT name, salary,
    ROW_NUMBER()  OVER (ORDER BY salary DESC) AS row_num,
    RANK()        OVER (ORDER BY salary DESC) AS rank_pos,
    DENSE_RANK()  OVER (ORDER BY salary DESC) AS dense_pos,
    NTILE(4)      OVER (ORDER BY salary DESC) AS quartile
FROM employees;</code></pre>

<p><code>NTILE(n)</code> делит строки на n равных групп и присваивает номер группы.</p>

<h3>Функции смещения</h3>

<pre><code class="language-sql">SELECT
    name,
    salary,
    LAG(salary, 1)  OVER (ORDER BY salary) AS prev_salary,
    LEAD(salary, 1) OVER (ORDER BY salary) AS next_salary
FROM employees;</code></pre>

<ul>
    <li><strong>LAG(col, n)</strong> — значение из строки на n позиций назад</li>
    <li><strong>LEAD(col, n)</strong> — значение из строки на n позиций вперёд</li>
</ul>

<h3>Функции первого и последнего значения</h3>

<pre><code class="language-sql">SELECT
    name,
    department,
    salary,
    FIRST_VALUE(name) OVER (
        PARTITION BY department
        ORDER BY salary DESC
    ) AS top_earner,
    LAST_VALUE(name) OVER (
        PARTITION BY department
        ORDER BY salary DESC
        ROWS BETWEEN UNBOUNDED PRECEDING AND UNBOUNDED FOLLOWING
    ) AS lowest_earner
FROM employees;</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Транзакции',
            'slug'         => 'transactions',
            'lesson_type'  => 'theory',
            'lesson_order' => 10,
            'content'      => <<<HTML
<h2>Транзакции в SQL</h2>

<p>Транзакция — это последовательность SQL-операций, которая выполняется как единое целое. Либо все операции завершаются успешно, либо ни одна из них не применяется.</p>

<h3>Классический пример — перевод денег</h3>

<pre><code class="language-sql">START TRANSACTION;

-- Списать деньги с отправителя
UPDATE accounts SET balance = balance - 1000 WHERE id = 1;

-- Зачислить деньги получателю
UPDATE accounts SET balance = balance + 1000 WHERE id = 2;

COMMIT; -- Подтвердить оба изменения</code></pre>

<p>Если между двумя UPDATE произойдёт сбой — без транзакции деньги спишутся, но не зачислятся. С транзакцией — оба изменения отменятся.</p>

<h3>Свойства ACID</h3>

<table>
    <thead>
        <tr><th>Свойство</th><th>Значение</th></tr>
    </thead>
    <tbody>
        <tr><td><strong>A</strong>tomicity (Атомарность)</td><td>Всё или ничего</td></tr>
        <tr><td><strong>C</strong>onsistency (Согласованность)</td><td>Данные остаются корректными</td></tr>
        <tr><td><strong>I</strong>solation (Изолированность)</td><td>Транзакции не мешают друг другу</td></tr>
        <tr><td><strong>D</strong>urability (Долговечность)</td><td>Результат сохраняется даже при сбое</td></tr>
    </tbody>
</table>

<h3>ROLLBACK — отмена изменений</h3>

<pre><code class="language-sql">START TRANSACTION;

UPDATE accounts SET balance = balance - 1000 WHERE id = 1;

-- Что-то пошло не так...
ROLLBACK; -- Отменить все изменения в транзакции</code></pre>

<h3>SAVEPOINT — точки сохранения</h3>

<pre><code class="language-sql">START TRANSACTION;

INSERT INTO orders (user_id, amount) VALUES (1, 500);
SAVEPOINT after_order;

INSERT INTO payments (order_id, amount) VALUES (LAST_INSERT_ID(), 500);

-- Если ошибка в payments — откатываемся только до savepoint
ROLLBACK TO after_order;

COMMIT;</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Блокировки в СУБД',
            'slug'         => 'locks',
            'lesson_type'  => 'theory',
            'lesson_order' => 11,
            'content'      => <<<HTML
<h2>Блокировки в базах данных</h2>

<p>Когда несколько пользователей одновременно работают с одними данными, СУБД использует блокировки для предотвращения конфликтов.</p>

<h3>Типы блокировок</h3>

<table>
    <thead>
        <tr><th>Тип</th><th>Описание</th></tr>
    </thead>
    <tbody>
        <tr><td>Shared Lock (S)</td><td>Блокировка чтения. Несколько транзакций могут читать одновременно</td></tr>
        <tr><td>Exclusive Lock (X)</td><td>Блокировка записи. Только одна транзакция может изменять данные</td></tr>
        <tr><td>Row-level Lock</td><td>Блокировка отдельной строки — минимальное влияние на других</td></tr>
        <tr><td>Table-level Lock</td><td>Блокировка всей таблицы — простая, но ограничивает параллелизм</td></tr>
    </tbody>
</table>

<h3>Явные блокировки</h3>

<pre><code class="language-sql">-- Заблокировать строку для чтения
SELECT * FROM accounts
WHERE id = 1
LOCK IN SHARE MODE;

-- Заблокировать строку для изменения
SELECT * FROM accounts
WHERE id = 1
FOR UPDATE;</code></pre>

<h3>Deadlock — взаимная блокировка</h3>

<p>Deadlock возникает когда две транзакции ждут освобождения ресурсов друг друга:</p>

<pre><code class="language-none">Транзакция A: заблокировала строку 1, ждёт строку 2
Транзакция B: заблокировала строку 2, ждёт строку 1
→ Оба ждут вечно = Deadlock</code></pre>

<h3>Как избежать Deadlock</h3>

<ul>
    <li>Всегда блокируй ресурсы в одном и том же порядке</li>
    <li>Держи транзакции короткими</li>
    <li>Используй блокировки на уровне строк, а не таблиц</li>
</ul>

<p>MySQL автоматически обнаруживает deadlock и отменяет одну из транзакций, возвращая ошибку <code>ERROR 1213: Deadlock found</code>.</p>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Создание транзакций',
            'slug'         => 'creating-transactions',
            'lesson_type'  => 'theory',
            'lesson_order' => 12,
            'content'      => <<<HTML
<h2>Синтаксис транзакций</h2>

<h3>Основные команды</h3>

<pre><code class="language-sql">START TRANSACTION;  -- начать транзакцию
COMMIT;             -- подтвердить все изменения
ROLLBACK;           -- отменить все изменения</code></pre>

<h3>Полный пример</h3>

<pre><code class="language-sql">START TRANSACTION;

UPDATE accounts SET balance = balance - 500 WHERE id = 1;
UPDATE accounts SET balance = balance + 500 WHERE id = 2;

-- Проверяем что всё хорошо
SELECT balance FROM accounts WHERE id IN (1, 2);

COMMIT;</code></pre>

<h3>Транзакция с обработкой ошибок</h3>

<pre><code class="language-sql">START TRANSACTION;

INSERT INTO orders (user_id, amount) VALUES (1, 1500);

-- Проверка остатка на складе
UPDATE products SET stock = stock - 1 WHERE id = 5 AND stock > 0;

-- Если товара нет (affected rows = 0) — откатываем
-- Иначе подтверждаем
COMMIT;</code></pre>

<h3>SAVEPOINT</h3>

<pre><code class="language-sql">START TRANSACTION;

INSERT INTO log (message) VALUES ('Начало операции');
SAVEPOINT step1;

UPDATE users SET balance = balance - 100 WHERE id = 1;
SAVEPOINT step2;

-- Что-то пошло не так на этапе 2
ROLLBACK TO step1;  -- вернуться к step1, step2 отменён

-- Продолжаем с step1
COMMIT;</code></pre>

<h3>Autocommit</h3>

<p>По умолчанию в MySQL каждый запрос автоматически подтверждается (autocommit = ON). START TRANSACTION временно отключает autocommit на время транзакции.</p>

<pre><code class="language-sql">-- Отключить autocommit для сессии
SET autocommit = 0;

-- Теперь нужно явно делать COMMIT
UPDATE users SET name = 'Ali' WHERE id = 1;
COMMIT;</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Хранимые процедуры и функции',
            'slug'         => 'stored-procedures-and-functions',
            'lesson_type'  => 'theory',
            'lesson_order' => 13,
            'content'      => <<<HTML
<h2>Хранимые процедуры и функции</h2>

<p>Хранимые процедуры и функции — это именованные блоки SQL-кода, сохранённые в базе данных. Их можно вызывать многократно.</p>

<h3>Сравнение</h3>

<table>
    <thead>
        <tr><th></th><th>Функция</th><th>Процедура</th></tr>
    </thead>
    <tbody>
        <tr><td>Возвращает</td><td>Одно значение</td><td>Ничего или OUT параметры</td></tr>
        <tr><td>Можно в SELECT</td><td>✅ Да</td><td>❌ Нет</td></tr>
        <tr><td>Вызов</td><td>В запросе</td><td>CALL имя()</td></tr>
        <tr><td>Транзакции внутри</td><td>❌ Нет</td><td>✅ Да</td></tr>
    </tbody>
</table>

<h3>Зачем использовать</h3>

<ul>
    <li>Инкапсуляция бизнес-логики на уровне БД</li>
    <li>Повторное использование кода</li>
    <li>Снижение нагрузки на сеть — один вызов вместо многих запросов</li>
    <li>Дополнительный уровень безопасности</li>
</ul>

<h3>DELIMITER</h3>

<p>При создании процедур и функций в MySQL нужно временно изменить разделитель команд, иначе <code>;</code> внутри тела прервёт создание:</p>

<pre><code class="language-sql">DELIMITER //

CREATE PROCEDURE my_proc()
BEGIN
    SELECT 'Hello from procedure';
END //

DELIMITER ;</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Хранимые функции',
            'slug'         => 'stored-functions',
            'lesson_type'  => 'theory',
            'lesson_order' => 14,
            'content'      => <<<HTML
<h2>Создание хранимых функций</h2>

<pre><code class="language-sql">DELIMITER //

CREATE FUNCTION имя(параметры)
RETURNS тип_данных
DETERMINISTIC
BEGIN
    -- тело функции
    RETURN значение;
END //

DELIMITER ;</code></pre>

<h3>Пример — полное имя</h3>

<pre><code class="language-sql">DELIMITER //

CREATE FUNCTION full_name(
    first_name VARCHAR(50),
    last_name  VARCHAR(50)
)
RETURNS VARCHAR(101)
DETERMINISTIC
BEGIN
    RETURN CONCAT(first_name, ' ', last_name);
END //

DELIMITER ;</code></pre>

<h3>Использование функции</h3>

<pre><code class="language-sql">-- Вызов с литералами
SELECT full_name('Ali', 'Khan') AS name;

-- Вызов со столбцами таблицы
SELECT full_name(first_name, last_name) AS name
FROM employees;</code></pre>

<h3>Пример — категория зарплаты</h3>

<pre><code class="language-sql">DELIMITER //

CREATE FUNCTION salary_level(salary DECIMAL(10,2))
RETURNS VARCHAR(20)
DETERMINISTIC
BEGIN
    DECLARE level VARCHAR(20);

    IF salary >= 100000 THEN
        SET level = 'Высокая';
    ELSEIF salary >= 50000 THEN
        SET level = 'Средняя';
    ELSE
        SET level = 'Низкая';
    END IF;

    RETURN level;
END //

DELIMITER ;

-- Использование
SELECT name, salary, salary_level(salary) AS level
FROM employees;</code></pre>

<h3>Управление функциями</h3>

<pre><code class="language-sql">-- Просмотр всех функций
SHOW FUNCTION STATUS WHERE Db = 'your_database';

-- Удаление функции
DROP FUNCTION IF EXISTS full_name;</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Хранимые процедуры',
            'slug'         => 'stored-procedures',
            'lesson_type'  => 'theory',
            'lesson_order' => 15,
            'content'      => <<<HTML
<h2>Создание хранимых процедур</h2>

<pre><code class="language-sql">DELIMITER //

CREATE PROCEDURE имя(
    IN  param1 тип,
    OUT param2 тип
)
BEGIN
    -- тело процедуры
END //

DELIMITER ;</code></pre>

<h3>Типы параметров</h3>

<ul>
    <li><strong>IN</strong> — входной параметр (передаём в процедуру)</li>
    <li><strong>OUT</strong> — выходной параметр (получаем из процедуры)</li>
    <li><strong>INOUT</strong> — входной и выходной одновременно</li>
</ul>

<h3>Пример — повышение зарплаты</h3>

<pre><code class="language-sql">DELIMITER //

CREATE PROCEDURE raise_salary(
    IN emp_id    INT,
    IN pct       DECIMAL(5,2)
)
BEGIN
    UPDATE employees
    SET salary = salary * (1 + pct / 100)
    WHERE id = emp_id;

    SELECT CONCAT('Зарплата сотрудника #', emp_id, ' повышена на ', pct, '%') AS result;
END //

DELIMITER ;

-- Вызов
CALL raise_salary(1, 10);</code></pre>

<h3>Пример с OUT параметром</h3>

<pre><code class="language-sql">DELIMITER //

CREATE PROCEDURE get_dept_stats(
    IN  dept     VARCHAR(50),
    OUT avg_sal  DECIMAL(10,2),
    OUT emp_cnt  INT
)
BEGIN
    SELECT AVG(salary), COUNT(*)
    INTO avg_sal, emp_cnt
    FROM employees
    WHERE department = dept;
END //

DELIMITER ;

-- Вызов
CALL get_dept_stats('IT', @avg, @cnt);
SELECT @avg AS avg_salary, @cnt AS employee_count;</code></pre>

<h3>Управление процедурами</h3>

<pre><code class="language-sql">SHOW PROCEDURE STATUS WHERE Db = 'your_database';
DROP PROCEDURE IF EXISTS raise_salary;</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Операторы IF, CASE, WHILE в хранимых процедурах',
            'slug'         => 'control-flow-in-procedures',
            'lesson_type'  => 'theory',
            'lesson_order' => 16,
            'content'      => <<<HTML
<h2>Управляющие конструкции в процедурах</h2>

<h3>IF ... THEN ... ELSEIF ... ELSE</h3>

<pre><code class="language-sql">DELIMITER //

CREATE PROCEDURE classify_employee(IN emp_id INT)
BEGIN
    DECLARE emp_salary DECIMAL(10,2);

    SELECT salary INTO emp_salary
    FROM employees WHERE id = emp_id;

    IF emp_salary >= 100000 THEN
        SELECT 'Топ-менеджер' AS category;
    ELSEIF emp_salary >= 60000 THEN
        SELECT 'Специалист' AS category;
    ELSE
        SELECT 'Стажёр' AS category;
    END IF;
END //

DELIMITER ;</code></pre>

<h3>CASE в процедурах</h3>

<pre><code class="language-sql">DELIMITER //

CREATE PROCEDURE get_day_name(IN day_num INT)
BEGIN
    CASE day_num
        WHEN 1 THEN SELECT 'Понедельник';
        WHEN 2 THEN SELECT 'Вторник';
        WHEN 3 THEN SELECT 'Среда';
        WHEN 4 THEN SELECT 'Четверг';
        WHEN 5 THEN SELECT 'Пятница';
        ELSE        SELECT 'Выходной';
    END CASE;
END //

DELIMITER ;</code></pre>

<h3>WHILE</h3>

<pre><code class="language-sql">DELIMITER //

CREATE PROCEDURE fill_numbers(IN max_val INT)
BEGIN
    DECLARE i INT DEFAULT 1;

    WHILE i <= max_val DO
        INSERT INTO numbers (value) VALUES (i);
        SET i = i + 1;
    END WHILE;
END //

DELIMITER ;

CALL fill_numbers(10);</code></pre>

<h3>LOOP и LEAVE</h3>

<pre><code class="language-sql">DELIMITER //

CREATE PROCEDURE count_loop()
BEGIN
    DECLARE i INT DEFAULT 0;

    my_loop: LOOP
        SET i = i + 1;
        IF i >= 5 THEN
            LEAVE my_loop;
        END IF;
    END LOOP;

    SELECT i AS final_value;
END //

DELIMITER ;</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 6,
            'title'        => 'Планировщик событий',
            'slug'         => 'event-scheduler',
            'lesson_type'  => 'theory',
            'lesson_order' => 17,
            'content'      => <<<HTML
<h2>Event Scheduler — планировщик событий MySQL</h2>

<p>Планировщик событий позволяет автоматически выполнять SQL-операции по расписанию — аналог cron, но на уровне базы данных.</p>

<h3>Включение планировщика</h3>

<pre><code class="language-sql">-- Включить на время сессии
SET GLOBAL event_scheduler = ON;

-- Проверить статус
SHOW VARIABLES LIKE 'event_scheduler';</code></pre>

<h3>Повторяющееся событие</h3>

<pre><code class="language-sql">CREATE EVENT clean_old_logs
ON SCHEDULE EVERY 1 DAY
STARTS '2026-01-01 03:00:00'
DO
    DELETE FROM logs
    WHERE created_at < NOW() - INTERVAL 90 DAY;</code></pre>

<h3>Одноразовое событие</h3>

<pre><code class="language-sql">CREATE EVENT send_new_year_bonus
ON SCHEDULE AT '2026-12-31 23:00:00'
DO
    UPDATE employees
    SET bonus = salary * 0.10
    WHERE active = 1;</code></pre>

<h3>Событие с блоком BEGIN...END</h3>

<pre><code class="language-sql">CREATE EVENT monthly_report
ON SCHEDULE EVERY 1 MONTH
STARTS '2026-02-01 00:00:00'
DO
BEGIN
    INSERT INTO reports (month, total_orders, total_revenue)
    SELECT
        DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m'),
        COUNT(*),
        SUM(amount)
    FROM orders
    WHERE MONTH(created_at) = MONTH(NOW() - INTERVAL 1 MONTH);
END;</code></pre>

<h3>Управление событиями</h3>

<pre><code class="language-sql">-- Просмотр событий
SHOW EVENTS;

-- Отключить событие
ALTER EVENT clean_old_logs DISABLE;

-- Включить снова
ALTER EVENT clean_old_logs ENABLE;

-- Удалить событие
DROP EVENT IF EXISTS clean_old_logs;</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        // =============================================================
        //  МОДУЛЬ 6: Базы данных и таблицы (module_id = 7)
        // =============================================================

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 7,
            'title'        => 'Создание и удаление баз данных',
            'slug'         => 'create-drop-database',
            'lesson_type'  => 'theory',
            'lesson_order' => 1,
            'content'      => <<<HTML
<h2>Управление базами данных</h2>

<h3>Создание базы данных</h3>

<pre><code class="language-sql">CREATE DATABASE shop
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;</code></pre>

<ul>
    <li><code>CHARACTER SET utf8mb4</code> — поддержка всех Unicode символов включая эмодзи</li>
    <li><code>COLLATE utf8mb4_unicode_ci</code> — правила сортировки (ci = case insensitive)</li>
</ul>

<h3>Проверка существования перед созданием</h3>

<pre><code class="language-sql">CREATE DATABASE IF NOT EXISTS shop
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;</code></pre>

<h3>Просмотр баз данных</h3>

<pre><code class="language-sql">-- Список всех баз данных
SHOW DATABASES;

-- Информация о конкретной БД
SHOW CREATE DATABASE shop;</code></pre>

<h3>Выбор базы данных</h3>

<pre><code class="language-sql">USE shop;</code></pre>

<h3>Удаление базы данных</h3>

<pre><code class="language-sql">-- Удалить если существует (безопасно)
DROP DATABASE IF EXISTS shop;

-- Без IF EXISTS — ошибка если не существует
DROP DATABASE shop;</code></pre>

<h3>⚠️ Осторожно</h3>

<p>DROP DATABASE удаляет базу данных со всеми таблицами и данными <strong>без возможности восстановления</strong>. Всегда делай резервную копию перед удалением.</p>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 7,
            'title'        => 'Создание и удаление таблиц',
            'slug'         => 'create-drop-table',
            'lesson_type'  => 'theory',
            'lesson_order' => 2,
            'content'      => <<<HTML
<h2>Управление таблицами</h2>

<h3>CREATE TABLE</h3>

<pre><code class="language-sql">CREATE TABLE users (
    id         INT          AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    email      VARCHAR(255) NOT NULL UNIQUE,
    age        INT,
    active     BOOLEAN      DEFAULT TRUE,
    created_at TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
);</code></pre>

<h3>CREATE TABLE IF NOT EXISTS</h3>

<pre><code class="language-sql">CREATE TABLE IF NOT EXISTS users (
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);</code></pre>

<h3>Копирование структуры таблицы</h3>

<pre><code class="language-sql">-- Создать таблицу с такой же структурой
CREATE TABLE users_backup LIKE users;

-- Создать таблицу и скопировать данные
CREATE TABLE users_backup AS SELECT * FROM users;</code></pre>

<h3>ALTER TABLE — изменение структуры</h3>

<pre><code class="language-sql">-- Добавить столбец
ALTER TABLE users ADD COLUMN phone VARCHAR(20);

-- Добавить столбец после определённого столбца
ALTER TABLE users ADD COLUMN phone VARCHAR(20) AFTER email;

-- Изменить тип столбца
ALTER TABLE users MODIFY COLUMN name VARCHAR(200) NOT NULL;

-- Переименовать столбец
ALTER TABLE users RENAME COLUMN age TO birth_year;

-- Удалить столбец
ALTER TABLE users DROP COLUMN age;

-- Переименовать таблицу
ALTER TABLE users RENAME TO site_users;
RENAME TABLE users TO site_users;</code></pre>

<h3>DROP TABLE</h3>

<pre><code class="language-sql">DROP TABLE IF EXISTS users;
DROP TABLE users;</code></pre>

<h3>SHOW — просмотр информации</h3>

<pre><code class="language-sql">SHOW TABLES;
SHOW COLUMNS FROM users;
DESCRIBE users;
SHOW CREATE TABLE users;</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 7,
            'title'        => 'Типы данных для колонок таблиц',
            'slug'         => 'column-data-types',
            'lesson_type'  => 'theory',
            'lesson_order' => 3,
            'content'      => <<<HTML
<h2>Типы данных для столбцов</h2>

<p>При создании таблицы каждому столбцу назначается тип данных. Правильный выбор влияет на объём хранилища, производительность и корректность данных.</p>

<h3>Числовые типы</h3>

<table>
    <thead>
        <tr><th>Тип</th><th>Диапазон (signed)</th><th>Байт</th><th>Применение</th></tr>
    </thead>
    <tbody>
        <tr><td>TINYINT</td><td>-128 до 127</td><td>1</td><td>Флаги, статусы</td></tr>
        <tr><td>SMALLINT</td><td>-32 768 до 32 767</td><td>2</td><td>Небольшие числа</td></tr>
        <tr><td>INT</td><td>-2.1 млрд до 2.1 млрд</td><td>4</td><td>ID, счётчики</td></tr>
        <tr><td>BIGINT</td><td>очень большие числа</td><td>8</td><td>Большие ID</td></tr>
        <tr><td>DECIMAL(p,s)</td><td>точные дроби</td><td>—</td><td>Деньги, цены</td></tr>
        <tr><td>FLOAT</td><td>приближённые дроби</td><td>4</td><td>Научные данные</td></tr>
    </tbody>
</table>

<h3>Строковые типы</h3>

<table>
    <thead>
        <tr><th>Тип</th><th>Максимум</th><th>Применение</th></tr>
    </thead>
    <tbody>
        <tr><td>CHAR(n)</td><td>255 символов</td><td>Фиксированная длина (коды, хэши)</td></tr>
        <tr><td>VARCHAR(n)</td><td>65 535 символов</td><td>Имена, email, заголовки</td></tr>
        <tr><td>TEXT</td><td>65 535 символов</td><td>Длинные тексты</td></tr>
        <tr><td>MEDIUMTEXT</td><td>16 млн символов</td><td>Статьи, HTML</td></tr>
        <tr><td>LONGTEXT</td><td>4 ГБ</td><td>Очень большие тексты</td></tr>
    </tbody>
</table>

<h3>Типы даты и времени</h3>

<table>
    <thead>
        <tr><th>Тип</th><th>Формат</th><th>Применение</th></tr>
    </thead>
    <tbody>
        <tr><td>DATE</td><td>YYYY-MM-DD</td><td>Дата рождения, событие</td></tr>
        <tr><td>TIME</td><td>HH:MM:SS</td><td>Время</td></tr>
        <tr><td>DATETIME</td><td>YYYY-MM-DD HH:MM:SS</td><td>Дата и время события</td></tr>
        <tr><td>TIMESTAMP</td><td>YYYY-MM-DD HH:MM:SS</td><td>Дата создания/обновления</td></tr>
        <tr><td>YEAR</td><td>YYYY</td><td>Год</td></tr>
    </tbody>
</table>

<h3>Специальные типы</h3>

<pre><code class="language-sql">-- ENUM — одно значение из списка
status ENUM('new', 'paid', 'shipped', 'cancelled') DEFAULT 'new'

-- SET — несколько значений из списка
permissions SET('read', 'write', 'delete')

-- BOOLEAN — логический тип (в MySQL = TINYINT(1))
is_active BOOLEAN DEFAULT TRUE

-- JSON — JSON данные (MySQL 5.7+)
settings JSON</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 7,
            'title'        => 'Строковый тип данных',
            'slug'         => 'string-data-type',
            'lesson_type'  => 'theory',
            'lesson_order' => 4,
            'content'      => <<<HTML
<h2>Строковые типы и функции</h2>

<h3>CHAR vs VARCHAR</h3>

<table>
    <thead>
        <tr><th></th><th>CHAR(n)</th><th>VARCHAR(n)</th></tr>
    </thead>
    <tbody>
        <tr><td>Длина</td><td>Фиксированная</td><td>Переменная</td></tr>
        <tr><td>Хранение</td><td>Всегда n байт</td><td>Фактическая длина + 1-2 байт</td></tr>
        <tr><td>Скорость</td><td>Чуть быстрее</td><td>Экономнее место</td></tr>
        <tr><td>Применение</td><td>Коды, хэши фиксированной длины</td><td>Имена, email, описания</td></tr>
    </tbody>
</table>

<pre><code class="language-sql">CREATE TABLE tokens (
    token  CHAR(64)     NOT NULL,  -- SHA256 всегда 64 символа
    email  VARCHAR(255) NOT NULL,  -- длина разная
    bio    TEXT                    -- длинный текст
);</code></pre>

<h3>Основные строковые функции</h3>

<pre><code class="language-sql">SELECT
    CONCAT('Hello', ' ', 'World')    AS concat_result,
    CONCAT_WS(', ', 'Ali', 'Sara')   AS joined,
    UPPER('hello')                   AS uppercased,
    LOWER('HELLO')                   AS lowercased,
    LENGTH('Привет')                 AS byte_length,
    CHAR_LENGTH('Привет')            AS char_length,
    TRIM('  hello  ')                AS trimmed,
    LTRIM('  hello')                 AS left_trimmed,
    RTRIM('hello  ')                 AS right_trimmed,
    SUBSTRING('Hello World', 7, 5)   AS sub_result,
    REPLACE('Hello World', 'World', 'SQL') AS replaced,
    REVERSE('SQL')                   AS reversed,
    REPEAT('ab', 3)                  AS repeated;</code></pre>

<h3>Поиск в строках</h3>

<pre><code class="language-sql">SELECT
    LOCATE('World', 'Hello World')      AS position,
    INSTR('Hello World', 'World')       AS instr_pos,
    LEFT('Hello World', 5)              AS left_part,
    RIGHT('Hello World', 5)             AS right_part;</code></pre>

<h3>Форматирование</h3>

<pre><code class="language-sql">SELECT
    LPAD('5', 3, '0')    AS padded_left,   -- 005
    RPAD('Hi', 5, '.')   AS padded_right,  -- Hi...
    FORMAT(12345.678, 2) AS formatted;     -- 12,345.68</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 7,
            'title'        => 'Числовой тип данных',
            'slug'         => 'numeric-column-type',
            'lesson_type'  => 'theory',
            'lesson_order' => 5,
            'content'      => <<<HTML
<h2>Числовые типы для столбцов</h2>

<h3>Целочисленные типы</h3>

<pre><code class="language-sql">CREATE TABLE example (
    tiny_col    TINYINT,            -- -128 до 127
    small_col   SMALLINT,           -- -32 768 до 32 767
    int_col     INT,                -- -2.1 млрд до 2.1 млрд
    big_col     BIGINT,             -- очень большие числа

    -- UNSIGNED — только положительные, вдвое больший максимум
    visits      INT UNSIGNED,       -- 0 до 4.3 млрд
    user_id     BIGINT UNSIGNED,

    -- Авто-инкремент
    id          INT AUTO_INCREMENT PRIMARY KEY
);</code></pre>

<h3>Дробные числа</h3>

<pre><code class="language-sql">CREATE TABLE finances (
    -- DECIMAL — точные вычисления, для денег
    price       DECIMAL(10, 2),  -- до 10 цифр, 2 после запятой
    tax_rate    DECIMAL(5, 4),   -- например 0.1500

    -- FLOAT/DOUBLE — приближённые, для научных данных
    latitude    FLOAT,
    longitude   DOUBLE
);</code></pre>

<h3>Почему DECIMAL для денег</h3>

<pre><code class="language-sql">-- FLOAT даёт погрешность
SELECT 0.1 + 0.2;         -- 0.30000000000000004

-- DECIMAL точен
SELECT CAST(0.1 AS DECIMAL(3,1)) + CAST(0.2 AS DECIMAL(3,1));  -- 0.3</code></pre>

<h3>Полезные числовые функции</h3>

<pre><code class="language-sql">SELECT
    ROUND(3.14159, 2),   -- 3.14
    ROUND(3.145, 2),     -- 3.15
    TRUNCATE(3.999, 2),  -- 3.99 (без округления!)
    CEIL(4.01),          -- 5
    FLOOR(4.99),         -- 4
    SIGN(-5),            -- -1
    SIGN(0),             --  0
    SIGN(5);             --  1</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 7,
            'title'        => 'Дата и время',
            'slug'         => 'datetime-column-type',
            'lesson_type'  => 'theory',
            'lesson_order' => 6,
            'content'      => <<<HTML
<h2>Типы даты и времени для столбцов</h2>

<h3>Обзор типов</h3>

<table>
    <thead>
        <tr><th>Тип</th><th>Формат</th><th>Диапазон</th><th>Применение</th></tr>
    </thead>
    <tbody>
        <tr><td>DATE</td><td>YYYY-MM-DD</td><td>1000-01-01 до 9999-12-31</td><td>Дата рождения, событие</td></tr>
        <tr><td>TIME</td><td>HH:MM:SS</td><td>-838:59:59 до 838:59:59</td><td>Продолжительность</td></tr>
        <tr><td>DATETIME</td><td>YYYY-MM-DD HH:MM:SS</td><td>1000 до 9999</td><td>Дата события</td></tr>
        <tr><td>TIMESTAMP</td><td>YYYY-MM-DD HH:MM:SS</td><td>1970 до 2038</td><td>Дата создания/изменения</td></tr>
        <tr><td>YEAR</td><td>YYYY</td><td>1901 до 2155</td><td>Год выпуска</td></tr>
    </tbody>
</table>

<h3>DATETIME vs TIMESTAMP</h3>

<table>
    <thead>
        <tr><th></th><th>DATETIME</th><th>TIMESTAMP</th></tr>
    </thead>
    <tbody>
        <tr><td>Хранение</td><td>Как есть</td><td>В UTC, конвертируется при чтении</td></tr>
        <tr><td>Диапазон</td><td>1000–9999</td><td>1970–2038</td></tr>
        <tr><td>Часовой пояс</td><td>Игнорирует</td><td>Учитывает</td></tr>
        <tr><td>Авто-обновление</td><td>❌</td><td>✅ ON UPDATE CURRENT_TIMESTAMP</td></tr>
    </tbody>
</table>

<h3>Практический пример таблицы</h3>

<pre><code class="language-sql">CREATE TABLE events (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    title       VARCHAR(200)  NOT NULL,
    event_date  DATE          NOT NULL,
    start_time  TIME,
    created_at  TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
                              ON UPDATE CURRENT_TIMESTAMP
);</code></pre>

<h3>DEFAULT значения для дат</h3>

<pre><code class="language-sql">CREATE TABLE articles (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    title        VARCHAR(255),
    published_at DATETIME  DEFAULT NULL,
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                           ON UPDATE CURRENT_TIMESTAMP
);</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 7,
            'title'        => 'Представления, VIEW',
            'slug'         => 'view',
            'lesson_type'  => 'theory',
            'lesson_order' => 7,
            'content'      => <<<HTML
<h2>Представления (VIEW)</h2>

<p>VIEW — это виртуальная таблица, основанная на SELECT-запросе. Данные не хранятся физически — каждый раз при обращении к VIEW выполняется сохранённый запрос.</p>

<h3>Создание VIEW</h3>

<pre><code class="language-sql">CREATE VIEW active_users AS
SELECT id, name, email, created_at
FROM users
WHERE active = 1;</code></pre>

<h3>Использование VIEW</h3>

<pre><code class="language-sql">-- Как обычная таблица
SELECT * FROM active_users;

-- С дополнительными условиями
SELECT name, email
FROM active_users
WHERE created_at >= '2026-01-01'
ORDER BY name;</code></pre>

<h3>VIEW с JOIN</h3>

<pre><code class="language-sql">CREATE VIEW order_details AS
SELECT
    o.id        AS order_id,
    u.name      AS customer,
    u.email,
    o.amount,
    o.status,
    o.created_at
FROM orders o
JOIN users u ON o.user_id = u.id;</code></pre>

<h3>Обновление VIEW</h3>

<pre><code class="language-sql">CREATE OR REPLACE VIEW active_users AS
SELECT id, name, email, phone, created_at
FROM users
WHERE active = 1;</code></pre>

<h3>Удаление VIEW</h3>

<pre><code class="language-sql">DROP VIEW IF EXISTS active_users;</code></pre>

<h3>Зачем использовать VIEW</h3>

<ul>
    <li>Упрощение сложных запросов — скрываем JOIN и условия за именем</li>
    <li>Безопасность — даём доступ к VIEW без доступа к исходным таблицам</li>
    <li>Консистентность — все используют одинаковую логику</li>
</ul>

<h3>Ограничения VIEW</h3>

<ul>
    <li>Не хранит данные — каждый запрос выполняется заново</li>
    <li>Сложные VIEW могут работать медленно</li>
    <li>Не все VIEW можно использовать для INSERT/UPDATE</li>
</ul>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 7,
            'title'        => 'Индексы в SQL',
            'slug'         => 'indexes',
            'lesson_type'  => 'theory',
            'lesson_order' => 8,
            'content'      => <<<HTML
<h2>Индексы в SQL</h2>

<p>Индекс — это структура данных, которая ускоряет поиск строк в таблице. Без индекса СУБД перебирает все строки (full table scan). С индексом — находит нужные записи напрямую.</p>

<h3>Аналогия</h3>

<p>Индекс в базе данных работает как оглавление в книге. Вместо того чтобы читать всю книгу (full scan), ты открываешь оглавление и сразу переходишь на нужную страницу.</p>

<h3>Создание индексов</h3>

<pre><code class="language-sql">-- Обычный индекс
CREATE INDEX idx_users_email ON users (email);

-- Уникальный индекс
CREATE UNIQUE INDEX idx_users_email ON users (email);

-- Составной индекс (по нескольким столбцам)
CREATE INDEX idx_name_city ON users (last_name, city);

-- Индекс при создании таблицы
CREATE TABLE users (
    id    INT AUTO_INCREMENT PRIMARY KEY,  -- PRIMARY KEY автоматически индексируется
    email VARCHAR(255) UNIQUE,             -- UNIQUE создаёт индекс
    name  VARCHAR(100),
    city  VARCHAR(100),
    INDEX idx_city (city)                  -- явный индекс
);</code></pre>

<h3>Когда индексы ускоряют запрос</h3>

<pre><code class="language-sql">-- ✅ WHERE по индексированному столбцу
SELECT * FROM users WHERE email = 'ali@example.com';

-- ✅ JOIN по индексированному столбцу
SELECT * FROM orders o
JOIN users u ON o.user_id = u.id;

-- ✅ ORDER BY по индексированному столбцу
SELECT * FROM products ORDER BY price;</code></pre>

<h3>Когда индексы НЕ помогают</h3>

<pre><code class="language-sql">-- ❌ Функция над индексированным столбцом — индекс не используется
SELECT * FROM users WHERE YEAR(created_at) = 2026;

-- ✅ Правильно
SELECT * FROM users
WHERE created_at BETWEEN '2026-01-01' AND '2026-12-31';</code></pre>

<h3>Просмотр и удаление индексов</h3>

<pre><code class="language-sql">-- Показать индексы таблицы
SHOW INDEX FROM users;

-- Удалить индекс
DROP INDEX idx_users_email ON users;

-- Анализ использования индексов
EXPLAIN SELECT * FROM users WHERE email = 'ali@example.com';</code></pre>

<h3>Плюсы и минусы индексов</h3>

<table>
    <thead>
        <tr><th>Плюсы</th><th>Минусы</th></tr>
    </thead>
    <tbody>
        <tr><td>Ускоряют SELECT</td><td>Замедляют INSERT, UPDATE, DELETE</td></tr>
        <tr><td>Ускоряют JOIN и ORDER BY</td><td>Занимают дополнительное место на диске</td></tr>
        <tr><td>Обеспечивают уникальность (UNIQUE)</td><td>Требуют обслуживания</td></tr>
    </tbody>
</table>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $lessons[] = [
            'id'           => $id++,
            'course_id'    => 1,
            'module_id'    => 7,
            'title'        => 'Ограничения столбцов (Constraints)',
            'slug'         => 'constraints',
            'lesson_type'  => 'theory',
            'lesson_order' => 9,
            'content'      => <<<HTML
<h2>Ограничения (Constraints)</h2>

<p>Ограничения задают правила для данных в столбцах. Они помогают поддерживать целостность и корректность данных на уровне базы данных.</p>

<h3>Основные ограничения</h3>

<pre><code class="language-sql">CREATE TABLE orders (
    -- PRIMARY KEY: уникальный идентификатор строки
    id         INT AUTO_INCREMENT PRIMARY KEY,

    -- NOT NULL: поле обязательно для заполнения
    user_id    INT NOT NULL,

    -- UNIQUE: все значения уникальны
    order_code VARCHAR(20) UNIQUE,

    -- DEFAULT: значение по умолчанию
    status     VARCHAR(20) DEFAULT 'new',

    -- CHECK: произвольное условие (MySQL 8.0.16+)
    amount     DECIMAL(10,2) NOT NULL CHECK (amount > 0),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    -- FOREIGN KEY: ссылка на другую таблицу
    FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);</code></pre>

<h3>ON DELETE / ON UPDATE для FOREIGN KEY</h3>

<table>
    <thead>
        <tr><th>Действие</th><th>Описание</th></tr>
    </thead>
    <tbody>
        <tr><td>CASCADE</td><td>Автоматически удалить/обновить связанные записи</td></tr>
        <tr><td>SET NULL</td><td>Установить NULL в связанных записях</td></tr>
        <tr><td>RESTRICT</td><td>Запретить удаление/обновление если есть связанные записи</td></tr>
        <tr><td>NO ACTION</td><td>Аналог RESTRICT в MySQL</td></tr>
        <tr><td>SET DEFAULT</td><td>Установить значение DEFAULT (поддерживается не везде)</td></tr>
    </tbody>
</table>

<h3>Добавление ограничений к существующей таблице</h3>

<pre><code class="language-sql">-- Добавить NOT NULL
ALTER TABLE users MODIFY COLUMN name VARCHAR(100) NOT NULL;

-- Добавить UNIQUE
ALTER TABLE users ADD CONSTRAINT uq_email UNIQUE (email);

-- Добавить CHECK
ALTER TABLE products ADD CONSTRAINT chk_price CHECK (price >= 0);

-- Добавить FOREIGN KEY
ALTER TABLE orders
ADD CONSTRAINT fk_orders_users
FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;</code></pre>

<h3>Удаление ограничений</h3>

<pre><code class="language-sql">-- Удалить уникальное ограничение
ALTER TABLE users DROP INDEX uq_email;

-- Удалить внешний ключ
ALTER TABLE orders DROP FOREIGN KEY fk_orders_users;

-- Удалить CHECK
ALTER TABLE products DROP CHECK chk_price;</code></pre>

<h3>Просмотр ограничений</h3>

<pre><code class="language-sql">SELECT *
FROM information_schema.TABLE_CONSTRAINTS
WHERE TABLE_NAME = 'orders'
  AND TABLE_SCHEMA = 'your_database';</code></pre>
HTML,
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        // =============================================================
        //  Финальная вставка всех уроков в БД
        // =============================================================

        DB::table('lessons')->insert($lessons);

        $this->command->info('✅ Уроки успешно созданы: ' . count($lessons) . ' записей');
    }
}
