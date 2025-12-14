<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Oficina;

class OficinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear las oficinas del sistema
        
        Oficina::create(['nombre' => 'MESA_DE_ENTRADA']);
        Oficina::create(['nombre' => 'PRESIDENCIA']);
        Oficina::create(['nombre' => 'SECRETARIA_GENERAL']);
        Oficina::create(['nombre' => 'MESA']);
        Oficina::create(['nombre' => 'OGD']);
        Oficina::create(['nombre' => 'PLENARIO']);
        Oficina::create(['nombre' => 'COMISION_DE_LEGISLACION']);
        Oficina::create(['nombre' => 'COMISION_DE_HACIENDA_Y_PRESUPUESTO']);
        Oficina::create(['nombre' => 'COMISION_DE_SEGURIDAD_PUBLICA_y_DDHH']);
        Oficina::create(['nombre' => 'PROSECRETARIA']);
        Oficina::create(['nombre' => 'CONTADURIA']);
        Oficina::create(['nombre' => 'PRENSA_Y_RRPP']);
        Oficina::create(['nombre' => 'ASESORIA_JURIDICA']);
        Oficina::create(['nombre' => 'JUTEP']);
        Oficina::create(['nombre' => 'PERSONAL']);
        Oficina::create(['nombre' => 'ARCHIVO']);
        Oficina::create(['nombre' => 'CONSERJERIA']);
    }
}
