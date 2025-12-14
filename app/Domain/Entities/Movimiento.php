<?php

namespace App\Domain\Entities;

use DateTime;
use App\Domain\ValueObjects\Firma; 
use App\Domain\Entities\Oficina;
use App\Domain\Entities\Usuario;
use App\Domain\Entities\Adjunto;

class Movimiento {
    //PROPIEDADES
    private ?int $id = null; // Nulable, por defecto null
    private DateTime $fecha;
    private Oficina $oficinaOrigen;
    private Oficina $oficinaDestino;
    private Usuario $funcionario; // El usuario que REALIZA el movimiento
    private ?Firma $firma = null; // La firma es OPCIONAL (nulable)
    private array $adjuntos = [];

    //CONSTRUCTOR vacío para Eloquent
    public function __construct()
    {
    }

    // MÉTODO FÁBRICA ESTÁTICO (para CREAR)
    // ExpedienteService llamará a este método

    public static function crear(
        Oficina $oficinaOrigen,
        Oficina $oficinaDestino,
        Usuario $funcionario 
    ): self {
        $movimiento = new self(); // Llama al constructor vacío

        // Asigna los valores iniciales y por defecto
        $movimiento->fecha = new DateTime();
        $movimiento->oficinaOrigen = $oficinaOrigen;
        $movimiento->oficinaDestino = $oficinaDestino;
        $movimiento->funcionario = $funcionario;

        return $movimiento;
    }

    

    //GETTERS

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): DateTime
    {
        return $this->fecha;
    }

    public function getOficinaOrigen(): Oficina
    {
        return $this->oficinaOrigen;
    }

    public function getOficinaDestino(): Oficina
    {
        return $this->oficinaDestino;
    }

    public function getFuncionario(): Usuario
    {
        return $this->funcionario;
    }

    public function getFirma(): ?Firma
    {
        return $this->firma;
    }

    public function getAdjuntos(): array
    {
        return $this->adjuntos;
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