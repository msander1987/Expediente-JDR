<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaGestionante extends Model
{
      protected $table = 'categoria_gestionantes'; // Nombre de la tabla en la base de datos

    // Configuración de campos (Seguridad)
    
    protected $fillable = ['nombre']; 

    // Una categoría se vincula a muchos gestionantes

    public function gestionantes()
    {
        return $this->hasMany(Gestionante::class);
    }
}
