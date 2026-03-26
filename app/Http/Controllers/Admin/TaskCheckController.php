<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Services\SqlCheckerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskCheckController extends Controller
{
    public function __construct(
        private SqlCheckerService $checker
    ) {}

    /**
     * POST /api/tasks/{task}/check
     */
    public function check(Request $request, Task $task): JsonResponse
    {
        $request->validate([
            'sql' => 'required|string|max:5000',
        ]);

        // 🔒 Проверка доступа (платная задача)
        if (!$task->is_free && !$request->user()?->hasSubscription()) {
            return response()->json([
                'status'  => 'error',
                'message' => '❌ Эта задача доступна только по подписке',
            ], 403);
        }

        $result = $this->checker->check($task, $request->input('sql'));

        $statusCode = $result['status'] === 'ok' ? 200 : 422;

        return response()->json($result, $statusCode);
    }
}
