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
        Schema::create('destino_externo_expediente', function (Blueprint $table) {
            $table->id();

            // El Expediente
            $table->foreignId('expediente_id')
                ->constrained('expedientes')
                ->onDelete('cascade'); // Si borro el expediente, se borran sus envíos

            // El Destino
            $table->foreignId('destino_externo_id')
                ->constrained('destinos_externos')
                ->onDelete('restrict'); // No se puede borrar un destino si tiene envíos (protegemos la historia)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destino_externo_expediente');
    }
};
