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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade'); // Relación con users
            $table->string('estado'); // Cambio "stado" a "estado" (corrección de ortografía)

            $table->unsignedBigInteger('membership_id')->nullable();
            $table->unsignedBigInteger('coach_id')->nullable();

            $table->timestamps();

            $table->foreign('membership_id')->references('id')->on('memberships')->onDelete('set null');
            $table->foreign('coach_id')->references('id')->on('coaches')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
