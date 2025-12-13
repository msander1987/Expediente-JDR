<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Adjunto extends Model
{

    use SoftDeletes;

    protected $table = 'adjuntos'; // Nombre de la tabla en la base de datos

    // Configuración de campos (Seguridad)

    protected $fillable = ['nombre_original', 'path', 'tipo_mime', 'tamanho_bytes', 'fecha_subida', 'movimiento_id'];

    /**
     * Los atributos que se deben convertir a tipos nativos.
     * Esto hace que 'fecha_subida' sea un objeto Carbon (librería de php con funciones de fecha)
     * en lugar de un simple string.
     */
    protected $casts = [
        'fecha_subida' => 'datetime',
        'tamanho_bytes' => 'integer',
    ];



    // Un adjunto se vincula a un Movimiento
    public function movimiento()
    {
        return $this->belongsTo(Movimiento::class);
    }
}
