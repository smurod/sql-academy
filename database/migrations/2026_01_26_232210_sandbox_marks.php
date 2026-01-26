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
        Schema::create('sandbox_marks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('sandbox_students')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('sandbox_subjects')->cascadeOnDelete();
            $table->integer('mark');
            $table->date('mark_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('sandbox_marks');
    }
};
