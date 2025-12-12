<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/* NO extiende de Models
|Extends Authenticatable (para que sea reconocido como 'user')
|Obtiene automáticamente los métodos para verificar contraseñas (hashes), 
recordar sesiones ("Remember me") y manejar tokens de seguridad*/

class Usuario extends Authenticatable
{
    /*Traits para funcionalides extras
    |HasFactory: Permite usar "Factories" para generar usuarios falsos (fakes) en pruebas automáticas.
    |Notifiable: Le da al usuario la capacidad de recibir notificaciones ($usuario->notify(new NuevoExpediente())) por email, SMS o Slack.
    |SoftDeletes: Activa la "Papelera de Reciclaje". Cuando se haga  $usuario->delete(), 
    Laravel solo llenará el campo deleted_at y dejará de mostrar al usuario en las consultas, 
    pero no lo borrará físicamente.*/
    use HasFactory, Notifiable, SoftDeletes;

    // Avisa explícitamente el nombre de la tabla (opcional si se sigue convención)
    protected $table = 'usuarios';

    // Campos que se pueden llenar masivamente
    //$fillable: Laravel solo permitirá guardar en la base de datos los campos que estén en esta lista. 
    //Cualquier otro campo que venga en el formulario será ignorado y descartado.
    protected $fillable = [

        'cedula', 
        'password',
        'nombre', 
        'apellido',  
        'email',      
        'firma',      
        'oficina_id', 
        'role_id', 
        'activo'
        
    ];

    // Ocultar el password o el token de sesión para que no salgan en respuestas JSON por API y terminen expuestos
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'activo' => 'boolean',
    ];

    /**
     * Define cuál es el campo que se usa para el Login.
     * Por defecto Laravel busca 'email', aquí lo forzamos a 'cedula'.
     */
    public function username()
    {
        return 'cedula';
    }


    /*
    
    Clase Usuario es un componente inteligente que:

        ->Sabe loguearse (Authenticatable).

        ->Sabe protegerse de hackeos (fillable).

        ->Sabe ocultar la información sensible (hidden).

        ->Sabe que su "nombre de usuario" es la cédula.
    
    */
}
