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
        Schema::create('sandbox_housing_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('sandbox_housing_users')->cascadeOnDelete();
            $table->string('address', 255);
            $table->string('home_type', 50);
            $table->decimal('price', 10, 2);
            $table->boolean('has_tv')->default(false);
            $table->boolean('has_internet')->default(false);
            $table->boolean('has_kitchen')->default(false);
            $table->boolean('has_air_con')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('sandbox_housing_rooms');
    }
};
