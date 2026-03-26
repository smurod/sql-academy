<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PremiumTasksSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = [

            // ================================================================
            //  #80 — Facebook — booking
            // ================================================================
            [
                'id' => 80,
                'task_number' => 80,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Активные арендаторы по месяцам',
                'description' => 'COUNT DISTINCT с группировкой по месяцам и фильтрацией по году',
                'task_text' => 'Для каждого месяца 2020 года определите количество уникальных пользователей, совершивших хотя бы одно бронирование. Выведите месяц и количество уникальных пользователей.',
                'database_schema' => 'booking',
                'solution_sql' => "SELECT MONTH(start_date) AS month, COUNT(DISTINCT user_id) AS active_users FROM Reservations WHERE YEAR(start_date) = 2020 GROUP BY MONTH(start_date) ORDER BY month;",
                'expected_results' => '[]',
                'difficulty_percent' => 30,
                'is_free' => 0,
                'hint' => 'Используйте COUNT(DISTINCT user_id) и GROUP BY MONTH(start_date) с фильтром по году',
                'points' => 15,
                'sql_type' => 'select',
                'task_order' => 80,
                'tags' => 'Date Functions,GROUP BY,DISTINCT,Aggregate Functions',
                'company' => 'Facebook',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #81 — Amazon — ecommerce
            // ================================================================
            [
                'id' => 81,
                'task_number' => 81,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Топ-3 товара по категориям',
                'description' => 'CTE с ROW_NUMBER для ранжирования внутри групп',
                'task_text' => 'Для каждой категории товаров выведите топ-3 самых продаваемых товара по общему количеству проданных единиц. Выведите категорию, название товара, общее количество продаж и ранг.',
                'database_schema' => 'ecommerce',
                'solution_sql' => "WITH ranked AS (SELECT p.category, p.product_name, SUM(oi.quantity) AS total_sold, ROW_NUMBER() OVER (PARTITION BY p.category ORDER BY SUM(oi.quantity) DESC) AS rn FROM Products p JOIN OrderItems oi ON p.id = oi.product_id GROUP BY p.category, p.product_name) SELECT category, product_name, total_sold, rn AS rank_num FROM ranked WHERE rn <= 3;",
                'expected_results' => '[]',
                'difficulty_percent' => 55,
                'is_free' => 0,
                'hint' => 'Используйте CTE с ROW_NUMBER() OVER (PARTITION BY category ORDER BY SUM(quantity) DESC)',
                'points' => 30,
                'sql_type' => 'select',
                'task_order' => 81,
                'tags' => 'CTE,Window Functions,JOIN,GROUP BY,Aggregate Functions',
                'company' => 'Amazon',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #82 — Tinkoff — family
            // ================================================================
            [
                'id' => 82,
                'task_number' => 82,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Месяцы с аномальными расходами',
                'description' => 'CTE для подсчёта помесячных расходов и сравнение со средним',
                'task_text' => 'Найдите месяцы, в которых общая сумма расходов семьи превысила среднемесячные расходы более чем в 1.5 раза. Выведите год, месяц и сумму расходов.',
                'database_schema' => 'family',
                'solution_sql' => "WITH monthly AS (SELECT YEAR(date) AS y, MONTH(date) AS m, SUM(unit_price * amount) AS total FROM Payments GROUP BY YEAR(date), MONTH(date)) SELECT y, m, total FROM monthly WHERE total > (SELECT AVG(total) * 1.5 FROM monthly);",
                'expected_results' => '[]',
                'difficulty_percent' => 50,
                'is_free' => 0,
                'hint' => 'Сначала вычислите помесячные расходы в CTE, затем сравните каждый месяц со средним из CTE',
                'points' => 25,
                'sql_type' => 'select',
                'task_order' => 82,
                'tags' => 'CTE,Aggregate Functions,Subquery,Date Functions,GROUP BY',
                'company' => 'Tinkoff',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #83 — Google — flights
            // ================================================================
            [
                'id' => 83,
                'task_number' => 83,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Ранжирование пилотов по налёту',
                'description' => 'CTE с UNION ALL и DENSE_RANK для ранжирования',
                'task_text' => 'Ранжируйте пилотов по общему количеству выполненных рейсов (как первый или второй пилот). Выведите имя пилота, количество рейсов и ранг. При одинаковом количестве рейсов ранг должен быть одинаковым.',
                'database_schema' => 'flights',
                'solution_sql' => "WITH pilot_flights AS (SELECT pilot_id, name, COUNT(*) AS flight_count FROM (SELECT first_pilot_id AS pilot_id FROM Flights UNION ALL SELECT second_pilot_id FROM Flights) AS all_flights JOIN Pilots ON Pilots.pilot_id = all_flights.pilot_id GROUP BY pilot_id, name) SELECT name, flight_count, DENSE_RANK() OVER (ORDER BY flight_count DESC) AS rank_num FROM pilot_flights;",
                'expected_results' => '[]',
                'difficulty_percent' => 55,
                'is_free' => 0,
                'hint' => 'Объедините first_pilot_id и second_pilot_id через UNION ALL, затем посчитайте и ранжируйте через DENSE_RANK',
                'points' => 30,
                'sql_type' => 'select',
                'task_order' => 83,
                'tags' => 'CTE,UNION ALL,Window Functions,JOIN,Aggregate Functions',
                'company' => 'Google',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #84 — Yandex — ecommerce
            // ================================================================
            [
                'id' => 84,
                'task_number' => 84,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Retention по когортам',
                'description' => 'Когортный анализ с CTE, DATE_ADD и LEFT JOIN',
                'task_text' => 'Для каждого месяца регистрации (когорты) определите, какой процент клиентов сделал повторный заказ в следующем месяце после первого заказа. Выведите месяц когорты и процент retention, округлённый до целого.',
                'database_schema' => 'ecommerce',
                'solution_sql' => "WITH first_orders AS (SELECT customer_id, MIN(order_date) AS first_order_date FROM Orders GROUP BY customer_id), cohorts AS (SELECT customer_id, DATE_FORMAT(first_order_date, '%Y-%m') AS cohort_month, first_order_date FROM first_orders), retained AS (SELECT DISTINCT c.customer_id, c.cohort_month FROM cohorts c JOIN Orders o ON o.customer_id = c.customer_id AND o.order_date > c.first_order_date AND o.order_date < DATE_ADD(c.first_order_date, INTERVAL 2 MONTH) AND o.order_date >= DATE_ADD(c.first_order_date, INTERVAL 1 MONTH)) SELECT c.cohort_month, ROUND(COUNT(DISTINCT r.customer_id) * 100.0 / COUNT(DISTINCT c.customer_id)) AS retention_percent FROM cohorts c LEFT JOIN retained r ON c.customer_id = r.customer_id AND c.cohort_month = r.cohort_month GROUP BY c.cohort_month ORDER BY c.cohort_month;",
                'expected_results' => '[]',
                'difficulty_percent' => 85,
                'is_free' => 0,
                'hint' => 'Определите когорту через MIN(order_date), затем найдите кто заказал в следующем месяце через DATE_ADD и INTERVAL',
                'points' => 40,
                'sql_type' => 'select',
                'task_order' => 84,
                'tags' => 'CTE,LEFT JOIN,Date Functions,Aggregate Functions,GROUP BY,DISTINCT',
                'company' => 'Yandex',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #85 — Microsoft — schedule
            // ================================================================
            [
                'id' => 85,
                'task_number' => 85,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Учителя-многостаночники',
                'description' => 'GROUP BY с HAVING COUNT(DISTINCT) для поиска пересечений',
                'task_text' => 'Найдите преподавателей, которые в один и тот же день вели занятия в разных классах. Выведите фамилию преподавателя, дату и количество различных классов.',
                'database_schema' => 'schedule',
                'solution_sql' => "SELECT T.last_name, S.date, COUNT(DISTINCT S.class) AS class_count FROM Schedule S JOIN Teacher T ON T.id = S.teacher GROUP BY T.last_name, S.date HAVING COUNT(DISTINCT S.class) > 1 ORDER BY S.date;",
                'expected_results' => '[]',
                'difficulty_percent' => 40,
                'is_free' => 0,
                'hint' => 'Сгруппируйте по преподавателю и дате, затем отфильтруйте через HAVING COUNT(DISTINCT class) > 1',
                'points' => 20,
                'sql_type' => 'select',
                'task_order' => 85,
                'tags' => 'JOIN,GROUP BY,HAVING,DISTINCT,Aggregate Functions',
                'company' => 'Microsoft',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #86 — Alfa-Bank — family
            // ================================================================
            [
                'id' => 86,
                'task_number' => 86,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Скользящее среднее расходов',
                'description' => 'Window Function AVG с ROWS BETWEEN для скользящего окна',
                'task_text' => 'Для каждой покупки вычислите скользящее среднее стоимости (unit_price * amount) по последним 3 покупкам (текущая + 2 предыдущие), отсортированным по дате. Выведите дату, стоимость покупки и скользящее среднее, округлённое до двух знаков.',
                'database_schema' => 'family',
                'solution_sql' => "SELECT date, unit_price * amount AS cost, ROUND(AVG(unit_price * amount) OVER (ORDER BY date ROWS BETWEEN 2 PRECEDING AND CURRENT ROW), 2) AS moving_avg FROM Payments ORDER BY date;",
                'expected_results' => '[]',
                'difficulty_percent' => 60,
                'is_free' => 0,
                'hint' => 'Используйте AVG() OVER (ORDER BY date ROWS BETWEEN 2 PRECEDING AND CURRENT ROW)',
                'points' => 30,
                'sql_type' => 'select',
                'task_order' => 86,
                'tags' => 'Window Functions,Math Functions,ORDER BY',
                'company' => 'Alfa-Bank',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #87 — VK — booking
            // ================================================================
            [
                'id' => 87,
                'task_number' => 87,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Пользователи без отзывов',
                'description' => 'LEFT JOIN с IS NULL для поиска отсутствующих связей',
                'task_text' => 'Найдите пользователей, которые бронировали жильё, но ни разу не оставили отзыв. Выведите имя пользователя и количество бронирований без отзыва.',
                'database_schema' => 'booking',
                'solution_sql' => "SELECT U.name, COUNT(R.id) AS reservations_without_review FROM Users U JOIN Reservations R ON U.id = R.user_id LEFT JOIN Reviews RV ON R.id = RV.reservation_id WHERE RV.id IS NULL GROUP BY U.name;",
                'expected_results' => '[]',
                'difficulty_percent' => 35,
                'is_free' => 0,
                'hint' => 'JOIN Users с Reservations, затем LEFT JOIN Reviews и отфильтруйте WHERE Reviews.id IS NULL',
                'points' => 20,
                'sql_type' => 'select',
                'task_order' => 87,
                'tags' => 'JOIN,LEFT JOIN,GROUP BY,Aggregate Functions',
                'company' => 'VK',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #88 — Tesla — flights
            // ================================================================
            [
                'id' => 88,
                'task_number' => 88,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Маршруты с максимальной выручкой',
                'description' => 'JOIN с подзапросом для вычисления доли от общей суммы',
                'task_text' => 'Для каждого маршрута (пара departure-destination) определите общую выручку за все рейсы. Выведите маршрут, количество рейсов, общую выручку и долю от общей выручки всех маршрутов в процентах (округлить до сотых).',
                'database_schema' => 'flights',
                'solution_sql' => "SELECT F.departure, F.destination, COUNT(DISTINCT F.flight_id) AS flights_count, SUM(B.price) AS total_revenue, ROUND(SUM(B.price) * 100.0 / (SELECT SUM(price) FROM Bookings), 2) AS revenue_share FROM Flights F JOIN Bookings B ON F.flight_id = B.flight_id GROUP BY F.departure, F.destination ORDER BY total_revenue DESC;",
                'expected_results' => '[]',
                'difficulty_percent' => 50,
                'is_free' => 0,
                'hint' => 'Используйте подзапрос (SELECT SUM(price) FROM Bookings) для вычисления общей выручки и деления на неё',
                'points' => 25,
                'sql_type' => 'select',
                'task_order' => 88,
                'tags' => 'JOIN,GROUP BY,Subquery,Aggregate Functions,Math Functions',
                'company' => 'Tesla',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #89 — Sber — ecommerce
            // ================================================================
            [
                'id' => 89,
                'task_number' => 89,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Сегментация клиентов по RFM',
                'description' => 'CTE с NTILE для сегментации по Recency, Frequency, Monetary',
                'task_text' => "Сегментируйте клиентов по модели RFM. Для каждого клиента вычислите: Recency — количество дней с последнего заказа до '2024-01-01', Frequency — общее количество заказов, Monetary — общую сумму заказов. Присвойте каждому показателю оценку от 1 до 3 с помощью NTILE(3). Выведите имя клиента, R, F, M оценки.",
                'database_schema' => 'ecommerce',
                'solution_sql' => "WITH rfm AS (SELECT c.name, DATEDIFF('2024-01-01', MAX(o.order_date)) AS recency, COUNT(o.id) AS frequency, SUM(o.total_amount) AS monetary FROM Customers c JOIN Orders o ON c.id = o.customer_id GROUP BY c.id, c.name) SELECT name, NTILE(3) OVER (ORDER BY recency DESC) AS R, NTILE(3) OVER (ORDER BY frequency ASC) AS F, NTILE(3) OVER (ORDER BY monetary ASC) AS M FROM rfm;",
                'expected_results' => '[]',
                'difficulty_percent' => 80,
                'is_free' => 0,
                'hint' => 'Используйте CTE для вычисления R/F/M метрик, затем NTILE(3) OVER (ORDER BY ...) для каждой метрики',
                'points' => 40,
                'sql_type' => 'select',
                'task_order' => 89,
                'tags' => 'CTE,Window Functions,JOIN,Date Functions,Aggregate Functions,GROUP BY',
                'company' => 'Sber',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #90 — Facebook — ecommerce
            // ================================================================
            [
                'id' => 90,
                'task_number' => 90,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Конверсия регистраций в заказы',
                'description' => 'Conditional Aggregation с CASE WHEN внутри COUNT',
                'task_text' => 'Для каждого города определите: общее количество зарегистрированных клиентов, количество клиентов, сделавших хотя бы один заказ, и процент конверсии (округлить до целого). Отсортируйте по проценту конверсии по убыванию.',
                'database_schema' => 'ecommerce',
                'solution_sql' => "SELECT c.city, COUNT(DISTINCT c.id) AS total_customers, COUNT(DISTINCT o.customer_id) AS buying_customers, ROUND(COUNT(DISTINCT o.customer_id) * 100.0 / COUNT(DISTINCT c.id)) AS conversion_percent FROM Customers c LEFT JOIN Orders o ON c.id = o.customer_id GROUP BY c.city ORDER BY conversion_percent DESC;",
                'expected_results' => '[]',
                'difficulty_percent' => 40,
                'is_free' => 0,
                'hint' => 'LEFT JOIN Customers с Orders, используйте COUNT(DISTINCT) для подсчёта уникальных покупателей',
                'points' => 20,
                'sql_type' => 'select',
                'task_order' => 90,
                'tags' => 'LEFT JOIN,GROUP BY,Aggregate Functions,DISTINCT,Math Functions',
                'company' => 'Facebook',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #91 — Facebook — flights
            // ================================================================
            [
                'id' => 91,
                'task_number' => 91,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'DAU авиакомпаний',
                'description' => 'COUNT DISTINCT по дням с оконной функцией AVG',
                'task_text' => 'Для каждой авиакомпании вычислите среднее количество уникальных пассажиров в день (средний DAU). Выведите название авиакомпании и средний DAU, округлённый до целого. Отсортируйте по убыванию.',
                'database_schema' => 'flights',
                'solution_sql' => "WITH daily AS (SELECT F.airline, F.flight_date, COUNT(DISTINCT B.passenger_id) AS daily_users FROM Flights F JOIN Bookings B ON F.flight_id = B.flight_id GROUP BY F.airline, F.flight_date) SELECT airline, ROUND(AVG(daily_users)) AS avg_dau FROM daily GROUP BY airline ORDER BY avg_dau DESC;",
                'expected_results' => '[]',
                'difficulty_percent' => 45,
                'is_free' => 0,
                'hint' => 'Сначала посчитайте уникальных пассажиров по дням в CTE, затем усредните',
                'points' => 25,
                'sql_type' => 'select',
                'task_order' => 91,
                'tags' => 'CTE,JOIN,GROUP BY,DISTINCT,Aggregate Functions',
                'company' => 'Facebook',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #92 — Facebook — booking
            // ================================================================
            [
                'id' => 92,
                'task_number' => 92,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Рост бронирований неделя к неделе',
                'description' => 'Window Function LAG для сравнения текущего периода с предыдущим',
                'task_text' => 'Для каждой недели 2020 года вычислите количество новых бронирований и процент изменения по сравнению с предыдущей неделей. Выведите номер недели, количество бронирований и процент изменения (округлить до целого). Для первой недели процент изменения выведите как NULL.',
                'database_schema' => 'booking',
                'solution_sql' => "WITH weekly AS (SELECT WEEK(start_date, 1) AS week_num, COUNT(*) AS bookings FROM Reservations WHERE YEAR(start_date) = 2020 GROUP BY WEEK(start_date, 1)) SELECT week_num, bookings, CASE WHEN LAG(bookings) OVER (ORDER BY week_num) IS NULL THEN NULL ELSE ROUND((bookings - LAG(bookings) OVER (ORDER BY week_num)) * 100.0 / LAG(bookings) OVER (ORDER BY week_num)) END AS change_percent FROM weekly ORDER BY week_num;",
                'expected_results' => '[]',
                'difficulty_percent' => 60,
                'is_free' => 0,
                'hint' => 'Используйте CTE для подсчёта понедельных бронирований, затем LAG() для сравнения с предыдущей неделей',
                'points' => 30,
                'sql_type' => 'select',
                'task_order' => 92,
                'tags' => 'CTE,Window Functions,Date Functions,CASE WHEN,Aggregate Functions',
                'company' => 'Facebook',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #93 — Google — ecommerce
            // ================================================================
            [
                'id' => 93,
                'task_number' => 93,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Ранжирование товаров по рейтингу',
                'description' => 'Window Functions RANK с фильтрацией по минимальному количеству отзывов',
                'task_text' => 'Ранжируйте товары по среднему рейтингу среди тех, у которых не менее 2 отзывов. Выведите название товара, средний рейтинг (округлить до сотых), количество отзывов и ранг. При одинаковом среднем рейтинге ранг должен быть одинаковым, но без пропусков.',
                'database_schema' => 'ecommerce',
                'solution_sql' => "WITH rated AS (SELECT p.product_name, ROUND(AVG(r.rating), 2) AS avg_rating, COUNT(r.id) AS review_count FROM Products p JOIN Reviews r ON p.id = r.product_id GROUP BY p.product_name HAVING COUNT(r.id) >= 2) SELECT product_name, avg_rating, review_count, DENSE_RANK() OVER (ORDER BY avg_rating DESC) AS rank_num FROM rated;",
                'expected_results' => '[]',
                'difficulty_percent' => 50,
                'is_free' => 0,
                'hint' => 'Используйте CTE с HAVING COUNT >= 2, затем DENSE_RANK() OVER (ORDER BY avg_rating DESC)',
                'points' => 25,
                'sql_type' => 'select',
                'task_order' => 93,
                'tags' => 'CTE,Window Functions,JOIN,GROUP BY,HAVING,Aggregate Functions',
                'company' => 'Google',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #94 — Google — aviation
            // ================================================================
            [
                'id' => 94,
                'task_number' => 94,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Маршруты-лидеры по пассажиропотоку',
                'description' => 'Коррелированный подзапрос для сравнения с общим средним',
                'task_text' => 'Найдите маршруты (town_from → town_to), количество пассажиров которых превышает среднее количество пассажиров по всем маршрутам. Выведите town_from, town_to и количество пассажиров.',
                'database_schema' => 'aviation',
                'solution_sql' => "WITH route_stats AS (SELECT T.town_from, T.town_to, COUNT(DISTINCT pit.passenger) AS passenger_count FROM Trip T JOIN Pass_in_trip pit ON T.id = pit.trip GROUP BY T.town_from, T.town_to) SELECT town_from, town_to, passenger_count FROM route_stats WHERE passenger_count > (SELECT AVG(passenger_count) FROM route_stats);",
                'expected_results' => '[]',
                'difficulty_percent' => 55,
                'is_free' => 0,
                'hint' => 'Вычислите количество пассажиров по маршрутам в CTE, затем сравните каждый маршрут со средним',
                'points' => 30,
                'sql_type' => 'select',
                'task_order' => 94,
                'tags' => 'CTE,Subquery,JOIN,GROUP BY,DISTINCT,Aggregate Functions',
                'company' => 'Google',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #95 — Google — flights
            // ================================================================
            [
                'id' => 95,
                'task_number' => 95,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Кумулятивная выручка по дням',
                'description' => 'Window Function SUM() OVER с ORDER BY для нарастающего итога',
                'task_text' => 'Для каждого дня вычислите общую выручку от бронирований за этот день и нарастающий итог выручки с начала данных. Выведите дату, дневную выручку и кумулятивную сумму.',
                'database_schema' => 'flights',
                'solution_sql' => "SELECT booking_date, SUM(price) AS daily_revenue, SUM(SUM(price)) OVER (ORDER BY booking_date) AS cumulative_revenue FROM Bookings GROUP BY booking_date ORDER BY booking_date;",
                'expected_results' => '[]',
                'difficulty_percent' => 45,
                'is_free' => 0,
                'hint' => 'Используйте SUM(SUM(price)) OVER (ORDER BY booking_date) — вложенная агрегация с оконной функцией',
                'points' => 25,
                'sql_type' => 'select',
                'task_order' => 95,
                'tags' => 'Window Functions,GROUP BY,Aggregate Functions,ORDER BY',
                'company' => 'Google',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #96 — Yandex — schedule
            // ================================================================
            [
                'id' => 96,
                'task_number' => 96,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Нагрузка преподавателей по дням недели',
                'description' => 'Pivot-like запрос с CASE WHEN для поворота данных',
                'task_text' => 'Для каждого преподавателя выведите количество занятий по дням недели в формате: last_name, mon, tue, wed, thu, fri, sat. Если в какой-то день занятий не было — выведите 0.',
                'database_schema' => 'schedule',
                'solution_sql' => "SELECT T.last_name, SUM(CASE WHEN DAYOFWEEK(S.date) = 2 THEN 1 ELSE 0 END) AS mon, SUM(CASE WHEN DAYOFWEEK(S.date) = 3 THEN 1 ELSE 0 END) AS tue, SUM(CASE WHEN DAYOFWEEK(S.date) = 4 THEN 1 ELSE 0 END) AS wed, SUM(CASE WHEN DAYOFWEEK(S.date) = 5 THEN 1 ELSE 0 END) AS thu, SUM(CASE WHEN DAYOFWEEK(S.date) = 6 THEN 1 ELSE 0 END) AS fri, SUM(CASE WHEN DAYOFWEEK(S.date) = 7 THEN 1 ELSE 0 END) AS sat FROM Teacher T JOIN Schedule S ON T.id = S.teacher GROUP BY T.last_name ORDER BY T.last_name;",
                'expected_results' => '[]',
                'difficulty_percent' => 60,
                'is_free' => 0,
                'hint' => 'Используйте SUM(CASE WHEN DAYOFWEEK(date) = N THEN 1 ELSE 0 END) для каждого дня недели',
                'points' => 30,
                'sql_type' => 'select',
                'task_order' => 96,
                'tags' => 'JOIN,GROUP BY,Conditional Aggregation,Pivot,Date Functions,CASE WHEN',
                'company' => 'Yandex',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #97 — Yandex — booking
            // ================================================================
            [
                'id' => 97,
                'task_number' => 97,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Медиана цен комнат',
                'description' => 'Window Function ROW_NUMBER + COUNT для вычисления медианы',
                'task_text' => 'Вычислите медианную цену комнаты. Если количество комнат чётное — выведите среднее двух центральных значений, округлённое до двух знаков.',
                'database_schema' => 'booking',
                'solution_sql' => "WITH ordered AS (SELECT price, ROW_NUMBER() OVER (ORDER BY price) AS rn, COUNT(*) OVER () AS total FROM Rooms) SELECT ROUND(AVG(price), 2) AS median_price FROM ordered WHERE rn IN (FLOOR((total + 1) / 2), CEIL((total + 1) / 2));",
                'expected_results' => '[]',
                'difficulty_percent' => 70,
                'is_free' => 0,
                'hint' => 'Пронумеруйте строки через ROW_NUMBER, вычислите позицию медианы через FLOOR/CEIL',
                'points' => 35,
                'sql_type' => 'select',
                'task_order' => 97,
                'tags' => 'CTE,Window Functions,Math Functions,Aggregate Functions',
                'company' => 'Yandex',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #98 — Yandex — ecommerce
            // ================================================================
            [
                'id' => 98,
                'task_number' => 98,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Клиенты с возрастающими заказами',
                'description' => 'Window Function LAG для сравнения последовательных значений',
                'task_text' => 'Найдите клиентов, у которых сумма каждого следующего заказа строго больше предыдущего (монотонный рост). Выведите имена таких клиентов. Учитывайте только клиентов с 3 и более заказами.',
                'database_schema' => 'ecommerce',
                'solution_sql' => "WITH ordered AS (SELECT customer_id, total_amount, LAG(total_amount) OVER (PARTITION BY customer_id ORDER BY order_date) AS prev_amount, COUNT(*) OVER (PARTITION BY customer_id) AS total_orders FROM Orders), non_growing AS (SELECT DISTINCT customer_id FROM ordered WHERE prev_amount IS NOT NULL AND total_amount <= prev_amount) SELECT DISTINCT c.name FROM Customers c JOIN Orders o ON c.id = o.customer_id WHERE c.id NOT IN (SELECT customer_id FROM non_growing) AND c.id IN (SELECT customer_id FROM ordered WHERE total_orders >= 3);",
                'expected_results' => '[]',
                'difficulty_percent' => 75,
                'is_free' => 0,
                'hint' => 'Используйте LAG для сравнения с предыдущим заказом, затем исключите тех, у кого есть нарушение роста',
                'points' => 35,
                'sql_type' => 'select',
                'task_order' => 98,
                'tags' => 'CTE,Window Functions,NOT IN,Subquery,JOIN,DISTINCT',
                'company' => 'Yandex',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #99 — Amazon — ecommerce
            // ================================================================
            [
                'id' => 99,
                'task_number' => 99,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Товары без продаж за 30 дней',
                'description' => 'NOT EXISTS с коррелированным подзапросом и DATE_SUB',
                'task_text' => "Найдите товары, которые не продавались в последние 30 дней (от '2024-01-01'). Выведите название товара, категорию и текущий остаток на складе. Отсортируйте по остатку по убыванию.",
                'database_schema' => 'ecommerce',
                'solution_sql' => "SELECT p.product_name, p.category, p.stock FROM Products p WHERE NOT EXISTS (SELECT 1 FROM OrderItems oi JOIN Orders o ON oi.order_id = o.id WHERE oi.product_id = p.id AND o.order_date >= DATE_SUB('2024-01-01', INTERVAL 30 DAY)) ORDER BY p.stock DESC;",
                'expected_results' => '[]',
                'difficulty_percent' => 45,
                'is_free' => 0,
                'hint' => 'Используйте NOT EXISTS с подзапросом, который ищет продажи за последние 30 дней',
                'points' => 25,
                'sql_type' => 'select',
                'task_order' => 99,
                'tags' => 'NOT EXISTS,Correlated Subquery,JOIN,Date Functions,ORDER BY',
                'company' => 'Amazon',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #100 — Amazon — ecommerce
            // ================================================================
            [
                'id' => 100,
                'task_number' => 100,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Кросс-продажи: товары покупаемые вместе',
                'description' => 'Self JOIN на OrderItems для поиска пар товаров в одном заказе',
                'task_text' => 'Найдите пары товаров, которые чаще всего покупаются в одном заказе. Выведите названия двух товаров и количество совместных заказов. Первый товар по алфавиту — в первом столбце. Выведите топ-5 пар.',
                'database_schema' => 'ecommerce',
                'solution_sql' => "SELECT p1.product_name AS product_1, p2.product_name AS product_2, COUNT(*) AS together_count FROM OrderItems oi1 JOIN OrderItems oi2 ON oi1.order_id = oi2.order_id AND oi1.product_id < oi2.product_id JOIN Products p1 ON oi1.product_id = p1.id JOIN Products p2 ON oi2.product_id = p2.id GROUP BY p1.product_name, p2.product_name ORDER BY together_count DESC LIMIT 5;",
                'expected_results' => '[]',
                'difficulty_percent' => 65,
                'is_free' => 0,
                'hint' => 'Self JOIN OrderItems по order_id с условием product_id_1 < product_id_2 чтобы избежать дублей',
                'points' => 35,
                'sql_type' => 'select',
                'task_order' => 100,
                'tags' => 'Self JOIN,JOIN,GROUP BY,Aggregate Functions,ORDER BY,LIMIT',
                'company' => 'Amazon',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #101 — Amazon — ecommerce
            // ================================================================
            [
                'id' => 101,
                'task_number' => 101,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Процент отменённых заказов по городам',
                'description' => 'Conditional Aggregation с CASE внутри SUM для подсчёта по условию',
                'task_text' => 'Для каждого города вычислите общее количество заказов и процент отменённых заказов (status = \'cancelled\'). Выведите город, общее количество, количество отменённых и процент отмен (округлить до сотых). Отсортируйте по проценту отмен по убыванию.',
                'database_schema' => 'ecommerce',
                'solution_sql' => "SELECT c.city, COUNT(o.id) AS total_orders, SUM(CASE WHEN o.status = 'cancelled' THEN 1 ELSE 0 END) AS cancelled_orders, ROUND(SUM(CASE WHEN o.status = 'cancelled' THEN 1 ELSE 0 END) * 100.0 / COUNT(o.id), 2) AS cancel_percent FROM Customers c JOIN Orders o ON c.id = o.customer_id GROUP BY c.city ORDER BY cancel_percent DESC;",
                'expected_results' => '[]',
                'difficulty_percent' => 40,
                'is_free' => 0,
                'hint' => 'Используйте SUM(CASE WHEN status = \'cancelled\' THEN 1 ELSE 0 END) для подсчёта отменённых',
                'points' => 20,
                'sql_type' => 'select',
                'task_order' => 101,
                'tags' => 'JOIN,GROUP BY,Conditional Aggregation,CASE WHEN,Aggregate Functions,Math Functions',
                'company' => 'Amazon',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #102 — Tesla — flights
            // ================================================================
            [
                'id' => 102,
                'task_number' => 102,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Загруженность типов самолётов',
                'description' => 'Pivot-like запрос с CASE для подсчёта по классам обслуживания',
                'task_text' => 'Для каждого типа самолёта выведите количество проданных билетов по классам обслуживания в формате: aircraft_type, economy, business, first_class. Отсортируйте по общему количеству билетов по убыванию.',
                'database_schema' => 'flights',
                'solution_sql' => "SELECT F.aircraft_type, SUM(CASE WHEN B.seat_class = 'economy' THEN 1 ELSE 0 END) AS economy, SUM(CASE WHEN B.seat_class = 'business' THEN 1 ELSE 0 END) AS business, SUM(CASE WHEN B.seat_class = 'first' THEN 1 ELSE 0 END) AS first_class FROM Flights F JOIN Bookings B ON F.flight_id = B.flight_id GROUP BY F.aircraft_type ORDER BY (economy + business + first_class) DESC;",
                'expected_results' => '[]',
                'difficulty_percent' => 50,
                'is_free' => 0,
                'hint' => 'Используйте SUM(CASE WHEN seat_class = \'...\' THEN 1 ELSE 0 END) для каждого класса',
                'points' => 25,
                'sql_type' => 'select',
                'task_order' => 102,
                'tags' => 'JOIN,GROUP BY,Conditional Aggregation,Pivot,CASE WHEN,ORDER BY',
                'company' => 'Tesla',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #103 — Microsoft — schedule
            // ================================================================
            [
                'id' => 103,
                'task_number' => 103,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Учителя без занятий',
                'description' => 'NOT EXISTS для поиска записей без связей',
                'task_text' => 'Найдите преподавателей, которые не провели ни одного занятия. Выведите фамилию и имя преподавателя.',
                'database_schema' => 'schedule',
                'solution_sql' => "SELECT T.last_name, T.first_name FROM Teacher T WHERE NOT EXISTS (SELECT 1 FROM Schedule S WHERE S.teacher = T.id);",
                'expected_results' => '[]',
                'difficulty_percent' => 25,
                'is_free' => 0,
                'hint' => 'Используйте NOT EXISTS с подзапросом к Schedule',
                'points' => 15,
                'sql_type' => 'select',
                'task_order' => 103,
                'tags' => 'NOT EXISTS,Correlated Subquery',
                'company' => 'Microsoft',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #104 — Microsoft — schedule
            // ================================================================
            [
                'id' => 104,
                'task_number' => 104,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Разница в возрасте учеников класса',
                'description' => 'Window Functions MAX/MIN OVER(PARTITION BY) для анализа внутри групп',
                'task_text' => 'Для каждого класса вычислите разницу в днях между датами рождения самого старшего и самого младшего ученика. Выведите название класса и разницу в днях. Отсортируйте по разнице по убыванию.',
                'database_schema' => 'schedule',
                'solution_sql' => "SELECT C.name, DATEDIFF(MAX(St.birthday), MIN(St.birthday)) AS age_diff_days FROM Class C JOIN Student_in_class SIC ON C.id = SIC.class JOIN Student St ON St.id = SIC.student GROUP BY C.name ORDER BY age_diff_days DESC;",
                'expected_results' => '[]',
                'difficulty_percent' => 35,
                'is_free' => 0,
                'hint' => 'Используйте DATEDIFF(MAX(birthday), MIN(birthday)) с GROUP BY class',
                'points' => 20,
                'sql_type' => 'select',
                'task_order' => 104,
                'tags' => 'JOIN,GROUP BY,Date Functions,Aggregate Functions,ORDER BY',
                'company' => 'Microsoft',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],
            // ================================================================
            //  #105 — Microsoft — aviation
            // ================================================================
            [
                'id' => 105,
                'task_number' => 105,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Пассажиры с рейсами во все города',
                'description' => 'Коррелированный подзапрос с COUNT(DISTINCT) для проверки полноты',
                'task_text' => 'Найдите пассажиров, которые летали во все города, представленные в таблице Trip (как town_to). Выведите имена таких пассажиров.',
                'database_schema' => 'aviation',
                'solution_sql' => "SELECT P.name FROM Passenger P JOIN Pass_in_trip pit ON P.id = pit.passenger JOIN Trip T ON pit.trip = T.id GROUP BY P.id, P.name HAVING COUNT(DISTINCT T.town_to) = (SELECT COUNT(DISTINCT town_to) FROM Trip);",
                'expected_results' => '[]',
                'difficulty_percent' => 65,
                'is_free' => 0,
                'hint' => 'COUNT(DISTINCT town_to) пассажира должен быть равен общему COUNT(DISTINCT town_to) из Trip',
                'points' => 35,
                'sql_type' => 'select',
                'task_order' => 105,
                'tags' => 'JOIN,GROUP BY,HAVING,Subquery,DISTINCT,Aggregate Functions',
                'company' => 'Microsoft',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #106 — Microsoft — ecommerce
            // ================================================================
            [
                'id' => 106,
                'task_number' => 106,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Сотрудники с зарплатой выше среднего по категории',
                'description' => 'Коррелированный подзапрос для сравнения со средним по группе',
                'task_text' => 'Найдите товары, цена которых выше средней цены товаров в их категории. Выведите название товара, категорию, цену товара и среднюю цену по категории (округлить до сотых).',
                'database_schema' => 'ecommerce',
                'solution_sql' => "SELECT p.product_name, p.category, p.price, ROUND((SELECT AVG(p2.price) FROM Products p2 WHERE p2.category = p.category), 2) AS avg_category_price FROM Products p WHERE p.price > (SELECT AVG(p2.price) FROM Products p2 WHERE p2.category = p.category) ORDER BY p.category, p.price DESC;",
                'expected_results' => '[]',
                'difficulty_percent' => 45,
                'is_free' => 0,
                'hint' => 'Используйте коррелированный подзапрос WHERE p2.category = p.category для вычисления средней цены по категории',
                'points' => 25,
                'sql_type' => 'select',
                'task_order' => 106,
                'tags' => 'Correlated Subquery,Aggregate Functions,ORDER BY',
                'company' => 'Microsoft',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #107 — Tinkoff — family
            // ================================================================
            [
                'id' => 107,
                'task_number' => 107,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Накопительный итог расходов',
                'description' => 'Window Function SUM OVER с PARTITION BY для нарастающего итога по членам семьи',
                'task_text' => 'Для каждого члена семьи вычислите накопительный итог расходов (unit_price * amount) по дате. Выведите имя члена семьи, дату, сумму покупки и нарастающий итог.',
                'database_schema' => 'family',
                'solution_sql' => "SELECT fm.member_name, p.date, p.unit_price * p.amount AS cost, SUM(p.unit_price * p.amount) OVER (PARTITION BY p.family_member ORDER BY p.date) AS running_total FROM Payments p JOIN FamilyMembers fm ON p.family_member = fm.member_id ORDER BY fm.member_name, p.date;",
                'expected_results' => '[]',
                'difficulty_percent' => 55,
                'is_free' => 0,
                'hint' => 'Используйте SUM() OVER (PARTITION BY family_member ORDER BY date) для нарастающего итога по каждому члену семьи',
                'points' => 30,
                'sql_type' => 'select',
                'task_order' => 107,
                'tags' => 'Window Functions,JOIN,ORDER BY,Aggregate Functions',
                'company' => 'Tinkoff',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #108 — Tinkoff — ecommerce
            // ================================================================
            [
                'id' => 108,
                'task_number' => 108,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Дни между заказами клиентов',
                'description' => 'Window Function LEAD для вычисления интервала между событиями',
                'task_text' => 'Для каждого заказа каждого клиента вычислите количество дней до следующего заказа этого же клиента. Выведите имя клиента, дату заказа, дату следующего заказа и разницу в днях. Если следующего заказа нет — выведите NULL.',
                'database_schema' => 'ecommerce',
                'solution_sql' => "SELECT c.name, o.order_date, LEAD(o.order_date) OVER (PARTITION BY o.customer_id ORDER BY o.order_date) AS next_order_date, DATEDIFF(LEAD(o.order_date) OVER (PARTITION BY o.customer_id ORDER BY o.order_date), o.order_date) AS days_until_next FROM Orders o JOIN Customers c ON o.customer_id = c.id ORDER BY c.name, o.order_date;",
                'expected_results' => '[]',
                'difficulty_percent' => 55,
                'is_free' => 0,
                'hint' => 'Используйте LEAD(order_date) OVER (PARTITION BY customer_id ORDER BY order_date) и DATEDIFF',
                'points' => 30,
                'sql_type' => 'select',
                'task_order' => 108,
                'tags' => 'Window Functions,JOIN,Date Functions,ORDER BY',
                'company' => 'Tinkoff',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #109 — Tinkoff — booking
            // ================================================================
            [
                'id' => 109,
                'task_number' => 109,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Доходность владельцев жилья',
                'description' => 'Множественный JOIN с агрегацией и ранжированием',
                'task_text' => 'Для каждого владельца жилья вычислите общий доход от аренды, количество уникальных арендаторов и средний рейтинг отзывов (округлить до сотых). Выведите имя владельца, доход, количество арендаторов и средний рейтинг. Отсортируйте по доходу по убыванию.',
                'database_schema' => 'booking',
                'solution_sql' => "SELECT U.name, SUM(Res.total) AS total_income, COUNT(DISTINCT Res.user_id) AS unique_tenants, ROUND(AVG(Rev.rating), 2) AS avg_rating FROM Users U JOIN Rooms R ON U.id = R.owner_id JOIN Reservations Res ON R.id = Res.room_id LEFT JOIN Reviews Rev ON Res.id = Rev.reservation_id GROUP BY U.id, U.name ORDER BY total_income DESC;",
                'expected_results' => '[]',
                'difficulty_percent' => 50,
                'is_free' => 0,
                'hint' => 'JOIN Users → Rooms → Reservations → LEFT JOIN Reviews, GROUP BY владельцу',
                'points' => 25,
                'sql_type' => 'select',
                'task_order' => 109,
                'tags' => 'JOIN,LEFT JOIN,GROUP BY,DISTINCT,Aggregate Functions,ORDER BY',
                'company' => 'Tinkoff',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #110 — Tinkoff — flights
            // ================================================================
            [
                'id' => 110,
                'task_number' => 110,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Средний чек по классам и авиакомпаниям',
                'description' => 'GROUP BY по двум измерениям с Conditional Aggregation',
                'task_text' => 'Для каждой авиакомпании вычислите средний чек бронирования по каждому классу обслуживания. Выведите авиакомпанию, средний чек economy, business и first (округлить до целого). Если бронирований определённого класса не было — выведите 0.',
                'database_schema' => 'flights',
                'solution_sql' => "SELECT F.airline, ROUND(COALESCE(AVG(CASE WHEN B.seat_class = 'economy' THEN B.price END), 0)) AS avg_economy, ROUND(COALESCE(AVG(CASE WHEN B.seat_class = 'business' THEN B.price END), 0)) AS avg_business, ROUND(COALESCE(AVG(CASE WHEN B.seat_class = 'first' THEN B.price END), 0)) AS avg_first FROM Flights F JOIN Bookings B ON F.flight_id = B.flight_id GROUP BY F.airline ORDER BY F.airline;",
                'expected_results' => '[]',
                'difficulty_percent' => 55,
                'is_free' => 0,
                'hint' => 'AVG(CASE WHEN seat_class = \'...\' THEN price END) для каждого класса, COALESCE для замены NULL на 0',
                'points' => 30,
                'sql_type' => 'select',
                'task_order' => 110,
                'tags' => 'JOIN,GROUP BY,Conditional Aggregation,CASE WHEN,Aggregate Functions',
                'company' => 'Tinkoff',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #111 — Alfa-Bank — aviation
            // ================================================================
            [
                'id' => 111,
                'task_number' => 111,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Компании с ростом пассажиропотока',
                'description' => 'CTE + LAG для сравнения метрик между периодами',
                'task_text' => 'Для каждой авиакомпании вычислите количество перевезённых пассажиров по месяцам. Найдите компании, у которых пассажиропоток в каждом следующем месяце не уменьшался. Выведите названия таких компаний.',
                'database_schema' => 'aviation',
                'solution_sql' => "WITH monthly AS (SELECT C.name AS company_name, MONTH(T.time_out) AS m, COUNT(DISTINCT pit.passenger) AS pax FROM Company C JOIN Trip T ON C.id = T.company JOIN Pass_in_trip pit ON T.id = pit.trip GROUP BY C.name, MONTH(T.time_out)), with_lag AS (SELECT company_name, m, pax, LAG(pax) OVER (PARTITION BY company_name ORDER BY m) AS prev_pax FROM monthly), declining AS (SELECT DISTINCT company_name FROM with_lag WHERE prev_pax IS NOT NULL AND pax < prev_pax) SELECT DISTINCT company_name FROM monthly WHERE company_name NOT IN (SELECT company_name FROM declining);",
                'expected_results' => '[]',
                'difficulty_percent' => 75,
                'is_free' => 0,
                'hint' => 'Подсчитайте пассажиров по месяцам, используйте LAG для сравнения, затем исключите компании с падением',
                'points' => 35,
                'sql_type' => 'select',
                'task_order' => 111,
                'tags' => 'CTE,Window Functions,JOIN,GROUP BY,DISTINCT,NOT IN,Aggregate Functions',
                'company' => 'Alfa-Bank',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #112 — Alfa-Bank — ecommerce
            // ================================================================
            [
                'id' => 112,
                'task_number' => 112,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'ABC-анализ товаров',
                'description' => 'CTE с SUM OVER для нарастающей доли и CASE для категоризации',
                'task_text' => 'Проведите ABC-анализ товаров по выручке. Отсортируйте товары по убыванию выручки, вычислите накопительную долю каждого товара. Категория A — до 80% накопительной доли, B — от 80% до 95%, C — остальные. Выведите название товара, выручку, накопительную долю (в %) и категорию.',
                'database_schema' => 'ecommerce',
                'solution_sql' => "WITH revenue AS (SELECT p.product_name, SUM(oi.quantity * oi.price) AS total_revenue FROM Products p JOIN OrderItems oi ON p.id = oi.product_id GROUP BY p.product_name), cumulative AS (SELECT product_name, total_revenue, ROUND(SUM(total_revenue) OVER (ORDER BY total_revenue DESC) * 100.0 / SUM(total_revenue) OVER (), 2) AS cumulative_pct FROM revenue) SELECT product_name, total_revenue, cumulative_pct, CASE WHEN cumulative_pct <= 80 THEN 'A' WHEN cumulative_pct <= 95 THEN 'B' ELSE 'C' END AS category FROM cumulative ORDER BY total_revenue DESC;",
                'expected_results' => '[]',
                'difficulty_percent' => 70,
                'is_free' => 0,
                'hint' => 'Используйте SUM() OVER (ORDER BY revenue DESC) для нарастающей суммы, SUM() OVER () для общей суммы',
                'points' => 35,
                'sql_type' => 'select',
                'task_order' => 112,
                'tags' => 'CTE,Window Functions,JOIN,GROUP BY,CASE WHEN,Aggregate Functions',
                'company' => 'Alfa-Bank',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #113 — Alfa-Bank — booking
            // ================================================================
            [
                'id' => 113,
                'task_number' => 113,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Сезонность бронирований',
                'description' => 'CASE для группировки месяцев в сезоны и агрегация',
                'task_text' => 'Определите среднюю стоимость бронирования по сезонам: зима (12,1,2), весна (3,4,5), лето (6,7,8), осень (9,10,11). Выведите сезон, количество бронирований и среднюю стоимость (округлить до целого). Отсортируйте по средней стоимости по убыванию.',
                'database_schema' => 'booking',
                'solution_sql' => "SELECT CASE WHEN MONTH(start_date) IN (12, 1, 2) THEN 'winter' WHEN MONTH(start_date) IN (3, 4, 5) THEN 'spring' WHEN MONTH(start_date) IN (6, 7, 8) THEN 'summer' ELSE 'autumn' END AS season, COUNT(*) AS bookings_count, ROUND(AVG(total)) AS avg_total FROM Reservations GROUP BY season ORDER BY avg_total DESC;",
                'expected_results' => '[]',
                'difficulty_percent' => 35,
                'is_free' => 0,
                'hint' => 'Используйте CASE WHEN MONTH(start_date) IN (...) для определения сезона',
                'points' => 20,
                'sql_type' => 'select',
                'task_order' => 113,
                'tags' => 'CASE WHEN,Date Functions,GROUP BY,Aggregate Functions,ORDER BY',
                'company' => 'Alfa-Bank',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #114 — Alfa-Bank — flights
            // ================================================================
            [
                'id' => 114,
                'task_number' => 114,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Самые прибыльные дни недели',
                'description' => 'DAYOFWEEK + GROUP BY + RANK для ранжирования дней',
                'task_text' => 'Определите, в какой день недели суммарная выручка от бронирований максимальна. Выведите день недели (1=Воскресенье, 7=Суббота), суммарную выручку и ранг дня по выручке.',
                'database_schema' => 'flights',
                'solution_sql' => "SELECT DAYOFWEEK(booking_date) AS day_of_week, SUM(price) AS total_revenue, RANK() OVER (ORDER BY SUM(price) DESC) AS revenue_rank FROM Bookings GROUP BY DAYOFWEEK(booking_date) ORDER BY total_revenue DESC;",
                'expected_results' => '[]',
                'difficulty_percent' => 40,
                'is_free' => 0,
                'hint' => 'GROUP BY DAYOFWEEK(booking_date), затем RANK() OVER (ORDER BY SUM(price) DESC)',
                'points' => 20,
                'sql_type' => 'select',
                'task_order' => 114,
                'tags' => 'Window Functions,Date Functions,GROUP BY,Aggregate Functions,ORDER BY',
                'company' => 'Alfa-Bank',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #115 — VK — aviation
            // ================================================================
            [
                'id' => 115,
                'task_number' => 115,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Граф перелётов пассажиров',
                'description' => 'Self JOIN для построения цепочек перелётов',
                'task_text' => 'Найдите пассажиров, которые совершили два последовательных перелёта (город прибытия первого = город отправления второго). Выведите имя пассажира, город отправления первого рейса, пересадочный город и город прибытия второго рейса.',
                'database_schema' => 'aviation',
                'solution_sql' => "SELECT DISTINCT P.name, T1.town_from AS origin, T1.town_to AS transfer, T2.town_to AS destination FROM Pass_in_trip pit1 JOIN Pass_in_trip pit2 ON pit1.passenger = pit2.passenger AND pit1.trip != pit2.trip JOIN Trip T1 ON pit1.trip = T1.id JOIN Trip T2 ON pit2.trip = T2.id JOIN Passenger P ON P.id = pit1.passenger WHERE T1.town_to = T2.town_from AND T1.time_in <= T2.time_out ORDER BY P.name;",
                'expected_results' => '[]',
                'difficulty_percent' => 70,
                'is_free' => 0,
                'hint' => 'Self JOIN Pass_in_trip с двумя Trip, где town_to первого = town_from второго и time_in <= time_out',
                'points' => 35,
                'sql_type' => 'select',
                'task_order' => 115,
                'tags' => 'Self JOIN,JOIN,DISTINCT,ORDER BY',
                'company' => 'VK',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #116 — VK — ecommerce
            // ================================================================
            [
                'id' => 116,
                'task_number' => 116,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Самые активные рецензенты',
                'description' => 'CTE + HAVING + Window Function для ранжирования',
                'task_text' => 'Найдите клиентов, которые оставили отзывы на 3 и более различных товара. Выведите имя клиента, количество отзывов, средний рейтинг (округлить до сотых) и ранг по количеству отзывов. Отсортируйте по количеству отзывов по убыванию.',
                'database_schema' => 'ecommerce',
                'solution_sql' => "WITH reviewers AS (SELECT c.name, COUNT(DISTINCT r.product_id) AS review_count, ROUND(AVG(r.rating), 2) AS avg_rating FROM Customers c JOIN Reviews r ON c.id = r.customer_id GROUP BY c.id, c.name HAVING COUNT(DISTINCT r.product_id) >= 3) SELECT name, review_count, avg_rating, DENSE_RANK() OVER (ORDER BY review_count DESC) AS rank_num FROM reviewers ORDER BY review_count DESC;",
                'expected_results' => '[]',
                'difficulty_percent' => 45,
                'is_free' => 0,
                'hint' => 'CTE с HAVING COUNT(DISTINCT product_id) >= 3, затем DENSE_RANK',
                'points' => 25,
                'sql_type' => 'select',
                'task_order' => 116,
                'tags' => 'CTE,Window Functions,JOIN,GROUP BY,HAVING,DISTINCT,Aggregate Functions',
                'company' => 'VK',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #117 — VK — flights
            // ================================================================
            [
                'id' => 117,
                'task_number' => 117,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Пассажиры-лоялисты авиакомпаний',
                'description' => 'HAVING COUNT + коррелированный подзапрос для проверки эксклюзивности',
                'task_text' => 'Найдите пассажиров, которые летали только одной авиакомпанией (все их рейсы — у одной компании) и совершили минимум 2 рейса. Выведите имя пассажира, название авиакомпании и количество рейсов.',
                'database_schema' => 'flights',
                'solution_sql' => "SELECT Pa.name, F.airline, COUNT(*) AS flight_count FROM Passengers Pa JOIN Bookings B ON Pa.passenger_id = B.passenger_id JOIN Flights F ON B.flight_id = F.flight_id GROUP BY Pa.passenger_id, Pa.name, F.airline HAVING COUNT(*) >= 2 AND COUNT(DISTINCT F.airline) = 1 ORDER BY flight_count DESC;",
                'expected_results' => '[]',
                'difficulty_percent' => 50,
                'is_free' => 0,
                'hint' => 'GROUP BY пассажиру, HAVING COUNT(*) >= 2 AND COUNT(DISTINCT airline) = 1',
                'points' => 25,
                'sql_type' => 'select',
                'task_order' => 117,
                'tags' => 'JOIN,GROUP BY,HAVING,DISTINCT,Aggregate Functions',
                'company' => 'VK',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #118 — Sber — flights
            // ================================================================
            [
                'id' => 118,
                'task_number' => 118,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Прогноз загрузки рейсов',
                'description' => 'Window Function AVG OVER с ROWS BETWEEN для скользящего среднего',
                'task_text' => 'Для каждого рейса вычислите количество бронирований и скользящее среднее количества бронирований по последним 3 рейсам той же авиакомпании (по дате). Выведите авиакомпанию, дату рейса, количество бронирований и скользящее среднее (округлить до целого).',
                'database_schema' => 'flights',
                'solution_sql' => "WITH flight_bookings AS (SELECT F.airline, F.flight_date, F.flight_id, COUNT(B.booking_id) AS booking_count FROM Flights F LEFT JOIN Bookings B ON F.flight_id = B.flight_id GROUP BY F.airline, F.flight_date, F.flight_id) SELECT airline, flight_date, booking_count, ROUND(AVG(booking_count) OVER (PARTITION BY airline ORDER BY flight_date ROWS BETWEEN 2 PRECEDING AND CURRENT ROW)) AS moving_avg FROM flight_bookings ORDER BY airline, flight_date;",
                'expected_results' => '[]',
                'difficulty_percent' => 60,
                'is_free' => 0,
                'hint' => 'CTE для подсчёта бронирований, затем AVG() OVER (PARTITION BY airline ORDER BY flight_date ROWS BETWEEN 2 PRECEDING AND CURRENT ROW)',
                'points' => 30,
                'sql_type' => 'select',
                'task_order' => 118,
                'tags' => 'CTE,Window Functions,LEFT JOIN,GROUP BY,Aggregate Functions',
                'company' => 'Sber',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #119 — Sber — ecommerce
            // ================================================================
            [
                'id' => 119,
                'task_number' => 119,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'LTV клиентов по когортам',
                'description' => 'CTE + DATE_FORMAT + SUM OVER для lifetime value',
                'task_text' => 'Для каждой когорты (месяц регистрации) вычислите средний LTV (lifetime value = средняя суммарная выручка на клиента). Выведите месяц когорты и средний LTV, округлённый до целого. Отсортируйте по когорте.',
                'database_schema' => 'ecommerce',
                'solution_sql' => "WITH customer_ltv AS (SELECT c.id, DATE_FORMAT(c.registration_date, '%Y-%m') AS cohort, COALESCE(SUM(o.total_amount), 0) AS ltv FROM Customers c LEFT JOIN Orders o ON c.id = o.customer_id GROUP BY c.id, cohort) SELECT cohort, ROUND(AVG(ltv)) AS avg_ltv FROM customer_ltv GROUP BY cohort ORDER BY cohort;",
                'expected_results' => '[]',
                'difficulty_percent' => 55,
                'is_free' => 0,
                'hint' => 'В CTE вычислите сумму заказов каждого клиента с LEFT JOIN, затем усредните по когорте',
                'points' => 30,
                'sql_type' => 'select',
                'task_order' => 119,
                'tags' => 'CTE,LEFT JOIN,Date Functions,GROUP BY,Aggregate Functions',
                'company' => 'Sber',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #120 — Amazon — ecommerce (INSERT)
            // ================================================================
            [
                'id' => 120,
                'task_number' => 120,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Массовое добавление товаров',
                'description' => 'INSERT с SELECT для копирования данных между таблицами',
                'task_text' => 'Добавьте в таблицу Products новый товар: product_name = \'Wireless Mouse\', category = \'Electronics\', price = 29.99, stock = 150.',
                'database_schema' => 'ecommerce',
                'solution_sql' => "INSERT INTO Products (product_name, category, price, stock) VALUES ('Wireless Mouse', 'Electronics', 29.99, 150);",
                'expected_results' => '[]',
                'difficulty_percent' => 25,
                'is_free' => 0,
                'hint' => 'INSERT INTO Products (столбцы) VALUES (значения)',
                'points' => 15,
                'sql_type' => 'insert',
                'task_order' => 120,
                'tags' => 'INSERT',
                'company' => 'Amazon',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #121 — Google — ecommerce (INSERT)
            // ================================================================
            [
                'id' => 121,
                'task_number' => 121,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Регистрация нового клиента',
                'description' => 'INSERT с указанием всех полей',
                'task_text' => 'Зарегистрируйте нового клиента: name = \'Ivan Petrov\', email = \'ivan@mail.ru\', age = 28, city = \'Moscow\', registration_date = \'2024-01-15\'.',
                'database_schema' => 'ecommerce',
                'solution_sql' => "INSERT INTO Customers (name, email, age, city, registration_date) VALUES ('Ivan Petrov', 'ivan@mail.ru', 28, 'Moscow', '2024-01-15');",
                'expected_results' => '[]',
                'difficulty_percent' => 25,
                'is_free' => 0,
                'hint' => 'INSERT INTO Customers (поля) VALUES (значения)',
                'points' => 15,
                'sql_type' => 'insert',
                'task_order' => 121,
                'tags' => 'INSERT',
                'company' => 'Google',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #122 — Yandex — flights (INSERT)
            // ================================================================
            [
                'id' => 122,
                'task_number' => 122,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Добавление нового рейса',
                'description' => 'INSERT с внешними ключами',
                'task_text' => 'Добавьте новый рейс: flight_date = \'2024-06-01\', departure = \'Moscow\', destination = \'Sochi\', first_pilot_id = 1, second_pilot_id = 2, airline = \'Aeroflot\', aircraft_type = \'Boeing 737\'.',
                'database_schema' => 'flights',
                'solution_sql' => "INSERT INTO Flights (flight_date, departure, destination, first_pilot_id, second_pilot_id, airline, aircraft_type) VALUES ('2024-06-01', 'Moscow', 'Sochi', 1, 2, 'Aeroflot', 'Boeing 737');",
                'expected_results' => '[]',
                'difficulty_percent' => 25,
                'is_free' => 0,
                'hint' => 'INSERT INTO Flights с указанием всех обязательных полей',
                'points' => 15,
                'sql_type' => 'insert',
                'task_order' => 122,
                'tags' => 'INSERT',
                'company' => 'Yandex',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #123 — Microsoft — ecommerce (UPDATE)
            // ================================================================
            [
                'id' => 123,
                'task_number' => 123,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Скидка на залежавшийся товар',
                'description' => 'UPDATE с подзапросом NOT IN для условного обновления',
                'task_text' => 'Уменьшите цену на 15% для всех товаров, которые ни разу не были заказаны.',
                'database_schema' => 'ecommerce',
                'solution_sql' => "UPDATE Products SET price = ROUND(price * 0.85, 2) WHERE id NOT IN (SELECT DISTINCT product_id FROM OrderItems);",
                'expected_results' => '[]',
                'difficulty_percent' => 40,
                'is_free' => 0,
                'hint' => 'UPDATE ... SET price = price * 0.85 WHERE id NOT IN (SELECT product_id FROM OrderItems)',
                'points' => 20,
                'sql_type' => 'update',
                'task_order' => 123,
                'tags' => 'UPDATE,NOT IN,Subquery',
                'company' => 'Microsoft',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #124 — Facebook — flights (UPDATE)
            // ================================================================
            [
                'id' => 124,
                'task_number' => 124,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Повышение цен бизнес-класса',
                'description' => 'UPDATE с JOIN для обновления по условию из связанной таблицы',
                'task_text' => 'Увеличьте цену бронирований бизнес-класса на 10% для всех рейсов авиакомпании \'Aeroflot\'.',
                'database_schema' => 'flights',
                'solution_sql' => "UPDATE Bookings B JOIN Flights F ON B.flight_id = F.flight_id SET B.price = ROUND(B.price * 1.10, 2) WHERE B.seat_class = 'business' AND F.airline = 'Aeroflot';",
                'expected_results' => '[]',
                'difficulty_percent' => 45,
                'is_free' => 0,
                'hint' => 'UPDATE с JOIN — UPDATE Bookings JOIN Flights ON ... SET price = price * 1.10 WHERE условия',
                'points' => 25,
                'sql_type' => 'update',
                'task_order' => 124,
                'tags' => 'UPDATE,JOIN',
                'company' => 'Facebook',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #125 — Tesla — ecommerce (DELETE)
            // ================================================================
            [
                'id' => 125,
                'task_number' => 125,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Удаление отменённых заказов',
                'description' => 'DELETE с условием по статусу и дате',
                'task_text' => "Удалите все заказы со статусом 'cancelled', сделанные до '2023-06-01'.",
                'database_schema' => 'ecommerce',
                'solution_sql' => "DELETE FROM Orders WHERE status = 'cancelled' AND order_date < '2023-06-01';",
                'expected_results' => '[]',
                'difficulty_percent' => 25,
                'is_free' => 0,
                'hint' => "DELETE FROM Orders WHERE status = 'cancelled' AND order_date < '...'",
                'points' => 15,
                'sql_type' => 'delete',
                'task_order' => 125,
                'tags' => 'DELETE,Date Functions',
                'company' => 'Tesla',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #126 — Sber — ecommerce (DELETE)
            // ================================================================
            [
                'id' => 126,
                'task_number' => 126,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Удаление неактивных клиентов',
                'description' => 'DELETE с NOT EXISTS для удаления записей без связей',
                'task_text' => 'Удалите клиентов, которые не сделали ни одного заказа.',
                'database_schema' => 'ecommerce',
                'solution_sql' => "DELETE FROM Customers WHERE id NOT IN (SELECT DISTINCT customer_id FROM Orders);",
                'expected_results' => '[]',
                'difficulty_percent' => 30,
                'is_free' => 0,
                'hint' => 'DELETE FROM Customers WHERE id NOT IN (SELECT customer_id FROM Orders)',
                'points' => 15,
                'sql_type' => 'delete',
                'task_order' => 126,
                'tags' => 'DELETE,NOT IN,Subquery',
                'company' => 'Sber',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #127 — Yandex — flights (CREATE VIEW)
            // ================================================================
            [
                'id' => 127,
                'task_number' => 127,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Представление статистики маршрутов',
                'description' => 'CREATE VIEW с JOIN и агрегацией',
                'task_text' => 'Создайте представление RouteStats, которое для каждого маршрута (departure → destination) содержит: количество рейсов, общее количество бронирований, суммарную выручку и среднюю цену билета (округлить до сотых).',
                'database_schema' => 'flights',
                'solution_sql' => "CREATE VIEW RouteStats AS SELECT F.departure, F.destination, COUNT(DISTINCT F.flight_id) AS flights_count, COUNT(B.booking_id) AS total_bookings, COALESCE(SUM(B.price), 0) AS total_revenue, ROUND(COALESCE(AVG(B.price), 0), 2) AS avg_ticket_price FROM Flights F LEFT JOIN Bookings B ON F.flight_id = B.flight_id GROUP BY F.departure, F.destination;",
                'expected_results' => '[]',
                'difficulty_percent' => 45,
                'is_free' => 0,
                'hint' => 'CREATE VIEW name AS SELECT ... с LEFT JOIN и GROUP BY',
                'points' => 25,
                'sql_type' => 'create_view',
                'task_order' => 127,
                'tags' => 'CREATE VIEW,LEFT JOIN,GROUP BY,DISTINCT,Aggregate Functions',
                'company' => 'Yandex',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #128 — Google — aviation
            // ================================================================
            [
                'id' => 128,
                'task_number' => 128,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Самолёты-рекордсмены',
                'description' => 'CTE с RANK и EXISTS для поиска лидеров по нескольким метрикам',
                'task_text' => 'Для каждого типа самолёта вычислите общее количество рейсов и общее количество перевезённых пассажиров. Выведите тип самолёта, количество рейсов, количество пассажиров и ранг по пассажирам (без пропусков). Отсортируйте по рангу.',
                'database_schema' => 'aviation',
                'solution_sql' => "WITH plane_stats AS (SELECT T.plane, COUNT(DISTINCT T.id) AS trip_count, COUNT(pit.passenger) AS passenger_count FROM Trip T JOIN Pass_in_trip pit ON T.id = pit.trip GROUP BY T.plane) SELECT plane, trip_count, passenger_count, DENSE_RANK() OVER (ORDER BY passenger_count DESC) AS rank_num FROM plane_stats ORDER BY rank_num;",
                'expected_results' => '[]',
                'difficulty_percent' => 55,
                'is_free' => 0,
                'hint' => 'CTE для подсчёта статистики по самолётам, затем DENSE_RANK по количеству пассажиров',
                'points' => 30,
                'sql_type' => 'select',
                'task_order' => 128,
                'tags' => 'CTE,Window Functions,JOIN,GROUP BY,DISTINCT,Aggregate Functions',
                'company' => 'Google',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

            // ================================================================
            //  #129 — Facebook — ecommerce (ФИНАЛЬНАЯ ЗАДАЧА)
            // ================================================================
            [
                'id' => 129,
                'task_number' => 129,
                'lesson_id' => null,
                'author_id' => 1,
                'title' => 'Полный отчёт по клиентам',
                'description' => 'CTE + множественные оконные функции + условная агрегация',
                'task_text' => 'Для каждого клиента выведите: имя, город, общее количество заказов, общую сумму заказов, средний чек (округлить до сотых), ранг по общей сумме (DENSE_RANK), процентиль по среднему чеку (PERCENT_RANK, округлить до сотых) и категорию клиента: \'VIP\' если общая сумма > 1000, \'Regular\' если от 500 до 1000, \'New\' если < 500. Отсортируйте по рангу.',
                'database_schema' => 'ecommerce',
                'solution_sql' => "WITH customer_stats AS (SELECT c.name, c.city, COUNT(o.id) AS order_count, COALESCE(SUM(o.total_amount), 0) AS total_spent, ROUND(COALESCE(AVG(o.total_amount), 0), 2) AS avg_check FROM Customers c LEFT JOIN Orders o ON c.id = o.customer_id GROUP BY c.id, c.name, c.city) SELECT name, city, order_count, total_spent, avg_check, DENSE_RANK() OVER (ORDER BY total_spent DESC) AS spending_rank, ROUND(PERCENT_RANK() OVER (ORDER BY avg_check), 2) AS check_percentile, CASE WHEN total_spent > 1000 THEN 'VIP' WHEN total_spent >= 500 THEN 'Regular' ELSE 'New' END AS customer_category FROM customer_stats ORDER BY spending_rank;",
                'expected_results' => '[]',
                'difficulty_percent' => 90,
                'is_free' => 0,
                'hint' => 'CTE для базовой статистики, затем DENSE_RANK, PERCENT_RANK и CASE WHEN для категоризации',
                'points' => 50,
                'sql_type' => 'select',
                'task_order' => 129,
                'tags' => 'CTE,Window Functions,LEFT JOIN,GROUP BY,CASE WHEN,Conditional Aggregation,Aggregate Functions',
                'company' => 'Facebook',
                'created_at' => '2026-03-01 19:41:38',
                'updated_at' => '2026-03-01 19:41:38',
            ],

        ];

        foreach (array_chunk($tasks, 10) as $chunk) {
            DB::table('tasks')->insert($chunk);
        }

        echo "✅ Вставлено " . count($tasks) . " premium-задач\n";
    }
}
