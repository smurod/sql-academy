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
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->string('status', 50);
            $table->string('name', 100);
            $table->date('birthday');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::drop('family_members');
    }
};
