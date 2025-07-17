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
        Schema::create('otros_pagos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->foreignId('socio_id')->constrained('socios')->onDelete('cascade');
            $table->string('descripcion');
            $table->decimal('importe', 10, 2);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otros_pagos');
    }
};
