<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HousingSeeder extends Seeder
{
    public function run(): void
    {
        // Отключить проверку foreign keys
        DB::connection('sandbox_template')->statement('SET FOREIGN_KEY_CHECKS=0;');

        // Очистить таблицы
        DB::connection('sandbox_template')->table('reviews')->truncate();
        DB::connection('sandbox_template')->table('reservations')->truncate();
        DB::connection('sandbox_template')->table('housing_rooms')->truncate();
        DB::connection('sandbox_template')->table('housing_users')->truncate();

        // Включить обратно проверку foreign keys
        DB::connection('sandbox_template')->statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. ПОЛЬЗОВАТЕЛИ (как на SQL Academy)
        $housingUsers = [
            ['id' => 1, 'name' => 'George Clooney', 'email' => 'george.clooney@example.com', 'registration_date' => '2019-01-15'],
            ['id' => 2, 'name' => 'Jennifer Aniston', 'email' => 'jennifer.aniston@example.com', 'registration_date' => '2019-02-20'],
            ['id' => 3, 'name' => 'Brad Pitt', 'email' => 'brad.pitt@example.com', 'registration_date' => '2019-03-10'],
            ['id' => 4, 'name' => 'Angelina Jolie', 'email' => 'angelina.jolie@example.com', 'registration_date' => '2019-04-05'],
            ['id' => 5, 'name' => 'Johnny Depp', 'email' => 'johnny.depp@example.com', 'registration_date' => '2019-05-12'],
            ['id' => 6, 'name' => 'Leonardo DiCaprio', 'email' => 'leonardo.dicaprio@example.com', 'registration_date' => '2019-06-18'],
            ['id' => 7, 'name' => 'Tom Cruise', 'email' => 'tom.cruise@example.com', 'registration_date' => '2019-07-22'],
            ['id' => 8, 'name' => 'Robert Downey Jr.', 'email' => 'robert.downey@example.com', 'registration_date' => '2019-08-30'],
            ['id' => 9, 'name' => 'Scarlett Johansson', 'email' => 'scarlett.johansson@example.com', 'registration_date' => '2019-09-14'],
            ['id' => 10, 'name' => 'Matt Damon', 'email' => 'matt.damon@example.com', 'registration_date' => '2019-10-25'],
            ['id' => 11, 'name' => 'Cameron Diaz', 'email' => 'cameron.diaz@example.com', 'registration_date' => '2019-11-08'],
            ['id' => 12, 'name' => 'Julia Roberts', 'email' => 'julia.roberts@example.com', 'registration_date' => '2019-12-16'],
            ['id' => 13, 'name' => 'Will Smith', 'email' => 'will.smith@example.com', 'registration_date' => '2020-01-20'],
            ['id' => 14, 'name' => 'Denzel Washington', 'email' => 'denzel.washington@example.com', 'registration_date' => '2020-02-28'],
            ['id' => 15, 'name' => 'Morgan Freeman', 'email' => 'morgan.freeman@example.com', 'registration_date' => '2020-03-15'],
        ];

        DB::connection('sandbox_template')->table('housing_users')->insert($housingUsers);

        // 2. ЖИЛЬЕ (ROOMS)
        $rooms = [
            // George Clooney's properties
            ['id' => 1, 'owner_id' => 1, 'address' => '11218, Friel Place, New York', 'home_type' => 'apartment', 'price' => 150.00, 'has_tv' => 1, 'has_internet' => 1, 'has_kitchen' => 1, 'has_air_con' => 1],
            ['id' => 2, 'owner_id' => 1, 'address' => '1984, Groveland Terrace, Chicago', 'home_type' => 'house', 'price' => 250.00, 'has_tv' => 1, 'has_internet' => 1, 'has_kitchen' => 1, 'has_air_con' => 1],
            ['id' => 3, 'owner_id' => 1, 'address' => '3711, Hauk Lane, Los Angeles', 'home_type' => 'studio', 'price' => 100.00, 'has_tv' => 1, 'has_internet' => 1, 'has_kitchen' => 0, 'has_air_con' => 1],

            // Jennifer Aniston's properties
            ['id' => 4, 'owner_id' => 2, 'address' => '2222, Oak Street, San Francisco', 'home_type' => 'apartment', 'price' => 180.00, 'has_tv' => 1, 'has_internet' => 1, 'has_kitchen' => 1, 'has_air_con' => 0],
            ['id' => 5, 'owner_id' => 2, 'address' => '3333, Pine Avenue, Miami', 'home_type' => 'house', 'price' => 300.00, 'has_tv' => 1, 'has_internet' => 1, 'has_kitchen' => 1, 'has_air_con' => 1],

            // Brad Pitt's properties
            ['id' => 6, 'owner_id' => 3, 'address' => '4444, Maple Drive, Boston', 'home_type' => 'apartment', 'price' => 120.00, 'has_tv' => 0, 'has_internet' => 1, 'has_kitchen' => 1, 'has_air_con' => 0],
            ['id' => 7, 'owner_id' => 3, 'address' => '5555, Elm Road, Seattle', 'home_type' => 'studio', 'price' => 90.00, 'has_tv' => 1, 'has_internet' => 1, 'has_kitchen' => 0, 'has_air_con' => 0],

            // Angelina Jolie's properties
            ['id' => 8, 'owner_id' => 4, 'address' => '6666, Cedar Lane, Austin', 'home_type' => 'house', 'price' => 350.00, 'has_tv' => 1, 'has_internet' => 1, 'has_kitchen' => 1, 'has_air_con' => 1],
            ['id' => 9, 'owner_id' => 4, 'address' => '7777, Birch Court, Portland', 'home_type' => 'apartment', 'price' => 160.00, 'has_tv' => 1, 'has_internet' => 1, 'has_kitchen' => 1, 'has_air_con' => 1],

            // Johnny Depp's properties
            ['id' => 10, 'owner_id' => 5, 'address' => '8888, Willow Street, Denver', 'home_type' => 'studio', 'price' => 80.00, 'has_tv' => 0, 'has_internet' => 1, 'has_kitchen' => 0, 'has_air_con' => 0],
            ['id' => 11, 'owner_id' => 5, 'address' => '9999, Spruce Avenue, Phoenix', 'home_type' => 'apartment', 'price' => 140.00, 'has_tv' => 1, 'has_internet' => 1, 'has_kitchen' => 1, 'has_air_con' => 1],

            // Leonardo DiCaprio's properties
            ['id' => 12, 'owner_id' => 6, 'address' => '1111, Ash Road, San Diego', 'home_type' => 'house', 'price' => 400.00, 'has_tv' => 1, 'has_internet' => 1, 'has_kitchen' => 1, 'has_air_con' => 1],

            // Tom Cruise's properties
            ['id' => 13, 'owner_id' => 7, 'address' => '2222, Poplar Drive, Las Vegas', 'home_type' => 'apartment', 'price' => 200.00, 'has_tv' => 1, 'has_internet' => 1, 'has_kitchen' => 1, 'has_air_con' => 1],
            ['id' => 14, 'owner_id' => 7, 'address' => '3333, Beech Lane, Dallas', 'home_type' => 'studio', 'price' => 110.00, 'has_tv' => 1, 'has_internet' => 1, 'has_kitchen' => 0, 'has_air_con' => 1],

            // Robert Downey Jr.'s properties
            ['id' => 15, 'owner_id' => 8, 'address' => '4444, Fir Court, Philadelphia', 'home_type' => 'house', 'price' => 280.00, 'has_tv' => 1, 'has_internet' => 1, 'has_kitchen' => 1, 'has_air_con' => 0],

            // Scarlett Johansson's properties
            ['id' => 16, 'owner_id' => 9, 'address' => '5555, Palm Street, Atlanta', 'home_type' => 'apartment', 'price' => 170.00, 'has_tv' => 1, 'has_internet' => 1, 'has_kitchen' => 1, 'has_air_con' => 1],

            // Matt Damon's properties
            ['id' => 17, 'owner_id' => 10, 'address' => '6666, Hickory Avenue, Houston', 'home_type' => 'house', 'price' => 320.00, 'has_tv' => 1, 'has_internet' => 1, 'has_kitchen' => 1, 'has_air_con' => 1],

            // Cameron Diaz's properties
            ['id' => 18, 'owner_id' => 11, 'address' => '7777, Walnut Road, Minneapolis', 'home_type' => 'studio', 'price' => 95.00, 'has_tv' => 0, 'has_internet' => 1, 'has_kitchen' => 0, 'has_air_con' => 0],

            // Julia Roberts' properties
            ['id' => 19, 'owner_id' => 12, 'address' => '8888, Cherry Drive, Detroit', 'home_type' => 'apartment', 'price' => 130.00, 'has_tv' => 1, 'has_internet' => 1, 'has_kitchen' => 1, 'has_air_con' => 0],

            // Will Smith's properties
            ['id' => 20, 'owner_id' => 13, 'address' => '9999, Magnolia Lane, Tampa', 'home_type' => 'house', 'price' => 380.00, 'has_tv' => 1, 'has_internet' => 1, 'has_kitchen' => 1, 'has_air_con' => 1],
        ];

        DB::connection('sandbox_template')->table('housing_rooms')->insert($rooms);

        // 3. БРОНИРОВАНИЯ (RESERVATIONS)
        $reservations = [
            // 2023 bookings
            ['id' => 1, 'user_id' => 2, 'room_id' => 1, 'start_date' => '2023-05-01', 'end_date' => '2023-05-05', 'total' => 600.00],
            ['id' => 2, 'user_id' => 3, 'room_id' => 1, 'start_date' => '2023-06-10', 'end_date' => '2023-06-15', 'total' => 750.00],
            ['id' => 3, 'user_id' => 4, 'room_id' => 2, 'start_date' => '2023-07-01', 'end_date' => '2023-07-10', 'total' => 2250.00],
            ['id' => 4, 'user_id' => 5, 'room_id' => 3, 'start_date' => '2023-08-15', 'end_date' => '2023-08-20', 'total' => 500.00],
            ['id' => 5, 'user_id' => 6, 'room_id' => 4, 'start_date' => '2023-09-05', 'end_date' => '2023-09-12', 'total' => 1260.00],
            ['id' => 6, 'user_id' => 7, 'room_id' => 5, 'start_date' => '2023-10-20', 'end_date' => '2023-10-25', 'total' => 1500.00],
            ['id' => 7, 'user_id' => 8, 'room_id' => 6, 'start_date' => '2023-11-01', 'end_date' => '2023-11-07', 'total' => 720.00],
            ['id' => 8, 'user_id' => 9, 'room_id' => 7, 'start_date' => '2023-12-15', 'end_date' => '2023-12-20', 'total' => 450.00],

            // 2024 bookings
            ['id' => 9, 'user_id' => 10, 'room_id' => 8, 'start_date' => '2024-01-05', 'end_date' => '2024-01-12', 'total' => 2450.00],
            ['id' => 10, 'user_id' => 11, 'room_id' => 9, 'start_date' => '2024-02-14', 'end_date' => '2024-02-21', 'total' => 1120.00],
            ['id' => 11, 'user_id' => 12, 'room_id' => 10, 'start_date' => '2024-03-10', 'end_date' => '2024-03-15', 'total' => 400.00],
            ['id' => 12, 'user_id' => 13, 'room_id' => 11, 'start_date' => '2024-04-01', 'end_date' => '2024-04-08', 'total' => 980.00],
            ['id' => 13, 'user_id' => 14, 'room_id' => 12, 'start_date' => '2024-05-20', 'end_date' => '2024-05-30', 'total' => 4000.00],
            ['id' => 14, 'user_id' => 15, 'room_id' => 13, 'start_date' => '2024-06-15', 'end_date' => '2024-06-22', 'total' => 1400.00],
            ['id' => 15, 'user_id' => 1, 'room_id' => 14, 'start_date' => '2024-07-01', 'end_date' => '2024-07-05', 'total' => 440.00],
            ['id' => 16, 'user_id' => 2, 'room_id' => 15, 'start_date' => '2024-08-10', 'end_date' => '2024-08-17', 'total' => 1960.00],
            ['id' => 17, 'user_id' => 3, 'room_id' => 16, 'start_date' => '2024-09-05', 'end_date' => '2024-09-12', 'total' => 1190.00],
            ['id' => 18, 'user_id' => 4, 'room_id' => 17, 'start_date' => '2024-10-20', 'end_date' => '2024-10-27', 'total' => 2240.00],
            ['id' => 19, 'user_id' => 5, 'room_id' => 18, 'start_date' => '2024-11-01', 'end_date' => '2024-11-04', 'total' => 285.00],
            ['id' => 20, 'user_id' => 6, 'room_id' => 19, 'start_date' => '2024-12-15', 'end_date' => '2024-12-22', 'total' => 910.00],
        ];

        DB::connection('sandbox_template')->table('reservations')->insert($reservations);

        // 4. ОТЗЫВЫ (REVIEWS)
        $reviews = [
            ['id' => 1, 'reservation_id' => 1, 'rating' => 5],
            ['id' => 2, 'reservation_id' => 2, 'rating' => 4],
            ['id' => 3, 'reservation_id' => 3, 'rating' => 5],
            ['id' => 4, 'reservation_id' => 4, 'rating' => 3],
            ['id' => 5, 'reservation_id' => 5, 'rating' => 4],
            ['id' => 6, 'reservation_id' => 6, 'rating' => 5],
            ['id' => 7, 'reservation_id' => 7, 'rating' => 4],
            ['id' => 8, 'reservation_id' => 8, 'rating' => 3],
            ['id' => 9, 'reservation_id' => 9, 'rating' => 5],
            ['id' => 10, 'reservation_id' => 10, 'rating' => 4],
            ['id' => 11, 'reservation_id' => 11, 'rating' => 2],
            ['id' => 12, 'reservation_id' => 12, 'rating' => 4],
            ['id' => 13, 'reservation_id' => 13, 'rating' => 5],
            ['id' => 14, 'reservation_id' => 14, 'rating' => 5],
            ['id' => 15, 'reservation_id' => 15, 'rating' => 3],
            ['id' => 16, 'reservation_id' => 16, 'rating' => 4],
            ['id' => 17, 'reservation_id' => 17, 'rating' => 5],
            ['id' => 18, 'reservation_id' => 18, 'rating' => 4],
            ['id' => 19, 'reservation_id' => 19, 'rating' => 3],
            ['id' => 20, 'reservation_id' => 20, 'rating' => 5],
        ];

        DB::connection('sandbox_template')->table('reviews')->insert($reviews);

        $this->command->info('✅ Housing data seeded successfully!');
    }
}
