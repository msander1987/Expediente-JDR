<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles'; // Nombre de la tabla en la base de datos

    // Configuración de campos (Seguridad)
    
    protected $fillable = ['nombre']; 

    // Un rol se vincula a muchos usuarios

    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }
}
