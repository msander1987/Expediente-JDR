<?php

//ESta clase se ha generado ejecutando en terminal el comando:
//php artisan make:request StoreExpedienteRequest

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//Hereda de FormRequest, que a su vez hereda de Request

class StoreExpedienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //Dejamos pasar a todo los usuarios logueados
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            // NOMBRE DEL CAMPO (DTO)  =>  REGLAS

            'descripcion' => 'required|string|max:255',
            'esInterno' => 'required|boolean',
            'idGestionante' => 'required|integer|exists:gestionantes,id',

            /*|exists:gestionantes,id'
            Laravel verifica que en la tabla Gestionantes de la BD, 
            exista el id que me mandaron
            */
            
        ];
    }
}
