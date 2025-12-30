<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\EstadoExpediente;
use App\Domain\Repositories\EstadoExpedienteRepositoryInterface;
use App\Models\EstadoExpediente as EstadoExpedienteModel;

class EloquentEstadoExpedienteRepository implements EstadoExpedienteRepositoryInterface
{
    public function __construct(
        private EstadoExpedienteModel $model
    ) {}

    public function buscarPorId(int $id): ?EstadoExpediente
    {
        // TODO: Buscar con find($id) → convertir a entidad
        throw new \Exception("Método buscarPorId() no implementado");
    }

    public function buscarEstadoInicial(): ?EstadoExpediente
    {
        // 1. Buscar el estado inicial: será EN_TRAMITE
        $modelo = $this->model->where('nombre', 'EN_TRAMITE')->first();

        // 2. Si no existe, retornar null
        if (!$modelo) {
            return null;
        }

        // 3. Convertir modelo Eloquent → entidad de dominio
        $estado = EstadoExpediente::crear($modelo->nombre);

        // 4. Asignar el ID
        $estado->asignarIdDesdeBD($modelo->id);

        return $estado;
    }

    public function listarTodos(): array
    {
        // TODO: Obtener todos los estados → retornar array de entidades
        throw new \Exception("Método listarTodos() no implementado");
    }
}
