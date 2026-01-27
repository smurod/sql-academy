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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('housing_users')->onDelete('cascade');
            $table->foreignId('room_id')->constrained('housing_rooms')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total', 10,2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('reservations');
    }
};
