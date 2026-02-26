<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class SqlSandboxService
{
    private function isAllowedSql(string $sql): bool
    {
        $sql = strtolower(trim($sql));

        // ❌ запрещаем всё опасное
        $forbidden = [
            'drop ',
            'alter ',
            'truncate ',
            'create ',
            'grant ',
            'revoke ',
        ];

        foreach ($forbidden as $word) {
            if (str_contains($sql, $word)) {
                return false;
            }
        }

        // ✅ разрешаем
        return preg_match('/^(select|update|delete|insert)/', $sql);
    }

    public function execute(string $sql): array
    {
        $sql = trim($sql);

        // ❌ Жёсткий запрет
        if ($this->isForbidden($sql)) {
            return $this->fail('Запрещённая SQL-команда');
        }

        // ✅ Только чтение
        if ($this->isReadOnly($sql)) {
            return $this->runSelect($sql);
        }

        // ⚠️ Изменение данных → rollback
        return $this->runWithRollback($sql);
    }

    // =====================

    private function runSelect(string $sql): array
    {
        try {
            $data = DB::connection('sandbox_template')->select($sql);

            return $this->success($data);
        } catch (\Throwable $e) {
            return $this->fail($e->getMessage());
        }
    }

    private function runWithRollback(string $sql): array
    {
        // 🔒 Разрешаем только безопасные запросы
        if (!$this->isAllowedSql($sql)) {
            return [
                'status' => 'error',
                'message' => 'Запрещённый SQL-запрос',
            ];
        }

        $conn = DB::connection('sandbox_template');

        $conn->beginTransaction();

        try {
            $conn->statement($sql);

            // сколько строк БЫЛО БЫ затронуто
            $affected = $conn->selectOne('SELECT ROW_COUNT() as cnt')->cnt ?? 0;

            return [
                'status' => 'ok',
                'message' => 'Запрос выполнен (ROLLBACK)',
                'affected_rows' => $affected,
            ];
        } catch (\Throwable $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        } finally {
            $conn->rollBack(); // 🔥 гарантированно
        }
    }


    // =====================

    private function isReadOnly(string $sql): bool
    {
        return preg_match('/^\s*(select|show|describe|explain)\s+/i', $sql);
    }

    private function isForbidden(string $sql): bool
    {
        return preg_match('/\b(drop|alter|truncate|create|rename)\b/i', $sql);
    }

    private function success(array $data): array
    {
        return [
            'status' => 'ok',
            'rows' => $data,
            'count' => count($data),
        ];
    }

    private function fail(string $message): array
    {
        return [
            'status' => 'error',
            'message' => $message,
        ];
    }
}
