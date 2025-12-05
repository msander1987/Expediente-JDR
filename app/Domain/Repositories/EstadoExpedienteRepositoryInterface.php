<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\EstadoExpediente;

interface EstadoExpedienteRepositoryInterface
{
    public function buscarPorId(int $id): ?EstadoExpediente;
    
    // Método especial que necesitamos para crearExpediente
    public function buscarEstadoInicial(): ?EstadoExpediente; 

    public function listarTodos(): array;
}
