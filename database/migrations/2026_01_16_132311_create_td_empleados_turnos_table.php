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
        Schema::create('td_empleados_turnos', function (Blueprint $table) {
            $table->id();
            $table->biginteger('persona_id')->unsigned();
            $table->biginteger('turno_id')->unsigned();
            $table->datetime('fecha_inicio');
            $table->datetime('fecha_fin')->nullable();
            $table->boolean('horas_extras')->default(false);
            $table->char('estado', 1)->default('A');
            $table->string('usuario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('td_empleados_turnos');
    }
};
