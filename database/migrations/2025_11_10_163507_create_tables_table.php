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
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();  // Número de mesa
            $table->integer('capacity');         // Capacidad de personas
            $table->string('location')->nullable(); // Ubicación (interior, terraza, etc.)
            $table->boolean('is_active')->default(true); // Si la mesa está disponible para reservas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
