<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename('destino_externos', 'destinos_externos'); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('destinos_externos', 'destino_externos');
    }
};
