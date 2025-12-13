<?php

namespace App\Domain\Entities;

class Gestionante
{

    private ?int $id = null;
    private string $nombre;
    private ?string $apellido;
    private string $identificador;
    private ?string $domicilio;
    private ?string $email;
    private string $telefono;
    private CategoriaGestionante $categoria;



    public function __construct() {}

    public static function crear(
        string $nombre,
        string $identificador,
        ?string $email=null,
        string $telefono,
        CategoriaGestionante $categoria,
        ?string $apellido = null,
        ?string $domicilio = null
    ): self {
        $gestionante = new self();

        $gestionante->nombre = $nombre;
        $gestionante->identificador = $identificador;
        $gestionante->categoria = $categoria;
        $gestionante->apellido = $apellido;
        $gestionante->domicilio = $domicilio;
        $gestionante->email = $email;
        $gestionante->telefono = $telefono;
        return $gestionante;
    }


    // GETTERS

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function getIdentificador(): string
    {
        return $this->identificador;
    }

    public function getDomicilio(): ?string
    {
        return $this->domicilio;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getTelefono(): string
    {
        return $this->telefono;
    }


    public function getCategoria(): CategoriaGestionante
    {
        return $this->categoria;
    }
}
