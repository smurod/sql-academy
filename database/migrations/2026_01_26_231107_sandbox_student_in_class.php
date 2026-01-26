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
        Schema::create('sandbox_student_in_class', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('sandbox_students')->cascadeOnDelete();
            $table->foreignId('class_id')->constrained('sandbox_classes')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sandbox_student_in_class');
    }
};
