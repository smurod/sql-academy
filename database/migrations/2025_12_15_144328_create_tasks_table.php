<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('title');
            $table->string('description');
            $table->string('database_schema', 50);
            $table->text('solution_sql');
            $table->json('expected_results');
            $table->text('hint');
            $table->integer('points')->default(0);
            $table->text('task_text');
            $table->string('difficulty'); // easy, medium, hard
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
