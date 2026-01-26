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
        Schema::create('sandbox_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('sandbox_classes')->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('sandbox_teachers')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('sandbox_students')->cascadeOnDelete();
            $table->date('lesson_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('sandbox_schedules');
    }
};
