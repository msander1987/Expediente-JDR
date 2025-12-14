<?php

namespace App\Domain\Entities;

class Usuario
{
    private ?int $id = null;
    private string $nombre;
    private string $apellido;
    private string $cedula;
    private string $password;
    private string $email;
    private bool $activo;
    private Oficina $oficina;
    private ?string $firma;
    private Rol $rol;

    // Constructor vacío para el ORM
    public function __construct() {}

    // Método de fábrica para crear un Usuario
    public static function crear(
        string $nombre,
        string $apellido,
        string $cedula,
        string $password,
        string $email,
        Oficina $oficina,
        ?string $firma,
        Rol $rol
    ): self {
        $usuario = new self();
        $usuario->nombre = $nombre;
        $usuario->apellido = $apellido;
        $usuario->cedula = $cedula;
        $usuario->password = $password;
        $usuario->email = $email;
        $usuario->activo = true; // Por defecto está activo
        $usuario->oficina = $oficina;
        $usuario->firma = $firma;
        $usuario->rol = $rol;

        return $usuario;
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

    public function getApellido(): string
    {
        return $this->apellido;
    }

    public function getCedula(): string
    {
        return $this->cedula;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function isActivo(): bool
    {
        return $this->activo;
    }

    public function getOficina(): Oficina
    {
        return $this->oficina;
    }

    public function getFirma(): ?string
    {
        return $this->firma;
    }

    public function getRol(): Rol
    {
        return $this->rol;
    }

    /**
     * Hidrata el ID de la entidad después de persistir en BD.
     * Solo debe ser invocado por el repositorio.
     */
    public function asignarIdDesdeBD(int $id): void
    {
        $this->id = $id;
    }
}