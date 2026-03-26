<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\SqlSandboxService;

class SqlSandboxController extends Controller
{
    public function form()
    {
        $schemas = $this->getSchemas();
        return view('public.sandbox', compact('schemas'));
    }

    public function execute(Request $request)
    {
        $request->validate([
            'sql' => ['required', 'string'],
        ]);

        $result = app(SqlSandboxService::class)
            ->execute($request->input('sql'));

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($result);
        }

        $schemas = $this->getSchemas();
        return view('public.sandbox', [
            'result'  => $result,
            'sql'     => $request->input('sql'),
            'schemas' => $schemas,
        ]);
    }

    /**
     * Читает структуру из БД-песочницы sql_academy_sandbox_template
     */
    private function getSchemas(): array
    {
        // ── Читаем именно из БД-песочницы, НЕ из основной Laravel БД ──
        $sandboxDb = 'sql_academy_sandbox_template';

        // 1. Все колонки
        $columns = DB::select("
            SELECT
                c.TABLE_NAME,
                c.COLUMN_NAME,
                c.COLUMN_TYPE,
                c.IS_NULLABLE,
                c.COLUMN_KEY,
                c.ORDINAL_POSITION
            FROM INFORMATION_SCHEMA.COLUMNS c
            WHERE c.TABLE_SCHEMA = ?
            ORDER BY c.TABLE_NAME, c.ORDINAL_POSITION
        ", [$sandboxDb]);

        // 2. Все FK
        $fks = DB::select("
            SELECT
                k.TABLE_NAME,
                k.COLUMN_NAME,
                k.REFERENCED_TABLE_NAME,
                k.REFERENCED_COLUMN_NAME
            FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE k
            WHERE k.TABLE_SCHEMA = ?
              AND k.REFERENCED_TABLE_NAME IS NOT NULL
        ", [$sandboxDb]);

        $fkMap = [];
        foreach ($fks as $fk) {
            $key = $fk->TABLE_NAME . '.' . $fk->COLUMN_NAME;
            $fkMap[$key] = [
                'table'  => $fk->REFERENCED_TABLE_NAME,
                'column' => $fk->REFERENCED_COLUMN_NAME,
            ];
        }

        // 3. Собираем таблицы
        $tables = [];
        foreach ($columns as $col) {
            $tName = $col->TABLE_NAME;
            if (!isset($tables[$tName])) {
                $tables[$tName] = [
                    'name'    => $tName,
                    'columns' => [],
                ];
            }

            $key = null;
            $fkTo = null;
            $fkLookup = $tName . '.' . $col->COLUMN_NAME;

            if ($col->COLUMN_KEY === 'PRI') {
                $key = 'pk';
            }
            if (isset($fkMap[$fkLookup])) {
                $key = $key === 'pk' ? 'pk_fk' : 'fk';
                $fkTo = $fkMap[$fkLookup];
            }

            $tables[$tName]['columns'][] = [
                'name'     => $col->COLUMN_NAME,
                'type'     => $col->COLUMN_TYPE,
                'key'      => $key,
                'nullable' => $col->IS_NULLABLE === 'YES',
                'fk_to'    => $fkTo,
            ];
        }

        // 4. Исключаем служебные
        $excluded = ['migrations'];
        $tables = array_filter($tables, function ($t) use ($excluded) {
            return !in_array($t['name'], $excluded);
        });

        // 5. Маппинг таблица → схема
        $tableSchemaMap = [
            // Авиаперелёты
            'companies'    => 'aero',
            'trips'        => 'aero',
            'passengers'   => 'aero',
            'pass_in_trip' => 'aero',

            // Семья
            'family_members' => 'family',
            'payments'       => 'family',
            'goods'          => 'family',
            'good_types'     => 'family',

            // Школа
            'classes'          => 'school',
            'students'         => 'school',
            'teachers'         => 'school',
            'subjects'         => 'school',
            'schedules'        => 'school',
            'student_in_class' => 'school',
            'marks'            => 'school',

            // Аренда жилья
            'housing_users'  => 'housing',
            'housing_rooms'  => 'housing',
            'reservations'   => 'housing',
            'reviews'        => 'housing',
        ];

        $schemasMeta = [
            'aero'    => ['id' => 'aero',    'name' => 'Авиаперелёты',  'icon' => '✈️'],
            'family'  => ['id' => 'family',  'name' => 'Семья',         'icon' => '👨‍👩‍👧‍👦'],
            'school'  => ['id' => 'school',  'name' => 'Школа',         'icon' => '🎓'],
            'housing' => ['id' => 'housing', 'name' => 'Аренда жилья',  'icon' => '🏠'],
            'other'   => ['id' => 'other',   'name' => 'Прочее',        'icon' => '📁'],
        ];

        $schemas = [];

        foreach ($tables as $table) {
            $schemaId = $tableSchemaMap[$table['name']] ?? 'other';

            if (!isset($schemas[$schemaId])) {
                $meta = $schemasMeta[$schemaId] ?? $schemasMeta['other'];
                $schemas[$schemaId] = [
                    'id'     => $meta['id'],
                    'name'   => $meta['name'],
                    'icon'   => $meta['icon'],
                    'tables' => [],
                ];
            }

            $schemas[$schemaId]['tables'][] = $table;
        }

        // Убираем пустые
        $schemas = array_filter($schemas, fn($s) => count($s['tables']) > 0);

        // Сортируем
        $order = ['aero', 'family', 'school', 'housing', 'other'];
        $sorted = [];
        foreach ($order as $id) {
            if (isset($schemas[$id])) $sorted[] = $schemas[$id];
        }
        foreach ($schemas as $id => $s) {
            if (!in_array($id, $order)) $sorted[] = $s;
        }

        return $sorted;
    }
}
