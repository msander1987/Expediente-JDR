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
        Schema::create('oficinas', function (Blueprint $table) {
            $table->id();


            // Columna 'nombre': Tipo VARCHAR(255)
            // ->unique() asegura que no haya dos oficinas llamadas igual
            $table->string('nombre')->unique();

            // Columna 'activo': Tipo TINYINT/BOOLEAN
            // ->default(true) asigna '1' si no se le envía valor
            $table->boolean('activo')->default(true);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oficinas');
    }
};
