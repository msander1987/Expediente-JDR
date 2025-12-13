<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gestionante extends Model
{
    use SoftDeletes; //Activar el borrado lógico

    protected $table = 'gestionantes'; // Nombre de la tabla en la base de datos

    // Configuración de campos (Seguridad)

    protected $fillable = ['nombre', 'apellido', 'identificador', 'domicilio', 'email', 'telefono', 'categoria_gestionante_id'];

    //Un gestionante tiene UNA categoria

    public function categoriaGestionante() // <-- Nombre en SINGULAR
    {

        //Deberìamos especificar la llave foránea si no sigue la convención (nombre clase en minúscula + _id)
        //Sería un segundo parámetro en belongsTo()

        return $this->belongsTo(CategoriaGestionante::class);
    }

    // Un gestionante se vincula a muchos expedentes

    public function expedientes() // <--nombre en PLURAL
    {
        return $this->hasMany(Expediente::class);
    }
}
