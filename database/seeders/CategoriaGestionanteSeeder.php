<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoriaGestionante;

class CategoriaGestionanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear las categorías de gestionantes
        
        CategoriaGestionante::create(['nombre' => 'INSTITUCION_PUBLICA']);
        CategoriaGestionante::create(['nombre' => 'INSTITUCION_PRIVADA']);
        CategoriaGestionante::create(['nombre' => 'EDIL']);
        CategoriaGestionante::create(['nombre' => 'FUNCIONARIO']);
        CategoriaGestionante::create(['nombre' => 'IDR']);
        CategoriaGestionante::create(['nombre' => 'PERSONA_FISICA']);
        CategoriaGestionante::create(['nombre' => 'OTRO']);
    }
}
