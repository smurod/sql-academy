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
        Schema::create('sandbox_pass_in_trip', function (Blueprint $table) {
            $table->id();
            $table->foreignId('passenger_id')->constrained('sandbox_passengers')->cascadeOnDelete();
            $table->foreignId('trip_id')->constrained('sandbox_trips')->cascadeOnDelete();
            $table->string('price', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('sandbox_pass_in_trip');
    }
};
