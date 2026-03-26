<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DeleteModulesChecker
{
    public function check(): array
    {
        $userSql = 'DELETE FROM modules WHERE id = 9';
        // 🔐 Минимальная защита
        if (!preg_match('/^\s*delete\s+from\s+modules/i', $userSql)) {
            return $this->fail('Разрешён только DELETE из modules');
        }

        DB::beginTransaction();
        try {
            // ✅ Эталон ДО DELETE
            $expectedIds = DB::table('modules')
                ->where('id', 9)
                ->orderBy('id')
                ->pluck('id')
                ->values();

            // 1️⃣ ДО
            $beforeIds = DB::table('modules')
                ->orderBy('id')
                ->pluck('id');

            // 2️⃣ DELETE пользователя
            DB::statement($userSql);

            // 3️⃣ ПОСЛЕ
            $afterIds = DB::table('modules')
                ->orderBy('id')
                ->pluck('id');

            // 4️⃣ Что удалилось
            $deletedIds = $beforeIds
                ->diff($afterIds)
                ->values();

            // 5️⃣ Сравнение
            if (
                $deletedIds->sort()->values()->toJson()
                ===
                $expectedIds->sort()->values()->toJson()
            ) {
                return $this->success();
            }

            return $this->fail('Удалены неверные записи');

        } catch (\Throwable $e) {
            return $this->fail('Ошибка выполнения SQL', [
                'exception' => $e->getMessage(),
            ]);
        } finally {
            DB::rollBack();
        }
    }

    private function success(): array
    {
        return [
            'status' => 'ok',
            'message' => '✅ Запрос верный',
        ];
    }

    private function fail(string $message, array $meta = []): array
    {
        return [
            'status' => 'error',
            'message' => '❌ ' . $message,
            'meta' => $meta,
        ];
    }
}
