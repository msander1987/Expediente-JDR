<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Expediente;

interface ExpedienteRepositoryInterface
{
    public function guardar(Expediente $expediente): Expediente;

    public function buscarPorId(int $id): ?Expediente;

    public function buscarPorNumero(string $numero): ?Expediente;

    public function buscar(array $filtros): array;

    public function obtenerUltimoNumero(): ?string; //BUSCAMOS EL NUMERO DEL EXPEDIENTE DEL ID MAYOR (ULTIMO CREADO)
}