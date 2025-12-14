<?php

namespace App\Domain\Entities;

use DateTime;

class Adjunto {
    private ?int $id = null;
    private string $nombreOriginal;
    private string $path;
    private string $tipoMIME;
    private int $tamanhoBytes;
    private DateTime $fechaSubida;

    // Constructor vacío para el ORM
    public function __construct() {}

    // Método de fábrica para crear un Adjunto
    public static function crear(
        string $nombreOriginal,
        string $path,
        string $tipoMIME,
        int $tamanhoBytes
    ): self {
        $adjunto = new self();
        $adjunto->nombreOriginal = $nombreOriginal;
        $adjunto->path = $path;
        $adjunto->tipoMIME = $tipoMIME;
        $adjunto->tamanhoBytes = $tamanhoBytes;
        $adjunto->fechaSubida = new DateTime();
        return $adjunto;
    }

    // GETTERS
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreOriginal(): string
    {
        return $this->nombreOriginal;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getTipoMIME(): string
    {
        return $this->tipoMIME;
    }

    public function getTamanhoBytes(): int
    {
        return $this->tamanhoBytes;
    }

    public function getFechaSubida(): DateTime
    {
        return $this->fechaSubida;
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