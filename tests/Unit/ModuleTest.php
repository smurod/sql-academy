<?php

test('example', function () {
    expect(true)->toBeTrue();
});
test('Проверка rollback и корректности DELETE', function () {

    $userSql = 'DELETE FROM modules WHERE id = 9';

    DB::beginTransaction();

    try {
        // ✅ Эталон ДО DELETE
        $expectedIds = DB::table('modules')
            ->where('id', 9)
            ->orderBy('id')
            ->pluck('id')
            ->values();

        // 1️⃣ Состояние ДО
        $beforeIds = DB::table('modules')
            ->orderBy('id')
            ->pluck('id');

        // 2️⃣ DELETE пользователя
        DB::statement($userSql);

        // 3️⃣ Состояние ПОСЛЕ
        $afterIds = DB::table('modules')
            ->orderBy('id')
            ->pluck('id');

        // 4️⃣ Что было удалено
        $deletedIds = $beforeIds
            ->diff($afterIds)
            ->values();

        // 5️⃣ Проверка
        expect(
            $deletedIds->sort()->values()->toJson()
        )->toBe(
            $expectedIds->sort()->values()->toJson()
        );

    } finally {
        // 6️⃣ ОБЯЗАТЕЛЬНО
        DB::rollBack();
    }
});
