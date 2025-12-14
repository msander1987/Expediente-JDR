<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecutar seeders en el orden correcto (respetando FKs)
        $this->call([
            EstadoExpedienteSeeder::class,
            RolSeeder::class,
            OficinaSeeder::class,
            CategoriaGestionanteSeeder::class,
            GestionanteSeeder::class,
            UsuarioSeeder::class,
        ]);
    }
}
