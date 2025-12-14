<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Application\Services\ExpedienteService;
use App\Http\Requests\StoreExpedienteRequest;
use App\Application\DTOs\CrearExpedienteDTO;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class ExpedienteController extends Controller
{

    // Constructor:  inyectamos el ExpedienteService
    public function __construct(
        private ExpedienteService $expedienteService
    ) {}

    //El método 'store' recibe el Request VALIDADO y devuelve un objeto JsonResponse
    public function store(StoreExpedienteRequest $request): JsonResponse
    {
        // 1. Obtener los datos limpios del Request
        //validated(): heredada de FormRequest, devuelve un array que tiene solo los campos definidos en rules()
        //$datos es un array asociativo con los datos validados
        //Toma el JSON del body y lo filtra según las reglas definidas en StoreExpedienteRequest
        //Ejemplo: ['descripcion' => 'Expediente sobre asunto X', 'esInterno' => true, 'idGestionante' => 5]
        $datos = $request->validated();

        // 2. Obtener el ID del usuario logueado (Garantizado por middleware auth:sanctum)
        //Auth: fachada de Laravel para autenticación
        $idUsuario = Auth::id(); //Devuelve el id del usuario logueado o null.


        /* Si el usuario no está logueado, devolvemos un error 401 Unauthorized
        Con el middleware 'auth:sanctum' esto no debería pasar nunca, por eso queda comentado
        if (!$idUsuario || $idUsuario ==null) {
            return response()->json([
                'error' => 'Usuario no autenticado'
            ], 401);
        }*/

        // 3. Crear el DTO con esos datos
        //Hago asignación directa con argumentos nombrados, obteniendo los valores del array $datos
        //Casteo a los tipos estrictos de mi DTO

        $dto = new CrearExpedienteDTO(
            descripcion: $datos['descripcion'],
            esInterno: (bool) $datos['esInterno'],
            idUsuarioCreador: $idUsuario,
            idGestionante: (int) $datos['idGestionante']
        );



        try {
            // 4. Llamo al método crearExpediente del Service y le paso el dto
            $nuevoExpediente = $this->expedienteService->crearExpediente($dto);

            // 5. Si llegamos acá, no hubo errores
            //Devuelvo una respuesta JSON
            //el método json(), convierte el array PHP en un string Json, pone las cabeceras y asigna el código de estado

            $respuesta= response()->json([
                'mensaje' => 'Expediente creado con éxito',
                'data' => [
                    'id' => $nuevoExpediente->getId(),
                    'descripcion' => $nuevoExpediente->getDescripcion(),
                    'numero' => $nuevoExpediente->getNumero(),
                    'fecha' => $nuevoExpediente->getFechaIngreso()->format('d-m-Y H:i')
                ]
            ], 201); // Código 201 = Created

        } catch (\Exception $e) {
            // Si algo falló en el servicio (ej: gestionante no existe), devolvemos error 400
            $respuesta= response()->json([
                'error' => $e->getMessage()
            ], 400);
        }

        return $respuesta;
    }
}
