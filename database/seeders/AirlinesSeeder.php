<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirlinesSeeder extends Seeder
{
    public function run(): void
    {
        // Отключить проверку foreign keys
        DB::connection('sandbox_template')->statement('SET FOREIGN_KEY_CHECKS=0;');

        // Очистить таблицы
        DB::connection('sandbox_template')->table('pass_in_trip')->truncate();
        DB::connection('sandbox_template')->table('passengers')->truncate();
        DB::connection('sandbox_template')->table('trips')->truncate();
        DB::connection('sandbox_template')->table('companies')->truncate();

        // Включить обратно проверку foreign keys
        DB::connection('sandbox_template')->statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. АВИАКОМПАНИИ (как на SQL Academy)
        $companies = [
            ['id' => 1, 'name' => 'Don_avia'],
            ['id' => 2, 'name' => 'Aeroflot'],
            ['id' => 3, 'name' => 'Dale_avia'],
            ['id' => 4, 'name' => 'air_France'],
            ['id' => 5, 'name' => 'British_AW'],
        ];

        DB::connection('sandbox_template')->table('companies')->insert($companies);

        // 2. РЕЙСЫ (trips)
        $trips = [
            // Don_avia рейсы
            ['id' => 1, 'company_id' => 1, 'plane' => 'Boeing 737-300', 'town_from' => 'Rostov', 'town_to' => 'Paris', 'time_out' => '10:00:00', 'time_in' => '14:00:00'],
            ['id' => 2, 'company_id' => 1, 'plane' => 'Boeing 737-300', 'town_from' => 'Paris', 'town_to' => 'Rostov', 'time_out' => '08:00:00', 'time_in' => '12:00:00'],
            ['id' => 3, 'company_id' => 1, 'plane' => 'TU-154', 'town_from' => 'Rostov', 'town_to' => 'Moscow', 'time_out' => '11:00:00', 'time_in' => '13:00:00'],
            ['id' => 4, 'company_id' => 1, 'plane' => 'TU-154', 'town_from' => 'Moscow', 'town_to' => 'Rostov', 'time_out' => '17:00:00', 'time_in' => '19:00:00'],
            ['id' => 5, 'company_id' => 1, 'plane' => 'Boeing 757-300', 'town_from' => 'Rostov', 'town_to' => 'Vladivostok', 'time_out' => '09:00:00', 'time_in' => '18:00:00'],
            ['id' => 6, 'company_id' => 1, 'plane' => 'Boeing 757-300', 'town_from' => 'Vladivostok', 'town_to' => 'Rostov', 'time_out' => '11:00:00', 'time_in' => '20:00:00'],

            // Aeroflot рейсы
            ['id' => 7, 'company_id' => 2, 'plane' => 'Airbus A320', 'town_from' => 'Moscow', 'town_to' => 'Rostov', 'time_out' => '12:00:00', 'time_in' => '14:00:00'],
            ['id' => 8, 'company_id' => 2, 'plane' => 'Airbus A320', 'town_from' => 'Rostov', 'town_to' => 'Moscow', 'time_out' => '16:00:00', 'time_in' => '18:00:00'],
            ['id' => 9, 'company_id' => 2, 'plane' => 'TU-134', 'town_from' => 'Moscow', 'town_to' => 'Paris', 'time_out' => '10:30:00', 'time_in' => '13:30:00'],
            ['id' => 10, 'company_id' => 2, 'plane' => 'TU-134', 'town_from' => 'Paris', 'town_to' => 'Moscow', 'time_out' => '09:00:00', 'time_in' => '12:00:00'],

            // Dale_avia рейсы
            ['id' => 11, 'company_id' => 3, 'plane' => 'Boeing 767-300', 'town_from' => 'Moscow', 'town_to' => 'London', 'time_out' => '18:00:00', 'time_in' => '20:00:00'],
            ['id' => 12, 'company_id' => 3, 'plane' => 'Boeing 767-300', 'town_from' => 'London', 'town_to' => 'Moscow', 'time_out' => '16:00:00', 'time_in' => '21:00:00'],
            ['id' => 13, 'company_id' => 3, 'plane' => 'Boeing 737-300', 'town_from' => 'Moscow', 'town_to' => 'Paris', 'time_out' => '11:00:00', 'time_in' => '13:00:00'],

            // air_France рейсы
            ['id' => 14, 'company_id' => 4, 'plane' => 'Airbus A380', 'town_from' => 'Paris', 'town_to' => 'London', 'time_out' => '09:30:00', 'time_in' => '10:30:00'],
            ['id' => 15, 'company_id' => 4, 'plane' => 'Airbus A380', 'town_from' => 'London', 'town_to' => 'Paris', 'time_out' => '12:00:00', 'time_in' => '13:00:00'],
            ['id' => 16, 'company_id' => 4, 'plane' => 'Airbus A321', 'town_from' => 'Paris', 'town_to' => 'Rostov', 'time_out' => '14:00:00', 'time_in' => '18:00:00'],

            // British_AW рейсы
            ['id' => 17, 'company_id' => 5, 'plane' => 'Boeing 777-300', 'town_from' => 'London', 'town_to' => 'Vladivostok', 'time_out' => '10:00:00', 'time_in' => '22:00:00'],
            ['id' => 18, 'company_id' => 5, 'plane' => 'Boeing 777-300', 'town_from' => 'Vladivostok', 'town_to' => 'London', 'time_out' => '08:00:00', 'time_in' => '20:00:00'],
            ['id' => 19, 'company_id' => 5, 'plane' => 'Airbus A319', 'town_from' => 'London', 'town_to' => 'Paris', 'time_out' => '07:00:00', 'time_in' => '08:00:00'],
            ['id' => 20, 'company_id' => 5, 'plane' => 'Airbus A319', 'town_from' => 'Paris', 'town_to' => 'London', 'time_out' => '19:00:00', 'time_in' => '20:00:00'],
        ];

        DB::connection('sandbox_template')->table('trips')->insert($trips);

        // 3. ПАССАЖИРЫ
        $passengers = [
            ['id' => 1, 'name' => 'Bruce Willis'],
            ['id' => 2, 'name' => 'George Clooney'],
            ['id' => 3, 'name' => 'Kevin Costner'],
            ['id' => 4, 'name' => 'Donald Sutherland'],
            ['id' => 5, 'name' => 'Jennifer Lopez'],
            ['id' => 6, 'name' => 'Ray Liotta'],
            ['id' => 7, 'name' => 'Samuel L. Jackson'],
            ['id' => 8, 'name' => 'Nikole Kidman'],
            ['id' => 9, 'name' => 'Alan Rickman'],
            ['id' => 10, 'name' => 'Kurt Russell'],
            ['id' => 11, 'name' => 'Harrison Ford'],
            ['id' => 12, 'name' => 'Russell Crowe'],
            ['id' => 13, 'name' => 'Steve Martin'],
            ['id' => 14, 'name' => 'Michael Caine'],
            ['id' => 15, 'name' => 'Angelina Jolie'],
            ['id' => 16, 'name' => 'Mel Gibson'],
            ['id' => 17, 'name' => 'Michael Douglas'],
            ['id' => 18, 'name' => 'John Travolta'],
            ['id' => 19, 'name' => 'Sylvester Stallone'],
            ['id' => 20, 'name' => 'Tommy Lee Jones'],
            ['id' => 21, 'name' => 'Catherine Zeta-Jones'],
            ['id' => 22, 'name' => 'Antonio Banderas'],
            ['id' => 23, 'name' => 'Kim Basinger'],
            ['id' => 24, 'name' => 'Sam Neill'],
            ['id' => 25, 'name' => 'Gary Oldman'],
            ['id' => 26, 'name' => 'Clint Eastwood'],
            ['id' => 27, 'name' => 'Brad Pitt'],
            ['id' => 28, 'name' => 'Johnny Depp'],
            ['id' => 29, 'name' => 'Pierce Brosnan'],
            ['id' => 30, 'name' => 'Sean Connery'],
            ['id' => 31, 'name' => 'Bruce Willis'],
            ['id' => 37, 'name' => 'Mullah Omar'],
        ];

        DB::connection('sandbox_template')->table('passengers')->insert($passengers);

        // 4. БИЛЕТЫ (pass_in_trip)
        $passInTrip = [
            // Рейс 1: Rostov -> Paris
            ['passenger_id' => 1, 'trip_id' => 1, 'price' => '1100'],
            ['passenger_id' => 2, 'trip_id' => 1, 'price' => '1100'],
            ['passenger_id' => 3, 'trip_id' => 1, 'price' => '1100'],
            ['passenger_id' => 4, 'trip_id' => 1, 'price' => '1100'],

            // Рейс 2: Paris -> Rostov
            ['passenger_id' => 5, 'trip_id' => 2, 'price' => '1200'],
            ['passenger_id' => 6, 'trip_id' => 2, 'price' => '1200'],
            ['passenger_id' => 1, 'trip_id' => 2, 'price' => '1200'],

            // Рейс 3: Rostov -> Moscow
            ['passenger_id' => 7, 'trip_id' => 3, 'price' => '850'],
            ['passenger_id' => 8, 'trip_id' => 3, 'price' => '850'],
            ['passenger_id' => 9, 'trip_id' => 3, 'price' => '850'],
            ['passenger_id' => 10, 'trip_id' => 3, 'price' => '850'],

            // Рейс 4: Moscow -> Rostov
            ['passenger_id' => 11, 'trip_id' => 4, 'price' => '850'],
            ['passenger_id' => 12, 'trip_id' => 4, 'price' => '850'],
            ['passenger_id' => 7, 'trip_id' => 4, 'price' => '850'],

            // Рейс 5: Rostov -> Vladivostok
            ['passenger_id' => 13, 'trip_id' => 5, 'price' => '2500'],
            ['passenger_id' => 14, 'trip_id' => 5, 'price' => '2500'],
            ['passenger_id' => 15, 'trip_id' => 5, 'price' => '2500'],

            // Рейс 7: Moscow -> Rostov (Aeroflot)
            ['passenger_id' => 16, 'trip_id' => 7, 'price' => '900'],
            ['passenger_id' => 17, 'trip_id' => 7, 'price' => '900'],
            ['passenger_id' => 18, 'trip_id' => 7, 'price' => '900'],

            // Рейс 8: Rostov -> Moscow (Aeroflot)
            ['passenger_id' => 19, 'trip_id' => 8, 'price' => '900'],
            ['passenger_id' => 20, 'trip_id' => 8, 'price' => '900'],

            // Рейс 9: Moscow -> Paris (Aeroflot)
            ['passenger_id' => 21, 'trip_id' => 9, 'price' => '1500'],
            ['passenger_id' => 22, 'trip_id' => 9, 'price' => '1500'],
            ['passenger_id' => 23, 'trip_id' => 9, 'price' => '1500'],

            // Рейс 11: Moscow -> London
            ['passenger_id' => 24, 'trip_id' => 11, 'price' => '1300'],
            ['passenger_id' => 25, 'trip_id' => 11, 'price' => '1300'],

            // Рейс 13: Moscow -> Paris (Dale_avia)
            ['passenger_id' => 26, 'trip_id' => 13, 'price' => '1450'],
            ['passenger_id' => 27, 'trip_id' => 13, 'price' => '1450'],

            // Рейс 14: Paris -> London
            ['passenger_id' => 28, 'trip_id' => 14, 'price' => '850'],
            ['passenger_id' => 29, 'trip_id' => 14, 'price' => '850'],
            ['passenger_id' => 30, 'trip_id' => 14, 'price' => '850'],

            // Рейс 17: London -> Vladivostok
            ['passenger_id' => 31, 'trip_id' => 17, 'price' => '3500'],
            ['passenger_id' => 1, 'trip_id' => 17, 'price' => '3500'],

            // Рейс 19: London -> Paris
            ['passenger_id' => 37, 'trip_id' => 19, 'price' => '900'],
        ];

        DB::connection('sandbox_template')->table('pass_in_trip')->insert($passInTrip);

        $this->command->info('✅ Airlines data seeded successfully!');
    }
}
