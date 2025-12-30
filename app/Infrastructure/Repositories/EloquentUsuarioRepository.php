<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Usuario;
use App\Domain\Entities\Oficina;
use App\Domain\Entities\Rol;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Models\Usuario as UsuarioModel;

class EloquentUsuarioRepository implements UsuarioRepositoryInterface
{
    public function __construct(
        private UsuarioModel $model
    ) {}

    public function guardar(Usuario $usuario): Usuario
    {
        // TODO: Convertir entidad → modelo → guardar → retornar entidad actualizada
        throw new \Exception("Método guardar() no implementado");
    }

    public function buscarPorId(int $id): ?Usuario
    {
        // 1. Traer el modelo de BD con sus relaciones (eager loading)
        $modelo = $this->model->with([
            'oficina',
            'rol'
        ])->find($id);

        // 2. Si no existe, retornar null
        if (!$modelo) {
            return null;
        }

        // 3. Convertir modelo → entidad
        return $this->mapearAEntidad($modelo);
    }

    public function buscarPorCedula(string $cedula): ?Usuario
    {
        // TODO: Buscar con $this->model->where('cedula', $cedula)->first() → convertir a entidad
        throw new \Exception("Método buscarPorCedula() no implementado");
    }

    public function listarActivos(): array
    {
        // TODO: Filtrar solo activos → retornar array de entidades
        // $this->model->where('activo', true)->get()
        throw new \Exception("Método listarActivos() no implementado");
    }

    /**
     * Convierte un modelo Eloquent de Usuario con sus relaciones cargadas
     * a una entidad de dominio Usuario.
     * 
     * @param UsuarioModel $modelo - Modelo Eloquent con relaciones oficina y rol cargadas
     * @return Usuario - Entidad de dominio
     */
    private function mapearAEntidad(UsuarioModel $modelo): Usuario
    {
        // Oficina
        $oficina = Oficina::crear(
            $modelo->oficina->nombre
        );
        $oficina->asignarIdDesdeBD($modelo->oficina->id);

        // Rol
        $rol = Rol::crear(
            $modelo->rol->nombre
        );
        $rol->asignarIdDesdeBD($modelo->rol->id);

        // Crear entidad Usuario
        $usuario = Usuario::crear(
            $modelo->nombre,
            $modelo->apellido,
            $modelo->cedula,
            $modelo->password,
            $modelo->email,
            $oficina,
            $modelo->firma ?? 'Firma pendiente',
            $rol
        );

        // Asignar el ID
        $usuario->asignarIdDesdeBD($modelo->id);

        return $usuario;
    }
}
