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
        Schema::create('expedientes', function (Blueprint $table) {

            $table->id(); // private ?int $id

            // --- ATRIBUTOS SIMPLES ---
            $table->string('numero');       // private string $numero
            $table->text('descripcion');    // private string $descripcion
            $table->dateTime('fecha_ingreso')->useCurrent();    // private \DateTime $fechaIngreso

            // --- BANDERAS (Booleans) ---
            $table->boolean('interno')->default(false);      // private bool $interno
            $table->boolean('reservado')->default(false);    // private bool $reservado
            $table->boolean('confidencial')->default(false); // private bool $confidencial

            // --- RELACIONES (Objetos -> FKs) ---

            // 1. Estado (private EstadoExpediente $estado)
            $table->foreignId('estado_expediente_id')->constrained('estado_expedientes');

            // 2. Gestionante (private Gestionante $gestionante)
            $table->foreignId('gestionante_id')->constrained('gestionantes');

            // 3. Usuario Generador (private Usuario $usuarioGenerador) 
          
            $table->foreignId('usuario_creador_id')->constrained('usuarios');


            // --- DOBLE RELACIÓN CON OFICINAS ---

            // 4. Oficina de Origen (private Oficina $oficinaOrigen)
            
            $table->foreignId('oficina_origen_id')->constrained('oficinas');

            // 5. Oficina Actual (private Oficina $oficinaActual)
            $table->foreignId('oficina_actual_id')->constrained('oficinas');

            $table->timestamps();

            // --- BORRADO LÓGICO (Decisión de seguridad) ---
            // Crear la columna 'deleted_at' (nullable) para soportar borrado lógico
            //Si deleted_at es null el expediente está activo.
            //Si tiene fecha, el expediente está borrado lógicamente.
            //Si se borra un expediente, no se elimina físicamente, solo se marca como borrado.
            //El sistema lo ocultará en las consultas normales, pero quedará en la base de datos para auditoría.
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expedientes');
    }
};
