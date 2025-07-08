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
        Schema::create('suscripciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('socio_id');

            $table->tinyInteger('tipo'); // 1: Mensual, 2: Diario, 3: Por Clase, 4: Free Pass
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();

            $table->decimal('monto', 12, 2);
            $table->boolean('activo')->default(true);
            $table->text('observaciones')->nullable();

            $table->tinyInteger('forma_pago'); // 1: Efectivo, 2: Transferencia, 3: Débito, 4: Crédito
            $table->string('modalidad', 20)->nullable(); // Presencial, Virtual, Híbrida

            $table->timestamps();

            $table->foreign('socio_id')->references('id')->on('socios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suscripcións');
    }
};
