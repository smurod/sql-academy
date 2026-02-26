<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class SqlCheckerService
{
    /**
     * Соединение для песочницы
     */
    private string $connection = 'sandbox_template';

    /**
     * Главная точка входа
     */
    public function check(Task $task, string $userSql): array
    {
        $userSql = trim($userSql);

        // 1️⃣ Проверка на запрещённые команды
        if ($this->isForbidden($userSql)) {
            return $this->fail('Запрещённая SQL-команда (DROP, ALTER, TRUNCATE и т.д.)');
        }

        // 2️⃣ Проверка что тип запроса совпадает с заданием
        if (!$this->matchesExpectedType($userSql, $task->sql_type)) {
            return $this->fail("Ожидается запрос типа: {$task->sql_type}");
        }

        // 3️⃣ Маршрутизация по типу
        return match ($task->sql_type) {
            'select' => $this->checkSelect($task, $userSql),
            'insert' => $this->checkDml($task, $userSql, 'insert'),
            'update' => $this->checkDml($task, $userSql, 'update'),
            'delete' => $this->checkDml($task, $userSql, 'delete'),
            default  => $this->fail('Неизвестный тип задачи'),
        };
    }

    // =========================================================
    // SELECT — сравниваем результаты
    // =========================================================

    private function checkSelect(Task $task, string $userSql): array
    {
        $conn = DB::connection($this->connection);

        try {
            // Результат пользователя
            $userResult = collect($conn->select($userSql))
                ->map(fn($row) => (array) $row);

            // Эталонный результат
            $expectedResult = collect($conn->select($task->solution_sql))
                ->map(fn($row) => (array) $row);

            // Сравнение
            if ($this->resultsMatch($userResult, $expectedResult)) {
                return $this->success('Запрос верный!', [
                    'rows_returned' => $userResult->count(),
                ]);
            }

            return $this->fail('Результат запроса не совпадает с ожидаемым', [
                'expected_count' => $expectedResult->count(),
                'actual_count'   => $userResult->count(),
            ]);

        } catch (\Throwable $e) {
            return $this->fail('Ошибка выполнения SQL', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    // =========================================================
    // DML (INSERT / UPDATE / DELETE) — с откатом
    // =========================================================

    private function checkDml(Task $task, string $userSql, string $type): array
    {
        $conn = DB::connection($this->connection);

        // Определяем таблицу из эталонного запроса
        $table = $this->extractTable($task->solution_sql, $type);

        if (!$table) {
            return $this->fail('Не удалось определить таблицу задачи');
        }

        $conn->beginTransaction();

        try {
            // ==========================================
            // 📸 Снимок ДО (эталонный запрос)
            // ==========================================
            $snapshotBefore = $this->getTableSnapshot($conn, $table);

            // Выполняем ЭТАЛОННЫЙ запрос
            $conn->statement($task->solution_sql);
            $snapshotAfterExpected = $this->getTableSnapshot($conn, $table);

            // Откатываем эталон
            $conn->rollBack();

            // ==========================================
            // 📸 Снимок ДО (пользовательский запрос)
            // ==========================================
            $conn->beginTransaction();

            $snapshotBeforeUser = $this->getTableSnapshot($conn, $table);

            // Выполняем ПОЛЬЗОВАТЕЛЬСКИЙ запрос
            $conn->statement($userSql);
            $snapshotAfterUser = $this->getTableSnapshot($conn, $table);

            // ==========================================
            // 🔍 Сравниваем эффекты
            // ==========================================
            $expectedDiff = $this->computeDiff($snapshotBefore, $snapshotAfterExpected, $type);
            $actualDiff   = $this->computeDiff($snapshotBeforeUser, $snapshotAfterUser, $type);

            if ($this->diffsMatch($expectedDiff, $actualDiff)) {
                return $this->success('Запрос верный!', [
                    'type'          => $type,
                    'affected_rows' => count($actualDiff['affected'] ?? []),
                ]);
            }

            return $this->fail('Результат запроса не совпадает с ожидаемым', [
                'type'              => $type,
                'expected_affected' => count($expectedDiff['affected'] ?? []),
                'actual_affected'   => count($actualDiff['affected'] ?? []),
            ]);

        } catch (\Throwable $e) {
            return $this->fail('Ошибка выполнения SQL', [
                'error' => $e->getMessage(),
            ]);
        } finally {
            // 🔥 Гарантированный откат
            try {
                $conn->rollBack();
            } catch (\Throwable) {
                // Транзакция уже откачена
            }
        }
    }

    // =========================================================
    // Снимки и сравнения
    // =========================================================

    /**
     * Полный снимок таблицы
     */
    private function getTableSnapshot($conn, string $table): Collection
    {
        return collect($conn->select("SELECT * FROM `{$table}` ORDER BY 1"))
            ->map(fn($row) => (array) $row);
    }

    /**
     * Вычисляет разницу между снимками
     */
    private function computeDiff(Collection $before, Collection $after, string $type): array
    {
        return match ($type) {
            'delete' => [
                'affected' => $before->filter(function ($row) use ($after) {
                    return !$after->contains(fn($r) => $r === $row);
                })->values()->toArray(),
            ],
            'insert' => [
                'affected' => $after->filter(function ($row) use ($before) {
                    return !$before->contains(fn($r) => $r === $row);
                })->values()->toArray(),
            ],
            'update' => [
                'before' => $before->toArray(),
                'after'  => $after->toArray(),
                'affected' => $after->filter(function ($row) use ($before) {
                    return !$before->contains(fn($r) => $r === $row);
                })->values()->toArray(),
            ],
            default => ['affected' => []],
        };
    }

    /**
     * Сравнивает два diff
     */
    private function diffsMatch(array $expected, array $actual): bool
    {
        $normalize = function (array $items): string {
            $sorted = collect($items)
                ->map(fn($row) => is_array($row) ? $row : (array) $row)
                ->sortBy(fn($row) => json_encode($row))
                ->values()
                ->toArray();
            return json_encode($sorted);
        };

        return $normalize($expected['affected'] ?? [])
            === $normalize($actual['affected'] ?? []);
    }

    /**
     * Сравнение результатов SELECT
     */
    private function resultsMatch(Collection $actual, Collection $expected): bool
    {
        // Сравниваем отсортированные JSON
        $normalize = function (Collection $data): string {
            return $data
                ->sortBy(fn($row) => json_encode($row))
                ->values()
                ->toJson();
        };

        return $normalize($actual) === $normalize($expected);
    }

    // =========================================================
    // Извлечение таблицы из SQL
    // =========================================================

    private function extractTable(string $sql, string $type): ?string
    {
        $pattern = match ($type) {
            'delete' => '/DELETE\s+FROM\s+`?(\w+)`?/i',
            'insert' => '/INSERT\s+INTO\s+`?(\w+)`?/i',
            'update' => '/UPDATE\s+`?(\w+)`?/i',
            default  => null,
        };

        if (!$pattern) return null;

        if (preg_match($pattern, $sql, $matches)) {
            return $matches[1];
        }

        return null;
    }

    // =========================================================
    // Валидация
    // =========================================================

    private function matchesExpectedType(string $sql, string $expectedType): bool
    {
        $sql = strtolower(trim($sql));
        return str_starts_with($sql, $expectedType);
    }

    private function isForbidden(string $sql): bool
    {
        return (bool) preg_match(
            '/\b(drop|alter|truncate|create|rename|grant|revoke)\b/i',
            $sql
        );
    }

    // =========================================================
    // Ответы
    // =========================================================

    private function success(string $message, array $meta = []): array
    {
        return [
            'status'  => 'ok',
            'message' => '✅ ' . $message,
            'meta'    => $meta,
        ];
    }

    private function fail(string $message, array $meta = []): array
    {
        return [
            'status'  => 'error',
            'message' => '❌ ' . $message,
            'meta'    => $meta,
        ];
    }
}
