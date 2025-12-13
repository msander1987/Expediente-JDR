<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    // Configuración
    protected $table = 'oficinas'; // Nombre de la tabla en la base de datos

    protected $fillable = ['nombre', 'activo'];

    //Casteo

    protected $casts = [
        'activo' => 'boolean',
    ];

    // Relaciones

    //Una oficina se vincula a muchos usuarios
    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }

    //Una oficina puede tener muchos expedientes actuales
    public function expedientesActuales()
    {
        return $this->hasMany(Expediente::class, 'oficina_actual_id');
    }

    //Una oficina puede tener muchos expedientes originados
    public function expedientesOriginados()
    {
        return $this->hasMany(Expediente::class, 'oficina_origen_id');
    }

    //Una oficina puede tener muchos movimientos de origen
    public function movimientosOrigen()
    {
        return $this->hasMany(Movimiento::class, 'oficina_origen_id');
    }

    //Una oficina puede tener muchos movimientos de destino
    public function movimientosDestino()
    {
        return $this->hasMany(Movimiento::class, 'oficina_destino_id');
    }
}
