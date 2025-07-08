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
        Schema::create('clase_socios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('socio_id')->constrained();
            $table->foreignId('clase_id')->constrained(); // La clase recurrente
            $table->foreignId('asistente_id')->constrained(); // El profe que da la clase
            $table->date('fecha'); // Día puntual (ej. 10/07/2025)
            $table->boolean('asistio')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clase_socios');
    }
};
