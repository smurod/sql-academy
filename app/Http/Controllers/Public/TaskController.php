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

    public function index()
    {
        $tasks = Task::orderBy('id')->get();
        return view('public.tasks.index', compact('tasks'));
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
