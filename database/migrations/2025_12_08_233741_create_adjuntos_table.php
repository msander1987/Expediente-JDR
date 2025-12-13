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
        Schema::create('adjuntos', function (Blueprint $table) {
            $table->id();

            //EL VÍNCULO PRINCIPAL
            // Un adjunto NO existe sin un movimiento.
            $table->foreignId('movimiento_id')
                ->constrained('movimientos')
                ->onDelete('cascade'); // Si borras el pase, se borran sus adjuntos.

            // ATRIBUTOS DE CLASE
            $table->string('nombre_original');  // private string $nombreOriginal
            $table->string('path');             // private string $path
            $table->string('tipo_mime');        // private string $tipoMIME

            // Usamos BigInteger porque los archivos pueden ser pesados 
            // y a veces los bytes superan el límite del integer normal.
            $table->bigInteger('tamanho_bytes'); // private int $tamanhoBytes

            $table->dateTime('fecha_subida');   // private DateTime $fechaSubida

        
            $table->timestamps();
            $table->softDeletes(); // Para no perder archivos por error
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adjuntos');
    }
};
