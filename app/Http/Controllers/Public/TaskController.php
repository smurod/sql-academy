<?php

namespace App\Http\Controllers\Public;

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

    // app/Http/Controllers/TaskController.php

    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Task::query();

        // ===== ПОИСК =====
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('task_number', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // ===== ФИЛЬТР ПО СТАТУСУ =====
        $status = $request->input('status', 'all');

        if ($user) {
            $solvedTaskIds = TaskSolution::where('user_id', $user->id)
                ->where('status', 'solved')
                ->pluck('task_id')
                ->toArray();

            if ($status === 'solved') {
                $query->whereIn('id', $solvedTaskIds);
            } elseif ($status === 'unsolved') {
                $query->whereNotIn('id', $solvedTaskIds);
            }
        }

        // ===== ФИЛЬТР ПО КАТЕГОРИИ =====
        $category = $request->input('category', 'all');

        $categoryFilters = [
            'select'    => function ($q) {
                $q->where('sql_type', 'select');
            },
            'join'      => function ($q) {
                $q->where(function ($sub) {
                    $sub->where('tags', 'LIKE', '%JOIN%')
                        ->orWhere('description', 'LIKE', '%JOIN%');
                });
            },
            'aggregate' => function ($q) {
                $q->where(function ($sub) {
                    $sub->where('tags', 'LIKE', '%Aggregate%')
                        ->orWhere('description', 'LIKE', '%COUNT%')
                        ->orWhere('description', 'LIKE', '%SUM%')
                        ->orWhere('description', 'LIKE', '%AVG%')
                        ->orWhere('description', 'LIKE', '%MIN%')
                        ->orWhere('description', 'LIKE', '%MAX%');
                });
            },
            'subquery'  => function ($q) {
                $q->where(function ($sub) {
                    $sub->where('tags', 'LIKE', '%Subquery%')
                        ->orWhere('tags', 'LIKE', '%NOT EXISTS%')
                        ->orWhere('tags', 'LIKE', '%NOT IN%')
                        ->orWhere('description', 'LIKE', '%подзапрос%');
                });
            },
            'dml'       => function ($q) {
                $q->whereIn('sql_type', ['insert', 'update', 'delete']);
            },
            'window'    => function ($q) {
                $q->where(function ($sub) {
                    $sub->where('tags', 'LIKE', '%Window%')
                        ->orWhere('description', 'LIKE', '%ROW_NUMBER%')
                        ->orWhere('description', 'LIKE', '%RANK%')
                        ->orWhere('description', 'LIKE', '%LAG%')
                        ->orWhere('description', 'LIKE', '%LEAD%')
                        ->orWhere('description', 'LIKE', '%NTILE%');
                });
            },
        ];

        if ($category !== 'all' && isset($categoryFilters[$category])) {
            $categoryFilters[$category]($query);
        }

        // ===== ПОДСЧЁТ ДЛЯ ТАБОВ =====
        $categoryCounts = $this->getCategoryCounts();

        // ===== ПОДСЧЁТ ДЛЯ СТАТУСОВ =====
        $statusCounts = $this->getStatusCounts($user);

        // ===== ПАГИНАЦИЯ =====
        $tasks = $query->orderBy('task_order')->paginate(10)
            ->appends($request->query());

        // ===== ПРОГРЕСС =====
        $totalTasks    = Task::count();
        $solvedCount   = $user ? count($solvedTaskIds ?? []) : 0;
        $progressPercent = $totalTasks > 0
            ? round(($solvedCount / $totalTasks) * 100)
            : 0;

        return view('public.tasks.index', compact(
            'tasks',
            'totalTasks',
            'solvedCount',
            'progressPercent',
            'search',
            'status',
            'category',
            'categoryCounts',
            'statusCounts',
            'solvedTaskIds'
        ));
    }

    private function getCategoryCounts(): array
    {
        return [
            'all'       => Task::count(),
            'select'    => Task::where('sql_type', 'select')->count(),
            'join'      => Task::where(function ($q) {
                $q->where('tags', 'LIKE', '%JOIN%')
                    ->orWhere('description', 'LIKE', '%JOIN%');
            })->count(),
            'aggregate' => Task::where(function ($q) {
                $q->where('tags', 'LIKE', '%Aggregate%')
                    ->orWhere('description', 'LIKE', '%COUNT%')
                    ->orWhere('description', 'LIKE', '%SUM%')
                    ->orWhere('description', 'LIKE', '%AVG%');
            })->count(),
            'subquery'  => Task::where(function ($q) {
                $q->where('tags', 'LIKE', '%Subquery%')
                    ->orWhere('tags', 'LIKE', '%NOT EXISTS%')
                    ->orWhere('description', 'LIKE', '%подзапрос%');
            })->count(),
            'dml'       => Task::whereIn('sql_type', ['insert', 'update', 'delete'])->count(),
            'window'    => Task::where(function ($q) {
                $q->where('tags', 'LIKE', '%Window%')
                    ->orWhere('description', 'LIKE', '%ROW_NUMBER%')
                    ->orWhere('description', 'LIKE', '%RANK%');
            })->count(),
        ];
    }

    private function getStatusCounts($user): array
    {
        $total = Task::count();

        if (!$user) {
            return ['all' => $total, 'solved' => 0, 'unsolved' => $total];
        }

        $solved = TaskSolution::where('user_id', $user->id)
            ->where('status', 'solved')
            ->count();

        return [
            'all'      => $total,
            'solved'   => $solved,
            'unsolved' => $total - $solved,
        ];
    }

    public function show(Task $task)
    {
        $schema = $this->getSchemaForTask($task);
        return view('public.tasks.show', compact('task', 'schema'));
    }

    public function check(Request $request, Task $task): JsonResponse
    {
        $request->validate([
            'sql' => 'required|string|max:5000',
        ]);

        $result = $this->checker->check($task, $request->input('sql'));

        return response()->json($result);
    }

    public function run(Request $request, Task $task): JsonResponse
    {
        $request->validate([
            'sql' => 'required|string|max:5000',
        ]);

        $sql = trim($request->input('sql'));

        if (!preg_match('/^\s*select/i', $sql)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Для просмотра данных используйте SELECT',
            ]);
        }

        if (preg_match('/\b(drop|alter|truncate|create|rename|grant|revoke)\b/i', $sql)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Запрещённая SQL-команда',
            ]);
        }

        try {
            $conn = DB::connection('sandbox_template');
            $rows = $conn->select($sql);

            return response()->json([
                'status' => 'ok',
                'rows' => $rows,
                'count' => count($rows),
                'columns' => count($rows) > 0 ? array_keys((array)$rows[0]) : [],
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    private function getSchemaForTask(Task $task): array
    {
        $conn = DB::connection('sandbox_template');

        $schemaMap = [
            'airlines' => [
                'Passenger' => 'passengers',
                'Company' => 'companies',
                'Trip' => 'trips',
                'Pass_in_trip' => 'pass_in_trip',
            ],
            'family' => [
                'FamilyMembers' => 'family_members',
                'Goods' => 'goods',
                'GoodTypes' => 'good_types',
                'Payments' => 'payments',
            ],
            'school' => [
                'Student' => 'students',
                'Class' => 'classes',
                'Student_in_class' => 'student_in_class',
                'Schedule' => 'schedules',
                'Subject' => 'subjects',
                'Teacher' => 'teachers',
                'Timepair' => 'Timepair',
            ],
            'booking' => [
                'Rooms' => 'housing_rooms',
                'Users' => 'housing_users',
                'Reservations' => 'reservations',
                'Reviews' => 'reviews',
            ],
        ];

        $tables = $schemaMap[$task->database_schema] ?? [];
        $schema = [];

        foreach ($tables as $viewName => $realTable) {
            try {
                $columns = $conn->select("SHOW COLUMNS FROM `{$realTable}`");
                $schema[$viewName] = array_map(function ($col) {
                    return [
                        'name' => $col->Field,
                        'type' => $col->Type,
                        'key' => $col->Key,
                        'nullable' => $col->Null === 'YES',
                    ];
                }, $columns);
            } catch (\Throwable $e) {
                // skip
            }
        }

        return $schema;
    }
}
