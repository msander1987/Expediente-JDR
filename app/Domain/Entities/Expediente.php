<?php

namespace App\Domain\Entities;

use DateTime;
use App\Domain\Entities\EstadoExpediente;
use App\Domain\Entities\Oficina;
use App\Domain\Entities\Gestionante;

class Expediente {

    private ?int $id = null;
    private string $numero; // El número de negocio, ej: "1/2025"
    private string $descripcion;
    private \DateTime $fechaIngreso;
    private bool $reservado;
    private bool $confidencial;
    private bool $interno;
    private EstadoExpediente $estado;
    private Oficina $oficinaActual;
    private Gestionante $gestionante;
    private array $movimientos;
    private array $destinos;

    // Constructor vacío para el ORM
    public function __construct() {}

    // Método de fábrica para crear un Expediente nuevo
    public static function crear(

        string $numero,
        string $descripcion,
        bool $interno,
        Oficina $oficinaActual,
        Gestionante $gestionante
    ): self {

        $expediente = new self();

        $expediente->numero = $numero; // <-- Asignado
        $expediente->descripcion = $descripcion;
        $expediente->fechaIngreso = new DateTime();
        $expediente->reservado = false;
        $expediente->confidencial = false;
        $expediente->interno = $interno;
        $expediente->estado = $expediente->estadoInicial(); // Estado inicial "EN_TRAMITE"
        $expediente->oficinaActual = $oficinaActual;
        $expediente->gestionante = $gestionante;
        $expediente->movimientos = [];
        $expediente->destinos = [];

        return $expediente;
    }

    // Método "stub" temporal
    private function estadoInicial(): EstadoExpediente
    {

        //TODO: Definir el estado inicial trayéndolo de la base de datos
        // Por ahora, se crea un estado temporal
        return EstadoExpediente::crearTemporal(1, 'EN_TRAMITE');
    }

    // GETTERS
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): string
    {
        return $this->numero;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function getFechaIngreso(): \DateTime
    {
        return $this->fechaIngreso;
    }
    public function isReservado(): bool
    {
        return $this->reservado;
    }
    public function isConfidencial(): bool
    {
        return $this->confidencial;
    }
    public function isInterno(): bool
    {
        return $this->interno;
    }
    public function getEstado(): EstadoExpediente
    {
        return $this->estado;
    }
    public function getOficinaActual(): Oficina
    {
        return $this->oficinaActual;
    }
    public function getGestionante(): Gestionante
    {
        return $this->gestionante;
    }

    public function getMovimientos(): array
    {
        return $this->movimientos;
    }
    public function getDestinos(): array
    {
        return $this->destinos;
    }
}
