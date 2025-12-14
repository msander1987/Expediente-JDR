<?php

namespace App\Domain\Entities;

class Oficina {

    //ATRIBUTOS

    private ?int $id = null;
    private string $nombre;
    private bool $activo;

    public function __construct() {}

    public static function crear(string $nombre): self
    {
        $oficina = new self();

        $oficina->nombre = $nombre;
        $oficina->activo = true;

        return $oficina;
    }


    //GETTERS

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;

    }
    public function isActivo(): bool
    {
        return $this->activo;
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
