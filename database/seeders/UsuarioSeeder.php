<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Oficina;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener oficina y rol para asignar
        $mesaEntrada = Oficina::where('nombre', 'MESA_DE_ENTRADA')->first();
        $funcionario = Role::where('nombre', 'FUNCIONARIO')->first();
        $admin = Role::where('nombre', 'ADMINISTRADOR')->first();
        
        // Usuario funcionario para pruebas
        Usuario::create([
            'cedula' => '12345678',
            'nombre' => 'Carlos',
            'apellido' => 'Rodríguez',
            'email' => 'carlos@junta.gub.uy',
            'password' => Hash::make('password123'),
            'oficina_id' => $mesaEntrada->id,
            'role_id' => $funcionario->id,
            'activo' => true
        ]);
        
        // Usuario administrador
        Usuario::create([
            'cedula' => '87654321',
            'nombre' => 'Admin',
            'apellido' => 'Sistema',
            'email' => 'admin@junta.gub.uy',
            'password' => Hash::make('admin123'),
            'oficina_id' => $mesaEntrada->id,
            'role_id' => $admin->id,
            'activo' => true
        ]);
    }
}
