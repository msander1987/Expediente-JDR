<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movimiento extends Model
{
    use SoftDeletes;

    // Configuración
    protected $table = 'movimientos'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'expediente_id',
        'fecha',
        'oficina_origen_id',
        'oficina_destino_id',
        'funcionario_id',
        'firma_hash',
        'firma_fecha',
        'firma_firmante_id'
    ];

    //CASTEOS

    protected $casts = [
        'fecha' => 'datetime',
        'firma_fecha' => 'datetime',
    ];

    // Relaciones

    //Un Movimiento es de un expediente
    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }

    //Un Movimiento tiene una oficina de origen
    public function oficinaOrigen()
    {
        return $this->belongsTo(Oficina::class, 'oficina_origen_id');
    }
    //Un Movimiento tiene una oficina de destino
    public function oficinaDestino()
    {
        return $this->belongsTo(Oficina::class, 'oficina_destino_id');
    }

    //Un Movimiento es de un funcionario
    public function funcionario()
    {
        return $this->belongsTo(Usuario::class, 'funcionario_id');
    }

    // Un movimiento puede tener muchos adjuntos
    public function adjuntos()
    {
        return $this->hasMany(Adjunto::class);
    }
}
