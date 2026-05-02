<?php

namespace App\Http\Controllers\Public;

use App\Models\UsersRating;
use Illuminate\Routing\Controller;
use App\Models\Task;
use App\Services\SqlCheckerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function __construct(
        private SqlCheckerService $checker
    ) {}

    public function index(Request $request)
    {
        $userId = auth()->id();

        // 1. Получаем ID решенных задач (уникальные)
        $solvedTaskIds = $userId
            ? UsersRating::where('user_id', $userId)
                ->where('type', 'task')
                ->distinct()
                ->pluck('source_id')
                ->toArray()
            : [];

        $solvedTasksCount = count($solvedTaskIds);

        // 2. Инициализируем фильтры
        $search = $request->input('search', '');
        $status = $request->input('status', 'all');
        $category = $request->input('category', 'all');

       $baseQuery = Task::query()->withCount(['solutions as solved_by_count' => function ($q) {
            $q->select(\DB::raw('count(distinct user_id)'));
        }]);
        if ($search) {
            $baseQuery->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('task_number', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // 4. Считаем СТАТУСЫ (только для найденных задач)
        $statusCounts = [
            'all'      => (clone $baseQuery)->count(),
            'solved'   => (clone $baseQuery)->whereIn('id', $solvedTaskIds)->count(),
            'unsolved' => (clone $baseQuery)->whereNotIn('id', $solvedTaskIds)->count(),
        ];

        // 5. Считаем КАТЕГОРИИ (только для найденных задач)
        // Это решит проблему, когда во вкладках висят пустые цифры
        $categoryCounts = $this->getDynamicCategoryCounts(clone $baseQuery);

        // 6. Применяем фильтр КАТЕГОРИИ к основному запросу
        if ($category !== 'all') {
            if ($category === 'dml') {
                $baseQuery->whereIn('sql_type', ['insert', 'update', 'delete']);
            } else {
                $baseQuery->where('sql_type', $category);
            }
        }

        // 7. Применяем фильтр СТАТУСА к основному запросу
        if ($status === 'solved') {
            $baseQuery->whereIn('id', $solvedTaskIds);
        } elseif ($status === 'unsolved') {
            $baseQuery->whereNotIn('id', $solvedTaskIds);
        }

        // 8. Финальная пагинация
        $tasks = $baseQuery->orderBy('task_order')
            ->paginate(10)
            ->appends($request->query());

        // Общий прогресс пользователя (по всей базе, не по поиску)
        $totalTasksGlobal = Task::count();
        $progressPercent = $totalTasksGlobal > 0
            ? round(($solvedTasksCount / $totalTasksGlobal) * 100)
            : 0;

        return view('public.tasks.index', [
            'tasks'            => $tasks,
            'totalTasks'       => $totalTasksGlobal,
            'solvedTasksCount' => $solvedTasksCount,
            'progressPercent'  => $progressPercent,
            'search'           => $search,
            'status'           => $status,
            'category'         => $category,
            'categoryCounts'   => $categoryCounts,
            'statusCounts'     => $statusCounts,
            'solvedTaskIds'    => $solvedTaskIds
        ]);
    }

    /**
     * Вспомогательный метод для подсчета количества задач в каждой категории с учетом поиска
     */
    private function getDynamicCategoryCounts($query)
    {
        $counts = $query->select('sql_type', \DB::raw('count(*) as total'))
            ->groupBy('sql_type')
            ->pluck('total', 'sql_type')
            ->toArray();

        return [
            'all'       => array_sum($counts),
            'select'    => $counts['select'] ?? 0,
            'join'      => $counts['join'] ?? 0,
            'aggregate' => $counts['aggregate'] ?? 0,
            'subquery'  => $counts['subquery'] ?? 0,
            'window'    => $counts['window'] ?? 0,
            'dml'       => ($counts['insert'] ?? 0) + ($counts['update'] ?? 0) + ($counts['delete'] ?? 0),
        ];
    }

    private function getCategoryCounts(): array
    {
        return [
            'all'       => Task::count(),
            'select'    => Task::where('sql_type', 'select')->count(),
            'join'      => Task::where(function ($q) {
                $q->where('tags', 'LIKE', '%JOIN%')->orWhere('description', 'LIKE', '%JOIN%');
            })->count(),
            'aggregate' => Task::where(function ($q) {
                $q->where('tags', 'LIKE', '%Aggregate%')
                    ->orWhere('description', 'LIKE', '%COUNT%')
                    ->orWhere('description', 'LIKE', '%SUM%');
            })->count(),
            'subquery'  => Task::where(function ($q) {
                $q->where('tags', 'LIKE', '%Subquery%')->orWhere('description', 'LIKE', '%подзапрос%');
            })->count(),
            'dml'       => Task::whereIn('sql_type', ['insert', 'update', 'delete'])->count(),
            'window'    => Task::where(function ($q) {
                $q->where('tags', 'LIKE', '%Window%')->orWhere('description', 'LIKE', '%RANK%');
            })->count(),
        ];
    }

    // ═══════════════════════════════════════════
    //  SHOW — Страница задачи
    // ═══════════════════════════════════════════

    public function show(Task $task)
    {
        // Предыдущая/следующая задача
        $prevTask = Task::where('task_order', '<', $task->task_order)
            ->orderBy('task_order', 'desc')->first();
        $nextTask = Task::where('task_order', '>', $task->task_order)
            ->orderBy('task_order', 'asc')->first();

        // Схема в ERD-формате (как в sandbox)
        $schemaData = $this->getErdSchemaForTask($task);

        return view('public.tasks.show', compact('task', 'prevTask', 'nextTask', 'schemaData'));
    }

    // ═══════════════════════════════════════════
    //  RUN — Выполнить запрос
    // ═══════════════════════════════════════════

    public function run(Request $request, Task $task): JsonResponse
    {
        $request->validate(['sql' => 'required|string|max:5000']);
        $sql = trim($request->input('sql'));

        if (!preg_match('/^\s*select/i', $sql)) {
            return response()->json(['status' => 'error', 'message' => 'Для просмотра данных используйте SELECT']);
        }

        if (preg_match('/\b(drop|alter|truncate|create|rename|grant|revoke)\b/i', $sql)) {
            return response()->json(['status' => 'error', 'message' => 'Запрещённая SQL-команда']);
        }

        try {
            $conn = DB::connection('sandbox_template');
            $start = microtime(true);
            $rows = $conn->select($sql);
            $time = round(microtime(true) - $start, 4);

            return response()->json([
                'status'  => 'ok',
                'rows'    => $rows,
                'count'   => count($rows),
                'columns' => count($rows) > 0 ? array_keys((array) $rows[0]) : [],
                'time'    => $time,
            ]);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // ═══════════════════════════════════════════
    //  CHECK — Проверить решение
    // ═══════════════════════════════════════════

    public function check(Request $request, Task $task): JsonResponse
    {
        $request->validate(['sql' => 'required|string|max:5000']);

        $result = $this->checker->check($task, $request->input('sql'));

        \Log::info('CHECK RESULT', ['status' => $result['status'] ?? 'no status', 'task_id' => $task->id]);

        if (($result['status'] ?? '') === 'ok') {
            $user = auth()->user();

            \Log::info('USER', ['user' => $user?->id ?? 'null']);

            if ($user) {
                $rating = UsersRating::firstOrCreate(
                    [
                        'user_id'   => $user->id,
                        'type'      => 'task',
                        'source_id' => $task->id,
                    ],
                    [
                        'xp' => $task->points ?? 10,
                    ]
                );

                \Log::info('RATING SAVED', ['id' => $rating->id, 'wasRecentlyCreated' => $rating->wasRecentlyCreated]);
            }

            try {
                $conn = DB::connection('sandbox_template');
                $sql = trim($request->input('sql'));
                if (preg_match('/^\s*select/i', $sql)) {
                    $rows = $conn->select($sql);
                    $result['rows']  = $rows;
                    $result['count'] = count($rows);
                }
            } catch (\Throwable $e) {
                // не критично
            }
        }

        return response()->json($result);
    }

    private const SCHEMA_TABLES = [
        'aviation' => ['passengers', 'companies', 'trips', 'pass_in_trip'],
        'family'   => ['family_members', 'goods', 'good_types', 'payments'],
        'schedule' => ['students', 'classes', 'student_in_class', 'schedules', 'subjects', 'teachers'],
        'booking'  => ['housing_rooms', 'housing_users', 'reservations', 'reviews'],
    ];

    private const SCHEMA_META = [
        'aviation' => ['name' => 'Авиаперелёты', 'icon' => '✈️'],
        'family'   => ['name' => 'Семья',        'icon' => '👨‍👩‍👧‍👦'],
        'schedule' => ['name' => 'Школа',        'icon' => '🎓'],
        'booking'  => ['name' => 'Аренда жилья', 'icon' => '🏠'],
    ];
    /**
     * Получить ERD-данные для задачи (формат как в sandbox)
     */
    public function getErdSchemaForTask(Task $task): array
    {
        $schemaKey = $task->database_schema;
        $realTables = self::SCHEMA_TABLES[$schemaKey] ?? [];
        $meta = self::SCHEMA_META[$schemaKey] ?? ['name' => $schemaKey, 'icon' => '📁'];

        if (empty($realTables)) {
            return ['name' => $meta['name'], 'icon' => $meta['icon'], 'tables' => []];
        }

        $sandboxDb = config('database.connections.sandbox_template.database', 'sql_academy_sandbox_template');
        $placeholders = implode(',', array_fill(0, count($realTables), '?'));

        // 1. Все колонки
        $columns = DB::select("
            SELECT TABLE_NAME, COLUMN_NAME, COLUMN_TYPE, IS_NULLABLE, COLUMN_KEY, ORDINAL_POSITION
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_SCHEMA = ? AND TABLE_NAME IN ({$placeholders})
            ORDER BY TABLE_NAME, ORDINAL_POSITION
        ", array_merge([$sandboxDb], $realTables));

        // 2. Все FK
        $fks = DB::select("
            SELECT TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
            FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
            WHERE TABLE_SCHEMA = ? AND TABLE_NAME IN ({$placeholders}) AND REFERENCED_TABLE_NAME IS NOT NULL
        ", array_merge([$sandboxDb], $realTables));

        $fkMap = [];
        foreach ($fks as $fk) {
            $fkMap[$fk->TABLE_NAME . '.' . $fk->COLUMN_NAME] = [
                'table'  => $fk->REFERENCED_TABLE_NAME,
                'column' => $fk->REFERENCED_COLUMN_NAME,
            ];
        }

        // 3. Группируем колонки по таблицам
        $grouped = [];
        foreach ($columns as $col) {
            $grouped[$col->TABLE_NAME][] = $col;
        }

        // 4. Собираем в ERD-формат (реальные имена таблиц!)
        $tables = [];
        foreach ($realTables as $tableName) {
            if (!isset($grouped[$tableName])) continue;

            $cols = [];
            foreach ($grouped[$tableName] as $col) {
                $isPK = $col->COLUMN_KEY === 'PRI';
                $fkLookup = $tableName . '.' . $col->COLUMN_NAME;
                $isFK = isset($fkMap[$fkLookup]);

                $key = null;
                if ($isPK && $isFK) $key = 'pk_fk';
                elseif ($isPK) $key = 'pk';
                elseif ($isFK) $key = 'fk';

                $fkTo = null;
                if ($isFK) {
                    $fkTo = $fkMap[$fkLookup]; // уже реальные имена
                }

                $cols[] = [
                    'name'     => $col->COLUMN_NAME,
                    'type'     => $col->COLUMN_TYPE,
                    'key'      => $key,
                    'nullable' => $col->IS_NULLABLE === 'YES',
                    'fk_to'    => $fkTo,
                ];
            }

            $tables[] = [
                'name'    => $tableName,
                'columns' => $cols,
            ];
        }

        return [
            'name'   => $meta['name'],
            'icon'   => $meta['icon'],
            'tables' => $tables,
        ];
    }
}
