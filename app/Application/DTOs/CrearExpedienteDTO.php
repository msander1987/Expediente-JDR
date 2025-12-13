<?php

namespace App\Application\DTOs;


/*
Al poner READONLY en la clase:

 - Las propiedades son public, por lo que se pueden acceder directamente($dto->descripcion).

- Pero son Inmutables: Una vez que se crea el DTO, nadie puede cambiar el valor. 
Si se intenta $dto->descripcion = "Otra cosa"; PHP lanzará un error.

*/
readonly class CrearExpedienteDTO
{
//Constructor con promoción de propiedades
//DECLARA, CREA e INICIALIZA las propiedades en un solo paso


    public function __construct(
        public string $descripcion,
        public bool $esInterno,
        // Pedimos QUIÉN lo crea, no DÓNDE, para saber la oficina origen.
        // El servicio deducirá el "dónde" a partir del id del usuario creador.
        public int $idUsuarioCreador, //será el usuario logueado
        public int $idGestionante
    ) {}
}
