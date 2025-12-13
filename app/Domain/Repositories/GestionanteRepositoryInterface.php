<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Gestionante;

interface GestionanteRepositoryInterface
{
    public function guardar(Gestionante $gestionante): Gestionante;

    public function buscarPorId(int $id): ?Gestionante;

    public function buscarPorCedula(string $cedula): ?Gestionante;
    
    public function buscarPorRUT(string $rut): ?Gestionante;

    public function buscar(array $filtros): array;
}
