<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            // ← ДОБАВЛЕНО: публичный номер задачи (Task №1 ... №79+)
            // Используется в URL: /trainer/tasks/{task_number}
            $table->unsignedInteger('task_number')->unique();

            // Привязка к уроку — NULLABLE (задачи тренажёра могут жить отдельно)
            $table->foreignId('lesson_id')
                ->nullable()                                     // ← ИЗМЕНЕНО: было NOT NULL
                ->constrained()
                ->nullOnDelete();                                // ← ИЗМЕНЕНО: было cascadeOnDelete

            $table->foreignId('author_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('title');
            $table->text('description');          // Краткое описание (для карточки)
            $table->text('task_text');             // Полная формулировка задания
            $table->string('database_schema', 50); // aviation, family, schedule, booking
            $table->text('solution_sql');           // Эталонный SQL-запрос
            $table->json('expected_results');       // Ожидаемый результат (JSON)

            $table->unsignedTinyInteger('difficulty_percent')->default(15); // 0-100%

            $table->boolean('is_free')->default(true);  // true = бесплатная, false = premium
            $table->text('hint')->nullable();            // Подсказка
            $table->integer('points')->default(0);       // Баллы за решение

            // ← ИЗМЕНЕНО: расширен тип, добавлен create_view
            $table->string('sql_type', 20)->default('select');
            // Допустимые значения: select, insert, update, delete, create_view

            // ← ДОБАВЛЕНО: порядок задачи внутри урока (для сортировки)
            $table->unsignedInteger('task_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
