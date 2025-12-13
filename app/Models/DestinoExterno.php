<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinoExterno extends Model
{
    protected $table = 'destinos_externos'; // Nombre de la tabla en la base de datos

    // Configuración de campos (Seguridad)

    protected $fillable = ['nombre'];



    // Un destino externo se vincula a muchos expedientes y muchos expedientes tienen el mismo destino externo
    //Tenemos tabla intermedia destino_externo_expediente: belongsToMany

    public function expedientes()
    {
        return $this->belongsToMany(
            Expediente::class,              // Con quién me relaciono
            'destino_externo_expediente',   // Nombre de la TABLA PIVOT (Intermedia)
            'destino_externo_id',           // Mi clave en esa tabla
            'expediente_id'                 // La clave del otro en esa tabla
        )->withTimestamps();
    }
}
