<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\CategoriaGestionante;
use App\Domain\Repositories\CategoriaGestionanteRepositoryInterface;
use App\Models\CategoriaGestionante as CategoriaGestionanteModel;

class EloquentCategoriaGestionanteRepository implements CategoriaGestionanteRepositoryInterface
{
    public function __construct(
        private CategoriaGestionanteModel $model
    ) {}

    public function buscarPorId(int $id): ?CategoriaGestionante
    {
        // TODO: Buscar con find($id) → convertir a entidad
        throw new \Exception("Método buscarPorId() no implementado");
    }

    public function listarTodas(): array
    {
        // TODO: Obtener todas las categorías → retornar array de entidades
        throw new \Exception("Método listarTodas() no implementado");
    }
}
