<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamilyBudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('sandbox_template')->statement('SET FOREIGN_KEY_CHECKS=0;');

        // Очистить таблицы перед заполнением
        DB::connection('sandbox_template')->table('payments')->truncate();
        DB::connection('sandbox_template')->table('goods')->truncate();
        DB::connection('sandbox_template')->table('family_members')->truncate();
        DB::connection('sandbox_template')->table('good_types')->truncate();

        // Включить обратно проверку foreign keys
        DB::connection('sandbox_template')->statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. ТИПЫ ТОВАРОВ
        $goodTypes = [
            ['id' => 1, 'name' => 'food'],
            ['id' => 2, 'name' => 'entertainment'],
            ['id' => 3, 'name' => 'delicacies'],
            ['id' => 4, 'name' => 'clothes'],
            ['id' => 5, 'name' => 'household'],
        ];

        DB::connection('sandbox_template')->table('good_types')->insert($goodTypes);

        // 2. ТОВАРЫ
        $goods = [
            // Food
            ['id' => 1, 'name' => 'potato', 'type_id' => 1],
            ['id' => 2, 'name' => 'bread', 'type_id' => 1],
            ['id' => 3, 'name' => 'milk', 'type_id' => 1],
            ['id' => 4, 'name' => 'eggs', 'type_id' => 1],
            ['id' => 5, 'name' => 'chicken', 'type_id' => 1],
            ['id' => 6, 'name' => 'apples', 'type_id' => 1],

            // Entertainment
            ['id' => 7, 'name' => 'cinema tickets', 'type_id' => 2],
            ['id' => 8, 'name' => 'theater tickets', 'type_id' => 2],
            ['id' => 9, 'name' => 'concert tickets', 'type_id' => 2],

            // Delicacies
            ['id' => 10, 'name' => 'red caviar', 'type_id' => 3],
            ['id' => 11, 'name' => 'black caviar', 'type_id' => 3],
            ['id' => 12, 'name' => 'salmon', 'type_id' => 3],
            ['id' => 13, 'name' => 'oysters', 'type_id' => 3],

            // Clothes
            ['id' => 14, 'name' => 'jeans', 'type_id' => 4],
            ['id' => 15, 'name' => 't-shirt', 'type_id' => 4],
            ['id' => 16, 'name' => 'sneakers', 'type_id' => 4],
            ['id' => 17, 'name' => 'jacket', 'type_id' => 4],

            // Household
            ['id' => 18, 'name' => 'detergent', 'type_id' => 5],
            ['id' => 19, 'name' => 'soap', 'type_id' => 5],
            ['id' => 20, 'name' => 'toilet paper', 'type_id' => 5],
        ];

        DB::connection('sandbox_template')->table('goods')->insert($goods);

        // 3. ЧЛЕНЫ СЕМЬИ (как на SQL Academy - семья Quincey)
        $familyMembers = [
            ['id' => 1, 'status' => 'father', 'name' => 'Headley Quincey', 'birthday' => '1960-05-13'],
            ['id' => 2, 'status' => 'mother', 'name' => 'Flavia Quincey', 'birthday' => '1963-02-16'],
            ['id' => 3, 'status' => 'son', 'name' => 'Andie Quincey', 'birthday' => '1983-06-05'],
            ['id' => 4, 'status' => 'son', 'name' => 'Lela Quincey', 'birthday' => '1985-06-07'],
            ['id' => 5, 'status' => 'daughter', 'name' => 'Annie Quincey', 'birthday' => '1988-04-10'],
        ];

        DB::connection('sandbox_template')->table('family_members')->insert($familyMembers);

        // 4. ПОКУПКИ (PAYMENTS) - данные за 2005 год как на SQL Academy
        $payments = [
            // Январь 2005
            ['family_member_id' => 1, 'good_id' => 1, 'amount' => 4.00, 'unit_price' => 1.50, 'payment_date' => '2005-01-12'],
            ['family_member_id' => 1, 'good_id' => 2, 'amount' => 2.00, 'unit_price' => 2.20, 'payment_date' => '2005-01-15'],
            ['family_member_id' => 2, 'good_id' => 3, 'amount' => 3.00, 'unit_price' => 3.50, 'payment_date' => '2005-01-18'],
            ['family_member_id' => 3, 'good_id' => 1, 'amount' => 2.00, 'unit_price' => 1.50, 'payment_date' => '2005-01-22'],

            // Февраль 2005
            ['family_member_id' => 2, 'good_id' => 4, 'amount' => 1.00, 'unit_price' => 4.80, 'payment_date' => '2005-02-05'],
            ['family_member_id' => 1, 'good_id' => 5, 'amount' => 3.00, 'unit_price' => 7.50, 'payment_date' => '2005-02-10'],
            ['family_member_id' => 4, 'good_id' => 6, 'amount' => 2.00, 'unit_price' => 5.00, 'payment_date' => '2005-02-14'],
            ['family_member_id' => 2, 'good_id' => 7, 'amount' => 2.00, 'unit_price' => 10.00, 'payment_date' => '2005-02-20'],

            // Март 2005
            ['family_member_id' => 1, 'good_id' => 2, 'amount' => 3.00, 'unit_price' => 2.20, 'payment_date' => '2005-03-08'],
            ['family_member_id' => 3, 'good_id' => 8, 'amount' => 2.00, 'unit_price' => 15.00, 'payment_date' => '2005-03-12'],
            ['family_member_id' => 2, 'good_id' => 1, 'amount' => 5.00, 'unit_price' => 1.50, 'payment_date' => '2005-03-18'],

            // Апрель 2005 - деликатесы
            ['family_member_id' => 2, 'good_id' => 10, 'amount' => 1.00, 'unit_price' => 35.00, 'payment_date' => '2005-04-05'],
            ['family_member_id' => 1, 'good_id' => 11, 'amount' => 1.00, 'unit_price' => 80.00, 'payment_date' => '2005-04-08'],
            ['family_member_id' => 2, 'good_id' => 12, 'amount' => 2.00, 'unit_price' => 25.00, 'payment_date' => '2005-04-15'],

            // Май 2005
            ['family_member_id' => 1, 'good_id' => 3, 'amount' => 4.00, 'unit_price' => 3.50, 'payment_date' => '2005-05-10'],
            ['family_member_id' => 5, 'good_id' => 14, 'amount' => 1.00, 'unit_price' => 45.00, 'payment_date' => '2005-05-20'],
            ['family_member_id' => 3, 'good_id' => 15, 'amount' => 1.00, 'unit_price' => 12.00, 'payment_date' => '2005-05-25'],

            // Июнь 2005 (важная дата для заданий)
            ['family_member_id' => 1, 'good_id' => 1, 'amount' => 3.00, 'unit_price' => 1.50, 'payment_date' => '2005-06-05'],
            ['family_member_id' => 2, 'good_id' => 9, 'amount' => 3.00, 'unit_price' => 20.00, 'payment_date' => '2005-06-10'],
            ['family_member_id' => 3, 'good_id' => 5, 'amount' => 2.00, 'unit_price' => 7.50, 'payment_date' => '2005-06-15'],
            ['family_member_id' => 4, 'good_id' => 16, 'amount' => 1.00, 'unit_price' => 55.00, 'payment_date' => '2005-06-20'],

            // Июль 2005
            ['family_member_id' => 2, 'good_id' => 4, 'amount' => 2.00, 'unit_price' => 4.80, 'payment_date' => '2005-07-08'],
            ['family_member_id' => 1, 'good_id' => 18, 'amount' => 2.00, 'unit_price' => 3.00, 'payment_date' => '2005-07-12'],
            ['family_member_id' => 2, 'good_id' => 19, 'amount' => 3.00, 'unit_price' => 1.80, 'payment_date' => '2005-07-18'],

            // Август 2005
            ['family_member_id' => 1, 'good_id' => 2, 'amount' => 4.00, 'unit_price' => 2.20, 'payment_date' => '2005-08-05'],
            ['family_member_id' => 3, 'good_id' => 6, 'amount' => 3.00, 'unit_price' => 5.00, 'payment_date' => '2005-08-10'],
            ['family_member_id' => 5, 'good_id' => 17, 'amount' => 1.00, 'unit_price' => 65.00, 'payment_date' => '2005-08-15'],

            // Сентябрь 2005
            ['family_member_id' => 2, 'good_id' => 1, 'amount' => 6.00, 'unit_price' => 1.50, 'payment_date' => '2005-09-03'],
            ['family_member_id' => 1, 'good_id' => 10, 'amount' => 1.00, 'unit_price' => 35.00, 'payment_date' => '2005-09-10'],
            ['family_member_id' => 4, 'good_id' => 7, 'amount' => 4.00, 'unit_price' => 10.00, 'payment_date' => '2005-09-18'],

            // Октябрь 2005
            ['family_member_id' => 1, 'good_id' => 5, 'amount' => 4.00, 'unit_price' => 7.50, 'payment_date' => '2005-10-05'],
            ['family_member_id' => 2, 'good_id' => 20, 'amount' => 2.00, 'unit_price' => 2.50, 'payment_date' => '2005-10-12'],
            ['family_member_id' => 3, 'good_id' => 3, 'amount' => 3.00, 'unit_price' => 3.50, 'payment_date' => '2005-10-20'],

            // Ноябрь 2005
            ['family_member_id' => 1, 'good_id' => 1, 'amount' => 5.00, 'unit_price' => 1.50, 'payment_date' => '2005-11-08'],
            ['family_member_id' => 2, 'good_id' => 8, 'amount' => 2.00, 'unit_price' => 15.00, 'payment_date' => '2005-11-15'],

            // Декабрь 2005
            ['family_member_id' => 1, 'good_id' => 11, 'amount' => 1.00, 'unit_price' => 80.00, 'payment_date' => '2005-12-20'],
            ['family_member_id' => 2, 'good_id' => 13, 'amount' => 2.00, 'unit_price' => 30.00, 'payment_date' => '2005-12-22'],
            ['family_member_id' => 3, 'good_id' => 9, 'amount' => 4.00, 'unit_price' => 20.00, 'payment_date' => '2005-12-28'],
        ];

        DB::connection('sandbox_template')->table('payments')->insert($payments);

        $this->command->info('✅ Family Budget data seeded successfully!');
    }
}
