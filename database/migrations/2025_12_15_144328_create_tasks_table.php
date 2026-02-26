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
            $table->foreignId('lesson_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('author_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->text('task_text');
            $table->string('database_schema', 50);
            $table->text('solution_sql');
            $table->json('expected_results');
            $table->unsignedTinyInteger('difficulty_percent')->default(15);
            $table->boolean('is_free')->default(true);
            $table->text('hint')->nullable();
            $table->integer('points')->default(0);
            $table->string('sql_type', 20)->default('select');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
