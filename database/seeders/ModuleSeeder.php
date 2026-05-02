<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('modules')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $modules = [
            [
                'id'          => 1,
                'course_id'   => 1,
                'title'       => 'Введение',
                'slug'        => 'intro',
                'description' => 'В этом коротком модуле мы познакомимся с тем, как работает платформа данного курса, и узнаем, как получить максимум от него. А также получим информацию о нашем сообществе.',
                'order_index' => 0,
                'xp' => 15,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 2,
                'course_id'   => 1,
                'title'       => 'Фундаментальные основы',
                'slug'        => 'fundamentals',
                'description' => 'Этот модуль сделан для того, чтобы бегло ознакомиться с фундаментальными знаниями о базах данных и восполнить потенциальные пробелы. Также в этом модуле мы познакомимся с терминологией реляционных СУБД.',
                'order_index' => 1,
                'xp' => 15,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 3,
                'course_id'   => 1,
                'title'       => 'Основы выборки I',
                'slug'        => 'basic-selection-1',
                'description' => 'В рамках этого модуля мы научимся писать наши первые SQL запросы, разберёмся с такими важными понятиями, как условная выборка, сортировка и группировка данных.',
                'order_index' => 2,
                'xp' => 15,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 4,
                'course_id'   => 1,
                'title'       => 'Основы выборки II',
                'slug'        => 'basic-selection-2',
                'description' => 'Продолжаем составлять всё более сложные запросы на выборку: учимся получать данные из нескольких таблиц, писать подзапросы и знакомимся с обобщённым табличным выражением.',
                'order_index' => 3,
                'xp' => 15,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 5,
                'course_id'   => 1,
                'title'       => 'Манипулирование данными',
                'slug'        => 'data-manipulation',
                'description' => 'В предыдущих модулях мы учились составлять запросы только на получение выборки, теперь пришло время пошалить посерьёзнее: мы знакомимся с добавлением, обновлением и удалением записей.',
                'order_index' => 4,
                'xp' => 15,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 6,
                'course_id'   => 1,
                'title'       => 'Продвинутый SQL',
                'slug'        => 'advanced-sql',
                'description' => 'Приступим к изучению более продвинутых тем по SQL и углубимся в уже пройденные.',
                'order_index' => 5,
                'xp' => 15,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'id'          => 7,
                'course_id'   => 1,
                'title'       => 'Базы данных и таблицы',
                'slug'        => 'databases-and-tables',
                'description' => 'Пришло время поработать не только с уже готовыми базами данных, но и научиться создавать свои.',
                'order_index' => 6,
                'xp' => 15,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        DB::table('modules')->insert($modules);

        echo "✅ Модули созданы (" . count($modules) . " записей)\n";
    }
}
