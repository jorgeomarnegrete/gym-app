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
        Schema::create('caja_movimientos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->decimal('monto', 10, 2);
            $table->string('concepto'); // Ej: "Pago suscripción julio"
            $table->enum('tipo', ['ingreso', 'egreso']);
            $table->foreignId('socio_id')->nullable()->constrained(); // Si aplica a un cliente
            $table->string('recibo_numero')->nullable()->unique(); // Para trazabilidad documental
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caja_movimientos');
    }
};
