<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoExpediente extends Model
{
     protected $table = 'estado_expedientes'; // Nombre de la tabla en la base de datos

    // Configuración de campos (Seguridad)
    
    protected $fillable = ['nombre']; 

    // Un estado se vincula a muchos expedientes

    public function expedientes()
    {
        return $this->hasMany(Expediente::class);
    }
}
