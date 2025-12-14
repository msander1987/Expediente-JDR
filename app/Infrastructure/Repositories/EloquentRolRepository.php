<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Rol;
use App\Domain\Repositories\RolRepositoryInterface;
use App\Models\Role as RolModel;

class EloquentRolRepository implements RolRepositoryInterface
{
    public function __construct(
        private RolModel $model
    ) {}

    public function buscarPorId(int $id): ?Rol
    {
        // TODO: Buscar con find($id) → convertir a entidad
        throw new \Exception("Método buscarPorId() no implementado");
    }

    public function listarTodos(): array
    {
        // TODO: Obtener todos los roles → retornar array de entidades
        throw new \Exception("Método listarTodos() no implementado");
    }
}
