<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Gestionante;
use App\Domain\Entities\CategoriaGestionante;
use App\Domain\Repositories\GestionanteRepositoryInterface;
use App\Models\Gestionante as GestionanteModel;

class EloquentGestionanteRepository implements GestionanteRepositoryInterface
{
    public function __construct(
        private GestionanteModel $model
    ) {}

    public function guardar(Gestionante $gestionante): Gestionante
    {
        // TODO: Convertir entidad → modelo → guardar → retornar entidad actualizada
        throw new \Exception("Método guardar() no implementado");
    }

    public function buscarPorId(int $id): ?Gestionante
    {
        // 1. Traer el modelo de BD con su relación (eager loading)
        $modelo = $this->model->with(['categoriaGestionante'])->find($id);

        // 2. Si no existe, retornar null
        if (!$modelo) {
            return null;
        }

        // 3. Convertir modelo → entidad
        return $this->mapearAEntidad($modelo);
    }

    public function buscarPorCedula(string $cedula): ?Gestionante
    {
        // TODO: Buscar con where('identificador', $cedula) → convertir a entidad
        throw new \Exception("Método buscarPorCedula() no implementado");
    }

    public function buscarPorRUT(string $rut): ?Gestionante
    {
        // TODO: Buscar con where('identificador', $rut) → convertir a entidad
        throw new \Exception("Método buscarPorRUT() no implementado");
    }

    public function buscar(array $filtros): array
    {
        // TODO: Aplicar filtros dinámicos → retornar array de entidades
        throw new \Exception("Método buscar() no implementado");
    }

    /**
     * Convierte un modelo Eloquent de Gestionante con su relación categoria cargada
     * a una entidad de dominio Gestionante.
     * 
     * @param GestionanteModel $modelo - Modelo Eloquent con relación categoria cargada
     * @return Gestionante - Entidad de dominio
     */
    private function mapearAEntidad(GestionanteModel $modelo): Gestionante
    {
        // Categoría
        $categoria = CategoriaGestionante::crear(
            $modelo->categoriaGestionante->nombre
        );
        $categoria->asignarIdDesdeBD($modelo->categoriaGestionante->id);

        // Crear entidad Gestionante
        $gestionante = Gestionante::crear(
            $modelo->nombre,
            $modelo->identificador,
            $modelo->email,
            $modelo->telefono,
            $categoria,
            $modelo->apellido,
            $modelo->domicilio
        );

        // Asignar el ID
        $gestionante->asignarIdDesdeBD($modelo->id);

        return $gestionante;
    }
}
