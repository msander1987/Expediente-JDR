<?php

namespace App\Domain\Entities;

class CategoriaGestionante
{
    private ?int $id = null;
    private string $nombre;

    // Constructor vacío para el ORM
    public function __construct() {}

    // Método de fábrica para crear una CategoriaGestionante
    public static function crear(string $nombre): self
    {
        $categoria = new self();
        $categoria->nombre = $nombre;
        return $categoria;
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
    /**
     * Hidrata el ID de la entidad después de persistir en BD.
     * Solo debe ser invocado por el repositorio.
     */
    public function asignarIdDesdeBD(int $id): void
    {
        $this->id = $id;
    }
}
