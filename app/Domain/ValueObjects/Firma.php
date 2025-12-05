<?php

namespace App\Domain\ValueObjects;

use App\Domain\Entities\Usuario;
use DateTimeImmutable;

class Firma
{
    // PROPIEDADES 
    private DateTimeImmutable $fechaFirma;
    private Usuario $firmante;
    private string $firmaAplicada; // El hash o token criptográfico

    // CONSTRUCTOR
    // En los Value Objects, el constructor SÍ puede recibir argumentos
    // porque no son entidades que el ORM hidrata vacías,
    // sino objetos que CREAMOS completos de una vez.
    public function __construct(
        Usuario $firmante,
        string $firmaAplicada,
        ?DateTimeImmutable $fechaFirma = null // Opcional, si no se pasa, es ahora.
    ) {
        $this->firmante = $firmante;
        $this->firmaAplicada = $firmaAplicada;
        // Si no pasan fecha, usamos "ahora" inmutable
        $this->fechaFirma = $fechaFirma ?? new DateTimeImmutable();
    }

    // GETTERS
    public function getFechaFirma(): DateTimeImmutable
    {
        return $this->fechaFirma;
    }

    public function getFirmante(): Usuario
    {
        return $this->firmante;
    }

    public function getFirmaAplicada(): string
    {
        return $this->firmaAplicada;
    }
    
    // MÉTODO DE IGUALDAD 
    
    public function equals(Firma $otraFirma): bool
    {
        return $this->firmaAplicada === $otraFirma->getFirmaAplicada()
            && $this->firmante->getId() === $otraFirma->getFirmante()->getId();
    }
}