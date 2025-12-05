<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\CategoriaGestionante;

interface CategoriaGestionanteRepositoryInterface
{
    
    public function buscarPorId(int $id): ?CategoriaGestionante;
    

    public function listarTodas(): array;

}
