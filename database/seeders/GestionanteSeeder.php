<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gestionante;
use App\Models\CategoriaGestionante;

class GestionanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener categorías para asignar
        $personaFisica = CategoriaGestionante::where('nombre', 'PERSONA_FISICA')->first();
        $institucionPublica = CategoriaGestionante::where('nombre', 'INSTITUCION_PUBLICA')->first();
        $edil = CategoriaGestionante::where('nombre', 'EDIL')->first();
        
        // Crear gestionantes de ejemplo
        Gestionante::create([
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'identificador' => '12345678',
            'telefono' => '099123456',
            'email' => 'juan.perez@email.com',
            'domicilio' => 'Av. 18 de Julio 1234',
            'categoria_gestionante_id' => $personaFisica->id
        ]);
        
        Gestionante::create([
            'nombre' => 'María',
            'apellido' => 'González',
            'identificador' => '87654321',
            'telefono' => '099654321',
            'email' => 'maria.gonzalez@email.com',
            'categoria_gestionante_id' => $edil->id
        ]);
        
        Gestionante::create([
            'nombre' => 'Ministerio de Educación',
            'apellido' => null,
            'identificador' => '211234560018',
            'telefono' => '29001234',
            'email' => 'contacto@mec.gub.uy',
            'domicilio' => 'Reconquista 535',
            'categoria_gestionante_id' => $institucionPublica->id
        ]);
    }
}
