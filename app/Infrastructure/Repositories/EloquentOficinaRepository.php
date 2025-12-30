<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Oficina;
use App\Domain\Repositories\OficinaRepositoryInterface;
use App\Models\Oficina as OficinaModel;

class EloquentOficinaRepository implements OficinaRepositoryInterface
{
    public function __construct(
        private OficinaModel $model
    ) {}

    public function guardar(Oficina $oficina): Oficina
    {
        // TODO: Convertir entidad → modelo → guardar → retornar entidad actualizada
        throw new \Exception("Método guardar() no implementado");
    }

    public function buscarPorId(int $id): ?Oficina
    {
        // TODO: Buscar con find($id) → convertir a entidad
        throw new \Exception("Método buscarPorId() no implementado");
    }

    public function listarTodas(): array
    {
        // TODO: Obtener todas las oficinas → retornar array de entidades
        throw new \Exception("Método listarTodas() no implementado");
    }
}
