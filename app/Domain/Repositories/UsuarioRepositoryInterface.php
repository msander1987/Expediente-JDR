<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Usuario;

interface UsuarioRepositoryInterface
{

    public function guardar(Usuario $usuario): Usuario;

    public function buscarPorId(int $id): ?Usuario;

   
    public function buscarPorCedula(string $cedula): ?Usuario;

    /**
     * Para listar funcionarios activos
     * @return Usuario[]
     */
    public function listarActivos(): array;
    
}
