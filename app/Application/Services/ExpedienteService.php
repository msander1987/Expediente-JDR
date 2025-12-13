<?php

namespace App\Application\Services;

use App\Application\DTOs\CrearExpedienteDTO;
use App\Domain\Entities\Expediente;
use App\Domain\Repositories\ExpedienteRepositoryInterface;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Domain\Repositories\GestionanteRepositoryInterface;
use App\Domain\Repositories\EstadoExpedienteRepositoryInterface;
use Exception;


class ExpedienteService
{

    // Inyectamos todos los repositorios que necesitamos

    public function __construct(

        private ExpedienteRepositoryInterface $expedienteRepo,
        private UsuarioRepositoryInterface $usuarioRepo,
        private GestionanteRepositoryInterface $gestionanteRepo,
        private EstadoExpedienteRepositoryInterface $estadoRepo,


    ) {}

    //TODO: Refactorizar a excepciones de dominio personalizadas
    
    //CU-01 - Crear Expediente

    public function crearExpediente(CrearExpedienteDTO $dto): Expediente
    {

        /* NOTA: Omitimos validaciones de formato (nulos, tipos, rangos) porque:
        1. El DTO garantiza tipos estrictos como int, bool, string.
        2. El FormRequest actúa como filtro previo en el Controlador.
        Aquí nos enfocamos exclusivamente en validar reglas de negocio (existencia en BD, estado, etc.)*/



        //Me traigo el usuario creador (logueado)
        $usuarioLogueado = $this->usuarioRepo->buscarPorId($dto->idUsuarioCreador);

        if ($usuarioLogueado == null) {

            throw new Exception("No se ha encontrado al usuario creador");
        }

        //Obtengo la oficinaActual del usuario

        $oficinaActual = $usuarioLogueado->getOficina();

        //Me traigo el gestionante

        $gestionante = $this->gestionanteRepo->buscarPorId($dto->idGestionante);

        if ($gestionante == null) {

            throw new Exception("No se ha encontrado el gestionante seleccionado");
        }


        //Me traigo el estado inicial (será siempre EN_TRAMITE)

        $estadoInicial = $this->estadoRepo->buscarEstadoInicial();

        if ($estadoInicial == null) {

            throw new Exception("Error crítico: No se encuentra el estado inicial 'EN TRAMITE' en el sistema.");
        }


        //Genero el número de expediente

        $numeroExpediente = $this->generarNumeroExpediente();

        //Creo el expediente

        $expedienteCreado = Expediente::crear(
            $numeroExpediente,
            $dto->descripcion,
            $dto->esInterno,
            $oficinaActual,
            $gestionante,
            $estadoInicial,
            $usuarioLogueado
        );

   

        //lo guardo en la BD

        $this->expedienteRepo->guardar($expedienteCreado);

        //retorno el nuevo expediente creado

        return $expedienteCreado;
    }




    private function generarNumeroExpediente(): string
    {

        $ultimoNumeroString = $this->expedienteRepo->obtenerUltimoNumero();

        //Extraer el año actual del sistema
        //date('Y'): Devuelve el año actual en formato de 4 dígitos (ej: "2025")
        $anhoActual = date('Y');
        $nuevoSecuencial = 1; // Valor por defecto (reinicio o primer expediente del sistema)


        if ($ultimoNumeroString != null) {

            /* Extraer el número secuencial y el año del último número
            => explode('/', $ultimoNumero): Divide el string $ultimoNumero usando el carácter "/" como separador 
            y devuelve un array.
            => [$secuencial, $anho] = ...: Asigna cada elemento del array resultante a variables individuales
            en una sola línea (destructuring de arrays)*/

            [$secuencialUltimo, $anho] = explode('/', $ultimoNumeroString);

            if ($anho == $anhoActual) {
                // Mismo año, incrementar el secuencialUltimo
                // Si son distintos, $nuevoSecuencial se mantiene en 1.
                $nuevoSecuencial = (int)$secuencialUltimo + 1;
            }
        }

        $numeroExpediente = $nuevoSecuencial . '/' . $anhoActual;

        return $numeroExpediente;
    }



}
