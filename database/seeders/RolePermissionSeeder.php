<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // ─────────────────────────────────────────
        // 1. Создаём права
        // ─────────────────────────────────────────
        $permissions = [
            'view courses',
            'view lessons',
            'view tasks',
            'solve tasks',
            'view own progress',

            'view admin panel',
            'manage courses',
            'manage lessons',
            'manage tasks',
            'manage users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // ─────────────────────────────────────────
        // 2. Создаём роли
        // ─────────────────────────────────────────
        $studentRole = Role::firstOrCreate(['name' => 'student']);
        $adminRole   = Role::firstOrCreate(['name' => 'admin']);

        $teacher = Role::where('name', 'teacher')->first();
        if ($teacher) {
            $teacher->delete();
        }

        // ─────────────────────────────────────────
        // 3. Назначаем права ролям
        // ─────────────────────────────────────────
        $studentRole->syncPermissions([
            'view courses',
            'view lessons',
            'view tasks',
            'solve tasks',
            'view own progress',
        ]);

        $adminRole->syncPermissions(
            Permission::pluck('name')->toArray()
        );

        // ─────────────────────────────────────────
        // 4. Твой аккаунт Google → сразу админ
        //
        //    Логика:
        //    - Если ты УЖЕ входил через Google — запись
        //      в таблице users есть, просто назначаем роль
        //    - Если ещё НЕ входил — создаём запись заранее,
        //      когда войдёшь через Google OAuth запись
        //      найдётся по email и роль уже будет стоять
        // ─────────────────────────────────────────
        $admin = User::firstOrCreate(
            [
                'email' => 'smurod8880@gmail.com',
            ],
            [
                'name'     => 'Smurod',
                // Пароль не важен — входим через Google
                // Ставим случайный чтобы не было пустого поля
                'password' => Hash::make(\Str::random(32)),
            ]
        );

        $admin->syncRoles(['admin']);

        // ─────────────────────────────────────────
        // 5. Тестовый студент (опционально)
        // ─────────────────────────────────────────
        $student = User::firstOrCreate(
            [
                'email' => 'student@sqlmastery.com',
            ],
            [
                'name'     => 'Student',
                'password' => Hash::make('student123456'),
            ]
        );

        $student->syncRoles(['student']);

        // ─────────────────────────────────────────
        // Вывод
        // ─────────────────────────────────────────
        $this->command->info('✅ Права и роли созданы');
        $this->command->info('👑 Админ: smurod8880@gmail.com (войди через Google)');
        $this->command->info('🎓 Студент: student@sqlmastery.com / student123456');
    }
}
