<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear los roles del sistema
        
        Role::create([
            'nombre' => 'FUNCIONARIO'
        ]);

        Role::create([
            'nombre' => 'ADMINISTRADOR'
        ]);

        Role::create([
            'nombre' => 'EDIL'
        ]);
    }
}
