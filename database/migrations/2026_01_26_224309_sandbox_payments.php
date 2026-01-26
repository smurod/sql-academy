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
        Schema::create('sandbox_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('family_member_id')->constrained('sandbox_family_members')->cascadeOnDelete();
            $table->foreignId('good_id')->constrained('sandbox_good_types')->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->decimal('unit_price', 10, 2);
            $table->date('payment_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::drop('sandbox_payments');
    }
};
