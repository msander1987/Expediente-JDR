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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();

            //VÍNCULO PRINCIPAL 
            //UN MOVIMIENTO SE ASOCIA SIEMPRE A UN EXPEDIENTE
            $table->foreignId('expediente_id')
                ->constrained('expedientes')
                ->onDelete('cascade'); // Si muere el expediente, mueren sus pasos.

            // DATOS DEL MOVIMIENTO (Clase Movimiento)
            $table->dateTime('fecha'); // private DateTime $fecha

            // Rutas (Origen y Destino)
            $table->foreignId('oficina_origen_id')->constrained('oficinas');
            $table->foreignId('oficina_destino_id')->constrained('oficinas');

            // El usuario que EJECUTA el movimiento en el sistema (el "Mover")
            $table->foreignId('funcionario_id')->constrained('usuarios');


            // VALUE OBJECT "FIRMA" (Embeddable / Aplanado)
            // Como private ?Firma $firma es nullable, estas columnas deben serlo.

            // El Hash (private string $firmaAplicada)
            $table->string('firma_hash')->nullable();

            // La Fecha de Firma (private DateTimeImmutable $fechaFirma)
            $table->dateTime('firma_fecha')->nullable();

            //RELACIONES con otras tablas

            // El Firmante (private Usuario $firmante)
            // ATENCION: Puede ser distinto al 'funcionario_id' de arriba.
            $table->foreignId('firma_firmante_id')
                ->nullable()
                ->constrained('usuarios');

            $table->timestamps();
            $table->softDeletes(); // Historial protegido
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
