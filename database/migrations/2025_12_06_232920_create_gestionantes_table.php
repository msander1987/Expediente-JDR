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
        Schema::create('gestionantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido')->nullable(); // Nullable (Empresas no tienen);
            $table->string('identificador')->unique(); // CI o RUT (Debe ser único)
            $table->string('domicilio')->nullable();
            $table->string('email')->nullable();
            $table->string('telefono');

            // DEPENDENCIA: esto conecta con la tabla gestionantes
            //usando constrained(), Laravel asume que la PK de la tabla referenciada (categoria_gestionantes) es 'id'
            $table->foreignId('categoria_gestionante_id') //crea la columna categoria_gestionante_id
                  ->constrained('categoria_gestionantes');

            $table->timestamps();
            $table->softDeletes(); // Protección de borrado
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gestionantes');
    }
};
