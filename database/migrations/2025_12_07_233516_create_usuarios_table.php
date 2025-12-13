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
        Schema::create('usuarios', function (Blueprint $table) {

            $table->id();

            // --- CREDENCIALES DE ACCESO ---
            // 1 - EL LOGIN: Cédula (String único)
            // Usamos string porque a veces guardan puntos o guiones, en nuestro sistema, se guardará limpia

            $table->string('cedula')->unique();

            // 2 - PASSWORD
            $table->string('password');

            // --- DATOS PERSONALES ---
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->unique();
            $table->string('firma')->nullable();

            // --- RELACIONES (Tu Dominio) ---
            $table->foreignId('oficina_id')->constrained('oficinas');
            $table->foreignId('role_id')->constrained('roles');

            // --- METADATA ---
            $table->rememberToken();
            $table->boolean('activo')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
