<?php

namespace App\Domain\Entities;

class Gestionante
{

    private ?int $id = null;
    private string $nombre;
    private string $cedula;
    private ?string $domicilio;
    private ?string $email;
    private ?int $telefono;
    private CategoriaGestionante $categoria;



    public function __construct() {}

    public static function crear(
        string $nombre,
        string $cedula,
        ?string $domicilio = null,
        ?string $email = null,
        ?int $telefono = null,
        CategoriaGestionante $categoria,
    ): self {
        $gestionante = new self();

        $gestionante->nombre = $nombre;
        $gestionante->cedula = $cedula;
        $gestionante->categoria = $categoria;
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

    public function getCedula(): string
    {
        return $this->cedula;
    }

    public function getDomicilio(): ?string
    {
        return $this->domicilio;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getTelefono(): ?int
    {
        return $this->telefono;
    }


    public function getCategoria(): CategoriaGestionante
    {
        return $this->categoria;
    }
}
