<?php

namespace App\Domain\Entities;

class DestinoExterno
{
    private ?int $id = null;
    private string $nombre;

    // Constructor vacío para el ORM
    public function __construct() {}

    // Método de fábrica para crear un DestinoExterno
    public static function crear(string $nombre): self
    {
        $destino = new self();
        $destino->nombre = $nombre;
        return $destino;
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
