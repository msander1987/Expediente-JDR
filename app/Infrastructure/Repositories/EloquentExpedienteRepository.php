<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Expediente;
use App\Domain\Entities\EstadoExpediente;
use App\Domain\Entities\CategoriaGestionante;
use App\Domain\Entities\Gestionante;
use App\Domain\Entities\Oficina;
use App\Domain\Entities\Rol;
use App\Domain\Entities\Usuario;
use App\Domain\Repositories\ExpedienteRepositoryInterface;
use App\Models\Expediente as ExpedienteModel;

class EloquentExpedienteRepository implements ExpedienteRepositoryInterface
{

    /**
     * @param ExpedienteModel $model - Modelo Eloquent de expediente, para interactuar con la tabla 'expedientes' en BD.
     * NO es una entidad de dominio, es la representación de Laravel/Eloquent de la tabla.
     * Se usa para hacer queries (create, find, where, etc.) y Laravel maneja el mapeo con la BD.
     */

    public function __construct(
        private ExpedienteModel $model
    ) {}

    public function guardar(Expediente $expediente): Expediente
    {
        // 1- Convertir entidad de dominio → array de datos para Eloquent
        $datos = [
            'numero' => $expediente->getNumero(),
            'descripcion' => $expediente->getDescripcion(),
            'fecha_ingreso' => $expediente->getFechaIngreso(),
            'interno' => $expediente->isInterno(),
            'reservado' => $expediente->isReservado(),
            'confidencial' => $expediente->isConfidencial(),
            'estado_expediente_id' => $expediente->getEstado()->getId(),
            'gestionante_id' => $expediente->getGestionante()->getId(),
            'usuario_creador_id' => $expediente->getUsuarioCreador()->getId(),
            'oficina_origen_id' => $expediente->getOficinaOrigen()->getId(),
            'oficina_actual_id' => $expediente->getOficinaActual()->getId(),
        ];


        // 2. Verificamos el ID (parta ver si es UPDATE o INSERT)

        $id = $expediente->getId();

        if ($id) {
            // --- CASO 2.1: YA EXISTE (UPDATE) ---
            // Buscamos la fila vieja
            $modelo = $this->model->find($id);

            // Sobrescribimos los datos en esa misma fila

            $modelo->update($datos);
        } else {
            // --- CASO 2.2: ES NUEVO (INSERT en BD) ---
            // Creamos una fila totalmente nueva
            $modelo = $this->model->create($datos);

            // La base de datos le acaba de dar un ID nuevo.
            // Se lo asignamos a nuestro objeto de dominio en memoria para que sepa quién es.
            $expediente->asignarIdDesdeBD($modelo->id);
        }



        // 4 - Retornar la entidad actualizada con su ID
        return $expediente;
    }

    public function buscarPorId(int $id): ?Expediente
    {
        // 1. Traer el modelo de BD con todas sus relaciones (eager loading)
        //UNA SOLA CONSULTA A LA BD
        $modelo = $this->model->with([
            'estadoExpediente',
            'gestionante.categoria',
            'usuarioCreador.oficina',
            'usuarioCreador.rol',
            'oficinaOrigen',
            'oficinaActual'
        ])->find($id);

        // 2. Si no existe, retornar null
        if (!$modelo) {
            return null;
        }

        // 3. Convertir modelo → entidad
        return $this->mapearAEntidad($modelo);
    }

    public function buscarPorNumero(string $numero): ?Expediente
    {
        // TODO: Buscar en BD con $this->model->where('numero', $numero)->first() → convertir a entidad

        // 1. Preparamos la consulta con Eager Loading (Igual que antes)
        $modelo = $this->model->with([
            'estadoExpediente',
            'gestionante.categoria',
            'usuarioCreador.oficina',
            'usuarioCreador.rol',
            'oficinaOrigen',
            'oficinaActual'
        ])->where('numero', $numero)
            ->first();


        // 2. Si no existe, retornar null
        if (!$modelo) {
            return null;
        }

        // 3. Convertir modelo → entidad
        return $this->mapearAEntidad($modelo);
    }

    public function buscar(array $filtros): array
    {
        // TODO: Aplicar filtros dinámicos → retornar array de entidades
        throw new \Exception("Método buscar() no implementado");
    }

    public function obtenerUltimoNumero(): ?string
    {
        // Obtener el número del expediente con id más alto (último creado)
        // SELECT TOP 1 FROM expedientes ORDER BY id DESC

        $modelo = $this->model->orderBy('id', 'desc')->first();

        return $modelo ? $modelo->numero : null;
    }


    /* METODO AUXILIAR PARA MAPEO Eloquent/Entidad
     Convierte un modelo Eloquent de Expediente con sus relaciones cargadas
     a una entidad de dominio Expediente.
     
     * @param ExpedienteModel $modelo - Modelo Eloquent con relaciones cargadas
     * @return Expediente - Entidad de dominio
     */
    private function mapearAEntidad(ExpedienteModel $modelo): Expediente
    {
        // Estado
        $estado = EstadoExpediente::crear(
            $modelo->estadoExpediente->nombre,
            $modelo->estadoExpediente->es_inicial
        );
        $estado->asignarIdDesdeBD($modelo->estadoExpediente->id);

        // Categoría del Gestionante
        $categoria = CategoriaGestionante::crear(
            $modelo->gestionante->categoria->nombre
        );
        $categoria->asignarIdDesdeBD($modelo->gestionante->categoria->id);

        // Gestionante
        $gestionante = Gestionante::crear(
            $modelo->gestionante->nombre,
            $modelo->gestionante->identificador,
            $modelo->gestionante->email,
            $modelo->gestionante->telefono,
            $categoria,
            $modelo->gestionante->apellido,
            $modelo->gestionante->domicilio
        );
        $gestionante->asignarIdDesdeBD($modelo->gestionante->id);

        // Oficina del Usuario Creador
        $oficinaUsuario = Oficina::crear(
            $modelo->usuarioCreador->oficina->nombre
        );
        $oficinaUsuario->asignarIdDesdeBD($modelo->usuarioCreador->oficina->id);

        // Rol del Usuario Creador
        $rol = Rol::crear(
            $modelo->usuarioCreador->rol->nombre
        );
        $rol->asignarIdDesdeBD($modelo->usuarioCreador->rol->id);

        // Usuario Creador
        $usuarioCreador = Usuario::crear(
            $modelo->usuarioCreador->nombre,
            $modelo->usuarioCreador->apellido,
            $modelo->usuarioCreador->cedula,
            $modelo->usuarioCreador->password,
            $modelo->usuarioCreador->email,
            $oficinaUsuario,
            $modelo->usuarioCreador->firma, // Puede ser null
            $rol
        );
        $usuarioCreador->asignarIdDesdeBD($modelo->usuarioCreador->id);

        // Oficina Origen
        $oficinaOrigen = Oficina::crear(
            $modelo->oficinaOrigen->nombre
        );
        $oficinaOrigen->asignarIdDesdeBD($modelo->oficinaOrigen->id);

        // Oficina Actual
        $oficinaActual = Oficina::crear(
            $modelo->oficinaActual->nombre
        );
        $oficinaActual->asignarIdDesdeBD($modelo->oficinaActual->id);

        // Crear entidad Expediente
        $expediente = Expediente::crear(
            $modelo->numero,
            $modelo->descripcion,
            $modelo->interno,
            $oficinaActual,
            $gestionante,
            $estado,
            $usuarioCreador
        );

        // Asignar el ID
        $expediente->asignarIdDesdeBD($modelo->id);

        return $expediente;
    }
}
