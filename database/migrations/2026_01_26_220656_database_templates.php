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
        Schema::create('database_templates', function (Blueprint $table) {
            $table->id();
            $table->string('schema_name', 50)->unique();
            $table->string('display_name');
            $table->text('description')->nullable();
            $table->longText('creation_script');
            $table->longText('seed_script');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('database_templates');
    }
};
