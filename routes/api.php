<?php

//Este archivo se crea en la terminal con el comando:
//php artisan install:api
//todas las rutas que se ponen aquí automáticamente tienen el prefijo /api
//se instala Sanctum para autenticación de API Tokens

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpedienteController;

// Grupo de rutas protegidas con autenticación Sanctum
Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // RUTA PARA CREAR EXPEDIENTES
    // Esto habilita: POST http://localhost:8000/api/expedientes
    /* Definición de Ruta (Endpoint) para Crear Expedientes:
     1. Route::post  -> Define que solo aceptamos el verbo HTTP POST (usado para CREAR).
     2. '/expedientes' -> Es la URI. Al estar en el archivo api.php, Laravel le antepone '/api' automáticamente.
                          La URL final será: http://localhost:8000/api/expedientes
     3. [Clase, Método] -> El array define quién atiende la petición:
          - ExpedienteController::class : Referencia estática a la clase (permite hacer Ctrl+Clic en el editor).
          - 'store' : El nombre exacto del método dentro del controlador que ejecutará la lógica.*/
    Route::post('/expedientes', [ExpedienteController::class, 'store']);
});