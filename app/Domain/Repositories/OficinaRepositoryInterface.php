<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Oficina;

interface OficinaRepositoryInterface
{
    public function guardar(Oficina $oficina): Oficina;

    public function buscarPorId(int $id): ?Oficina;

    public function listarTodas(): array;
}
