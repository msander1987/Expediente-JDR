<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EstadoExpediente;

class EstadoExpedienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear los estados del sistema
        // create() inserta un registro y devuelve el modelo creado
        
        EstadoExpediente::create([
            'nombre' => 'EN_TRAMITE'
        ]);

        EstadoExpediente::create([
            'nombre' => 'EN_TRAMITE_ESPERANDO_RESPUESTA'
        ]);

        EstadoExpediente::create([
            'nombre' => 'ARCHIVADO'
        ]);
    }
}
