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
        Schema::create('sandbox_goods', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->foreignId('type_id')->constrained('sandbox_good_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('sandbox_goods');
    }
};
