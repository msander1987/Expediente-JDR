<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Registro de bindings: Interfaz → Implementación
        // Laravel usará estos bindings para resolver las dependencias automáticamente

        /*Ejemplo: Esto le dice a Laravel que si alguien necesita ExpedienteRepositoryInterface, 
       debe inyectarle EloquentExpedienteRepository".*/
        $this->app->bind(
            \App\Domain\Repositories\ExpedienteRepositoryInterface::class,
            \App\Infrastructure\Repositories\EloquentExpedienteRepository::class
        );

        $this->app->bind(
            \App\Domain\Repositories\UsuarioRepositoryInterface::class,
            \App\Infrastructure\Repositories\EloquentUsuarioRepository::class
        );

        $this->app->bind(
            \App\Domain\Repositories\GestionanteRepositoryInterface::class,
            \App\Infrastructure\Repositories\EloquentGestionanteRepository::class
        );

        $this->app->bind(
            \App\Domain\Repositories\EstadoExpedienteRepositoryInterface::class,
            \App\Infrastructure\Repositories\EloquentEstadoExpedienteRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
