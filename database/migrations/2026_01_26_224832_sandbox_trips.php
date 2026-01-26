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
        Schema::create('sandbox_trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('sandbox_companies')->cascadeOnDelete();
            $table->string('plane', 50);
            $table->string('town_from', 100);
            $table->string('town_to', 100);
            $table->time('time_out');
            $table->time('time_in');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('sandbox_trips');
    }
};
