<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Rol;

interface RolRepositoryInterface
{
    public function buscarPorId(int $id): ?Rol;


    public function listarTodos(): array;
}
