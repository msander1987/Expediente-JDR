<?php

namespace App\Domain\Entities;

class EstadoExpediente
{
    private ?int $id = null;
    private string $nombre;

    // Constructor vacío para el ORM
    public function __construct() {}

    // Método de fábrica para crear un EstadoExpediente
    public static function crear(string $nombre): self
    {
        $estado = new self();
        $estado->nombre = $nombre;
        return $estado;
    }

    // Factory temporal
    // TODO: Borrar este método cuando exista el repositorio de estados
    public static function crearTemporal(int $id, string $nombre): self
    {
        $estado = new self();
        $estado->id = $id;      // Acceso permitido por estar dentro de la clase
        $estado->nombre = $nombre;
        return $estado;
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
}
