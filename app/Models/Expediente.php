<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expediente extends Model
{
    use SoftDeletes;

    // Configuración
    protected $table = 'expedientes'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'numero',
        'descripcion',
        'fecha_ingreso',
        'interno',
        'reservado',
        'confidencial',
        'estado_expediente_id',
        'gestionante_id',
        'usuario_creador_id',
        'oficina_origen_id',
        'oficina_actual_id',
    ];

    //CASTEOS

    protected $casts = [

        'fecha_ingreso' => 'datetime',
        'interno'      => 'boolean',
        'reservado'    => 'boolean',
        'confidencial' => 'boolean',

    ];

    // Relaciones

    //Un expediente tiene un estado
    public function estadoExpediente()
    {
        return $this->belongsTo(EstadoExpediente::class);
    }

    //Un Expediente tiene  una oficina de origen
    public function oficinaOrigen()
    {
        return $this->belongsTo(Oficina::class, 'oficina_origen_id');
    }

    //Un Expediente tiene una oficina actual
    public function oficinaActual()
    {
        return $this->belongsTo(Oficina::class, 'oficina_actual_id');
    }

    //Un Expediente es de un gestionante
    public function gestionante()
    {
        return $this->belongsTo(Gestionante::class, 'gestionante_id');
    }


    //Un expediente fue creado por un usuario    
    public function usuarioCreador()
    {
        return $this->belongsTo(Usuario::class, 'usuario_creador_id');
    }

    //Un expediente puede tener muchos movimientos

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }

    // Un expediente puede tener muchos destinos externos
    //TENEMOS TABLA INTERMEDIA destino_externo_expediente: belongsToMany

    public function destinosExternos()
    {
        return $this->belongsToMany(
            DestinoExterno::class,
            'destino_externo_expediente', // Nombre de la TABLA PIVOT (Intermedia)
            'expediente_id',  // Mi clave en esa tabla
            'destino_externo_id'      // La clave del otro en esa tabla     

        )->withTimestamps();
    }
}
